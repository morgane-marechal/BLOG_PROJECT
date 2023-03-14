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
                echo json_encode(['response' => 'ok', 'reussite' => 'Inscription réussie.']);
            } else {
                echo json_encode(['response' => 'not ok', 'echoue' => 'L\'inscription a échoué.']);
            }
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'L\'utilisateur existe déjà']);
        }
    }

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
                return json_encode(['response' => 'ok', 'reussite' => 'connexion réussie']);
            }
        } else {
            return json_encode(['response' => 'not ok', 'echec' => 'connexion refusée']);
        }
    }

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

    public function isConnected()
    {
        if (isset($_SESSION['utilisateur'])) {
            return true;
        } else {
            return false;
        }
    }

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

    //methode update login
    public function setLogin($newlogin){
        $login=$_SESSION['login']; //<- la fonction update ne fonctionne qui si un utilisateur est connecté
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET login = '$newlogin' WHERE login = :login ");
        $sqlupdate->execute([
            'login' => $login,
        ]);
        $_SESSION['login'] = $newlogin;
        return "Vous avez changé votre login mis à jour votre profil.<br>";
    }

    //methode update nom
    public function setNom($newnom){
        $nom=$_SESSION['nom']; //<- la fonction update ne fonctionne qui si un utilisateur est connecté
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET nom = '$newnom' WHERE nom = :nom ");
        $sqlupdate->execute([
            'nom' => $nom,
        ]);
        $_SESSION['nom'] = $newnom;
        return "Vous avez changer votre nom et mis à jour votre profil.<br>";
    }

    //methode update prenom
    public function setPrenom($newprenom){
        $prenom=$_SESSION['prenom']; //<- la fonction update ne fonctionne qui si un utilisateur est connecté
        $sqlupdate = $this -> db -> prepare("UPDATE utilisateurs SET prenom = '$newprenom' WHERE prenom = :prenom ");
        $sqlupdate->execute([
            'prenom' => $prenom,
        ]);
        $_SESSION['prenom'] = $newprenom;
        return "Vous avez changer votre prenom et mis à jour votre profil.<br>";
    }

    //methode update mot de passe
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
    public function setBio(?string $bio): ?string
    {
        $newBio = htmlspecialchars($bio);
        $sql = "UPDATE utilisateurs SET bio = '$newBio' WHERE bio = :bio";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'bio'=> $newBio,
        ]);
        return $sql_exe->fetch(PDO::FETCH_ASSOC);
    }

    // methode pour afficher la bio
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

    //display all users for admin

    public function displayUsers()
    {
        
        $displayUsers = $this->db->prepare("SELECT * FROM utilisateurs");
        $displayUsers->execute([
            //'id' => $id,
        ]);
        $result = $displayUsers->fetchAll(PDO::FETCH_ASSOC);
        //echo var_dump($result);
        for ($i = 0; $i <= (count($result)-1); $i++) {
        echo 
        "<div id='user".$result[$i]['id']." class='user'>
        <div class = 'id'> <p>Id : ".$result[$i]['id']."</p></div>
        <div class = 'login'> <p>Login : ".$result[$i]['login']."</p></div>
        <div class= 'nom'> <p> Nom : ".$result[$i]['nom']."</p></div> 
        <div class='prenom' <p> Prénom : ".$result[$i]['prenom']."</p></div>
        <form id='form_role' action='admin.php' method='get'>
            <label for='role'>Rôle:</label>
            <select name='role' id='role'>
                <option value=''>Nouveau rôle :</option>
                <option value='utilisateur'>Utilisateur</option>
                <option value='moderateur'>Moderateur</option>
                <option value='administrateur'>Administrateur</option>
            </select>
            
            <input name='update' id='update' value='".$result[$i]['id']."' readonly>
        <button type='submit' class='update' id='".$result[$i]['id']."' >Modifier</button>
        </form>
        
            <button type='submit' class='del' id='".$result[$i]['id']."' href=admin.php?delete=".$result[$i]['id']." >Supprimer</button>
        

        </div>";
        
        }
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
