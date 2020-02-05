<?php
require_once('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Order</title>
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
    <h1 class="text-center">Order list</h1> <br><br>
    <table class="table table-striped col-xs-12" >
        <tr style="max-width:50px;">
            <th>Name</th>
            <th>Address</th>
            <th>OrderDate</th>
            <th>Shipdate</th>
            <th>Price</th>
            <th>Status</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $Order_set = find_Order_by_Username($_SESSION['username']);
        $count = mysqli_num_rows($Order_set);
        for ($i = 0; $i < $count; $i++):
            $Order = mysqli_fetch_assoc($Order_set); 
        ?>
            <tr>
                <td><?php echo $Order['Name']; ?></td>
                <td><?php echo $Order['Address']; ?></td>
                <td><?php echo $Order['OrderDate']; ?></td>
                <td><?php echo $Order['Shipdate']; ?></td>
                <td><?php echo $Order['Price']; ?></td>
                <td><?php echo $Order['Status']; ?></td>
                <td>
                    <a class="btn btn-xs btn-info" href="<?php echo 'viewdetail.php?id='.$Order['OrderID']; ?>">View Order Detail</a>
                    <a class="btn btn-xs btn-danger" href="<?php echo 'deleteorder.php?id='.$Order['OrderID']; ?>">Delete</a>
                </td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($Order_set);
        ?>
    </table>
    <?php 
        require('footer.php');
    ?>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>