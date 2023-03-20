<header>
    <nav class="nav">
        <div id="container-logo">
            <a href="index.php"><img id="logo" src="assets/newway-logo.png" alt="logo"></a>
        </div>
        <div id="container-list-nav">
            <ul class="ul_nav_desktop">
                    <li><a href="index.php">Accueil</a></li>
                    <?php if (isset($_SESSION['utilisateur'])) { ?>
                        <li><a href="profil.php">Profil</span></a></li>
                    <?php } ?>
                <li><a href="blog.php">Blog</a></li>
                <?php if (!isset($_SESSION['utilisateur'])) : ?>
                    <div class="container-buttons-nav">
                        <a href="authentification.php">
                            <button class="btn-register">S'authentifier</button>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ((isset($_SESSION['rangs']) && $_SESSION['rangs'] === 'administrateur' || $_SESSION['rangs'] === 'moderateur')) { ?>
                    <li><a href="article_form.php">Rédaction</span></a></li>
                <?php } ?>

                <?php if ((isset($_SESSION['rangs']) && $_SESSION['rangs'] === 'administrateur') && (!empty($_SESSION['rangs']))) { ?>
                    <li><a href=admin.php>Administration</span></a></li>
                <?php } ?>
                <?php if (isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])) { ?>
                    <li><a href=deconnexion.php>
                            <button class="btn-deconnection">Déconnexion</button>
                        </a></li>
                <?php } ?>
            </ul>

            <div class="burger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar bar3"></span>
            </div>
            <ul class="ul_nav">
                <p id="menu-title">MENU</p>
                <li><a href="index.php">Accueil</a></li>
                <?php if (isset($_SESSION['utilisateur'])) { ?>
                    <li><a href="profil.php">Profil</span></a></li>
                <?php } ?>
                <li><a href="blog.php">Blog</a></li>
                <?php if (!isset($_SESSION['utilisateur'])) : ?>
                    <div class="container-buttons-nav">
                        <a href="authentification.php">
                            <button class="btn-register">S'authentifier</button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ((isset($_SESSION['rangs']) === ('admin' || 'moderateur')) && (!empty($_SESSION['rangs']))) { ?>
                        <li><a href=article_form.php>Rédiger</span></a></li>
                    <?php } ?>

                    <?php if ((isset($_SESSION['rangs']) === 'admin') && (!empty($_SESSION['rangs']))) { ?>
                        <li><a href=administration.php>Administration</span></a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])) { ?>
                        <li><a href=deconnexion.php><button class="btn-deconnection">Déconnexion</button></a></li>
                    <?php } ?>
            </ul>
        </nav>
</header>
<script src="app/hamburger.js"></script>
</body>
</html>



