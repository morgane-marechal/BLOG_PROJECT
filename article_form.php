<?php session_start(); ?>

    <?php require('src/Article.php'); ?>
    <?php require('src/User.php'); ?>

    <?php 
    if(!empty($_POST['title']) && !empty($_POST['article_content'])&& !empty($_POST['categorie'])) {
        //valeur de la date pour le type sql datetime YYYY-MM-DD
        $contenu = htmlspecialchars($_POST['article_content']);
        $titre = htmlspecialchars($_POST['article_title']);
        $categorie = htmlspecialchars($_POST['categorie-select']);
        $idUtilisateur = $_SESSION['id'];
        $newArticle = new Article();
        $newArticle->registerArticle($contenu, $titre, $categorie, $idUtilisateur);
    }
    ?>

<h2 class="article-form">Rédaction d'un article</h2>
<form id="form-register" method="post">
    <label for="article_title"></label>
    <input id="article_title" name="article_title" type="text" placeholder="Titre ..." required>
    <label for="article_content"></label>
    <textarea id="article_content" name="article_content" rows="5" cols="33" placeholder="Rédiger de l'article ..." required>
    </textarea>

    <label for="categorie-select">Catégories:</label>
        <select name="categorie-select" id="categorie">
            <option value="">--Choisir une catégorie pour l'article--</option>
            <option value="reconversion">Reconversion</option>
            <option value="autoformation">Autoformation</option>
            <option value="actu">Actu</option>
            <option value="divers">Divers</option>
            <option value="jsepa">Je ne sais pas</option>
        </select>
    <button type="submit" class="register_form_button" id="envoie" name="envoie">Soumettre l'article</button>
</form>