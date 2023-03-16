<?php session_start(); ?>
<?php require_once 'src/Article.php';?>



<?php 
     $manage_articles = new Article();
     $manage_articles->manageArticles();

     if (isset($_GET['delete-article'])){
        $deleteArticle = new Article();
        $deleteArticle->deleteArticle((int) $_GET['delete-article']);
        die();
    }

?>

<!-- <form id='admin_article_form' action='' method='post'>
    <h3>Modération des articles</h3>
    <label for='newtitre'>Titre</label>
    <input type='text' name='newtitre' id='newtitre' value='mettre titre' minlength='3'>
    <label for='contenu'>Contenu
        <textarea name='contenu' value='mettre contenu'></textarea>
    </label>
    <select name='categorie' id='categorie'>
            <option value=''>Choisir une catégorie pour l'article :</option>
            <option value='reconversion'>Reconversion</option>
            <option value='autoformation'>Autoformation</option>
            <option value='actu'>Actu</option>
            <option value='divers'>Divers</option>
            <option value='jsepa'>Je ne sais pas</option>
    </select>

    <input class='submit' id='submit' name='submit' type='submit' value='Appliquer le changement'>
</form> -->
</body>
</html>

<?php



?>