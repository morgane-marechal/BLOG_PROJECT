<?php session_start(); ?>

<head>
    <meta charset="utf-8"/>
    <script defer type="text/javascript" src="app/admin.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Admin</title>
    
</head>

<body>
    <?php
    require('header.php');
    ?>
    <?php require('src/User.php'); ?>
    <?php require('src/Article.php'); ?>
    <main>

    <div id="buttons-admin">
            <button id="utilisateurs-button">Gestion des utilisateurs</button>
            <button id="articles-button">Gestion des articles</button>
            <button id="commentaires-button">Gestion des commentaires</button>       
    </div>


    <?php 
         if (isset($_GET['update']) && isset($_GET['role'])) {
            $updateUser = new User();
            $updateUser->update((int) $_GET['update'], $_GET['role']);
             }

        //update de l'article
        if (isset($_GET['id_article']) && isset($_GET['newtitre'])) {
            $updateTitre = new Article();
            $updateTitre->updateTitre((int) $_GET['id_article'], $_GET['newtitre']);
        }
        
        if (isset($_GET['id_article']) && isset($_GET['contenu'])) {
            $updateContent = new Article();
            $updateContent->updateContent((int) $_GET['id_article'], $_GET['contenu']);
        } 

        if (isset($_GET['id_article']) && isset($_GET['categorie'])) {
            $updateCategorie = new Article();
            $updateCategorie->updateCategorie((int) $_GET['id_article'], $_GET['categorie']);
        } 
        
    ?>

    <div id="user-place"></div>
    <div id="article-place"></div>

    </main>
</body>