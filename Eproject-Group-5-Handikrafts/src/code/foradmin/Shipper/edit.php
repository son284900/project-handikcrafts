<?php
require_once('../admin/adminheader.php');

$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;
    if (empty($_POST['name'])){
        $errors[] = 'Category Name is required';
    }
    if (empty($_POST['Phone'])){
        $errors[] = 'Phone is required';
    }
    if(!empty($_POST['Phone']) && !is_numeric($_POST['Phone'])){
        $errors[] = 'Phone is number';
    }
    if(strlen($_POST['Phone'])!=10){
        $errors[] = 'Phone is incorrect';
    }
    if(substr($_POST['Phone'],0,1)!="0"){
        $errors[] = 'Phone Start with 0';
    }
        
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        //do update
        $shipper = [];
        $shipper['ShipperID'] = $_POST['ShipperID'];
        $shipper['CompanyName'] = $_POST['name'];
        $shipper['Phone'] = $_POST['Phone'];

        update_shipper($shipper);
        $_SESSION['Update'] = 'Update Successfull';
        redirect_to('index.php');
    }
}else {
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
    <title>Edit Shipper</title>
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
                foreach ($errors as $key => $value){
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
            <legend>Edit Shipper</legend>
            <input class="form-control" type="hidden" name="ShipperID" value="<?php echo isFormValidated()? $shipper['ShipperID']: $_POST['ShipperID'] ?>" >
            <div class="form-group">
                <label for="name">Company Name</label> <!--required-->
                <input class="form-control" type="text" id="name" name="name" value="<?php echo isFormValidated()? $shipper['CompanyName']: $_POST['name'] ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label> <!--required-->
                <input class="form-control" type="text" id="phone" name="Phone" value="<?php echo isFormValidated()? $shipper['Phone']: $_POST['Phone'] ?>" maxlength="10">
            </div>
            <br>
            <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
        </form>
    
    <br><br>
    <a href="index.php">Back to Shipper list</a> 
    </div>
</body>
</html>
<?php 
db_disconnect($db);
?>