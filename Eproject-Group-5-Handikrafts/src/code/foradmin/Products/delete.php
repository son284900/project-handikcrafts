<?php
require_once('../admin/adminheader.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    delete_products($_POST['ProductID']);
    if(delete_products($_POST['ProductID'])){
        unlink($_POST['Image']);
    }
    $_SESSION['delete'] = 'Delete Successfull';
    redirect_to('index.php');
} else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $product = find_products_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Product</title>
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
            <h1>Delete Product</h1>
			<h2>Are you sure you want to delete this Product?</h2>
			<input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>" >
            <div class="form-group">
				<h4><span class="label" style="color:black;">Product Name: </span><?php echo $product['Name']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">CatID: </span><?php echo $product['CatID']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Image: </span><img height=200 src="<?php echo $product['Image']?>"></h4>
            </div>
			<div class="form-group">
				<input type="hidden" class="form-control" name="Image" value="<?php echo $product['Image'];?>">
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Price: </span><?php echo $product['Price']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Information: </span><?php echo $product['Information']; ?></h4>
            </div>
			<br>
            <input type="submit"  name="submit"  class="btn btn-danger" value="Delete Product">
        </form>
		<br><br>
		<a href="index.php">Back to Product list</a> 
	</div>	
</body>
</html>


<?php
db_disconnect($db);
?>