<?php
session_start();
require('header.php');
require('src/Article.php');
require('src/User.php');

if(!isset($_SESSION['utilisateur'])){
    header('Location: connexion.php');
}



if (!empty($_POST['article_title']) && !empty($_POST['article_content']) && !empty($_POST['categorie'])) {

    //$image = $_POST['image'];
    if (isset($_FILES['image'])) {
        $tmpName = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        # TODO : FAIRE ATTENTION AU CHEMINS
            move_uploaded_file( $tmpName, './images/'.$name);
            $image = $_FILES['image']['name'];
        }

        //pour avoir la date
        $mydate=getdate(date("U"));
        $myhour=date("H:i:s");
        //valeur de la date pour le type sql datetime YYYY-MM-DD
        $date="$mydate[year]/$mydate[mon]/$mydate[mday] $myhour";
        $contenu = htmlspecialchars($_POST['article_content']);
        $titre = htmlspecialchars($_POST['article_title']);
        $categorie = htmlspecialchars($_POST['categorie']);
        //$_SESSION['id']=1;
        //echo var_dump($_POST);

        $idUtilisateur = $_SESSION['id'];
        $newArticle = new Article();
        $newArticle->registerArticle($idUtilisateur, $titre, $contenu, $date, $categorie, $image);
    }
    ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="assets/style.css" />
<div id="color-bg">
    <h2 id="title-form-article">Rédaction d'un article</h2>
    <form id="form-article" method="post" enctype="multipart/form-data">
        <label for="title">Titre de l'article</label>
        <input id="article_title" name="article_title" type="text" placeholder="Titre ..." required>
        <label for="article_content">Écrivez votre article</label>
        <textarea id="article_content" name="article_content"  rows="20" placeholder="Rédiger de l'article ..." required></textarea>
        <label for="file">Importez votre image</label>
        <input type="file" name="image">
        <label for="categorie-select">Catégories:</label>
        <select name="categorie" id="categorie">
            <option value="">Choisir une catégorie pour l'article :</option>
            <option value="reconversion">Reconversion</option>
            <option value="autoformation">Autoformation</option>
            <option value="actu">Actu</option>
            <option value="divers">Divers</option>
            <option value="jsepa">Je ne sais pas</option>
        </select>
        <button type="submit" class="register_form_button" id="envoie" name="envoie">Soumettre l'article</button>
    </form>
</div>
