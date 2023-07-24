<?php
session_start();
require_once "config.php";
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
//fixes a bug

if (isset($_POST["inputName"])){
  $_SESSION["iName"] = $_POST["inputName"];
  $_SESSION["iPass"] = password_hash($_POST["inputPass"], PASSWORD_DEFAULT);

  $sth = $dbh->prepare("SELECT uName FROM `users` WHERE uName = :enteredName");
  $sth->bindValue(":enteredName",$_SESSION["iName"]);
  $sth->execute();
  $checkName = $sth->fetch();
  echo $_SESSION["iName"];
  echo "<br>";
  if($checkName == ""){
// Add this new user to the database
    $sth = $dbh->prepare("INSERT INTO `users` (`uName`,`role`,`hashpass`)  VALUES( :user, :roleBool, :pass)");

    $sth->bindValue(":user",$_SESSION["iName"]);
    $sth->bindValue(":roleBool",0);
    $sth->bindValue(":pass",$_SESSION["iPass"]);
    $sth->execute();
    echo "<p>Added to user list</p>";
  }
}
else{




// save post into in session if it exists
if (isset($_POST["userName"])){
    $_SESSION["uName"] = $_POST["userName"];
}
if (isset($_POST["password"])){
    $_SESSION["pass"] = $_POST["password"];
}

// password_hash($_SESSION["pass"], PASSWORD_DEFAULT);



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
// create cart if it doesn't exist
if(!isset($_SESSION["cart"])){
  $_SESSION["cart"] = array();
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

  </style>
</head>
  <body>
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
        $sth = $dbh->prepare("SELECT * FROM items"); 
        $sth->execute();
        $items = $sth->fetchAll(); 
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


    <h2>Shopping cart:</h2>
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
     <br><br>
    <a href="checkout.php"><button>Check Out</button></a>
    <br><br>
    <a href="signout.php"><button>Sign out</button></a>

  </body>
</html>


  </body>
</html>
