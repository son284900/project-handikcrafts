<?php
require('../admin/AdminHeader.php');
$errors=[];
function isformvalidated(){
    global $errors;
    return count($errors)==0;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])){
    if($_POST['choose']==''){
        $errors[] = 'Please select what you want to search';
    }
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['choose'] = $_POST['choose'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancle'])){
    unset($_SESSION['name']);
    unset($_SESSION['choose']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <style>
        table th{
            background-color:lightblue;
        }
        body{
            margin-top:70px
        }
    </style>
</head>
<body>
    <form class="navbar-form navbar-left" action="<?php $_SERVER['REQUEST_METHOD']; ?>" method="post" role="form">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_POST['name'])){echo $_POST['name'];} ?>">
            <select class="form-control" name="choose">
                <option value="" <?php if(!empty($_POST['choose']) && $_POST['choose'] == '') echo 'selected'; ?>>--Choose--</option>
                <option value="Categories" <?php if(!empty($_POST['choose']) && $_POST['choose'] == 'Categories') echo 'selected'; ?>>Categories</option>
                <option value="Products" <?php if(!empty($_POST['choose']) && $_POST['choose'] == 'Products') echo 'selected'; ?>>Products</option>
                <option value="Shipper" <?php if(!empty($_POST['choose']) && $_POST['choose'] == 'Shipper') echo 'selected'; ?>>Shipper</option>
                <option value="FAQs" <?php if(!empty($_POST['choose']) && $_POST['choose'] == 'FAQs') echo 'selected'; ?>>FAQs</option>
                <option value="Customer" <?php if(!empty($_POST['choose']) && $_POST['choose'] == 'Customer') echo 'selected'; ?>>Customer</option>
                <option value="Order" <?php if(!empty($_POST['choose']) && $_POST['choose'] == 'Order') echo 'selected'; ?>>Order</option>
            </select>
        </div>
        <button type="submit" name="search" class="btn btn-success">Search</button>
        <button type="submit" name="cancle" class="btn btn-danger">Cancle</button>
    </form>
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
    
    <?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isformvalidated() && isset($_POST['search'])):
    ?>  
        <br><h1 style ="text-align:center; margin-top:70px;">Search List</h1><br>
    <?php
        if($_SESSION['choose']=='Categories'): 
    ?>
    <table class="table table-striped">
        <tr>
            <th>Category Name</th>
            <th>CatID</th>
            <th>Quantity Of Product</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $category_set = select_categories($_SESSION['name']);
        $count = mysqli_num_rows($category_set);
        for ($i = 0; $i < $count; $i++):
            $category = mysqli_fetch_assoc($category_set); 
        ?>
            <tr>
                <td><?php echo $category['Category_Name']; ?></td>
                <td><?php echo $category['Category_CatID']; ?></td>
                <td><?php echo $category['Quantity_Of_Product']; ?></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/edit.php?id='.$category['Category_CatID']; ?>">Edit</a></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/delete.php?id='.$category['Category_CatID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($category_set);
        ?>
    </table>
    <?php
        endif;
    ?>
    <?php 
        if($_SESSION['choose']=='Products'): 
            
    ?>
    <table class="table table-striped">
        <tr>
            <th>ProductID</th>
            <th>Product Name</th>
            <th>Category Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Information</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $product_set = select_Products($_SESSION['name']);
        $count = mysqli_num_rows($product_set);
        for ($i = 0; $i < $count; $i++):
            $product = mysqli_fetch_assoc($product_set); 
        ?>
            <tr>
                <td><?php echo $product['ProductID']; ?></td>
                <td><?php echo $product['Products_Name']; ?></td>
                <td><?php echo $product['Category_Name']; ?></td>
                <td><img height = 100 src="<?php echo "../".$_SESSION['choose']."/".$product['Image']; ?>"></td>
                <td><?php echo $product['Price']; ?></td>
                <td><?php echo $product['Information']; ?></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/edit.php?id='.$product['ProductID']; ?>">Edit</a></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/delete.php?id='.$product['ProductID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($product_set);
        ?>
    </table>
    <?php
        endif;
    ?>
    <?php 
        if($_SESSION['choose']=='Shipper'): 
            
    ?>
    <table class="table table-striped">
        <tr>
            <th>ShipperID</th>
            <th>Company Name</th>
            <th>Phone Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $Shipper_set = select_Shipper($_SESSION['name']);
        $count = mysqli_num_rows($Shipper_set);
        for ($i = 0; $i < $count; $i++):
            $Shipper = mysqli_fetch_assoc($Shipper_set); 
        ?>
            <tr>
                <td><?php echo $Shipper['ShipperID']; ?></td>
                <td><?php echo $Shipper['CompanyName']; ?></td>
                <td><?php echo $Shipper['Phone']; ?></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/edit.php?id='.$Shipper['ShipperID']; ?>">Edit</a></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/delete.php?id='.$Shipper['ShipperID']; ?>">Delete</a></td>
            </tr>
        <?php
        endfor;
        mysqli_free_result($Shipper_set);
        ?>
    </table>
    <?php
        endif;
    ?>
    <?php 
        if($_SESSION['choose']=='Customer'): 
            
    ?>
    <table class="table table-striped">
        <tr>
            <th>CusID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $customer_set = select_customer($_SESSION['name']);
        $count = mysqli_num_rows($customer_set);
        for ($i = 0; $i < $count; $i++):
            $customer = mysqli_fetch_assoc($customer_set); 
        ?>
            <tr>
                <td><?php echo $customer['CusID']; ?></td>
                <td><?php echo $customer['Name']; ?></td>
                <td><?php echo $customer['Address']; ?></td>
                <td><?php echo $customer['Phone']; ?></td>
                <td><?php echo $customer['Email']; ?></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/delete.php?id='.$customer['CusID']; ?>">Delete</a></td>
            </tr>
        <?php
        endfor;
        mysqli_free_result($customer_set);
        ?>
    </table>
    <?php
        endif;
    ?>
    <?php 
        if($_SESSION['choose']=='Order'): 
            
    ?>
    <table class="table table-striped">
        <tr>
            <th>OrderID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Price</th>
            <th>Order Date</th>
            <th>Ship Date</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $order_set = select_Orderdetail($_SESSION['name']);
        $count = mysqli_num_rows($order_set);
        for ($i = 0; $i < $count; $i++):
            $Order = mysqli_fetch_assoc($order_set); 
        ?>
            <tr>
                <td><?php echo $Order['OrderID']; ?></td>
                <td><?php echo $Order['Customer_Name']; ?></td>
                <td><?php echo $Order['Address']; ?></td>
                <td><?php echo $Order['Phone']; ?></td>
                <td><?php echo $Order['Price']; ?></td>
                <td><?php echo $Order['OrderDate']; ?></td>
                <td><?php echo $Order['Shipdate']; ?></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/edit.php?id='.$Order['OrderID']; ?>">Edit</a></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/delete.php?id='.$Order['OrderID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($order_set);
        ?>
    </table>
    <?php
        endif;
    ?>
    <?php 
        if($_SESSION['choose']=='FAQs'): 
            
    ?>
    <table class="table table-striped">
        <tr>
            <th>Question</th>
            <th>Answer</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $FAQs_set = select_FAQs($_SESSION['name']);
        $count = mysqli_num_rows($FAQs_set);
        for ($i = 0; $i < $count; $i++):
            $FAQs = mysqli_fetch_assoc($FAQs_set); 
        ?>
            <tr>
                <td><?php echo $FAQs['Question']; ?></td>
                <td><?php echo $FAQs['Answer']; ?></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/edit.php?id='.$FAQs['FAQsID']; ?>">Edit</a></td>
                <td><a href="<?php echo '../'.$_SESSION['choose'].'/delete.php?id='.$FAQs['FAQsID']; ?>">Delete</a></td>
            </tr>
        <?php
        endfor;
        mysqli_free_result($FAQs_set);
        ?>
    </table>
    <?php
        endif;
    endif;
    ?>
    <script src="../../js/jquery-2.2.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>