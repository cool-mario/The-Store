<?php 
session_start(); 
// go to login if user is not signed in
if(!isset($_SESSION["uName"])){
    header("Location: login.php");
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

if (isset($_POST["buy"])){

    $itemID = $_POST["buy"];

    // add item to shopping cart
    if (empty($_SESSION["cart"][$itemID])){
        // create NEW item in cart
        $_SESSION["cart"][$itemID] = 1;
    } else {
        // increase amount of items 
        $_SESSION["cart"][$itemID]++;
    }

    // add the item to the database so that it's saved every time (note: this used to be in checkout.php)
    $sth = $dbh->prepare("INSERT INTO `cart` 
                              (`user_id`, `item_id`)
                          VALUES
                              (:userID, :itemID)    
                        ");
    $sth->bindValue(":userID", $_SESSION["userID"]);
    $sth->bindValue(":itemID", $itemID);
    $sth->execute();

    header( "Location: store.php"); // go back to store

    echo "<h2>Added to your shopping cart!</h2>";
    echo '<a href="store.php">Go back</a>';
}

?>
    
</body>
</html>
