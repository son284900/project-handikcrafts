
<?php
require_once("../foradmin/lib/database.php");
require_once('../foradmin/lib/initialize.php');
if(!isset($_SESSION['username'])){
    //redirect_to('Product.php');
    echo "<script>alert('You must be log in to buy or add to cart');location.href='product.php'</script>";
}else{
    if(!isset($_GET['id'])) {
        redirect_to('Product.php');
    }
    $id = $_GET['id'];
    $Product = find_products_by_id($id);
    if(!isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['name'] = $Product['Name'];
        $_SESSION['cart'][$id]['image'] = $Product['Image'];
        $_SESSION['cart'][$id]['quantity'] = 1;
        $_SESSION['cart'][$id]['price'] = $Product['Price'];
        $_SESSION['cart'][$id]['totalprice'] = $_SESSION['cart'][$id]['price']*$_SESSION['cart'][$id]['quantity'];
    }else{
        $_SESSION['cart'][$id]['quantity'] += 1;
        $_SESSION['cart'][$id]['totalprice'] = $_SESSION['cart'][$id]['price']*$_SESSION['cart'][$id]['quantity'];
    }
    $_SESSION['addcart'] = 'Add To Cart Success';
    redirect_to('product.php');
}
?>