<?php
require_once('../admin/adminheader.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Order Detail</title>
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
    <h1 class="text-center">Order detail list</h1> <br><br>
    <table class="table table-striped">
        <tr>
            <th>OrderDetailID</th>
            <th>OrderID</th>
            <th>ProductID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $Order_set = find_all_orderdetail();
        $count = mysqli_num_rows($Order_set);
        for ($i = 0; $i < $count; $i++):
            $Order = mysqli_fetch_assoc($Order_set); 
        ?>
            <tr>
                <td><?php echo $Order['ID'];?></td>
                <td><?php echo $Order['OrderID']; ?></td>
                <td><?php echo $Order['ProductID']; ?></td>
                <td><?php echo $Order['Quantity']; ?></td>
                <td><?php echo $Order['Price']; ?></td>
                <td><a href="<?php echo 'delete.php?id='.$Order['ID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($Order_set);
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>