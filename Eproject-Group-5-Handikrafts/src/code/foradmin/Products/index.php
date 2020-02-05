<?php
require_once('../admin/adminheader.php');
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
    <a href="new.php" style="text-align:center;"><h1>Create new product</h1></a> <br><br>
    <table class="table table-striped">
        <tr>
            <th>ProductID</th>
            <th>Product Name</th>
            <th>CatID</th>
            <th>Image</th>
            <th>Url Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Information</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $product_set = find_all_products();
        $count = mysqli_num_rows($product_set);
        for ($i = 0; $i < $count; $i++):
            $product = mysqli_fetch_assoc($product_set); 
        ?>
            <tr>
                <td><?php echo $product['ProductID']; ?></td>
                <td><?php echo $product['Name']; ?></td>
                <td><?php echo $product['CatID']; ?></td>
                <td><img height=100 src="<?php echo $product['Image']; ?>"></td>
                <td><?php echo $product['Image']; ?></td>
                <td><?php echo $product['Price']; ?></td>
                <td><?php echo $product['Quantity']; ?></td>
                <td><?php echo $product['Information']; ?></td>
                <td><a href="<?php echo 'edit.php?id='.$product['ProductID']; ?>">Edit</a></td>
                <td><a href="<?php echo 'delete.php?id='.$product['ProductID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($product_set);
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>