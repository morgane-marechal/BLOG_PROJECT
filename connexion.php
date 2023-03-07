<?php
require_once 'src/User.php';

/* Si le formulaire est envoyé, que les inputs ne sont pas vides alors on stocke les inputs dans des variables
    puis on instancie un objet de la classe user et l'on appelle la fonction connection */

if (isset($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['password'])) {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $password = htmlspecialchars($_POST['password']);
    $new_connection = new User();
    echo $new_connection->connection($prenom, $nom, $password);
    // die pour éviter que le json ne soit corrompu par le html
    die();

}
?>

<h2 class="title-form">Connexion</h2>
<form id="form-connection" method="post">
    <label for="prenom"></label>
    <input id="prenom" name="prenom" type="text" placeholder="Prénom" required>
    <label for="nom"></label>
    <input id="nom" name="nom" type="text" placeholder="nom" required>
    <label for="password"></label>
    <input id="password" name="password" type="password" placeholder="mot de passe" required>
    <button type="submit" class="register_form_button" id="envoie" name="envoie">S'inscrire</button>
</form>