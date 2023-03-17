
<?php session_start(); ?>
<?php require('src/Article.php'); ?>
<?php require('src/User.php'); ?>
<?php 
    //echo var_dump($_SESSION);
     $new_display = new User();
    $result = $new_display->displayUsers();
?>

     <h2>Affichage des utilisateurs</h2>
<?php    for ($i = 0; $i <= (count($result)-1); $i++) { ?>
     
         <div class='user' id='user<?=$result[$i]['id']?>' >
             <div class = 'id'> Id :<?=$result[$i]['id']?></div>
             <div class = 'login'> Login : <?=$result[$i]['login']?></div>
             <div class= 'nom'>  Nom : <?=$result[$i]['nom']?></div> 
             <div class='prenom'> Prénom : <?=$result[$i]['prenom']?></div>
             <div class='rang'> Rang : <?=$result[$i]['rangs']?></div>
             <form id='form_role' action='admin.php' method='get'>
             <input type='hidden' name='update' class='id_user' id='update' value='<?=$result[$i]['id']?>' readonly>
                 <label for='role'></label>
                 <select name='role' id='role'>
                     <option value=''>Nouveau rôle :</option>
                     <option value='utilisateur'>Utilisateur</option>
                     <option value='moderateur'>Moderateur</option>
                     <option value='administrateur'>Administrateur</option>
                 </select>
             <button type='submit' class='update' id='<?=$result[$i]['id']?>' >Modifier</button>
             </form>
             <button type='submit' class='del' id='<?=$result[$i]['id']?>' href=admin.php?delete=<?=$result[$i]['id']?> >Supprimer l'utilisateur</button>
         </div>
     </div>
<?php } ?>


<?php
 if (isset($_GET['update']) && isset($_GET['role'])) {
    $updateUser = new User();
    $updateUser->update((int) $_GET['update'], $_GET['role']);
     }


if (isset($_GET['delete'])){
    $id_user = $_SESSION['id'];
    $deleteUser = new User();
    $deleteUser->delete((int) $_GET['delete']);
    die();
}

?>

