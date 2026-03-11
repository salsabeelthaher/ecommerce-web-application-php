<?php
session_start();

$id = $_GET['id'];
$action = $_GET['action'];

$key = "prod_$id";

if ($action == "plus") {

    $_SESSION[$key]++;

} elseif ($action == "minus") {

    if ($_SESSION[$key] > 1) {
        $_SESSION[$key]--;
    } else {
        unset($_SESSION[$key]); 
    }

} elseif ($action == "delete") {

    unset($_SESSION[$key]);

}

header("Location: cart.php");
exit;
?>
