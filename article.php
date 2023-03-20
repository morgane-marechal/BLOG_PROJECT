<?php
session_start();
require_once ('src/Article.php');
require_once ('src/User.php');
require_once ('src/Comments.php');

// Si GET['ID'] est set alors on instancie un nouvel objet article de la classe Article()
// On appelle la fonction getUniqueArticle qui possède l'ID DE l'article afin d'afficher cet article en particulier
if (isset($_GET['id'])) {
    $article = new Article();
    $article = $article->getUniqueArticle($_GET['id']);
}

if (isset($_GET['articleid'])) {
    $commentaires = new Comments();
    echo $commentaires->displayComments($_GET['articleid']);
    die();
}

if(isset($_POST['commentaire'])){
    $contenu = htmlspecialchars($_POST['commentaire']);

    $mydate=getdate(date("U"));
    $myhour=date("H:i:s");
    //valeur de la date pour le type sql datetime YYYY-MM-DD
    $date="$mydate[year]/$mydate[mon]/$mydate[mday] $myhour";
    $id_utilisateur = $_SESSION['id'];
    $id_article = $article->id;


    $commenter = new Comments();
    $commenter->registerComments($contenu, $date, $id_utilisateur, $id_article);
    echo json_encode(['insert' => true]);
    die();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    <script src="app/comments-display.js" defer></script>
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
            <!-- Appel de la catégorie avec PHP -->
            <span id="categorie-unique-article"><?= $article->categorie ?></span>
        </div>
        <div id="container-titre">
            <!-- Appel du titre avec PHP -->
            <h1><?= $article->titre ?></h1>
        </div>
        <div id="container-image">
            <!-- Appel de l'image avec PHP -->
            <img id="image-article-unique" src="./images/<?=$article->image?>">
        </div>
        <!-- Appel du contenu avec PHP -->
        <div id="contenu-unique-article"><?= $article->contenu ?></div>
        <div id="container-info">
            <!-- Appel de la date, du nom et prénom de l'auteur avec PHP -->
            <span id="info-unique-article">Publié le <?= $article->date ?> par <?= $article->prenom ?> <?= $article->nom ?></span>
        </div>
    </article>
    <div id="auteur">
        <h3 id="titre-auteur"><?= $article->prenom . " " . $article->nom ?></h3>
        <!-- Appel de la bio avec PHP -->
        <p><?= $article->author->bio ?></p>
    </div>
    <div id="content-commentaires">

    </div>
    <div id="container-commentaires">
        <?php if(!isset($_SESSION['utilisateur'])): ?>
            <p>Connectez-vous pour laisser un commentaire</p>
        <?php else: ?>

        <div id="comments-input-container">
            <h3 id="title-comments">Écrire un commentaire</h3>
            <form method="POST" name="comments-form" id="comments-form">
                <label for="commentaire"> </label>
                <textarea  name="commentaire" id="commentaire" rows="5"  cols="44" placeholder="Entrez votre commentaire"></textarea>
                <button type="submit"  name="envoie-commentaire" id="envoie-commentaire" value="submit">Commenter</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</section>
</body>
</html>
