<?php 
session_start(); 
// if (empty($_SESSION)){
//     header("Location: signin.php"); // redirect to signin if not signed in
//     die();
// }

var_dump($_POST);
var_dump($_SESSION["cart"]);

?>
