<?php
require_once('header.php');
$customer = find_customer_by_UserName($_SESSION['username']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Customer</title>
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
            <h1>Your Information</h1>
			<input type="hidden" name="CusID" value="<?php echo $customer['CusID']; ?>" >
            <div class="form-group">
				<h4><span class="label" style="color:black;">User Name: </span><?php echo $customer['UserName']; ?></h4>
            </div>
            <div class="form-group">
				<h4><span class="label" style="color:black;">Name: </span><?php echo $customer['Name']; ?></h4>
            </div>
            <div class="form-group">
				<h4><span class="label" style="color:black;">Age: </span><?php echo $customer['Age']; ?></h4>
            </div>
            <div class="form-group">
				<h4><span class="label" style="color:black;">Gender: </span><?php echo $customer['Gender']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Address: </span><?php echo $customer['Address']; ?></h4>
            </div>
            <div class="form-group">
				<h4><span class="label" style="color:black;">Phone: </span><?php echo $customer['Phone']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Email: </span><?php echo $customer['Email']; ?></h4>
            </div>
			<br>
            <a href="changeinformation.php" class="btn btn-danger">Change Information</a>
            <a href="changepassword.php" class="btn btn-danger">Change Password</a>
        </form>
    
		<br><br>
		<a href="homepage.php" class="btn btn-info" >Back to Homepage</a> 
        <br><br><br>
	</div>
    <?php require_once('footer.php'); ?>
</body>
</html>


<?php
db_disconnect($db);
?>