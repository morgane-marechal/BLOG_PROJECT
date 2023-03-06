<?php
require_once 'src/User.php';
if(isset($_POST) && !empty($_POST['prenom']) && !empty($_POST['nom'])) {
    $user = 'user';
    $new_user = new User();
    $new_user->register($_POST['prenom'], $_POST['nom'], $_POST['password'], $user);
    var_dump($_POST['password']);
    die(); // permet que le code s'arrête avant d'afficher le formulaire pour éviter de poser problème avec le json
}

?>

<h2 class="title-form">Inscription</h2>
<form id="form-register" method="post">
    <label for="prenom"></label>
    <input id="prenom" name="prenom" type="text" placeholder="Prénom" required>
    <label for="nom"></label>
    <input id="nom" name="nom" type="text" placeholder="nom" required>
    <label for="password"></label>
    <input id="password" name="password" type="password" placeholder="mot de passe" required>
    <button type="submit" class="register_form_button" id="envoie" name="envoie">S'inscrire</button>
</form>
