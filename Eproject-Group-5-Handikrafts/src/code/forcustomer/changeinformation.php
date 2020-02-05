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
    if (empty($_POST['Name'])){
        $errors[] = 'Name is required';
    }
    if (empty($_POST['Age'])){
        $errors[] = 'Age is required';
    }
    if (empty($_POST['Gender'])){
        $errors[] = 'Gender is required';
    }
    if (empty($_POST['Address'])){
        $errors[] = 'Address is required';
    }
    if (empty($_POST['Phone'])){
        $errors[] = 'Phone is required';
    }
    if(!is_numeric($_POST['Phone'])){
        $errors[] = 'Phone is number';
    }
    if(strlen($_POST['Phone'])!=10){
        $errors[] = 'The Phone has ten number';
    }
    if(substr($_POST['Phone'],0,1)!='0'){
        $errors[] = 'The Phone must start by 0';
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    checkForm();
    if(isFormValidated()){
        $customer = [];
        $customer['CusID'] = $_POST['CusID'];
        $customer['Name'] = $_POST['Name'];
        $customer['Age'] = $_POST['Age'];
        $customer['Gender'] = $_POST['Gender'];
        $customer['Address'] = $_POST['Address'];
        $customer['Phone'] = $_POST['Phone'];
        $customer['Email'] = $_POST['Email'];
        if(empty($_POST['Email'])){
            $customer['Email']='null';
        }
        update_Customer($customer);
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
                    <label for="Name">Name:</label>
                    <input type="Text" class="form-control" name="Name" value="<?php if(!empty($_POST['Name'])){echo $_POST['Name'];}else{ echo $customer['Name'];} ?>">
                </div>
                <div class="form-group">
                    <label for="Age">Age</label> <!--required-->
                    <input class="form-control" type="int" id="Age" name="Age" value="<?php if(!empty($_POST['Age'])){echo $_POST['Age'];}else{ echo $customer['Age'];} ?>">
                </div>
                <div class="form-group">
                    <label for="Gender">Gender</label> <!--required-->
                    <input type="radio" name="Gender" value="Male" <?php if(!empty($_POST['Gender'])&& $_POST['Gender']=='Male'){echo 'checked';}elseif(!empty($customer['Gender'])&& $customer['Gender']=='Male'){echo 'checked';}?>> Male 
                    <input type="radio" name="Gender" value="Female" <?php if(!empty($_POST['Gender'])&& $_POST['Gender']=='Female'){echo 'checked';}elseif(!empty($customer['Gender'])&& $customer['Gender']=='Female'){echo 'checked';}?>> Female 
                    <input type="radio" name="Gender" value="Other" <?php if(!empty($_POST['Gender'])&& $_POST['Gender']=='Other'){echo 'checked';}elseif(!empty($customer['Gender'])&& $customer['Gender']=='Other'){echo 'checked';}?>> Other
                </div>
                <div class="form-group">
                    <label for="Address">Address</label> <!--required-->
                    <input class="form-control" type="text" id="Address" name="Address" value="<?php if(!empty($_POST['Address'])){echo $_POST['Address'];}else{ echo $customer['Address'];} ?>">
                </div>
                <div class="form-group">
                    <label for="Phone">Phone</label> <!--required-->
                    <input class="form-control" type="text" id="Phone" name="Phone" value="<?php if(!empty($_POST['Phone'])){echo $_POST['Phone'];}else{ echo $customer['Phone'];} ?>">
                </div>
                <div class="form-group">
                    <label for="Email">Email</label> <!--required-->
                    <input class="form-control" type="Email" id="Email" name="Email" value="<?php if(!empty($_POST['Email'])){echo $_POST['Email'];}else{ echo $customer['Email'];} ?>">
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