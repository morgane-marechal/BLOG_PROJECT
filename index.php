<?php session_start(); ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <title>Accueil</title>
</head>

<body>
    <?php
    require('header.php');
    ?>
    <?php require('src/Article.php'); ?>
    <?php require('src/User.php'); ?>

    <div id="home_image_place">
        <img id="home_image" src="assets/work-space.jpg" alt="Desk for work">
        <div id="articles_vignette_place">
            <?php
            $lastArticle = new Article();
            $arrayArticles = $lastArticle->getLastArticles();
            //var_dump($arrayArticles);
            for ($i = 0; $i <= (count($arrayArticles) - 1); $i++) { ?>
                <div class="home_vignette">
                    <a href="http://localhost/blog-js/article.php?id=<?= $arrayArticles[$i]['id'] ?>">
                        <div class="v-image"><img class="vignette_image" src="images/<?= $arrayArticles[$i]['image'] ?>" alt="<?= $arrayArticles[$i]['categorie'] ?>"></div>
                        <div class="titre_vignette"><?= $arrayArticles[$i]['titre'] ?></div>
                        <div class="date_vignette"><?= $arrayArticles[$i]['date'] ?></div>
                        <div class="contenu_vignette"><?= $arrayArticles[$i]['contenu'] ?></div>
                        <div class="auteur_vignette">par <?= $arrayArticles[$i]['prenom'] ?> <?= $arrayArticles[$i]['nom'] ?></div>
                    <button class="lien_article">Accéder à l'article</button>
                    </a>
                    
                </div>
            <?php } ?>
        </div>
    </div>

</body>