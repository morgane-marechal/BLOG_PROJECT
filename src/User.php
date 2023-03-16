<?php

class User
{
    public ?int $id = null;
    public ?string $login = null;
    public ?string $prenom = null;
    public ?string $nom = null;
    public ?string $password = null;
    public ?string $bio = null;
    private PDO $db;

    public function __construct()
    {
        $db_dsn = 'mysql:host=localhost; dbname=blog_js';
        $username = 'root';
        strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh') !== false ? $password_db = 'root' : $password_db = '';

        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //ERROR TYPE
                    PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
                ];
            $this->db = new PDO($db_dsn, $username, $password_db, $options);
        } catch (PDOException $e) {
            print "Erreur! :" . $e->getMessage() . "</br>";
            die();
        }
    }

    /* Méthode d'enregistrement de l'utilisateur
        Si l'utilisateur n'existe pas (verifUser = false) alors on lance la requête
        On insert en BDD login, prenom, nom, password, rangs et biographie
        On lie les variables
        Si $sql_exe = true alors on acho un message de réussite et on envoie vers page connexion
    */
    public function register($login, $prenom, $nom, $password, $rangs, $bio)
    {
        if (!$this->verifUser()) {
            $sql = "INSERT INTO utilisateurs (login, prenom, nom, password, rangs, bio)
                    VALUES (:login, :prenom, :nom, :password, :rangs, :bio)";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'login' => htmlspecialchars($login),
                'prenom' => htmlspecialchars($prenom),
                'nom' => htmlspecialchars($nom),
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'rangs' => htmlspecialchars($rangs),
                'bio' => htmlspecialchars($bio),
            ]);

            if ($sql_exe) {
                header("Refresh:2; url=connexion.php");
                echo json_encode(['response' => 'ok', 'reussite' => 'Inscription réussie.']);
            } else {
                echo json_encode(['response' => 'not ok', 'echoue' => 'L\'inscription a échoué.']);
            }
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'L\'utilisateur existe déjà']);
        }
    }

    /* Méthode qui permet de vérifier que l'utilisateur existe ou non en BDD
        On vérifie si le login est déjà présent dans la base de données
        Si $results possède une correspondance on return true sinon false
        On appelle la fonction dans la fonction register pour vérifier avant d'insérer ou non
    */
    public function verifUser()
    {
        if ($_POST['prenom'] && $_POST['nom'] && $_POST['login'] > 3) {
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $login = htmlspecialchars($_POST['login']);
            $sql = "SELECT * 
                    FROM utilisateurs
                    WHERE login = :login";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'login' => $login,
            ]);
            $results = $sql_exe->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return true;
            } else {
                return false;
            }
        }
    }

    /* La méthode connection permet à l'utilisateur de se connecter
        On récupère tout ce qui est dans la table utilisateur là où le login = login entré
        On le met le résultat de la recherche en BDD dans un tableau associatif
        Si results est true (existe) alors on vérifie le mot de passe, si c'est true alors
        On lance une session, initialise des variables de SESSION et renvoie un json + redirection
        Sinon on return un json echec
    */
    public function connection($login, $password)
    {
        $sql = "SELECT * 
                FROM utilisateurs
                WHERE login = :login ";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'login' => $login,

        ]);
        $results = $sql_exe->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            $hashed_password = $results['password'];
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['id'] = $results['id'];
                $_SESSION['utilisateur'] = $results['login'];
                echo json_encode(['response' => 'ok', 'reussite' => 'connexion réussie']);
                header('Location: profil.php');
                die();

            }
        } else {
            return json_encode(['response' => 'not ok', 'echec' => 'connexion refusée']);
        }
    }

    /* Méthode pour récupérer toutes les informations de l'utilisateur
        On récupère toutes les informations de l'utilisateur là où l'id est égal à l'id de session
        On fetch le résultat pour ensuite donner des valeurs à des variables globales du nom, prenom, login et pass
    */
    public function getAllInfos()
    {
        $id = $_SESSION['id'];
        $allInfo = $this->db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $allInfo->execute([
            'id' => $id,
        ]);
        $result = $allInfo->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login'] = $result['login'];
        $_SESSION['nom'] = $result['nom'];
        $_SESSION['prenom'] = $result['prenom'];
        $_SESSION['password'] = $result['password'];
    }

    //Méthode update login
    public function setLogin($newlogin){
        $login=$_SESSION['login']; //<- la fonction update ne fonctionne qui si un utilisateur est connecté
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET login = '$newlogin' WHERE login = :login ");
        $sqlupdate->execute([
            'login' => $login,
        ]);
        $_SESSION['login'] = $newlogin;
        return "Vous avez changé votre login mis à jour votre profil.<br>";
    }

    // Méthode update nom
    public function setNom($newnom){
        $nom=$_SESSION['nom']; //<- la fonction update ne fonctionne qui si un utilisateur est connecté
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET nom = '$newnom' WHERE nom = :nom ");
        $sqlupdate->execute([
            'nom' => $nom,
        ]);
        $_SESSION['nom'] = $newnom;
        return "Vous avez changer votre nom et mis à jour votre profil.<br>";
    }

    //methode update prénom
    public function setPrenom($newprenom){
        $prenom=$_SESSION['prenom']; //<- la fonction update ne fonctionne qui si un utilisateur est connecté
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET prenom = '$newprenom' WHERE prenom = :prenom ");
        $sqlupdate->execute([
            'prenom' => $prenom,
        ]);
        $_SESSION['prenom'] = $newprenom;
        return "Vous avez changer votre prenom et mis à jour votre profil.<br>";
    }

    // Méthode update mot de passe
    public function setPassword($newpassword){
        $password=$_SESSION['password'];
        $newpassword = password_hash($password, PASSWORD_BCRYPT); 
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET password = '$newpassword' WHERE password = :password ");
        $sqlupdate->execute([
            'password' => $password,
        ]);
        $_SESSION['password'] = $newpassword;
        return "Vous avez changé votre mot de passe et mis à jour votre profil.<br>";
    }
    
     public function getBio()
    {
        return $this->bio;
    }

    //methode update bio
    public function setBio(?string $bio)
    {
        $id = $this->id;
        $newBio = htmlspecialchars($bio);
        $sql = "UPDATE utilisateurs SET bio = :bio WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'bio' => $newBio,
            'id' => $id,
        ]);
        $this->bio = $newBio;
    }
    
    
 //display all users for admin

    public function displayUsers()
    {
        $displayUsers = $this->db->prepare("SELECT * FROM utilisateurs");
        $displayUsers->execute([
            //'id' => $id,
        ]);
        $result = $displayUsers->fetchAll(PDO::FETCH_ASSOC);
        //echo var_dump($result);
        echo "<h2>Affichage des utilisateurs</h2>";
        for ($i = 0; $i <= (count($result)-1); $i++) {
        echo 
            "<div class='user' id='user".$result[$i]['id']."' >
                <div class = 'id'> <p>Id : ".$result[$i]['id']."</p></div>
                <div class = 'login'> <p>Login : ".$result[$i]['login']."</p></div>
                <div class= 'nom'> <p> Nom : ".$result[$i]['nom']."</p></div> 
                <div class='prenom' <p> Prénom : ".$result[$i]['prenom']."</p></div>
                <div class='rang' <p> Rang : ".$result[$i]['rangs']."</p></div>
                <form id='form_role' action='admin.php' method='get'>
                <input name='update' class='id_user' id='update' value='".$result[$i]['id']."' readonly>
                    <label for='role'>Rôle:</label>
                    <select name='role' id='role'>
                        <option value=''>Nouveau rôle :</option>
                        <option value='utilisateur'>Utilisateur</option>
                        <option value='moderateur'>Moderateur</option>
                        <option value='administrateur'>Administrateur</option>
                    </select>
                <button type='submit' class='update' id='".$result[$i]['id']."' >Modifier</button>
                </form>
                <button type='submit' class='del' id='".$result[$i]['id']."' href=admin.php?delete=".$result[$i]['id']." >Supprimer</button>
            </div>
        </div>";
        }
    }
    


    public function delete(int $idDelete){
        $delete= $this->db->prepare("DELETE from utilisateurs WHERE id = '$idDelete'");
        $delete->execute();
    }

    public function update(int $iduser, $newrang){
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET rangs = '$newrang' WHERE id = :iduser ");
        $sqlupdate->execute([
            'iduser' => $iduser,
        ]);

    }
    
    public function deconnect()
    {
        unset($_SESSION['utilisateur']);
        session_destroy();
        header('Location: index.php');
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }



}

