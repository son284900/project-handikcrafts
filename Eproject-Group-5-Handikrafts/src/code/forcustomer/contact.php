<?php
require("header.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>contact</title>
</head>
<style>
    .name{
        text-align: center;
    }
    table{
        border:3;width:1200px;
        height:auto;
        padding:20px;margin: auto;
        background-color: rgba(225, 255, 205, 0.356);
        color: black;
           
    }
    i,p,h2{
        
        margin: 10px;
    }
    .in{
        text-align: right;
    }
</style>
<body>
 <div class="name">
    <h2> CONTACTS US </h2>
    <p style="color:rgb(255, 196, 0);">___________________________</p><br>
 </div>
    <table >
          <tr>
              <td>
                  <h2 style="color:black;"> Coutact Details</h2>
              </td>
          </tr>
        <tr>
            <td rowspan="2"class='us'>
                <button type="button" style='margin-left:5%;' class="btn btn-danger glyphicon"><h4 class='glyphicon glyphicon-map-marker'> Address :</h4></button>
                <br>
                <a  style="color:black;"><h5 style='margin:15px'>Get direction <b class="glyphicon glyphicon-share"></b> </h5></a>         
                <p>History Handicraft Company 
                <p>at Verus street No 54,Le Thanh Nghi</p>
                <a  style="color:black;"><h5 style='margin:15px'>Address Verified <b class="glyphicon glyphicon-check"></b></h5></a></p>
                <button type="button" style='margin-left:5%;' class="btn btn-success"><h4  class='glyphicon glyphicon-phone'> Call Us:</h4></button>
                <h2  class='google'> +0971454728</h2> 
            </td>
            <td rowspan="2"class='us'>
                <p>
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.759775523829!2d105.83989091440692!3d21.002264494059382!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad58455db2ab%3A0x9b3550bc22fd8bb!2zNTQgTMOqIFRoYW5oIE5naOG7iywgSGFpIELDoCBUcsawbmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1553469403893" width="300px"height='300px' frameborder="0" allowfullscreen></iframe>  
                    </div>              
                </p>                 
            </td>         
            <td rowspan="2">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="form-group" >
                    <td>
                        <label for="name">Name</label><br>
                        <input type="text"name="name"required>
                    </td>
                    <td>
                        <label for="email">Email ID</label><br>
                        <input type="email"name="email"required>
                    </td>
                </div>
                    <tr>
                        <td colspan="2">
                            <h4>Comments</h4>
                            <form role="form">
                            <div class="form-group" style='margin-right:5%;'>
                                <textarea width=500 class="form-control" name="Question" rows="4" required></textarea>                                
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <br>     
                            <br>
                            <?php if ($_SERVER["REQUEST_METHOD"] == 'POST'): ?> 
                            <?php 
                                $contact = [];
                                $contact['Name'] = $_POST['name'];
                                $contact['Email'] = $_POST['email'];
                                $contact['Question'] = $_POST['Question'];
                                $result = insert_Contact($contact);
                            ?>
                            <?php endif; ?>
                            <br><br>
                        </td>
                    </tr>
            </table>
        <?php
            require("footer.php");
        ?>
</body>
</html>
<?php
db_disconnect($db);
?>