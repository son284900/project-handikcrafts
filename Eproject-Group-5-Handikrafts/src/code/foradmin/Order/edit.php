<?php
require_once('../admin/adminheader.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        
        $Order = [];
        $Order['OrderID'] = $_POST['OrderID'];
        $Order['CusID'] = $_POST['CusID'];
        $Order['OrderDate'] = $_POST['OrderDate'];
        $Order['Shipdate'] = $_POST['Shipdate'];
        $Order['Price'] = $_POST['Price'];
        $Order['Status'] = $_POST['Status'];
        $Order['ShipperID'] = $_POST['ShipperID'];

        update_Order($Order);
        $_SESSION['Update'] = 'Update Successfull';
        redirect_to('index.php');
}else {
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $Order = find_Order_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Order</title>
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
    <br>
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
            <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" role="form" enctype="multipart/form-data">
                <legend>Edit Order Form</legend>
                <input type="hidden" class="form-control" name="OrderID" value="<?php echo $Order['OrderID'] ?>" >
                <div class="form-group">
                    <label for="CusID">CusID:</label>
                    <input type="number" readonly="" class="form-control" name="CusID" value="<?php echo $Order['CusID'] ?>">
                </div>
                <div class="form-group">
                    <label for="OrderDate">OrderDate:</label>
                    <input type="date" readonly="" class="form-control" name="OrderDate" value="<?php echo $Order['OrderDate'] ?>">
                </div>
                <div class="form-group">
                    <label for="Shipdate">Shipdate: </label>
                    <input type="date" class="form-control" name="Shipdate" value="<?php if(empty($_POST['Shipdate'])){ echo $Order['Shipdate'];}else{echo $_POST['Shipdate'];} ?>">
                </div>
                <div class="form-group" disabled>
                    <label for="Price">Price: </label>
                    <input type="number" readonly="" class="form-control" name="Price" value="<?php echo $Order['Price'];?>">
                </div>
                <div class="form-group">
                    <label for="Status">Status:</label>
                    <input type="text" readonly="" class="form-control" name="Status" value="<?php echo $Order['Status']?>">
                </div>
                <div class="form-group">
                    <label for="ShipperID">ShipperID:</label>
                    <select name="ShipperID">
                        <option value="">--Choose Shipper--</option>
                        <?php
                            $shiper_set = find_all_shipper();
                            $count = mysqli_num_rows($shiper_set);
                            for ($i = 0; $i < $count; $i++):
                                $Shipper = mysqli_fetch_assoc($shiper_set);
                        ?>
                        <option value="<?php echo $Shipper['ShipperID'] ?>" <?php if(!empty($_POST['ShipperID']) && $_POST['ShiperID'] == $Shipper['ShipperID']){echo 'selected';}?>><?php echo $Shipper['CompanyName'];?></option>
                        <?php 
                            endfor;
                            mysqli_free_result($shiper_set);
                        ?>
                    </select>
                </div>
                <input type="submit"  name="submit"  class="btn btn-success" value="Submit">
                <input type="reset" name="reset" value="Reset" class="btn btn-danger">
            </form>
            <br><br>
            <a href="index.php">Back to Order list</a> 
        </div>
    </div>
    
    
</body>
</html>
<?php 
db_disconnect($db);
?>