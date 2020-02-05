<?php
require('header.php');
?>
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<title>FAQs</title>
</head>
<style>
.name{
        text-align: center;
    }
table{
        border:3;
        width:1300px;
        margin: auto;
        background-color: rgba(225, 255, 205, 0.356);
    }
tr td{
    padding:20px 40px;
}
</style>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
       
       
        <table>
            <tr>
                <div class="name">
                       <h2>FAQs</h2>
                    <p style="color:rgb(255, 196, 0);">___________________________</p>
                 </div>
        </tr>
         <?php  
            
            $set = find_all_faqs();
            $count = mysqli_num_rows($set);
            for ($i = 0; $i < $count; $i++):
            $faqs = mysqli_fetch_assoc($set); 
            ?>
            <br>
            <tr>
                <td>
                    <p style="text-align:left;">
                        <b><?php echo $faqs['Question'];?></b>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#<?php echo $faqs['FAQsID'];?>">Read</span></button>
                    </p>
                    <div class="collapse" id="<?php echo $faqs['FAQsID'];?>">
                        <ul>
                            <li><?php echo $faqs['Answer']; ?></li>
                        </ul>
                    <div>
                </td>
            </tr>
            <?php 
                endfor; 
                mysqli_free_result($set);
            ?>
    </table> 
       
    </form>
    <?php 
       require('footer.php');
    ?>
</body>
</html>