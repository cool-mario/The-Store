<?php 
session_start(); 
if (empty($_SESSION)){
    header("Location: signin.php"); // redirect to signin if not signed in
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Added to shopping cart</title>
</head>
<body>
<?php


var_dump($_POST);
var_dump($_SESSION["cart"]);

// check if the user actually bought something
if (isset($_POST["buy"])){
    // add item to shopping cart
    array_push($_SESSION["cart"], $_POST["buy"]);
    // wait 2 seconds until going back to the page
    header( "refresh:2; url=store.php");

    echo "<h2>Added to your shopping cart!</h2>";
} else {
    // go back if something went wrong
    header('Location: store.php');
}

?>
    
</body>
</html>


