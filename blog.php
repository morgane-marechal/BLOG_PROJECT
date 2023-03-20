<?php
session_start();
require_once('src/Pagination.php');
require_once('src/Article.php');

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

$currentPage = $paginate->currentPage;
$lastPage = $paginate->countPages();

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    <script src="app/module_display_all_article.js" defer></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<?php
require('header.php');
?>

<body>
<div class="diagonal">
    <div class="title-page">
        <h1>Blog</h1>
    </div>
</div>

<!-- Les articles vont s'afficher dans la section ci-dessous à l'aide de Javascript -->
<section class="articles">

</section>
<div class="control">
    <a id="btn-previous" href="/blog-js/blog.php?page=<?= $currentPage - 1 ?>" <?= $currentPage == 1 ? 'disabled' : ''?>>Page Précédente</a>
    <a id="btn-next" href="/blog-js/blog.php?page=<?= $currentPage + 1 ?>" <?= $currentPage == $lastPage? 'disabled' : ''?>>Page Suivante</a>
</div>
</body>
</html>
