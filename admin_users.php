
<?php session_start(); ?>
<?php require('src/Article.php'); ?>
<?php require('src/User.php'); ?>
<?php 



    echo var_dump($_SESSION);
     $new_display = new User();
     $new_display->displayUsers();
   
 if (!empty($_POST['role'])) {
     $role = htmlspecialchars($_POST['role']);
     echo $role." et ".$idUser;
     $_SESSION['newRang'] = $role;
     }


if (isset($_GET['delete'])){
    $id_user = $_SESSION['id'];
    $deleteUser = new User();
    $deleteUser->delete((int) $_GET['delete']);
    die();
}




?>

