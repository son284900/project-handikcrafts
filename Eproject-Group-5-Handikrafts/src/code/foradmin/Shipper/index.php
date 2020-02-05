<?php
require_once('../admin/adminheader.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Shipper</title>
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
    <a href="new.php" style="text-align:center;"><h1>Create new shipper</h1></a> <br><br>
    <table class="table table-striped">
        <tr>
            <th>ShipperID</th>
            <th>Company Name</th>
            <th>Phone</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $shipper_set = find_all_shipper();
        $count = mysqli_num_rows($shipper_set);
        for ($i = 0; $i < $count; $i++):
            $shipper = mysqli_fetch_assoc($shipper_set); 
        ?>
            <tr>
                <td><?php echo $shipper['ShipperID']; ?></td>
                <td><?php echo $shipper['CompanyName']; ?></td>
                <td><?php echo $shipper['Phone']; ?></td>
                <td><a href="<?php echo 'edit.php?id='.$shipper['ShipperID']; ?>">Edit</a></td>
                <td><a href="<?php echo 'delete.php?id='.$shipper['ShipperID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($shipper_set);
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>