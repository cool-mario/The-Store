<?php
session_start();
require_once "config.php"; 
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
    // var_dump($_SESSION["cart"]);
    // echo "</pre>";
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $sth = $dbh->prepare("SELECT * FROM items"); 
    $sth->execute();
    $items = $sth->fetchAll(); 


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
    }
    ?>
    </table>
    <?php
    echo "<p>Your total cart total is $" . $cost .  "</p>";
    ?>
    <a href="store.php">Continue Shopping</a>
    <br>
    <button id="paymentB">Continue Checkout</button>
    <div id="payment" class="hide">
        <form action="ordered.php" method="post">
        <!-- Adress -->
        <p>Step 1</p>
        <div>
            <label for="ad">Enter your shipping address</label>
            <br>
            <input id="ad" name="address" type="text"></input>
            <br>
            <label for="z">Enter your zip code</label>
            <br>
            <input id="z" name="zip" type="text"></input>
        </div>
        <!-- C Card -->
        <p>Step 2</p>
        <div>
            <label for="cCard">Enter your credit card number</label>
            <br>
            <input id="cCard" name="card" type="number"></input>
            <br>
            <label for="cvcC">Enter your CVC</label>
            <br>
            <input id="cvcC" name="cvc" type="number"></input>
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

</body>
</html>
