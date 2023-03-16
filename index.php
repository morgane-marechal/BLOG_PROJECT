<?php session_start(); ?>
<?php require_once ('src/Pagination.php');
require_once ('src/Article.php');

// Instance de la classe Article et Pagination
$articles = new Article();
$paginate = new Pagination();

/* On récupère :
    la currentPage
    le nombre d'articles par pages
    le nombre d'articles en base de données
*/

$paginate->currentPage = $_GET['page'] ?? 1;
$paginate->nbrOfArticlesPerPage = 5;
$paginate->nbrOfArticles = $articles->countArticles();

$paginate->countPages();


echo "<pre>";
$articles->getArticles($paginate);
echo "</pre>";




?>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Accueil</title>
</head>

<body>
    <?php
    require('header.php');
    ?>
<?php var_dump($_SESSION['utilisateur']); ?>
</body>