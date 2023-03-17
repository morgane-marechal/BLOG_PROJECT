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

echo json_encode($articles->getArticles($paginate));