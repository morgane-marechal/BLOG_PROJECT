<?php session_start(); ?>
<?php require_once 'src/Article.php';?>



<?php 
     $manage_articles = new Article();
     $display_articles=$manage_articles->manageArticles();

     if (isset($_GET['delete-article'])){
        $deleteArticle = new Article();
        $deleteArticle->deleteArticle((int) $_GET['delete-article']);
        die();
    }

?>

<h2>Modération des articles</h2>
      <?php  for ($i = 0; $i <= (count($display_articles)-1); $i++) { ?>
        <form class='admin-article' id='admin_article_form' action='' method='get'>
        <input type='hidden' name='id_article' id='id_article' value='<?=$display_articles[$i]['id']?>' readonly>
        <label for='newtitre'>Titre</label>
        <input type='text' name='newtitre' id='newtitre' class='titre_article' value='<?=$display_articles[$i]['titre']?>' minlength='3'>
        <p><label for='contenu'>Contenu</label></p>
        <p><textarea name='contenu' class='manage-content' value='<?=$display_articles[$i]['contenu']?>' ><?=$display_articles[$i]['contenu']?>'</textarea></p>
        <label for='categorie'>Catégorie</label>
        <select name='categorie' id='categorie'>
                <option value=''><?=$display_articles[$i]['categorie']?></option>
                <option value='reconversion'>Reconversion</option>
                <option value='autoformation'>Autoformation</option>
                <option value='actu'>Actu</option>
                <option value='divers'>Divers</option>
                <option value='jsepa'>Je ne sais pas</option>
        </select>
        <input class='updateArticle' id='submit' name='submit' type='submit' value='Appliquer le changement'>
        </form>
        <button type='submit' class='del-article' id='<?=$display_articles[$i]['id']?>' href=admin_articles.php?delete-article=<?=$display_articles[$i]['id']?> >Supprimer l'article</button>
<?php } ?>


</body>
</html>

<?php



?>