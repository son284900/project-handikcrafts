<?php
require_once('../admin/adminheader.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    delete_categories($_POST['CatID']);
    $_SESSION['delete'] = 'Delete Successfull';
    redirect_to('index.php');
} else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $category = find_categories_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Category</title>
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
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
            <h1>Delete Category</h1>
			<h2>Are you sure you want to delete this category?</h2>
			<input type="hidden" name="CatID" value="<?php echo $category['CatID']; ?>" >
            <div class="form-group">
				<h4><span class="label" style="color:black;">Category Name: </span><?php echo $category['Name']; ?></h4>
            </div>
            <input type="submit"  name="submit"  class="btn btn-danger" value="Delete Category">
        </form>
    
		<br><br>
		<a href="index.php">Back to Category list</a> 
	</div>	
</body>
</html>


<?php
db_disconnect($db);
?>