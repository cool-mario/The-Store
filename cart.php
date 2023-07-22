<?php 
session_start(); 
// if (empty($_SESSION)){
//     header("Location: signin.php"); // redirect to signin if not signed in
//     die();
// }
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

if (isset($_POST["buy"])){

    $itemID = $_POST["buy"];

    // add item to shopping cart
    if (isset($_SESSION["cart"][$itemID])){
        // create new item in cart
        array_push($_SESSION["cart"], array($_POST["buy"] => 1));
    } else {
        // increase amount of items 
        $_SESSION["cart"][$itemID]++;
    }
    // header( "refresh:2; url=store.php"); // wait 2 seconds until going back to the page

    header( "Location: store.php"); // go back to store

    echo "<h2>Added to your shopping cart!</h2>";
}

?>
    
</body>
</html>
