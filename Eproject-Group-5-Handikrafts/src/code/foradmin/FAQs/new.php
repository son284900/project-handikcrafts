<?php
require_once('../admin/adminheader.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_POST['Question'])){
        $errors[] = 'Question is required';
    }
    if (empty($_POST['Answer'])){
        $errors[] = 'Answer is required';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New FAQs</title>
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
            <legend>FAQs Form</legend>
            <div class="form-group">
                <label for="Question">Question: </label> <!--required-->
                <input class="form-control" type="text" id="name" name="Question" value="<?php echo isFormValidated()? '': $_POST['Question'] ?>">
            </div>
            <div class="form-group">
                <label for="Answer">Answer</label> <!--required-->
                <input class="form-control" type="text" id="phone" name="Answer" value="<?php echo isFormValidated()? '': $_POST['Answer'] ?>">
            </div>
            <br>
            <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
            $faqs = [];
            $faqs['Question'] = $_POST['Question'];
            $faqs['Answer'] = $_POST['Answer'];
            $result = insert_faqs($faqs);
            $newfaqsId = mysqli_insert_id($db);
        ?>
            <h2>A new FAQs (ID: <?php echo $newfaqsId ?>) has been created:</h2>
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
    <a href="index.php">Back to FAQs list</a> 
    </div>
</body>
</html>


<?php
db_disconnect($db);
?>