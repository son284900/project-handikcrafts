<?php 
require('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sitemap</title>   
    <style>
    .sitemap{
        width:1300px;
        background-color:rgba(225, 255, 205, 0.356);
        margin:auto;
        padding:12px;
    }
    .site{
        color:lightblue;
    }
    </style>
</head>
<body>
<form  class="navbar-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" role="form">
<div class="name">
    <h2> SiteMap </h2>
    <p style="color:rgb(255, 196, 0);">___________________________</p><br>
 </div>
<section class="sitemap">  
    <div class="container"> 
            <br><br>
            <h4><a class='site' href="homepage.php"><b> Home</b></a></h4>
            <br>
            
            <h4><a class='site' href="Product.php"><b> Product</b></a></h4>
            
                <?php 
                    $t = 0; $y = 0;
                    $category_set = find_all_categories();
                    $count = mysqli_num_rows($category_set);
                    $x=[];
                    for ($i = 0; $i < $count; $i++):
                        $category = mysqli_fetch_assoc($category_set); 
                ?>
                <h4 class='yellow'>&#8211; <?php echo $category['Name'];?><br></h4>
                <?php 
                    endfor; 
                    mysqli_free_result($category_set);
                ?><br>
            <h4><a class='site'><b> Contact US</b></a></h4>
            <br>
            <h4><a class='site' href="faqs.php"><b> FAQs</b></a></h4>
            <br>
            <h4><a class='site' href="about.php"><b> About US</b></a></h4>
    </div>
</section>
</form>
</body>
</html>

<?php
require('footer.php');
?>