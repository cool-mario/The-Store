
<style>
    body{
        text-align:center;
    }
    table{
        margin: 0px auto;
    }
</style>
<h1>Checkout</h1>
<p>Price Summary</p>
<table>
<?php
session_start();
require_once "config.php";
        
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
