<?php
require_once('../admin/adminheader.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Customer</title>
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
    <h1 style="text-align:center;">Customer list</h1> <br><br>
    <table class="table table-striped">
        <tr>
            <th>CusID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $customer_set = find_all_customer();
        $count = mysqli_num_rows($customer_set);
        for ($i = 0; $i < $count; $i++):
            $customer = mysqli_fetch_assoc($customer_set);
        ?>
            <tr>
                <td><?php echo $customer['CusID']; ?></td>
                <td><?php echo $customer['Name']; ?></td>
                <td><?php echo $customer['Age']; ?></td>
                <td><?php echo $customer['Gender']; ?></td>
                <td><?php echo $customer['Address']; ?></td>
                <td><?php echo $customer['Phone']; ?></td>
                <td><?php echo $customer['Email']; ?></td>
                <td><a href="<?php echo 'delete.php?id='.$customer['CusID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($customer_set);
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>