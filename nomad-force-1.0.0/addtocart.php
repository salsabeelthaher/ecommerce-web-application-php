<?php
session_start();
include_once('config2.php');

$id = $_GET['id'];
if(isset($_SESSION["prod_$id"])){
    $_SESSION["prod_$id"]++;
}else {       
    $_SESSION["prod_$id"] = 1;
}

header("Location:cart.php");
exit;
?>
