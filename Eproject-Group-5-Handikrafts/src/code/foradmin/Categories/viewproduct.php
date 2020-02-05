<?php
require_once('../admin/adminheader.php');
$id = $_GET['id'];
$Category = find_categories_by_id($id)['Name'];
$product_set = find_products_by_CatID($id);
$count = mysqli_num_rows($product_set);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Product</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <style>
        table th{
            background-color:lightblue;
        }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['Update'])): ?>
        <h1 style="text-align:center;border:medium solid green;color:green;padding:10px 0;width:500px;margin:auto;"><?php echo $_SESSION['Update']; ?></h1>
    <?php endif;?>
    <?php if(isset($_SESSION['delete'])): ?>
        <h1 style="text-align:center;border:medium solid green;color:green;padding:10px 0;width:500px;margin:auto;"><?php echo $_SESSION['delete']; ?></h1>
    <?php endif;?>
    <?php if($count == 0 ):?>
    <h1 style="text-align:center;color:red">Don't have products of <?php echo $Category?></h1>
    <?php elseif($count > 0):;?>
    <h1 style="text-align:center;">Product of <?php echo $Category?></h1><br><br>
    <table class="table table-striped">
        <tr>
            <th>ProductID</th>
            <th>Product Name</th>
            <th>CatID</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Information</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php 
        for ($i = 0; $i < $count; $i++):
            $product = mysqli_fetch_assoc($product_set); 
        ?>
            <tr>
                <td><?php echo $product['ProductID']; ?></td>
                <td><?php echo $product['Name']; ?></td>
                <td><?php echo $product['CatID']; ?></td>
                <td><img height=100 src="../Products/<?php echo $product['Image']; ?>"></td>
                <td><?php echo $product['Price']; ?></td>
                <td><?php echo $product['Quantity']; ?></td>
                <td><?php echo $product['Information']; ?></td>
                <td><a href="<?php echo 'editproduct.php?id='.$product['ProductID']; ?>" >Edit</a></td>
                <td><a href="<?php echo 'deleteproduct.php?id='.$product['ProductID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($product_set);
        endif;
        ?>
    </table>
    <br><br>
    <a href="Index.php" style="text-align:center;width:200px" class="btn btn-info col-xs-offset-5 col-xs-2">Back to Category List</a>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>