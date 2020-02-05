<?php
require('header.php');
?>
<!doctype html>
    <head>
        <meta charset="utf-8">
        <title>handicraft</title>
      
    </head>
    <style>
    </style>
   
    <body data-spy="scroll" data-target=".navbar-collapse" data-offset="100">
        <div class="culmn">
                <div class="overlay" style="margin:0px;"></div>
                <div class="container"> 
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="col-md-12">
                                <div class="hello">
                                    <div class="slid_item">
                                        <div class="home_text " >
                                            <h1 style="color:orange;font-size:500%;margin-top:0px;margin-left:3%;">Venus Handicraft</h1>
                                           
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            <font face="Comic sans MS">
            <section id="home" class="home">
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="image/3.jpg"style='margin:auto;' alt="Construction">
                        <div class="overlay">
                            <div class="carousel-caption">
                            <h1 style="color:orange;font-size:700%;">Welcome To Shop Handicraft</h1>
                            
                            </div>					
                        </div>
                    </div>
                   
        </section>
        </font>
            <section class="margin-top-120">
            <div class="name">
            <h2 class="text-uppercase">Our <strong> construction team wed</strong></h2>
            <p style="color:rgb(255, 196, 0);">___________________________</p><br><br>
            </div>
                <div class='row'>
                <div class="container-fluid  text-center">
                    <div class='col-sm-12'>
                        <div class='col-sm-1'>
                        </div>
                        <div class='col-sm-11'>
                            <div class='col-sm-4'>
                                <img src="image/tem/5.jpg" alt=""height='100px'width='100px' class="img-circle" /><br><br>
                                <h4 class="m-top-20">Sơn <strong>Trần</strong></h4><h5> Designer</h5>
                                <a href='https://www.facebook.com/son.san.526'><img src='image/7.jpg' class='' width='30px'></a>
                               
                            </div>
                            <div class='col-sm-3'>
                            <img src="image/tem/2.jpg" alt="" height='100px'width='100px'class="img-circle" /><br><br>
                            <h4 class="m-top-20">Long <strong>Lê</strong></h4>
                            <h5>buildler</h5>
                            <a href='https://www.facebook.com/profile.php?id=100010094047282'><img src='image/7.jpg' class='' width='30px'></a>
                            </div>
                            <div class='col-sm-4'>
                            <img src="image/tem/4.jpg" alt="" height='100px'width='100px'class="img-circle" /><br><br>
                            <h4 class="m-top-20">An <strong>Nguyễn</strong></h4>
                            <h5> developer</h5>
                            <a href='https://www.facebook.com/profile.php?id=100009356841964'><img src='image/7.jpg' class='' width='30px'></a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <br>
            </section>
            <section id="product" class="margin-top-120 text-center" >  
                <div class="container">
                    <div class="name">
                        <h2><b>A </b><b>F</b>ew  <b>P</b>roducts</b></h2>
                        <p style="color:rgb(255, 196, 0);">___________________________</p><br>
                    </div>
                </div>
                <div>
                <?php
                                    $product_set = find_top6_products();
                                    $count2 = mysqli_num_rows($product_set);
                                    for ($j = 0; $j < $count2; $j++):
                                    $product = mysqli_fetch_assoc($product_set); 
                                ?>
                                <div  class="">
                                <figure class="image col-lg-4 col-md-6 col-sm-6" >
                                    <img  src="../foradmin/products/<?php echo $product['Image']?>" class="img-thumbnail"/>
                                    <figcaption>
                                        <h3><?php echo $product['Name']?></h3>
                                        <h4>Price: <?php echo $product['Price']?>$;Quantity Existing: <?php echo $product['Quantity']?></h4>
                                    </figcaption>
                                </figure>
                                </div>
                                <?php
                                    endfor;
                                    mysqli_free_result($product_set);
                                ?>
                
                </div>
                <hr>
                <a href='Product.php' class='btn btn-info' style="margin:20px;text-align:center">View More </a>
                
            </section>
            
        </div>
        
       

    <?php 
    require('footer.php');
    ?>
    </body>
 
</html>