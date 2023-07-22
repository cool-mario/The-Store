<?php
session_start();
require_once "config.php";
$_SESSION["uName"] = $_POST["userName"];
$_SESSION["pass"] = $_POST["password"];
password_hash($_SESSION["pass"], PASSWORD_DEFAULT);




// Password checking
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh->prepare("SELECT hashpass FROM `users` WHERE uName = :enteredName");
$sth->bindValue(":enteredName",$_SESSION["uName"]);
$sth->execute();
$pass = $sth->fetch();

if (!$pass){
    header( "Location: login.php?m=name"); // go back to sign in if name is wrong
}
else {
    if(password_verify($_SESSION["pass"],$pass[0])){
        echo "<p>logged in</p>";
    }
    else{
        header( "Location: login.php?m=pass"); // go back to sign in if password is wrong
    }
}
// create cart if it doesn't exist
if(!isset($_SESSION["cart"])){
  $_SESSION["cart"] = array();
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

  </style>
</head>
  <body>
    <h1>Store Home Page</h1>

    <?php
    echo "<h2>Welcome {$_SESSION['uName']}!!!</h2>";
    var_dump($_SESSION["cart"]);
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
        //   Item Pricce
        echo "<tr>";   
        foreach($items as $item){
          echo "<td>  " . $item["price"] . "  </td>";
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

  </body>
</html>


  </body>
</html>
