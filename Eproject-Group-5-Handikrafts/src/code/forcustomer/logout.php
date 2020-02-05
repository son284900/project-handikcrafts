<?php
require_once('../foradmin/lib/initialize.php');
unset($_SESSION['username']);
unset($_SESSION['cart']);
redirect_to('homepage.php');
exit;
?>