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
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
    <title>Connexion</title>
</head>
<body>
<?php require_once ('header.php')?>
</body>
</html>

<h2 class="title-form">Connexion</h2>
<form id="form-connection" method="post">
    <label for="login"></label>
    <input id="login" name="login" type="text" placeholder="Login" required>
    <label for="prenom"></label>
    <label for="password"></label>
    <input id="password" name="password" type="password" placeholder="mot de passe" required>
    <button type="submit" class="register_form_button" id="envoie" name="envoie">Se connecter</button>
</form>