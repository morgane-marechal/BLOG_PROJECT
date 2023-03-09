<?php session_start(); ?>

    <?php require('src/Article.php'); ?>
    <?php require('src/User.php'); ?>

    <?php 
    if(!empty($_POST['article_title'])&& !empty($_POST['article_content']) && !empty($_POST['categorie'])) {
        //pour avoir la date
        $mydate=getdate(date("U"));
        $myhour=date("H:i:s");
        //valeur de la date pour le type sql datetime YYYY-MM-DD
        $date="$mydate[year]/$mydate[mon]/$mydate[mday] $myhour";
        $contenu = htmlspecialchars($_POST['article_content']);
        $titre = htmlspecialchars($_POST['article_title']);
        $categorie = htmlspecialchars($_POST['categorie']);
        //$_SESSION['id']=1;
        $idUtilisateur = $_SESSION['id'];
        $newArticle = new Article();
        $newArticle->registerArticle($idUtilisateur, $titre, $contenu, $date, $categorie);
    }
    ?>

<h2 class="article-form">Rédaction d'un article</h2>
<form id="form-register" method="post">
    <label for="title"></label>
    <input id="article_title" name="article_title" type="text" placeholder="Titre ..." required>
    <label for="article_content"></label>
    <textarea id="article_content" name="article_content" type="textarea" placeholder="Rédiger de l'article ..." required></textarea>

    <label for="pet-select">Catégories:</label>
        <select name="categorie" id="categorie">
            <option value="">--Choisir une catégorie pour l'article--</option>
            <option value="reconversion">Reconversion</option>
            <option value="autoformation">Autoformation</option>
            <option value="actu">Actu</option>
            <option value="divers">Divers</option>
            <option value="jsepa">Je ne sais pas</option>
        </select>
    <button type="submit" class="register_form_button" id="envoie" name="envoie">Soumettre l'article</button>
</form>