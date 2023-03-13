<?php
session_start();
require_once ('src/Article.php');
$article = new Article();
if (isset($_GET['articles']) && $_GET['articles'] === 'all'){

 echo $article->getArticles();
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
<section class="articles">

</section>
</body>
</html>
