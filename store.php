<?php
session_start();
require_once "config.php";
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

// if the user registered
if (isset($_POST["inputName"])){
    $_SESSION["uName"] = $_POST["inputName"];
    $_SESSION["pass"] = password_hash($_POST["inputPass"], PASSWORD_DEFAULT);

    $sth = $dbh->prepare("SELECT uName FROM `users` WHERE uName = :enteredName");
    $sth->bindValue(":enteredName",$_SESSION["uName"]);
    $sth->execute();
    $checkName = $sth->fetch();
    echo $_SESSION["uName"];
    echo "<br>";
    // if name does not exist
    if($checkName == ""){
        // Add this new user to the database
        $sth = $dbh->prepare("INSERT INTO `users` (`uName`,`role`,`hashpass`)  VALUES( :user, :roleBool, :pass)");

        $sth->bindValue(":user",$_SESSION["uName"]);
        $sth->bindValue(":roleBool",0);
        $sth->bindValue(":pass",$_SESSION["pass"]);
        $sth->execute();
        echo "<p>Added to user list</p>";
    }

    // save user registering post into in session if it exists
    if (isset($_POST["inputName"])){
        $_SESSION["uName"] = $_POST["inputName"];
    }
    if (isset($_POST["inputPass"])){ // don't password hash this! it's mean to be the passwrod string
        $_SESSION["pass"] = $_POST["inputPass"];
    }
}

// if the user didn't register and is logging in
else{

    // save post into in session if it exists
    if (isset($_POST["userName"])){
        $_SESSION["uName"] = $_POST["userName"];
    }
    if (isset($_POST["password"])){
        $_SESSION["pass"] = $_POST["password"];
    }
    // Checking if they are an admin 
    $sth = $dbh->prepare("SELECT `role` FROM `users` WHERE uName = :enteredName");
    $sth->bindValue(":enteredName",$_SESSION["uName"]);
    $sth->execute();
    $admin = $sth->fetch();
    if($admin == 1){
        header( "Location: admin.php");
    }
    else{
        // Password checking
        $sth = $dbh->prepare("SELECT hashpass FROM `users` WHERE uName = :enteredName");
        $sth->bindValue(":enteredName",$_SESSION["uName"]);
        $sth->execute();
        $pass = $sth->fetch();

        // username checking
        $sth = $dbh->prepare("SELECT uName FROM `users` WHERE uName = :enteredName");
        $sth->bindValue(":enteredName",$_SESSION["uName"]);
        $sth->execute();
        $checkName1 = $sth->fetch();

        // if the username and session username don't exist, go to login
        if (empty($checkName1) && !isset($_SESSION["uName"])){
            header( "Location: login.php?m=name"); // go back to sign in if name is wrong
        }

        // check if post doesn't exist, then use session's password
        if (!isset($_POST["password"]) && isset($_SESSION["pass"])){
            if(!password_verify($_SESSION["pass"],$pass[0])){
                header( "Location: login.php?m=pass"); // go back to sign in if password is wrong
            }
            // if just the post password exists
        } elseif (isset($_POST["password"])){
            if(!password_verify($_POST["password"],$pass[0])){
                header( "Location: login.php?m=pass"); // go back to sign in if password is wrong
            }
        }
            
        if($checkName1 == ""){
            header( "Location: login.php?m=name");
        }
  }

}




// after everything is verified save user ID into session
$sth = $dbh->prepare("SELECT id FROM `users` WHERE uName = :enteredName");
$sth->bindValue(":enteredName",$_SESSION["uName"]);
$sth->execute();
$userID = $sth->fetch();
$_SESSION["userID"] = $userID["id"];

