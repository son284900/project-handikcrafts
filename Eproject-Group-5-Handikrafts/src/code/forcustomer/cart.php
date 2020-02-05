<?php
require_once('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cart</title>
    <style>
        table {
        border-collapse: collapse;
        vertical-align: top;
        }
        table.list {
        width:1100px;
        margin:auto;
        margin-bottom:50px;
        }

        table.list tr td {
        border: 1px solid #999999;
        text-align: Center;
        padding:5px;
        }

        table.list tr th {
        border: 1px solid #0055DD;
        background: #0055DD;
        color: white;
        text-align: left;
        }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['cart']) && count($_SESSION["cart"])!=0): ?>
    <h2 style="text-align:center;color:red;margin-bottom:40px">Cart of you</h2>
    <form action="" method="post" class="text-center">
    <table class="list" id="list">
        <tr>
            <th>STT</th>
            <th>Product Name</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total Price</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        if(isset($_SESSION['cart'])):
            $_SESSION['total']=0;
            $x=[];
            $i=0;
            $stt = 1; 
        foreach ($_SESSION['cart'] as $key => $value):
            $x[$i] = $key; 
        ?>
            <tr>
                <td width=50><?php echo $stt ?></td>
                <td width=200><?php echo $_SESSION['cart'][$x[$i]]['name']; ?></td>
                <td width=300><img height=200px src="../foradmin/products/<?php echo $_SESSION['cart'][$x[$i]]['image']; ?>" alt=""></td>
                <td width=100><input type="number" name="<?php echo $x[$i];?>" id="qty" value="<?php if(!isset($_POST[$x[$i]])){echo $_SESSION['cart'][$x[$i]]['quantity'];}else echo $_POST[$x[$i]]; ?>" class="form-control" style="width:70px" min=1></td>
                <td width=100><?php echo $_SESSION['cart'][$x[$i]]['price']; ?>$</td>
                <td width=100><?php if(!isset($_POST[$x[$i]])){echo $_SESSION['cart'][$x[$i]]['price']*$_SESSION['cart'][$x[$i]]['quantity'];}else echo $_SESSION['cart'][$x[$i]]['price']*$_POST[$x[$i]];?>$</td>
                <td class="text-center" width=250>
                    <a href="remove.php?id=<?php echo $key;?>" class="btn btn-danger">Remove</a>
                </td>
            </tr>
        <?php
        if(!isset($_POST[$x[$i]])){$_SESSION['total'] += $_SESSION['cart'][$x[$i]]['price']*$_SESSION['cart'][$x[$i]]['quantity'];}
        else {$_SESSION['total'] += $_SESSION['cart'][$x[$i]]['price']*$_POST[$x[$i]];}
        $i++;
        $stt++;endforeach;
        ?>
    </table>
    <input type="submit" name="update" class="btn btn-info" value="Update">
    </form>
    <br>
        <div style="width:300px; margin:auto">
            <ul class="list-group">
                <li class="list-group-item">
                    <h3>Order Information</h3>
                </li>
                <li class="list-group-item">
                    <span class="badge"><?php echo $_SESSION['total']." $";?></span>Total Payment
                </li>
                <li class="list-group-item">
                    <a href="Product.php" class="btn btn-primary">Continue Buying</a>
                    <a href="Payment.php" class="btn btn-danger">Payment</a>
                </li>
            </ul>
        </div>
    <?php
        endif;
    endif;
    ?>
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            if(isset($stt) && $stt>0){
                for($i=0;$i<$stt-1;$i++){
                    if(!empty($_POST[$x[$i]])){
                        $_SESSION['cart'][$x[$i]]['quantity'] = $_POST[$x[$i]];
                    }
                    if($_POST[$x[$i]] == 0){
                        unset($_SESSION['cart'][$x[$i]]);
                    }
                }
            }
        }
    ?>
    <?php if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0):?>
    <h2 style="text-align:center;color:red;margin-bottom:40px">You don't have product in your cart</h2>
    <?php endif;?>
    <br>
    <br>
    <?php require_once("footer.php") ?>
</body>
</html>

<?php
db_disconnect($db);
?>