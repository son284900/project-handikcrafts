<?php
require_once('../admin/adminheader.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_POST['name'])){
        $errors[] = 'Category Name is required';
    }
    if (empty($_POST['phone'])){
        $errors[] = 'Phone is required';
    }
    if(!empty($_POST['phone']) && !is_numeric($_POST['phone'])){
        $errors[] = 'Phone is number';
    }
    if(strlen($_POST['phone'])!=10){
        $errors[] = 'Phone is incorrect';
    }
    if(substr($_POST['phone'],0,1)!="0"){
        $errors[] = 'Phone Start with 0';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New Shipper</title>
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
            <legend>Shipper Form</legend>
            <div class="form-group">
                <label for="name">Company Name</label> <!--required-->
                <input class="form-control" type="text" id="name" name="name" value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label> <!--required-->
                <input class="form-control" type="text" id="phone" name="phone" value="<?php echo isFormValidated()? '': $_POST['phone'] ?>" maxlength="10">
            </div>
            <br>
            <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
            $shipper = [];
            $shipper['CompanyName'] = $_POST['name'];
            $shipper['Phone'] = $_POST['phone'];
            $result = insert_shipper($shipper);
            $newshipperId = mysqli_insert_id($db);
        ?>
            <h2>A new shipper (ID: <?php echo $newshipperId ?>) has been created:</h2>
            <ul>
            <?php 
                foreach ($_POST as $key => $value) {
                    if ($key == 'submit') continue;
                    if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
                }        
            ?>
            </ul>
        <?php endif; ?>
    
    <br><br>
    <a href="index.php">Back to Shipper list</a> 
    </div>
</body>
</html>


<?php
db_disconnect($db);
?>