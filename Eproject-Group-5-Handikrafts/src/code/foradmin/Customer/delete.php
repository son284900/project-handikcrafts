<?php
require_once('../admin/adminheader.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    delete_faqs($_POST['FAQsID']);
    $_SESSION['delete'] = 'Delete Successfull';
    redirect_to('index.php');
} else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $customer = find_customer_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Customer</title>
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
            <h1>Delete FAQs</h1>
			<h2>Are you sure you want to delete this Customer?</h2>
			<input type="hidden" name="CusID" value="<?php echo $customer['CusID']; ?>" >
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
            <input type="submit"  name="submit"  class="btn btn-danger" value="Delete Customer">
        </form>
    
		<br><br>
		<a href="index.php">Back to Customer list</a> 
	</div>
</body>
</html>


<?php
db_disconnect($db);
?>