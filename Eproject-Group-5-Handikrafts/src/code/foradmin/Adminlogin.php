<?php
require_once("lib/database.php");
require_once('lib/initialize.php');
$errors=[];
function isformvalidated(){
    global $errors;
    return count($errors)==0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['adminname'])){
        $errors[] = 'Admin name is required';
    }else{
        $Admin = find_Admin_by_AdminName($_POST['adminname']);
        if($Admin['AdminName'] != $_POST['adminname']){
            $errors[] = 'Admin name is fail';
        }
    }
    if(empty($_POST['password'])){
        $errors[] = 'Password is required';
    }else{
        if($Admin['Password'] != $_POST['password']){
            $errors[] = 'Password is incorrect';
        }
    }
    if(isformvalidated()){
        $adminname = isset($_POST['adminname'])? $_POST['adminname']: '';
        $_SESSION['adminname'] = $adminname;
        redirect_to('admin/AdminHome.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
            label {
                font-weight: bold;
            }
            .error {
                color: #FF0000;
                text-align:left;
            }
            div.error{
                border: thin solid red; 
                display: inline-block;
                padding: 5px;
            }
    </style>
</head>
<body>
    <div class="col-xs-offset-4 col-xs-4">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isformvalidated()): ?> 
        <div style="text-align:center">
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
        </div>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
            <legend style="text-align:center">Log In For Admin</legend>
            <div class="form-group">
                <label for="adminname">Admin Name</label>
                <input type="text" class="form-control" id="" name="adminname" value="<?php echo isformvalidated() ? '' : $_POST['adminname'] ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="" name="password">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
</body>
</html>