<?php
require_once('../admin/adminheader.php');
$errors = [];
function getExtension($str) {
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}
function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}
if(!is_dir("uploadimage")){
    mkdir("uploadimage");
}
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['submit'])){
    $target_dir="uploadimage/";
    $target_file = $target_dir.basename($_FILES['Image']['name']);
    if (empty($_POST['name'])){
        $errors[] = 'Product Name is required';
    }
    if (empty($_POST['Category'])){
        $errors[] = 'Category is required';
    }
    if (empty($_FILES['Image']['name'])){
        $errors[] = 'Image is required';
    }
    if (empty($_POST['Price'])){
        $errors[] = 'Price is required';
    }
    if (empty($_POST['information'])){
        $errors[] = 'Information is required';
    }
    if(file_exists($target_file)){
        $errors[]="File is exists";
    }
    if($_FILES['Image']['error']>0){
        $errors[]= "Upload Image is error";
    }
    if(isFormValidated()){
        move_uploaded_file($_FILES['Image']['tmp_name'],$target_file);
    }
    strtolower($_FILES['Image']['name']);
    $filename = stripslashes($_FILES['Image']['name']);
    $extension = getExtension($filename);
    $extension = strtolower($extension);
    if (!empty($_FILES['Image']['name']) && ($extension != "jpg") && ($extension != "jpeg") && ($extension !="png") && ($extension != "gif"))
    {
        $errors[]= 'Please select an image';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New Product</title>
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
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
            <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" role="form" enctype="multipart/form-data">
                <legend>Product Form</legend>
                <div class="form-group">
                    <label for="name">Product name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="CatID">Category:</label>
                    <!-- <input type="number" class="form-control" name="CatID" value="<?php //echo isFormValidated()? '': $_POST['CatID'] ?>"> -->
                    <select name="Category" id="">
                        <option value="">--Choose Category--</option>
                        <?php
                            $categories_set = find_all_categories();
                            $count = mysqli_num_rows($categories_set);
                            $x = [];
                            for ($i = 0; $i < $count; $i++):
                                $category = mysqli_fetch_assoc($categories_set); 
                                $x[$i]=$category['CatID'];
                        ?>
                        <option value="<?php echo $category['CatID']; ?>" <?php if(!empty($_POST['Category']) && $_POST['Category'] == $category['CatID']) echo 'selected';?>><?php echo $category['Name']; ?></option>
                        <?php
                            endfor; 
                            mysqli_free_result($categories_set);
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Image">Image:</label>
                    <input type="file" class="form-control" name="Image" >
                </div>
                <div class="form-group">
                    <label for="Price">Price:</label>
                    <input type="number" step="0.01" class="form-control" name="Price" value="<?php echo isFormValidated()? '': $_POST['Price'] ?>">
                </div>
                <div class="form-group">
                    <label for="Quantity">Quantity:</label>
                    <input type="number" class="form-control" name="Quantity" value="<?php echo isFormValidated()? '': $_POST['Quantity'] ?>">
                </div>
                <div class="form-group">
                    <label for="information">Information:</label>
                    <input type="text" class="form-control" name="information" value="<?php echo isFormValidated()? '': $_POST['information'] ?>">
                    <!-- <textarea class="form-control col-xs-4" name="information" placeholder="Write information of product.." style="height:200px" value="à"></textarea> -->
                </div>
                <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
                <input type="reset" name="reset" value="Reset" class="btn btn-danger">
            </form>
    
    
            <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['submit']) && isFormValidated()): ?> 
                <?php 
                $_POST['Image'] = $target_dir.$_FILES['Image']['name'];
                $product = [];
                $product['name'] = $_POST['name'];
                $product['CatID'] = $_POST['Category'];
                $product['Image'] = $_POST['Image'];
                $product['Price'] = $_POST['Price'];
                $product['Quantity'] = $_POST['Quantity'];
                $product['information'] = $_POST['information'];
                $result = insert_products($product);
                $newProductId = mysqli_insert_id($db);
                ?>
                <h2>A new product (ID: <?php echo $newProductId ?>) has been created:</h2>
                <ul>
                <?php 
                    foreach ($_POST as $key => $value) {
                        if ($key == 'submit') continue;
                        if ($key == 'Image'){echo '<li>', $key.': <img height=200; src="'.$target_file. '"></li>'; continue;}
                        if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
                    }        
                ?>
                </ul>
            <?php endif; ?>
    
            <br><br>
            <a href="index.php">Back to Product list</a> 
        </div>
    </div>
</body>
</html>


<?php
db_disconnect($db);
?>