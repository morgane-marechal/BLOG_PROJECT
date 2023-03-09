<!doctype html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav class="nav">
        <div id="container-logo">
            <img id="logo" src="assets/newway-logo.png" alt="logo">
        </div>
        <div id="container-list-nav">
            <div class="burger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar bar3"></span>
            </div>
            <ul class="ul_nav">
                <p id="menu-title">MENU</p>
                    <li><a href=index.php>Accueil</a></li>
                    <li><a href=authentification.php>Authentification</a></li>
                    <?php if (isset($_SESSION['nom']) && !empty($_SESSION['nom'])) { ?>
                        <li><a href=profil.php>Profil</span></a></li>
                    <?php } ?>
                    <li><a href=articles.php>Articles</a></li>

                    <?php if ((isset($_SESSION['rangs']) === ('admin' || 'moderateur')) && (!empty($_SESSION['rangs']))) { ?>
                        <li><a href=redaction.php>Rédaction</span></a></li>
                    <?php } ?>

                    <?php if ((isset($_SESSION['rangs']) === 'admin') && (!empty($_SESSION['rangs']))) { ?>
                        <li><a href=administration.php>Administration</span></a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['nom']) && !empty($_SESSION['nom'])) { ?>
                        <li><a href=deconnexion.php>Déconnexion</span></a></li>
                    <?php } ?>
            </ul>


    </nav>
</header>
<script src="app/hamburger.js"></script>
</body>
</html>



