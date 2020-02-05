<?php
require_once('../admin/adminheader.php');

$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;
    if (empty($_POST['Question'])){
        $errors[] = 'Question Name is required';
    }
    if (empty($_POST['Answer'])){
        $errors[] = 'Answer is required';
    }
        
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        //do update
        $faqs = [];
        $faqs['FAQsID'] = $_POST['FAQsID'];
        $faqs['Question'] = $_POST['Question'];
        $faqs['Answer'] = $_POST['Answer'];

        update_faqs($faqs);
        $_SESSION['Update'] = 'Update Successfull';
        redirect_to('index.php');
    }
}else {
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
    <title>Edit FAQs</title>
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
            <legend>Edit FAQs</legend>
            <input class="form-control" type="hidden" name="FAQsID" value="<?php echo isFormValidated()? $faqs['FAQsID']: $_POST['FAQsID'] ?>" >
            <div class="form-group">
                <label for="Question">Question</label> <!--required-->
                <input class="form-control" type="text" id="Question" name="Question" value="<?php echo isFormValidated()? $faqs['Question']: $_POST['Question'] ?>">
            </div>
            <div class="form-group">
                <label for="Answer">Answer</label> <!--required-->
                <input class="form-control" type="text" id="Answer" name="Answer" value="<?php echo isFormValidated()? $faqs['Answer']: $_POST['Answer'] ?>" maxlength="10">
            </div>
            <br>
            <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
        </form>
    
    <br><br>
    <a href="index.php">Back to FAQs list</a> 
    </div>
</body>
</html>
<?php 
db_disconnect($db);
?>