// if the user has items saved in cart database, add it into session
$sth = $dbh->prepare("SELECT cart.item_id FROM `cart` 
                      JOIN `users` ON cart.user_id = users.id 
                      JOIN `items` ON cart.item_id = items.id 
                      WHERE cart.user_id = :userID
                    "); // get all items own by user. this took me way tooo long
$sth->bindValue(":userID",$_SESSION["userID"]);
$sth->execute();
$cartItemID = $sth->fetchAll(); // i spent 30 minutes being confused and then i realize It was fetch() and not fetchAll()


// create cart if it doesn't exist
if(!isset($_SESSION["cart"]) || empty($_SESSION["cart"])){
    $_SESSION["cart"] = array();

    // add stuff from sql to session!
    foreach ($cartItemID as $array){
        $itemID = $array["item_id"];
        // add item to shopping cart
        if (!isset($_SESSION["cart"][$itemID]) || empty($_SESSION["cart"][$itemID])){
            // create NEW item in cart
            $_SESSION["cart"][$itemID] = 1;
        } else {
            // increase amount of items 
            $_SESSION["cart"][$itemID]++;
        }
    }
}



?>

<!DOCTYPE html>
<html lang=en-us>
<head>
    <title>  Store Page  </title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <!-- this makes it work on different screen sizes like a phone -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style>
    body{
        text-align: center;
    }
    #products table, th, td{
        /* border: 2px solid black; */
    }
    td, td > * {
        text-align: center;
    }
    button {
        /* nice color */
        background-color:cadetblue; 
    }
    #checkout {
        font-size: 170%;
        padding: 10px;
        border-radius: 10px;
    }
    .dropbtn {
        background-color: rgb(129, 182, 255);
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #4693a2;
        min-width: 160px;
        z-index: 1;
        margin-left: -138px
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: rgb(59 150 200 / 72%);
    }

    .dropdown{
        /* goes to the right!! */
        float:right; 
    }

    img{
        width:120px;
    }

</style>

<?php
$sth = $dbh->prepare("SELECT * FROM items"); 
$sth->execute();
$items = $sth->fetchAll(); 
?>

</head>
  <body>
      <!-- Start of Cart -->
    <div class="dropdown">
    <button class="dropbtn">Cart</button>
    <div class="dropdown-content">
    <?php

        
    // echo "<pre>";
    // var_dump($_SESSION["cart"]);
    // echo "</pre>";

    echo "<table>";
    echo "<tr><th>Item</th><th>Amount</th></tr>";
    foreach ($_SESSION["cart"] as $itemID => $amount){
        echo "<tr>";
        // get the name of the item from the id. it just works....
        echo "<td>{$items[$itemID-1]['name']}</td>";
        echo "<td>{$amount}</td>";
        echo "</tr>";
    }  
    echo "</table>";
    ?>
    </div>
    </div>
  <!-- End of Cart -->
  <h1>Store Home Page</h1>
    <?php
    if(isset($_SESSION['uName'])){
    echo "<h2>Welcome {$_SESSION['uName']}!!!</h2>";
    }
    ?>
    <!-- List of products -->
    <table id="products">
    <?php
    try {
        // Getting PKM

        //   Item Names
        echo "<tr>";   
        foreach($items as $item){
          echo "<td>  " . $item["name"] . "  </td>";
        }
        echo "</tr>";
        //   Item Descriptions
        echo "<tr>";   
        foreach($items as $item){
          echo "<td>  " . $item["desc"] . "  </td>";
        }
        echo "</tr>";
        // Images
        echo "<tr>";   
        foreach($items as $item){
          echo "<td><img src='imgs/" . $item["img"] . "'></td>";
        }
        echo "</tr>";
        //   Item Price
        echo "<tr>";   
        foreach($items as $item){
          echo "<td>  " . $item["price"] . "$  </td>";
        }
        echo "</tr>";
        //   Button to add to cart
        echo "<tr>";   
        foreach($items as $item){
          echo "<td>"; 
          echo "<form action='cart.php' method='post'>";
          echo "<select class='hide' name='buy'>";
          echo "<option value='". $item["id"] ."'>an option</option>";
          echo "</select>";
          echo "<button type='submit'>Add to Cart</button>";
          echo "</form>";
          echo "</td>";
        }
        echo "</tr>";

        
      }
      catch (PDOException $e) {
          echo "<p>Error connecting to database!</p>";
          echo $e->getMessage();
      }
    ?>
    </table>

    <br><br>
    <a href="checkout.php"><button id="checkout">Check out!!</button></a>
    <br><br>
    <a href="signout.php"><button>Sign out</button></a>

  </body>
</html>
