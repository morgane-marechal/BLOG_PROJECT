<?php

class User
{
    private ?int $id = null;
    private ?string $prenom = null;
    private ?string $nom = null;
    private ?string $password = null;
    private PDO $db;

    public function __construct()
    {
        $db_dsn = 'mysql:host=localhost; dbname=blog_js';
        $username = 'root';
        $password_db = 'root';

        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//ERROR TYPE
                    PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
                ];
            $this->db = new PDO($db_dsn, $username, $password_db, $options);
        } catch (PDOException $e) {
            print "Erreur! :" . $e->getMessage() . "</br>";
            die();
        }
    }

    public function register($login, $prenom, $nom, $password, $rangs)
    {
        if (!$this->verifUser()) {
            $sql = "INSERT INTO utilisateurs (login, prenom, nom, password, rangs)
                    VALUES (:login, :prenom, :nom, :password, :rangs)";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'login' => htmlspecialchars($login),
                'prenom' => htmlspecialchars($prenom),
                'nom' => htmlspecialchars($nom),
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'rangs' => htmlspecialchars($rangs),
            ]);

            if ($sql_exe) {
                echo json_encode(['response' => 'ok', 'reussite' => 'Inscription réussie.']);
            } elseif ($sql_exe) {
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
            return json_encode(['reponse' => 'not ok', 'echec' => 'connexion refusée']);
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

    public function delete()
    {
        unset($_SESSION['utilisateur']);
        session_destroy();
        header('Location: index.php');
    }
}