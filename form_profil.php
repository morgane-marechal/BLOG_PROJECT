<?php session_start(); ?>
<?php
require_once 'src/User.php';
require_once 'src/Article.php';
$bio = new User();
$article = new Article();
?>
<?php

$new_info = new User();
$new_info->getAllInfos();

if ((!empty($_POST)) && $_POST['newlogin']) {
    $newlogin = htmlspecialchars($_POST['newlogin']);
    $new_info->setLogin($newlogin);
}

if ((!empty($_POST)) && $_POST['prenom']) {
    $newprenom = htmlspecialchars($_POST['prenom']);
    $new_info->setPrenom($newprenom);
}

if ((!empty($_POST)) && $_POST['nom']) {
    $newnom = htmlspecialchars($_POST['nom']);
    $new_info->setNom($newnom);
}

if ((!empty($_POST)) && $_POST['biographie']) {
    $newBio = htmlspecialchars($_POST['biographie']);
    $new_info->setBio($newBio);
}

if ((!empty($_POST)) && $_POST['newpassword']) {
    $newpassword = htmlspecialchars($_POST['newpassword']);
    $new_info->setPassword($newpassword);
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    <title>Profil</title>
</head>
<body>
<div class="container-div-profil">
    <form id="profil_form" action="" method="post">
        <h2 class="title-form">Modification du compte</h2>
        <p class="sous-titre-form">Modifier votre compte</p>
        <label for="newlogin">Login</label>
        <input type="text" name="newlogin" id="newlogin" placeholder="<?php echo $_SESSION['login'] ?>" minlength="3">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="<?php echo $_SESSION['nom'] ?>" minlength="3">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="<?php echo $_SESSION['prenom'] ?>" minlength="3">
        <label for="biographie">Biographie</label>
        <textarea name="biographie" rows="10" placeholder="<?php echo $_SESSION['bio'] ?>"></textarea>
        <label for="newpassword">Mot de passe</label>
        <input type="password" name="newpassword" id="newpassword" placeholder="mot de passe" minlength="3">

        <input class="submit" id="submit" name="submit" type="submit" value="Envoyer">
        <i class="small">* Champs obligatoires avec 3 caractères minimum</i>
    </form>
</div>
</body>
</html>

