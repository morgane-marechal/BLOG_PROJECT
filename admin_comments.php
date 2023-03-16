<?php session_start(); ?>
<?php require_once 'src/Comments.php';?>

<?php 
     $manage_comments = new Comments();
     $result_display=$manage_comments->manageComment();
     //var_dump($result_display);
?>

<?php
    for ($i = 0; $i <= (count($result_display)-1); $i++) { ;
    echo 
    "<div id='id_user".$result_display[$i]['id']." class='id_user'>
    <div class = 'titre_commentaire'> <p>Titre : ".$result_display[$i]['titre']."</p></div>
    <div class= 'login_commentaire'> <p> Auteur : ".$result_display[$i]['login']."</p></div> 
    <div class = 'contenu_commentaire'> <p>Contenu : ".$result_display[$i]['contenu']."</p></div>
    <button class='del-comment' id='".$result_display[$i]['id']."' name='submit' type='submit' value='Supprimer le commentaire' href=admin_comments.php?delete-comment=".$result_display[$i]['id']." >Supprimer le commentaire</button>";
    }
?>

<?php 


     if (isset($_GET['delete-comment'])){
        $delete_comment = new Comments();
        $delete_comment->deleteComment($_GET['delete-comment']);
        die();
    }

?>




