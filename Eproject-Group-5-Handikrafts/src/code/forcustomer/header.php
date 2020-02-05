<?php 
require_once('../foradmin/lib/database.php');
require_once('../foradmin/lib/initialize.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
  <style>
        body {  
            padding-top: 0px;
            background-color:#4E574A;
            color:lightblue;
        }
        .carousel-indicators {  
            bottom:15px;    
            left:10px;  
            width:auto; 
            margin-left:0;
        }
        .carousel-indicators li {   
            border-radius:0;    
            width:8px;  
            height:8px; 
            background:#fff;
        }
        .carousel-indicators .active {  
            width:10px; 
            height:10px;    
            background:#3276b1; 
            border-color:#3276b1;
        }
    #home{
        /* background-image:url("image/3.jpg");
        padding:280px 50px;
        width:1920px;
        height:850px; */
        margin:auto; 
    }
    .a{
        margin:auto;
        width:1500px;

    }
    .gray{
        color:gray;
    }
    /* .b{
        margin:auto;
       text-align:center;
    } */
  a{
    color:gray;
  }
  .name{
        text-align: center;
    }
  a.link:hover{
        color:brown;
        text-decoration: none;
    }
    a.get:hover{
        color:red;
        text-decoration: none;
    }
    .link:hover{
      color:brown;
    }
    .table1{
        color:black;
        border:3;
        width:1400px;
        height:auto;
        padding:20px;
        margin: auto;
        background-color: rgba(128, 128, 128, 0.603);
    }
    .Address{
      color:gray;
    }
    .Address:hover{
      color:black;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-default" style="width:max;">

  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="homepage.php"><b class='red'>VENUS</b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="homepage.php"><b class=' link'> Home</b></a></li>
        <li><a  href="Product.php"><b class=' link'> Products</b></a></li>
        <li><a  href="contact.php"><b class=' link'> Contact-US</b> </a></li>
        <li><a  href="FAQs.php"><b class=' link'> FAQs</b></a></li>
        <li><a  href="about.php"><b class=' link'> About US </b></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
          if(!isset($_SESSION['username'])):
        ?>
          <li><a href="cart.php" ><b class=""><b> Cart</b></b></a></li>
          <li><a href="login.php"><b class=''><span></span> Log In</b></a></li>
          <li><a href="SignIn.php"><b class='link'><span></span>Sign In</b></a></li>
        <?php
          elseif(isset($_SESSION['username'])):
        ?>
          <li><a href="cart.php"><b class=""><b>Cart</b></b></a></li>
          <li><a href="#"><b><span></span><?php echo 'User:'.$_SESSION['username'];?></b></a></li>
          <li class="dropdown">
            <a href="#"  class="dropdown-toggle" data-toggle="dropdown"><button class="dropdown-toggle btn btn-xs btn-info" ><b>Account</b><span class="caret"></span></button></a>
            <ul class="dropdown-menu">
              <li><a href="user.php"><b>Information</b></a></li>
              <li><a href="order.php"><b>Your Order</b></a></li>
              <li><a href="logout.php"><b>Log Out</b></a></li>
            </ul>
          </li>
          
        <?php 
          endif; 
        ?>
      </ul>
    </div>
  </div>
  </div>
</nav>
</div>
</body>
</html>
