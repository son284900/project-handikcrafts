<?php
require_once('header.php');
$customer = find_customer_by_UserName($_SESSION['username']);
$errors = [];
function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}
function checkForm(){
    global $errors;
    global $customer;
        if(empty($_POST['oldpass'])){
            $errors[] = 'Old Password is required';
        }
        if(!empty($_POST['oldpass']) && $_POST['oldpass'] != $customer['Password']){
            $errors[] = 'Old Password is incorect';
        }
        if(empty($_POST['newpass'])){
            $errors[] = 'New Password is required';
        }
        if(empty($_POST['cfnewpass'])){
            $errors[] = 'Confirm New Password is required';
        }
        if(!empty($_POST['cfnewpass']) && !empty($_POST['newpass']) && $_POST['cfnewpass'] != $_POST['newpass']){
            $errors[] = 'Confirm New Password is different than New Password';
        }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    checkForm();
    if(isFormValidated()){
        $customer['CusID'] = $_POST['CusID'];
        $customer['Password'] = $_POST['newpass'];
        update_Password_Customer($customer);
        $_SESSION['UpdatePass'] = 'Update Password Successfull';
        redirect_to('user.php');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Product</title>
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
    <br>
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
            <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" role="form" enctype="multipart/form-data">
                <legend>Edit Order Form</legend>
                <input type="hidden" class="form-control" name="CusID" value="<?php echo $customer['CusID'] ?>" >
                <div class="form-group">
                    <label for="CusID">Old Password:</label>
                    <input type="password" class="form-control" name="oldpass" value="<?php if(!empty($_POST['oldpass'])){echo $_POST['oldpass'];}else{ echo '';} ?>">
                </div>
                <div class="form-group">
                    <label for="CusID">New Password:</label>
                    <input type="password" class="form-control" name="newpass" value="<?php if(!empty($_POST['newpass'])){echo $_POST['newpass'];}else{ echo '';} ?>">
                </div>
                <div class="form-group">
                    <label for="CusID">Confirm New Password:</label>
                    <input type="password" class="form-control" name="cfnewpass" value="<?php if(!empty($_POST['cfnewpass'])){echo $_POST['cfnewpass'];}else {echo '';} ?>">
                </div>
                <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
                <input type="reset" name="reset" value="Reset" class="btn btn-danger">
            </form>
            <br><br>
            <a href="user.php" class="btn btn-info" >Back to Your Information</a> 
            <br><br><br>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
    
</body>
</html>
<?php 
db_disconnect($db);
?>