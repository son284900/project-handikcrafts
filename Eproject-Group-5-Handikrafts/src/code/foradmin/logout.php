<?php
require_once('lib/initialize.php');

unset($_SESSION['adminname']);

redirect_to('Adminlogin.php');
exit;
?>