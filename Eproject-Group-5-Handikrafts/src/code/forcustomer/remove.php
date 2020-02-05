<?php
    require_once("../foradmin/lib/database.php");
    require_once('../foradmin/lib/initialize.php');
    
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
    redirect_to('cart.php');
?>