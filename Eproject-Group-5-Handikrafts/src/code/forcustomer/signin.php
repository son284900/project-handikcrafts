<?php
require_once('header.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_POST['UserName'])){
        $errors[] = 'User Name is required';
    }
    if(!empty($_POST['UserName'])){
        $User = find_customer_by_UserName($_POST['UserName']);
        if(isset($User)){
            $errors[] = "User name is exist";
        }
    }
    if (empty($_POST['Password'])){
        $errors[] = 'Password is required';
    }
    if (strlen($_POST['Password'])>64){
        $errors[] = 'Password has max 64 character';
    }
    if (empty($_POST['CFPassword'])){
        $errors[] = 'Password is required';
    }
    if($_POST['Password'] != $_POST['CFPassword']){
        $errors[] = 'Confirm Password is incorect';
    }
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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New User</title>
    <style>
        body div form{
            color:orange;
        }
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
    <div class="col-xs-offset-4 col-xs-4">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <legend>Create New User Form</legend>
            <div class="form-group">
                <label for="UserName">UserName: </label> <!--required-->
                <input class="form-control" type="text" id="UserName" name="UserName" value="<?php echo isFormValidated()? '': $_POST['UserName'] ?>">
            </div>
            <div class="form-group">
                <label for="Password">Password</label> <!--required-->
                <input class="form-control" type="Password" id="Password" name="Password" value="<?php echo isFormValidated()? '': $_POST['Password'] ?>">
            </div>
            <div class="form-group">
                <label for="CFPassword"> Confirm Password</label> <!--required-->
                <input class="form-control" type="Password" id="CFPassword" name="CFPassword" value="<?php echo isFormValidated()? '': $_POST['CFPassword'] ?>">
            </div>
            <div class="form-group">
                <label for="Name">Name</label> <!--required-->
                <input class="form-control" type="text" id="Name" name="Name" value="<?php echo isFormValidated()? '': $_POST['Name'] ?>">
            </div>
            <div class="form-group">
                <label for="Age">Age</label> <!--required-->
                <input class="form-control" type="int" id="Age" name="Age" value="<?php echo isFormValidated()? '': $_POST['Age'] ?>">
            </div>
            <div class="form-group">
                <label for="Gender">Gender</label> <!--required-->
                <input type="radio" name="Gender" value="Male" <?php if(!empty($_POST['Gender'])&& $_POST['Gender']=='male') echo 'checked';?>> Male 
                <input type="radio" name="Gender" value="Female" <?php if(!empty($_POST['Gender'])&& $_POST['Gender']=='female') echo 'checked';?>> Female 
                <input type="radio" name="Gender" value="Other" <?php if(!empty($_POST['Gender'])&& $_POST['Gender']=='other') echo 'checked';?>> Other
            </div>
            <div class="form-group">
                <label for="Address">Address</label> <!--required-->
                <input class="form-control" type="text" id="Address" name="Address" value="<?php echo isFormValidated()? '': $_POST['Address'] ?>">
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label> <!--required-->
                <input class="form-control" type="text" id="Phone" name="Phone" value="<?php echo isFormValidated()? '': $_POST['Phone'] ?>">
            </div>
            <div class="form-group">
                <label for="Email">Email</label> <!--required-->
                <input class="form-control" type="Email" id="Email" name="Email" value="<?php echo isFormValidated()? '': $_POST['Email'] ?>">
            </div>
            <br>
            <input type="submit"  name="submit"  class="btn btn-success" value="Sign In">
            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
        </form>
        <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
            $Customer = [];
            $Customer['UserName'] = $_POST['UserName'];
            $Customer['Password'] = $_POST['Password'];
            $Customer['Name'] = $_POST['Name'];
            $Customer['Age'] = $_POST['Age'];
            $Customer['Gender'] = $_POST['Gender'];
            $Customer['Address'] = $_POST['Address'];
            $Customer['Phone'] = $_POST['Phone'];
            $Customer['Email'] = $_POST['Email'];
            if(empty($_POST['Email'])){
                $Customer['Email']='null';
            }
            $result = insert_customer($Customer);
        ?>
            <hr>
            <h2><?php echo 'Create Acount Success'; ?></h2>
            <hr>
        <?php endif; ?>
    
    <br><br>
    <a href="login.php" class="btn btn-info">Go to Log In</a> 
    <br><br>
    </div>
    <?php require('footer.php');?>
</body>
</html>


<?php
db_disconnect($db);
?>