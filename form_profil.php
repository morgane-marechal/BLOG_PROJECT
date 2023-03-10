<?php session_start(); ?>
<?php require_once 'src/User.php'; ?>



<form id="profil_form" action="" method="post">
    <h3>Modification du compte</h3>
    <input type="text" name="newlogin" id="newlogin" placeholder="<?php echo $_SESSION['login'] ?>" minlength="3">
    <input type="text" name="nom" id="nom" placeholder="<?php echo $_SESSION['nom'] ?>" minlength="3">
    <input type="text" name="prenom" id="prenom" placeholder="<?php echo $_SESSION['prenom'] ?>" minlength="3">

    <input type="password" name="newpassword" id="newpassword" placeholder="*****" minlength="3">
    </select>
    <input class="submit" id="submit" name ="submit" type="submit" value="submit">
    <i class="small">* Champs obligatoires avec 3 caractères minimum</i>
</form>

<?php
    
    $new_info = new User();
    $new_info->getAllInfos();
    Print_r ($_SESSION);


    if((!empty($_POST)) && $_POST['newlogin']){
        $newlogin = htmlspecialchars($_POST['newlogin']);
        $update = new User();
        $update->setLogin($newlogin);
        //$update->getAllInfos();
    }

    if((!empty($_POST)) && $_POST['prenom']){
        $newprenom = htmlspecialchars($_POST['prenom']);
        $updatePrenom = new User();
        $updatePrenom->setPrenom($newprenom);
        //$updatePrenom->getAllInfos();
    }

    if((!empty($_POST)) && $_POST['nom']){
        $newnom = htmlspecialchars($_POST['nom']);
        $updateNom = new User();
        $updateNom->setNom($newnom);
        //$updateNom->getAllInfos();
    }

    if((!empty($_POST)) && $_POST['newpassword']){
        $newpassword = htmlspecialchars($_POST['newpassword']);
        $updatePW = new User();
        $updatePW->setPassword($newpassword);
        //$updatePW->getAllInfos();
    }


    
?>

