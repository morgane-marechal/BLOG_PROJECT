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
    <main>

    <div id="buttons-admin">
            <button id="utilisateurs-button">Gestion des utilisateurs</button>
            <button id="articles-button">Gestion des articles</button>        
    </div>

    <div id="user-place"></div>

    </main>
</body>