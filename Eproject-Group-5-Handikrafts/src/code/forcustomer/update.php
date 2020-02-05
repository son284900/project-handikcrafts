<?php
    require_once("../foradmin/lib/database.php");
    require_once('../foradmin/lib/initialize.php');
    
    $key = intval(getInput("key"));
    $qty = intval(getInput("qty"));

    $_SESSION['cart'][$key]['quantity'] =$qty;
?>