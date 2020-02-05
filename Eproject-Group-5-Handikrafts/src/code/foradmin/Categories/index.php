<?php
require_once('../admin/adminheader.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Category</title>
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
    <a href="new.php" style="text-align:center"><h1>Create new categories</h1></a> <br><br>
    <table class="table table-striped">
        <tr>
            <th>CatID</th>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $categories_set = find_all_categories();
        $count = mysqli_num_rows($categories_set);
        for ($i = 0; $i < $count; $i++):
            $category = mysqli_fetch_assoc($categories_set); 
        ?>
            <tr>
                <td><?php echo $category['CatID']; ?></td>
                <td><?php echo $category['Name']; ?></td>
                <td><a href="<?php echo 'editcategory.php?id='.$category['CatID']; ?>">Edit</a></td>
                <td><a href="<?php echo 'deletecategory.php?id='.$category['CatID']; ?>">Delete</a></td>
                <td><a href="<?php echo 'viewproduct.php?id='.$category['CatID']; ?>">View Product Of <?php echo $category['Name']; ?></a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($categories_set);
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
unset($_SESSION['Update']);
unset($_SESSION['delete']);
?>