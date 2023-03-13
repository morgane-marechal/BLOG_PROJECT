<?php
require_once ('src/Article.php');
if (isset($_GET['id'])) {
    $article = new Article();
    $article = $article->getUniqueArticle($_GET['id']);

}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article</title>
</head>
<body>
<?php
require('header.php');
?>
<section class="article">
    <article>
        <div id="container-categorie">
            <span id="categorie-unique-article"><?= $article->categorie ?></span>
        </div>
        <div id="container-titre">
            <h1><?= $article->titre ?></h1>
        </div>
        <div id="container-image">
            <img id="image-article-unique" src="./images/<?=$article->image?>">
        </div>
            <div id="contenu-unique-article"><?= $article->contenu ?></div>
        <div id="container-info">
            <span id="info-unique-article">Publié le <?= $article->date ?> par <?= $article->prenom ?> <?= $article->nom ?></span>
        </div>
    </article>
    <div id="auteur">
        <h3 id="titre-auteur">A propos de l'auteur</h3>
        <p>L'auteur est un jeune écrivain et journaliste s'intéressant particulièrement à l'écologie. </p>
    </div>
    <div id="container-commentaires">
        <?php if(!isset($_SESSION['nom']) && !isset($_SESSION['prenom'])):?>
        <?= "Connectez-vous pour laisser un commentaire" ?>
        <?php else: ?>
        <?php "<input type='text'>"?>
        <?php endif; ?>

    </div>

</section>
</body>
</html>

