
<?php session_start(); ?>
<?php require('src/Article.php'); ?>
<?php require('src/User.php'); ?>
<?php 
     $new_display = new User();
     $new_display->displayUsers();
   

     if (!empty($_POST['role'])) {
        $role = htmlspecialchars($_POST['role']);
        $idUser = htmlspecialchars($_POST['idUser']);
        echo $role." et ".$idUser;
    
    }


?>

