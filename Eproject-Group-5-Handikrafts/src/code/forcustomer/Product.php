<?php
require('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Product</title>
    <style>
    div form ul li{
        margin-left:10px;
        line-height:35px;
        width:auto;
        list-style:none;
        display:inline-block;
    }
    
    .image {
        font-family: 'Montserrat', Arial, sans-serif; */
        position: relative;
        /* display: inline-block; */
        margin: 20px 10px;
        /* color: #fff; */
        text-align: center;
        font-size: 16px;
        /* background: #000; */
    }
    /*
    .image *,
    .image:before,
    .image:after {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    .image img {
        max-width: 100%;
        backface-visibility: hidden;
        vertical-align: top;
    }

    .image:before,
    .image:after {
        position: absolute;
        top: 20px;
        right: 20px;
        content: '';
        background-color: #fff;
        z-index: 1;
        opacity: 0;
    }

    .image:before {
        width: 0;
        height: 1px;
    }

    .image:after {
        height: 0;
        width: 1px;
    }

    .image figcaption {
        position: absolute;
        left: 0;
        bottom: 0;
        padding: 15px 20px;
    }

    .image h3,
    .image h4,.buy {
        margin-bottom: 3px;
        font-size: 1.4em;
        font-weight: normal;
        opacity: 0;
        text-transform: uppercase;
    }

    .image h4,.buy {
        font-size: 1em;
    }

    .image a {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1;
    }

    .image:hover img,
    .image.hover img {
        zoom: 1;
        filter: alpha(opacity=20);
        -webkit-opacity: 0.2;
        opacity: 0.2;
    }

    .image:hover:before,
    .image.hover:before,
    .image:hover:after,
    .image.hover:after {
        opacity: 1;
        -webkit-transition-delay: 0.25s;
        transition-delay: 0.25s;
    }

    .image:hover:before,
    .image.hover:before {
        width: 70px;
    }

    .image:hover:after,
    .image.hover:after {
        height: 70px;
    }

    .image:hover h3,
    .image.hover h3,
    .image:hover h4,
    .image.hover h4,
    .buy:hover,
    .buy.hover {
        opacity: 1;
        -webkit-transition-delay: 0.25s;
        transition-delay: 0.25s;
    } */
    </style>
</head>
<body>
<div class="container-fluid"  style="text-align:center">
    <div style="text-align:left">
    <form class="navbar-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" role="form" style="color:#44FDB9">
        <div class="form-group" style="width:600px">
            <input style="width:300px" type="text" name="search" class="form-control" value="<?php if(!empty($_POST['search'])) echo $_POST['search'];?>" placeholder="Search">
            <button style="margin-bottom:0px;" type="submit" name="submit" class="btn btn-default glyphicon glyphicon-search link"> </button>
        </div>
        <hr>

        <p style="text-align:left;">
        <button style="margin-bottom:0px;" class="btn btn- default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <span style='color:black;'><i class="glyphicon glyphicon-filter link"> Filter</i></span>
        </button>
        </p>
    
        <div class="collapse" id="collapseExample">
            <ul>
                <?php 
                    $t = 0; $y = 0;
                    $category_set = find_all_categories();
                    $count = mysqli_num_rows($category_set);
                    $x=[];
                    for ($i = 0; $i < $count; $i++):
                        $category = mysqli_fetch_assoc($category_set); 
                ?>
                    <li>
                        <input class="check" type="checkbox" name="<?php $x[$i]=$category['CatID']; echo $x[$i];?>" value="<?php echo $x[$i];?>" <?php if(!empty($_POST[$x[$i]])){ echo 'checked';} ?>> <?php echo $category['Name'];?>
                    </li>
                <?php 
                    endfor; 
                    mysqli_free_result($category_set);
                ?>
                <li><input type="checkbox" name="checkall" <?php if(!empty($_POST['checkall']) || $_SERVER['REQUEST_METHOD']!='POST') echo 'checked'; ?> id="checkall">Check All</li>
            </ul>
        </div>
        <hr>
    </div>
    </form>
    <div class="name">
    <h2>  Product </h2>
    <p style="color:rgb(255, 196, 0);">___________________________</p><br>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'):
    ?>
    <div class="product">
        <?php for($i = 0; $i< $count; $i++): ?>
            <?php if(!empty($_POST[$x[$i]]) && !empty($_POST['search'])):?>
                <?php 
                    $t++;
                    $product_set = find_products_by_CatIDandName($x[$i],$_POST['search']);
                    $count2 = mysqli_num_rows($product_set);
                    if($count2 != 0) $y++;
                    for ($j = 0; $j < $count2; $j++):
                    $product = mysqli_fetch_assoc($product_set); 
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <figure class="image">
                    <img width=310 height=400 src="../foradmin/products/<?php echo $product['Image']?>" />
                        <figcaption>
                            <h3><?php echo $product['Name']?></h3>
                            <h4>Price: <?php echo $product['Price']?>$</h4><h4>Quantity Existing: <?php echo $product['Quantity']?></h4>
                        </figcaption>
                    </figure><br>
                    <?php if($product['Quantity']<=0): ?>
                        <h3 style="color:red;margin:auto;">Out of stock</h3>
                    <?php elseif($product['Quantity']>0): ?>
                        <a href="<?php echo 'product_detail.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger  glyphicon glyphicon-eye-open"> View</button></a>
                        <a href="<?php echo 'addcart.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger glyphicon glyphicon-shopping-cart add"> Add </button></a>
                    <?php endif;?>
                </div>
                <?php
                    endfor;
                    mysqli_free_result($product_set);
                ?> 
            <?php 
                endif;
            ?>
            <?php if(!empty($_POST[$x[$i]]) && empty($_POST['search'])):?>
                <?php
                    $t++;
                    $product_set = find_products_by_CatID($x[$i]);
                    $count2 = mysqli_num_rows($product_set);
                ?>
                <?php if($count2 !=0) $y++; ?>
                <?php
                    for ($j = 0; $j < $count2; $j++):
                    $product = mysqli_fetch_assoc($product_set); 
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <figure class="image">
                    <img width=310 height=400 src="../foradmin/products/<?php echo $product['Image']?>" />
                        <figcaption>
                            <h3><?php echo $product['Name']?></h3>
                            <h4>Price: <?php echo $product['Price']?>$</h4><h4>Quantity Existing: <?php echo $product['Quantity']?></h4>
                        </figcaption>
                    </figure><br>
                    <?php if($product['Quantity']<=0): ?>
                        <h3 style="color:red;margin:auto;">Out of stock</h3>
                    <?php elseif($product['Quantity']>0): ?>
                        <a href="<?php echo 'product_detail.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger  glyphicon glyphicon-eye-open"> View</button></a>
                        <a href="<?php echo 'addcart.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger glyphicon glyphicon-shopping-cart add"> Add </button></a>
                    <?php endif;?>
                </div>
                <?php
                    endfor;
                    mysqli_free_result($product_set);
                ?>
            <?php    
                endif;
            ?>
            
        <?php
            endfor;
            if(!empty($_POST['search']) && $t!=0 && $y==0):
        ?>
            <h1>We can not find the product for you</h1>
        <?php
            elseif($y==0 && $t!=0):
        ?>
            <h1>We can not find the product for you</h1>
        <?php
            endif;
        ?>
        <?php if(!empty($_POST['search'])): ?>
            <?php for($i=0;$i<$count;$i++): ?>
            <?php 
                if(!empty($_POST[$x[$i]])) $t++;
                endfor;
            ?>
                <?php
                if($t==0):
                    $product_set = find_products_by_Name($_POST['search']);
                    $count2 = mysqli_num_rows($product_set);
                ?>
                <?php if($count2!=0): $y++;?>
                <?php
                    for ($j = 0; $j < $count2; $j++):
                    $product = mysqli_fetch_assoc($product_set); 
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <figure class="image">
                    <img width=310 height=400 src="../foradmin/products/<?php echo $product['Image']?>" />
                        <figcaption>
                            <h3><?php echo $product['Name']?></h3>
                            <h4>Price: <?php echo $product['Price']?>$</h4><h4>Quantity Existing: <?php echo $product['Quantity']?></h4>
                        </figcaption>
                    </figure><br>
                    <?php if($product['Quantity']<=0): ?>
                        <h3 style="color:red;margin:auto;">Out of stock</h3>
                    <?php elseif($product['Quantity']>0): ?>
                        <a href="<?php echo 'product_detail.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger  glyphicon glyphicon-eye-open"> View</button></a>
                        <a href="<?php echo 'addcart.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger glyphicon glyphicon-shopping-cart add"> Add </button></a>
                    <?php endif;?>
                </div>
                <?php 
                    endfor;
                    mysqli_free_result($product_set);
                    endif;
                endif;
                ?>
            <?php elseif(empty($_POST['search']) && $t==0):?>
                
                <h1>We can not find the product for you</h1>
            <?php    
                endif;
            ?>
        <?php elseif($_SERVER['REQUEST_METHOD']!='POST'):?>
        <?php 
            $product_set = find_all_products();
            $count = mysqli_num_rows($product_set);
            for ($i = 0; $i < $count; $i++):
            $product = mysqli_fetch_assoc($product_set); 
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <figure class="image">
                <img height=300  src="../foradmin/products/<?php echo $product['Image']?>" class="img-thumbnail"/>
                    <figcaption>
                        <h3><?php echo $product['Name']?></h3>
                        <h4>Price: <?php echo $product['Price']?>$</h4><h4>Quantity Existing: <?php echo $product['Quantity']?></h4>
                    </figcaption>
                </figure><br>
                <?php if($product['Quantity']<=0): ?>
                    <h3 style="color:red;margin:auto;">Out of stock</h3>
                <?php elseif($product['Quantity']>0): ?>
                    <a href="<?php echo 'product_detail.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger  glyphicon glyphicon-eye-open"> View</button></a>
                    <a href="<?php echo 'addcart.php?id='.$product['ProductID']; ?>"><button type="Submit" class="btn btn-danger glyphicon glyphicon-shopping-cart add"> Add </button></a>
                <?php endif;?>
            </div>
        <?php 
            endfor; 
            mysqli_free_result($product_set);
        ?>
    </div>
    <?php 
        endif;
    ?>
</div>
<?php require('footer.php');?>
<script>
    if($('#checkall').is(':checked'))
        $('.check').prop("checked",true);
    $('#checkall').click(function() {
        if($(this).is(':checked'))
            $('.check').prop("checked",true);
        else
            $('.check').prop("checked",false);
    });
    $('.check').click(function() {
        if(!$(this).is(':checked'))
            $('#checkall').prop("checked",false);
    })

</script>
</body>
</html>