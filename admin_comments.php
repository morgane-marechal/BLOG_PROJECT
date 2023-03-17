<?php session_start(); ?>
<?php require_once 'src/Comments.php'; ?>

<?php
$manage_comments = new Comments();
$result_display = $manage_comments->manageComment();
//var_dump($result_display);
?>
<h2>Affichage des commentaires</h2>
<?php for ($i = 0; $i <= (count($result_display) - 1); $i++) { ?>
    <div id='id_user' <?= $result_display[$i]['id'] ?> class='id_comment'>
        <div class='titre_commentaire'>
            Titre : <?= $result_display[$i]['titre'] ?>
        </div>
        <div class='login_commentaire'>
            Auteur : <?= $result_display[$i]['login'] ?>
        </div>
        <div class='contenu_commentaire'>
            Contenu : <?= $result_display[$i]['contenu'] ?>
        </div>
        <button class='del-comment' id=' <?= $result_display[$i]['id'] ?>' name='submit' type='submit' value='Supprimer le commentaire' href=admin_comments.php?delete-comment=".$result_display[$i]['id'].">Supprimer le commentaire</button>
    </div>
<?php   } ?>

    <?php


    if (isset($_GET['delete-comment'])) {
        $delete_comment = new Comments();
        $delete_comment->deleteComment($_GET['delete-comment']);
        die();
    }

    ?>