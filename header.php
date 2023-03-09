<header>
    <nav class="nav">
        <div id="container-logo">
            <a href="index.php"><img id="logo" src="assets/newway-logo.png" alt="logo"></a>
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
                    <li><a href=article_form.php>Rédiger</a></li>

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



