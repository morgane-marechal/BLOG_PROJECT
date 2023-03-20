<?php
require_once 'src/User.php';
if(isset($_POST) && !empty($_POST['login']) &&!empty($_POST['prenom']) && !empty($_POST['nom'])) {
    $user = 'utilisateur';
    $bio = "Aucune biographie n'a été renseignée";
    $new_user = new User();
    $new_user->register($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'], $user, $bio);
    die(); // permet que le code s'arrête avant d'afficher le formulaire pour éviter de poser problème avec le json
}
?>

<!doctype html>
<html lang="fr">
<body>

<div class="container-div">
    <form id="form-register" method="post">
        <h2 class="title-form">Inscription</h2>
        <p class="sous-titre-form">Inscrivez-vous maintenant</p>
        <label for="login">Login</label>
        <input id="login" name="login" type="text" placeholder="Login" required>
        <label for="prenom">Prénom</label>
        <input id="prenom" name="prenom" type="text" placeholder="Prénom" required>
        <label for="nom">Nom</label>
        <input id="nom" name="nom" type="text" placeholder="Nom" required>
        <label for="password">Mot de passe</label>
        <input id="password" name="password" type="password" placeholder="Mot de passe" required>
        <button type="submit" class="register_form_button" id="envoie" name="envoie">S'inscrire</button>
    </form>
</div>
</body>
</html>


