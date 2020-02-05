<?php
require('header.php');
$error = 0;
$product=[];
foreach($_SESSION['cart'] as $key => $value){
    $product[$key] = [];
    $product[$key]['orderID']='';
    $product[$key]['productID'] = $key;
    $product[$key]['quantity'] = $value['quantity'];
    $product[$key]['price'] = $value['price']*$value['quantity'];
}
foreach($_SESSION['cart'] as $key => $value){
    $quantity = find_products_by_id($key)['Quantity'];
    if($quantity - $value['quantity']<0){
        echo "<h2 style='color:red;text-align:center'>Quantity of ".$value['name']." exceeds the existing quantity</h2>";
        $error = 1;
    }
}
$Customer = find_customer_by_UserName($_SESSION['username']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $error == 0){
    $Order = [];
    if(find_last_OrderID()){
        $Order['OrderID'] = mysqli_fetch_assoc(find_last_OrderID())['OrderID']+1;
    }else{
        $Order['OrderID'] = 1;
    }
    $Order['CusID'] = $Customer['CusID'];
    $Order['Price'] = $_SESSION['total'];
    if(!empty($_POST['Status'])){
        $Order['Status'] = $_POST['Status'];
    }else{
        $Order['Status'] = '';
    }
    $Order['OrderDate'] = date('Y/m/d');
    insert_Order($Order);
    foreach($_SESSION['cart'] as $key => $value){
        $quantity = find_products_by_id($key)['Quantity'];
        $product[$key] = [];
        $product[$key]['orderID'] = $Order['OrderID'];
        $product[$key]['productID'] = $key;
        $product[$key]['quantity'] = $value['quantity'];
        $product[$key]['price'] = $value['price']*$value['quantity'];
        insert_orderdetail($product[$key]);
        $quantity = $quantity - $value['quantity'];
        update_quantity_product_in_ID($key,$quantity);
    }
    unset($_SESSION['cart']);
    unset($_SESSION['total']);
    unset($_SESSION['totalquantity']);
    redirect_to("paymentnotice.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Payment</title>
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
    <?php if(isset($_SESSION['cart'])): ?>
    <div class="col-xs-offset-2 col-xs-8">
        <form action="" method="post">
            <legend>Payment</legend>
            <div class="form-group">
                <label for="Name">Name</label> <!--required-->
                <input class="form-control" readonly="" type="text" id="Name" name="Name" value="<?php echo $Customer['Name'] ?>">
            </div>
            <div class="form-group">
                <label for="Address">Address</label> <!--required-->
                <input class="form-control" readonly="" type="text" id="Address" name="Address" value="<?php echo $Customer['Address'] ?>">
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label> <!--required-->
                <input class="form-control" readonly="" type="text" id="Phone" name="Phone" value="<?php echo $Customer['Phone'] ?>">
            </div>
            <div class="form-group">
                <label for="Email">Email</label> <!--required-->
                <input class="form-control" readonly="" type="Email" id="Email" name="Email" value="<?php echo $Customer['Email'] ?>">
            </div>
            <?php
                foreach($_SESSION['cart'] as $key => $value):
            ?>
                <div class="form-group">
                    <input type="hidden" name="<?php echo $key?>" value="<?php echo $key;?>">
                    <h4>Product Name: <?php echo $value['name']; ?></h4>
                    <h4>Product Name: <?php echo $product[$key]['productID']; ?></h4>
                    <h4>Quantity: <?php echo $product[$key]['quantity']; ?></h4>
                    <h4>Price: <?php echo $product[$key]['price']; ?></h4>
                </div>
            <?php  
                endforeach;
            ?>
            <div class="form-group">
                <label for="totalPrice">Total Price</label> <!--required-->
                <input class="form-control" readonly="" type="text" id="Status" name="Status" value="<?php if(isset($_SESSION['total'])){ echo $_SESSION['total']; } else echo '0';?>$">
            </div>
            <div class="form-group">
                <label for="Status">Status</label> <!--required-->
                <input class="form-control"  type="text" id="Status" name="Status" value="">
            </div>
            <br>
            <input type="submit"  name="payment"  class="btn btn-success" value="Payment">
        </form>
        <br><br>
        <a href="Cart.php">Back to Cart</a> 
        <?php endif;?>   
    <br><br>
    </div>
    <?php require('footer.php');?>
</body>
</html>


<?php
db_disconnect($db);
?>