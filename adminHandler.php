<?php
session_start();
require_once "config.php"; 
if(!isset($_SESSION["uName"])){
    header("Location: login.php");
}
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh->prepare("SELECT * FROM `items`");
$sth->execute(); 
$itemsInfo = $sth->fetchAll();

$sth = $dbh->prepare("SELECT id FROM `items` ORDER BY `id` DESC LIMIT 1");
$sth->execute(); 
$itemNum = $sth->fetch();

if(isset($_POST["chosenItem"])){
    if(filter_var($_POST["chosenItem"], FILTER_VALIDATE_INT) != false){
        if($_POST["chosenItem"] > 0 and $_POST["chosenItem"] < $itemNum){
            // Validation for chosen item is complete
            if(isset($_POST["chosenPrice"])){
                if(filter_var($_POST["chosenPrice"], FILTER_VALIDATE_INT) != false){
                    // Validation for chosen price is done
                    echo "<p>Feet</p>";
                    $sth = $dbh->prepare("UPDATE `items` SET `price` = :givenPrice WHERE id = :givenID");
                    $sth->bindValue(':givenPrice',$_POST["chosenPrice"]);
                    $sth->bindValue(':givenID',$_POST["chosenItem"] );
                    $sth->execute(); 
                    header("Location: admin.php?m=success");
                }
                else{
                    header("Location: admin.php?m=error");
                }
            }      
            else{
                header("Location: admin.php?m=error");
            }
        }
        else{
            header("Location: admin.php?m=error");
        }
    }
    else{
        header("Location: admin.php?m=error");
    }
}
if(isset($_POST["chosenItem2"])){
    if(filter_var($_POST["chosenItem2"], FILTER_VALIDATE_INT) != false){
        if($_POST["chosenItem2"] > 0 and $_POST["chosenItem2"] < $itemNum){
            // Validation for chosen item is complete
            if(isset($_POST["chosenDesc"])){
                    // Validation for chosen price is done
                    echo "<p>Feet</p>";
                    $sth = $dbh->prepare("UPDATE `items` SET `desc` = :givenPrice WHERE id = :givenID");
                    $sth->bindValue(':givenPrice',$_POST["chosenDesc"]);
                    $sth->bindValue(':givenID',$_POST["chosenItem2"] );
                    $sth->execute(); 
                    header("Location: admin.php?m=success");
            }   
            else{
                header("Location: admin.php?m=error");
            }
        }
        else{
            header("Location: admin.php?m=error");
        }
    }
    else{
        header("Location: admin.php?m=error");
    }
}
if(isset($_POST["chosenItem3"])){
    if(filter_var($_POST["chosenItem3"], FILTER_VALIDATE_INT) != false){
        if($_POST["chosenItem3"] > 0 and $_POST["chosenItem3"] < $itemNum){
// Validation of item selected is complete
        $sth = $dbh->prepare("DELETE FROM `items` WHERE items.id = :idD;");
        $sth->bindValue(':idD',$_POST["chosenItem3"]);
        $sth->execute(); 
        header("Location: admin.php?m=success");
        }
    else{
        header("Location: admin.php?m=error"); 
    }
    }
    else{
        header("Location: admin.php?m=error"); 
    }
}
?>

