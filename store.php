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
  echo "<p>not right username!!!!!!!!!!!!!!!!!!!!!</p>";
}
else {
  if(password_verify($_SESSION["pass"],$pass[0])){
    echo "<p>logged in</p>";
  }
  else{
    // header("Location: login.php");
    // exit;
    echo "<p>not right password!!!!!!!!!!!!!!!!!!</p>";
  }
}

?>

<!DOCTYPE html>
<html  lang=en-US>
<head>
  <title>  Store Page  </title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link rel="stylesheet" href="style.css">
  <style>
    body{
        text-align: center;
    }
    #products table, th, td{
        /* border: 2px solid black; */
    }

  </style>
</head>
  <body>
    <h1>Store Home Page</h1>

    <?php
    echo "<h2>Welcome {$_SESSION['uName']}!!!</h2>";
    ?>
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


  </body>
</html>
