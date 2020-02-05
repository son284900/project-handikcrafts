<?php
require('header.php');
if(!isset($_GET['id'])) {
    redirect_to('Product.php');
}
$id = $_GET['id'];
$Product = find_products_by_id($id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        .product{
            width:1000px;
            height:540px;
            margin:auto;
            background-color:rgba(225, 255, 205, 0.356);
        }
        .Image{
            float:left;
            width:450px;
            height:540px;
            Padding:20px 10px;
            display: inline-block;
            background-color:rgba(225, 255, 205, 0.356);
        }
        .Information{
            float:left;
            width:550px;
            height:540px;
            Padding:20px 10px;
            display: inline-block;
            background-color:rgba(225, 255, 205, 0.356);
        }
    </style>
</head>
<body>
<div class="name">
    <h2> View Product </h2>
    <p style="color:rgb(255, 196, 0);">___________________________</p><br>
 </div>
    <div class=''>
        <div class="product">
            <aside class="Image">
                <img src="../foradmin/products/<?php echo $Product['Image'];?>" alt="" class="img-thumbnail">
            </aside>
            <aside class="Information">
                <h1>Name: <?php echo $Product['Name'];?></h1><hr>
                <h3>Price: <?php echo $Product['Price'];?></h3>
                <h3>Information: <?php echo $Product['Information'];?></h3><hr>
                <a href="<?php echo 'addcart.php?id='.$id; ?>"><button type="Submit" class="btn btn-danger">Add Cart</button></a>
            </aside>
        </div>
    </div>
    <br>
    <div style='text-align:center;'>
        <a href="product.php" style="text-align:center"><button type="Submit" class="btn btn-info"> Back to Product</button></a>
    </div>
    <?php require('footer.php') ?>
</body>
</html>