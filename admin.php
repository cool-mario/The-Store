<?php
session_start();
require_once "config.php"; 
// check login
if(!isset($_SESSION["uName"])){
    header("Location: login.php");
}
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh->prepare("SELECT `role` FROM `users` WHERE uName = :enteredName");
$sth->bindValue(":enteredName",$_SESSION["uName"]);
$sth->execute();
$admin = $sth->fetch();

if($admin["0"] == 0){
    header("Location: store.php");
}

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
    <!-- Choose item -->
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
    <input id="inp2"  name="chosenPrice" type="number" min="1">
    <br>
    <button type="submit">Change</button>
</form>
<?php
// check for thrown errors from admin handler
if (isset($_GET['m']) && $_GET['m'] == "error"){
    echo "<h1>You goofed up, donm't mess with the form :3</h1>";
    } 
?>
<br>
<!-- Description changing -->
<form method="post" action="adminHandler.php">
    <!-- Select which item we change the desc on -->
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
    <!-- Set a specific desc on an item -->
    <label for="inp3">Set a description</label>
    <br>
    <input id="inp3" name="chosenDesc" type="text">
    <br>
    <button type="submit">Change</button>
</form>
<!-- Item Deletion -->
<form method="post" action="adminHandler.php">
    <!-- Select which item we delete -->
    <label for="inp1"><h3>Item Deletion</h3></label>
    <br>
    <select id="inp1"  name="chosenItem3">
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
    <button type="submit">Delete</button>
</form>
<!-- Display results of SQL for user -->
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
