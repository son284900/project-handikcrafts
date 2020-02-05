<?php
require_once('../admin/adminheader.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    $Order = find_Order_by_id($_POST['OrderID']);
    $quantity = find_products_by_id($_POST['ProductID'])['Quantity'];
    $Order['OrderID'] = $_POST['OrderID'];
    $Order['Price'] = $Order['Price'] - $_POST['Price']; 
    $ProductID = $_POST['ProductID'];
    $quantity += $_POST['Quantity'];
    delete_orderdetail($_POST['ID']);
    if(delete_orderdetail($_POST['ID'])){
        update_Order_price($Order);
        update_quantity_product_in_ID($ProductID,$quantity);
    }
    $_SESSION['delete'] = 'Delete Successfull';
    redirect_to('index.php');
} else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $Orderdetail = find_orderdetail_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Order Detail</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
		body{
            margin:50px auto;
        }
    </style>
</head>
<body>
	<div class="col-xs-offset-4 col-xs-4">
	    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <h1>Delete Orderdetail</h1>
			<h2>Are you sure you want to delete this Orderdetail?</h2>
			<input type="hidden" name="ID" value="<?php echo $Orderdetail['ID']; ?>" >
            <div class="form-group">
                <input type="hidden" name="OrderID" value="<?php echo $Orderdetail['OrderID']; ?>" >
				<h4><span class="label" style="color:black;">OrderID: </span><?php echo $Orderdetail['OrderID']; ?></h4>
            </div>
            <div class="form-group">
                <input type="hidden" name="ProductID" value="<?php echo $Orderdetail['ProductID']; ?>" >
				<h4><span class="label" style="color:black;">ProductID: </span><?php echo $Orderdetail['ProductID']; ?></h4>
            </div>
			<div class="form-group">
                <input type="hidden" name="Quantity" value="<?php echo $Orderdetail['Quantity']; ?>" >
				<h4><span class="label" style="color:black;">Quantity: </span><?php echo $Orderdetail['Quantity']; ?></h4>
            </div>
			<div class="form-group">
                <input type="hidden" name="Price" value="<?php echo $Orderdetail['Price']; ?>" >
				<h4><span class="label" style="color:black;">Price: </span><?php echo $Orderdetail['Price']; ?></h4>
            </div>
			<br>
            <input type="submit"  name="submit"  class="btn btn-danger" value="Delete Order Detail">
        </form>
		<br><br>
		<a href="index.php">Back to Order Detail list</a> 
	</div>	
</body>
</html>


<?php
db_disconnect($db);
?>