
<?php session_start(); ?>
<?php require('src/Article.php'); ?>
<?php require('src/User.php'); ?>
<?php 



    echo var_dump($_SESSION);
     $new_display = new User();
     $new_display->displayUsers();
   
 if (isset($_GET['update']) && isset($_GET['role'])) {
    $updateUser = new User();
    $updateUser->update((int) $_GET['update'], $_GET['role']);
     }


if (isset($_GET['delete'])){
    $id_user = $_SESSION['id'];
    $deleteUser = new User();
    $deleteUser->delete((int) $_GET['delete']);
    die();
}




?>

