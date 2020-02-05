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
    $faqs = find_faqs_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete FAQs</title>
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
			<h2>Are you sure you want to delete this faqs?</h2>
			<input type="hidden" name="FAQsID" value="<?php echo $faqs['FAQsID']; ?>" >
            <div class="form-group">
				<h4><span class="label" style="color:black;">Question: </span><?php echo $faqs['Question']; ?></h4>
            </div>
			<div class="form-group">
				<h4><span class="label" style="color:black;">Answer: </span><?php echo $faqs['Answer']; ?></h4>
            </div>
			<br>
            <input type="submit"  name="submit"  class="btn btn-danger" value="Delete Shipper">
        </form>
    
		<br><br>
		<a href="index.php">Back to FAQs list</a> 
	</div>
</body>
</html>


<?php
db_disconnect($db);
?>