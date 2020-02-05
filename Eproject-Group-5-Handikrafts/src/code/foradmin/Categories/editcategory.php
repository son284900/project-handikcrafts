<?php
require_once('../admin/adminheader.php');

$error = [];

function isFormValidated(){
    global $error;
    return count($error) == 0;
}

function checkForm(){
    global $error;
        if(empty($_POST['name'])){
            $error[] = 'Category Name is required';
        }
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        //do update
        $Category = [];
        $Category['CatID'] = $_POST['CatID'];
        $Category['Name'] = $_POST['name'];

        update_categories($Category);
        $_SESSION['Update'] = 'Update Successfull';
        redirect_to('index.php');
    }
}else {
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $Category = find_categories_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Category</title>
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
		body{
            margin:50px auto;
        }
    </style>
</head>
<body>
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="error">
            <span> Please fix the following errors </span>
            <ul>
                <?php
                foreach ($error as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div><br><br>
    <?php endif; ?>
	<div class="col-xs-offset-4 col-xs-4">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <legend>Edit Category Form</legend>
			<input type="hidden" name="CatID" value="<?php echo isFormValidated()? $Category['CatID']: $_POST['CatID'] ?>" >
            <div class="form-group">
                <label for="name">Category Name</label> <!--required-->
                <input class="form-control" type="text" id="name" name="name" value="<?php echo isFormValidated()? $Category['Name']: $_POST['name'] ?>">
            </div>
            <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
        </form>
    
    <br><br>
    <a href="index.php">Back to Category list</a>  
    </div>
</body>
</html>
<?php 
db_disconnect($db);
?>