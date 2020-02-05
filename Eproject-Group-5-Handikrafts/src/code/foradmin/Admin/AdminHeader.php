<?php
require_once("../lib/database.php");
require_once('../lib/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
  <style>
  body{
    margin-top:70px;
  }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">

  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="../admin/AdminHome.php"><b>Admin</b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <!-- class="active" -->
        <li><a href="../categories/"><b>Categories</b></a></li>
        <li><a href="../products/"><b>Product</b></a></li>
        <li><a href="../shipper/"><b>Shipper</b></a></li>
        <li><a href="../faqs/"><b>FAQs</b></a></li>
        <li><a href="../customer/"><b>Customer</b></a></li>
        <li><a href="../Contact/"><b>Contact from Customer</b></a></li>
        <li><a href="../order/"><b>Order</b></a></li>
        <li><a href="../orderdetail/"><b>Order Detail</b></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><b><span class="glyphicon glyphicon-user"></span><?php include('user.php'); ?></b></a></li>
          <li><a href="../logout.php"><b><span class="glyphicon glyphicon-log-out"></span> Log out</b></a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
</body>
</html>
