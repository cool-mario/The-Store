<?php
session_start();
require_once "config.php";
$_SESSION["uName"] = $_POST["userName"];
$_SESSION["pass"] = $_POST["password"];
var_dump($_POST);
// Password checking
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh->prepare("SELECT * FROM `users` WHERE ");
$sth->execute();
$pass = $sth->fetch();

password_hash($_SESSION["inputPass"], PASSWORD_DEFAULT);
echo password_hash($_SESSION["pass"], PASSWORD_DEFAULT);

if(password_verify($_SESSION["inputPass"],$pass[0] )){
  $_SESSION["user"] = (int)$_POST["trainer"];
  echo "<p>logged in</p>";
}
else{
  header("Location: https://atdpsites.berkeley.edu/achandra/2023_AIC/X11/signin.php");
  exit;
  echo "<p>nmot right!</p>";
}

if(!isset($_SESSION["user"])){
  header("Location: https://atdpsites.berkeley.edu/achandra/2023_AIC/X11/signin.php");
  exit;
}
?>

<!DOCTYPE html>
<html  lang=en-US>
<head>
  <title>  Store Page  </title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <style>
    body{
        text-align: center;
    }
    #products table, th, td{
        border: 2px solid black;
    }

  </style>
</head>
  <body>
    <h1>Store Home Page</h1>
    <!-- List of products -->
    <table id="products">
    <?php
    try {
          // Getting PKM
          $sth = $dbh->prepare("SELECT * FROM items"); 
          $sth->execute();
          $items = $sth->fetchAll(); 
          //   Cycling and inserting items into table   
        foreach($items as $item){
        echo "<tr>";
          echo "<td>" . $item["name"] . "</td>";
          echo "<td>  " . $item["price"] . "  </td>";
          echo "</tr>";
        }
        
      }
      catch (PDOException $e) {
          echo "<p>Error connecting to database!</p>";
          echo $e->getMessage();
      }
    ?>
    </table>

  </body>
</html>
