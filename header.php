<header>
        <nav>
            <ul>
                <li><a href=index.php>Accueil</a></li>
                <li><a href=authentification.php>Authentification</a></li>
                <?php if (isset($_SESSION['login'])&& !empty($_SESSION['login'])){?>
                <li><a href=profil.php>Profil</span></a></li>
                <?php } ?>
                <li><a href=articles.php>Articles</a></li>
                
                <?php if ((isset($_SESSION['rangs'])===('admin'||'moderateur'))&& (!empty($_SESSION['rangs']))){ ?>
                <li><a href=redaction.php>Rédaction</span></a></li>
                <?php } ?>

                <?php if ((isset($_SESSION['rangs'])==='admin')&& (!empty($_SESSION['rangs']))){ ?>
                <li><a href=administration.php>Administration</span></a></li>
                <?php } ?>

                <?php if (isset($_SESSION['login'])&& !empty($_SESSION['login'])){ ?>
                <li><a href=deconnexion.php>Déconnexion</span></a></li>
                <?php } ?>
            </ul>
        </nav>
</header>