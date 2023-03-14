<?php
require_once 'src/User.php';
if(isset($_POST) && !empty($_POST['login']) &&!empty($_POST['prenom']) && !empty($_POST['nom'])) {
    $user = 'user';
    $bio = "Aucune biographie n'a été renseignée";
    $new_user = new User();
    $new_user->register($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'], $user, $bio);
    die(); // permet que le code s'arrête avant d'afficher le formulaire pour éviter de poser problème avec le json
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
    <title>Inscription</title>
</head>
<body>
<?php require_once ('header.php'); ?>
</body>
</html>
<h2 class="title-form">Inscription</h2>
<form id="form-register" method="post">
    <label for="login"></label>
    <input id="login" name="login" type="text" placeholder="Login" required>
    <label for="prenom"></label>
    <input id="prenom" name="prenom" type="text" placeholder="Prénom" required>
    <label for="nom"></label>
    <input id="nom" name="nom" type="text" placeholder="nom" required>
    <label for="password"></label>
    <input id="password" name="password" type="password" placeholder="mot de passe" required>
    <button type="submit" class="register_form_button" id="envoie" name="envoie">S'inscrire</button>
</form>
