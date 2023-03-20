<?php
require_once 'src/User.php';

/* Si le formulaire est envoyé, que les inputs ne sont pas vides alors on stocke les inputs dans des variables
    puis on instancie un objet de la classe user et l'on appelle la fonction connection */

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $new_connection = new User();
    echo $new_connection->connection($login, $password);
    // die pour éviter que le json ne soit corrompu par le html
    die();
}
?>

<!doctype html>
<html lang="fr">
<body>
    <div class="container-div">
        <form id="form-connection" method="post">
            <h2 class="title-form">Connexion</h2>
            <p class="sous-titre-form">Connectez-vous</p>
            <label for="login">Login</label>
            <input id="login" name="login" type="text" placeholder="Login" required>
            <label for="password">Mot de passe</label>
            <input id="password" name="password" type="password" placeholder="Mot de passe" required>
            <button type="submit" class="register_form_button" id="envoie" name="envoie">Se connecter</button>
        </form>
</div>
</body>
</html>
