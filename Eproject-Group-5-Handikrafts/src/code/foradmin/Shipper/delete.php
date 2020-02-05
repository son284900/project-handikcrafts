<?php
require_once('../admin/adminheader.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    delete_shipper($_POST['ShipperID']);
    $_SESSION['delete'] = 'Delete Successfull';
    redirect_to('index.php');
} else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $shipper = find_shipper_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Shipper</title>
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
            <h1>Delete Shipper</h1>
			<h2>Are you sure you want to delete this Shipper?</h2>
			<input type="hidden" name="ShipperID" value="<?php echo $shipper['ShipperID']; ?>" >
            <div class="form-group">
				<h4><span class="label" style="color:black;">Company Name: </span><?php echo $shipper['CompanyName']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Phone: </span><?php echo $shipper['Phone']; ?></h4>
            </div>
			<br>
            <input type="submit"  name="submit"  class="btn btn-danger" value="Delete Shipper">
        </form>
    
		<br><br>
		<a href="index.php">Back to Shipper list</a> 
	</div>
</body>
</html>


<?php
db_disconnect($db);
?>