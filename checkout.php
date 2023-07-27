<?php
session_start();
require_once "config.php"; 
if(!isset($_SESSION["uName"])){
    header("Location: login.php");
}
// if the user is not logged in
if (!isset($_SESSION["uName"]) || !isset($_SESSION["pass"])){
    header( "Location: login.php?m=name");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            text-align:center;
        }
        table{
            margin: 0px auto;
        }
        .hide{
            display:none;
        }
        #payment > form > div {
            border: 3px solid rgb(26 107 127 / 72%);
            padding:2%;
            width:  30vmax;
            margin-left:auto;
            margin-right:auto;
            border-radius:15px;
        }
    </style>
</head>
<body>

    <h1>Checkout</h1>
    <h3>Price Summary:</h3>
    <table>
    <?php 
            
    // echo "<pre>";
    // echo "</pre>";
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $sth = $dbh->prepare("SELECT * FROM items"); 
    $sth->execute();
    $items = $sth->fetchAll(); 

    // loop through all the items in the cart and count the total cost
    $cost = 0;
    echo "<tr><th> Item</th><th> Amount</th><th> Price</th></tr>";
    foreach($_SESSION["cart"] as $itemID => $amount){
        echo "<tr>";
        echo "<td>  " . $items[$itemID-1]['name'] . "  </td>";
        $x = (int)($items[$itemID-1]['price']);
        $y = $x * (int)$amount;
        echo "<td>" . $amount . "</td>";
        echo "<td>$" . $x*(int)$amount . "</td>";
        echo "</tr>";
        $cost = $cost + $x*(int)$amount;

        // add each cart item to the database so that it's saved
        $sth = $dbh->prepare("INSERT INTO `cart` 
                                (`user_id`, `item_id`)
                            VALUES
                                (:userID, :itemID)    
                            ");
        $sth->bindValue(":userID", $_SESSION["userID"]);
        $sth->bindValue(":itemID", $itemID);
        $sth->execute();

    }
    ?>
    </table>
    <?php
    echo "<p>Your total is $" . $cost .  "</p>";

    // print an error message if the user's username is taken already. store.php redirect back with the get info
    if (isset($_GET['m'])){
        if ($_GET['m'] == "error"){
            echo "<br><strong class='error'>Bro you filled in something wrong!!!!!</strong><br><br>";
        }
    }
        
    ?>
    <a href="store.php">Continue Shopping</a>
    <br><br>
    <button id="paymentB">Continue Checkout</button>
    <div id="payment" class="hide">
        <form action="ordered.php" method="post">
        <!-- Adress -->
        <p>Step 1</p>
        <div>
            <label for="ad">Enter your shipping address</label>
            <br>
            <input id="ad" name="address" type="text" required></input>
            <br>
            <label for="z">Enter your zip code</label>
            <br>
            <input id="z" name="zip" type="text" required></input>
        </div>
        <!-- C Card -->
        <p>Step 2</p>
        <div>
            <label for="cCard">Enter your credit card number</label>
            <br>
            <input id="cCard" name="card" type="number" required></input>
            <br>
            <label for="cvcC">Enter your Card Verification Code</label>
            <br>
            <input id="cvcC" name="cvc" type="number" required></input>
        </div>
        <!-- Delivery -->
        <p>Step 3</p>
        <div>
            <label for="del">Special delivery instructions</label>
            <br>
            <textarea id="del" name="card"></textarea>
        </div>

        <div>
            <button type="submit">Purchase</button>
        </div>
        <br>
        </form>

        <?php
        // print an error message if the user's username is taken already. store.php redirect back with the get info
        if (isset($_GET['m'])){
            if ($_GET['m'] == "error"){
                echo "<br><br><strong class='error'>Bro you filled in something wrong!!!!!</strong><br>";
            }
        }
        ?>

</body>
</html>
