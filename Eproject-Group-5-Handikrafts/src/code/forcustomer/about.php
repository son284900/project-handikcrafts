<?php
require('header.php');
// require('database/database.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>about us</title>
<style>
    /* a.get:hover{
        color:aqua;
        text-decoration: none;
    }
   
    a.verified:hover{
        color:greenyellow;
        text-decoration: none;
    } */
 .name{
        text-align: center;
    }
 table{
        
        
        width:1200px;
        height:auto;
        padding:20px;margin: auto;
        background-color: rgba(225, 255, 205, 0.356);
       
    }
    /* a{
        color: darkgray;text-decoration: none;
    }
    p{
    color: darkgray;
           
    }
    a.home:hover{
        color:brown;
        text-decoration: none;
    }
    a.Our:hover{
        color:brown;
        text-decoration: none;
    } */
    form i,form p,form h2{
        
        margin: 18px;
    }

</style>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
<div class="name">
        <h2>History Handicraft Company</h2>
    <p style="color:rgb(255, 196, 0);">___________________________</p>
 </div>
 <p style="text-align:left;"><b>In the era of industry 4.0 developed rapidly.</b>Information 
     Technology (IT) has been changing the world quickly. 
     <b>Website system is growin</b>g in the world and increasingly 
     playing an important role for people. Enterprises gradually 
     use the commercial website to replace the old business form 
     because of its superiority from entertainment, marketing and trade.
     Business website has many advantages: faster, more convenient, more efficient,
     not limited in space and time, cost effective.<b>There fore Venus Handicrafts 
     specializes in handicraft products to create a Website to advertise, and trade goods</b>.x`
     <b>This project can contribute
    to publicizing the company, attracting customers, increasing revenue for the company.</b></p>
 <table >
     <tr>
            <div class="name">
                    <h2>FACTSHEET</h2>
                <p style="color:rgb(255, 196, 0);">___________________________</p>
             </div>
     </tr>
    <tr>
        <tr>
        <td>
            <h3 style='margin-left:3%;'>Basic Information</h3>
        </td>
    </tr>
        <td rowspan="2" style="text-align:left;">
            <p> Nature of Business </p>
            <p>Company CEO </p>
            <p> Total Number of Employees</p>
            <p> Year of Establishment</p>
            <p>Legal Status of Firm</p>
           
            
        </td>
        <td rowspan="2" style="text-align:left;">
            <p>Manufacturer  </p>
            <p>Monu Saxena </p>
            <p> Upto 10 People</p>
            <p> 2019 </p>
            <p>Sole Proprietorship (Individual) </p>


        </td>
    </tr>
   <br>
 </table>
 <table>
     <tr>
            <div class="name">
                    <h2>WHY US ?</h2>
                <p style="color:rgb(255, 196, 0);">___________________________</p>
             </div>
     </tr>
     <tr>
         <td>
                <p><b>W</b>e are a customer-centric organization that believes in satisfying our clients. We follow a systematic and professional approach towards our manufacturing process. </p>
                <p><b>Following are the reasons that help us to gain immense recognition in the market.</b></p>
                <p>&#9679; World-class quality standards</p>
                <p>&#9679; Well-equipped & the latest production line</p>
                <p>&#9679; Advanced and updated production techniques</p>
                <p>&#9679; On-time delivery and after sales support</p>
                <p>&#9679; Competitive industrial leading prices</p>
        </td>
     </tr>
 </table>
 <br>
 <br>
</form>
<?php
 require('footer.php');
?>
</body>
</html>
