<?php 
require('header.php');
$errors=[];
function isformvalidated(){
    global $errors;
    return count($errors)==0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['username'])){
        $errors[] = 'User name is required';
    }else{
        $user = find_customer_by_UserName($_POST['username']);
        if($user['UserName'] != $_POST['username']){
            $errors[] = 'User name is fail';
        }
    }
    if(empty($_POST['password'])){
        $errors[] = 'Password is required';
    }else{
        if($user['Password'] != $_POST['password']){
            $errors[] = 'Password is incorrect';
        }
    }
    if(isformvalidated()){
        $username = isset($_POST['username'])? $_POST['username']: '';
        $_SESSION['username'] = $username;
        redirect_to('homepage.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
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
            <legend style="text-align:center">Log In</legend>
            <div class="form-group">
                <label for="username">UserName</label>
                <input type="text" class="form-control" id="" name="username" value="<?php echo isformvalidated() ? '' : $_POST['username'] ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="" name="password">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Log In">
        </form>
        <br><br>
        <a href="signin.php" class="btn btn-info" >Create new User</a>
        <br><br>
    </div>
    <?php
        require("footer.php");
    ?>
</body>
</html>