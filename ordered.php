<?php
session_start();
require_once "config.php";
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
if(!isset($_SESSION["uName"])){
    header("Location: login.php");
}


// backend validation for the checkout information
// get data from post request
$address = $_POST["address"] ?? null;
$zip = $_POST["zip"] ?? null;
$card = $_POST["card"] ?? null;
$cvc = $_POST["cvc"] ?? null;

// check if the user info given are actually ints
if (filter_var($zip, FILTER_VALIDATE_INT) === false || filter_var($card, FILTER_VALIDATE_INT) === false || filter_var($cvc, FILTER_VALIDATE_INT) === false){
    header("Location: checkout.php?m=error");
    die(); // quit
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            text-align:center;
        }
    </style>

    <title>Thanks for your purchase!!</title>
</head>
<body>

<?php

if (isset($_SESSION["userID"])){
    // delete all items owned by the user in the data
    $sth = $dbh->prepare("DELETE FROM cart 
    WHERE cart.user_id = :userID
    ");
    $sth->bindValue(":userID", $_SESSION["userID"]);
    $sth->execute();

    // empty the session array
    $_SESSION["cart"] = array();

    echo "<h1>Thank you for your purchase!</h1>";

} else {
    echo "an error occured...........";
}
?>

<br>
<a href="store.php"><button>Click here to shop for more stuff</button></a>
<br><br>
<a href="signout.php"><button>Click here to Log Out</button></a>
    
</body>
</html>
