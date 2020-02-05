<?php
require_once('header.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    delete_Order($_POST['OrderID']);
    $_SESSION['delete'] = 'Delete Successfull';
    redirect_to('order.php');
} else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('order.php');
    }
    $id = $_GET['id'];
    $Order = find_Order_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Order</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
	<div class="col-xs-offset-4 col-xs-4">
	    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <h1>Delete Order</h1>
			<h2>Are you sure you want to delete this Order?</h2>
			<input type="hidden" name="OrderID" value="<?php echo $Order['OrderID']; ?>" >
            <div class="form-group">
				<h4><span class="label" style="color:black;">CusID: </span><?php echo $Order['CusID']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">OrderDate: </span><?php echo $Order['OrderDate']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Shipdate: </span><?php echo $Order['Shipdate']?></h4>
            </div>
			<div class="form-group">
                <input type="hidden" name="Price" value="<?php echo $Order['Price']; ?>" >
				<h4><span class="label" style="color:black;">Price: </span><?php echo $Order['Price']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Status: </span><?php echo $Order['Status']; ?></h4>
            </div>
            <div class="form-group">
				<h4><span class="label" style="color:black;">ShipperID: </span><?php echo $Order['ShipperID']; ?></h4>
            </div>
			<br>
            <?php
                if($Order['Price']!=0):
                    echo '<h3 style="color:red;text-align:center">You must be delete all Order Detail to delete Order</h3>';
                else:
            ?>
            <input type="submit"  name="submit"  class="btn btn-danger" value="Delete Order">
            <?php 
                endif;
            ?>
        </form>
		<br><br>
		<a href="order.php">Back to Order list</a> 
	</div>	
    <?php 
        require('footer.php');
    ?>
</body>
</html>


<?php
db_disconnect($db);
?>