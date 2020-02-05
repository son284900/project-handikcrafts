<?php
require_once('../admin/adminheader.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Contact</title>
    <style>
        table th{
            background-color:lightblue;
        }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['Update'])): ?>    
        <h1 style="text-align:center;border:medium solid green;color:green;padding:10px 0;width:500px;margin:auto;"><?php echo $_SESSION['Update']; ?></h1>
    <?php endif;?>
    <?php if(isset($_SESSION['delete'])): ?>
        <h1 style="text-align:center;border:medium solid green;color:green;padding:10px 0;width:500px;margin:auto;"><?php echo $_SESSION['delete']; ?></h1>
    <?php endif;?>
    <h1 style="text-align:center;">Contact list</h1> <br><br>
    <table class="table table-striped">
        <tr>
            <th>ContactID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Question</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $Contact_set = find_all_contact();
        $count = mysqli_num_rows($Contact_set);
        for ($i = 0; $i < $count; $i++):
            $contact = mysqli_fetch_assoc($Contact_set);
        ?>
            <tr>
                <td><?php echo $contact['ContactID']; ?></td>
                <td><?php echo $contact['Name']; ?></td>
                <td><?php echo $contact['Email']; ?></td>
                <td><?php echo $contact['Question']; ?></td>
                <td><a href="<?php echo 'delete.php?id='.$contact['ContactID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($Contact_set);
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>