<?php
require_once ('src/Article.php');
$article = new Article();
if (isset($_GET['id'])) {
    $arrayArticle = $article->getUniqueArticle($_GET['id']);
    $article->id = $arrayArticle['id'];
    var_dump($arrayArticle['id']);
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

    <h1><?= $arrayArticle['titre'] ?></h1>

</section>
</body>
</html>

