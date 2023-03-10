<?php session_start(); ?>

<head>
    <meta charset="utf-8"/>
    <script defer type="text/javascript" src="app/script_profil.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Profil</title>
    
</head>

<body>
    <?php
    require('header.php');
    ?>
    <main>
        


            <div id="profil-form-place"></div>

            <div id="connexion-ok">
                <?php if (isset($_SESSION['login'])&& !empty($_SESSION['login'])){
                        echo "Vous êtes toujours connecté ".$_SESSION['login'];
                }
                ?>
            </div>
 
</main>

   
</body>


