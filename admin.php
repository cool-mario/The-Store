<?php
session_start();
require_once "config.php"; 
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            text-align:center;
        }
        table{
            margin: 0px auto;
        }
    </style>
    <title>Admin panel!!</title>
</head>
<body>
    

<h1>Welcome to the Admin Control Panel!</h1>
<br>

<form method="post" action="adminHandler.php">
    <!-- Select which item we change the price on -->
    <label for="inp1"><h3>Price Changing</h3></label>
    <br>
    <select id="inp1" name="chosenItem">
        <?php
        $sth = $dbh->prepare("SELECT * FROM `items`");
        $sth->execute(); 
        $itemsInfo = $sth->fetchAll();
        foreach($itemsInfo as $item){
            echo "<option value='". $item["id"] ."'>". $item["name"] ."</option>";
        }
        ?>
    </select>
    <br>
    <!-- Set a specific price on an item -->
    <label for="inp2">Set a price</label>
    <br>
    <input id="inp2"  name="chosenPrice" type="number">
    <br>
    <button type="submit">Change</button>
</form>
<?php
if (isset($_GET['m']) && $_GET['m'] == "error"){
    echo "<h1>You goofed up, donm't mess with the form :3</h1>";
    } 
?>
<br>
<!-- Description changing -->
<form method="post" action="adminHandler.php">
    <!-- Select which item we change the price on -->
    <label for="inp1"><h3>Description Changing</h3></label>
    <br>
    <select id="inp1"  name="chosenItem2">
        <?php
        $sth = $dbh->prepare("SELECT * FROM `items`");
        $sth->execute(); 
        $itemsInfo = $sth->fetchAll();
        foreach($itemsInfo as $item){
            echo "<option value='". $item["id"] ."'>". $item["name"] ."</option>";
        }
        ?>
    </select>
    <br>
    <!-- Set a specific price on an item -->
    <label for="inp3">Set a description</label>
    <br>
    <input id="inp3" name="chosenDesc" type="text">
    <br>
    <button type="submit">Change</button>
</form>

<?php
if (isset($_GET['m']) && $_GET['m'] == "error"){
    echo "<h1>You goofed up, donm't mess with the form :3</h1>";
} else {
    if (isset($_GET['m']) && $_GET['m'] == "success"){
        echo "<h2>Changes saved!! UwU</h2>";
    }
}
?>

<br><br>

<a href="store.php"><button>Go to the store</button></a><br><br>
    
<a href="signout.php"><button>Sign out</button></a>

</body>
</html>