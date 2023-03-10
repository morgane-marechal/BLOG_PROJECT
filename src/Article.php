<?php

class Article
{
    public ?int $id = null;
    private ?string $contenu = null;
    private ?string $titre = null;
    private ?string $categorie= null;
    private ?string $date = null;
    private ?string $idUtilisateur= null;
    
    
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

    public function registerArticle($idUtilisateur, $titre, $contenu, $date, $categorie, $image)
    {
        $idUtilisateur=$_SESSION['id'];
        
            $sql = "INSERT INTO articles (contenu, titre, categorie, date, id_utilisateur, image)
                    VALUES (:contenu, :titre, :categorie, :date, :id_utilisateur, :image)";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'contenu' => htmlspecialchars($contenu),
                'titre' => htmlspecialchars($titre),
                'categorie' => htmlspecialchars($categorie),
                'date' => $date,
                'id_utilisateur' => $idUtilisateur,
                'image' => $image,
            ]);

            if ($sql_exe) {
                echo json_encode(['response' => 'ok', 'reussite' => 'Votre article a été soumis.']);
            } elseif ($sql_exe) {
                echo json_encode(['response' => 'not ok', 'echoue' => 'Echec!']);
            }
    }

    public function getAuteur()
    {
        $allInfo = $this->db -> prepare("SELECT * FROM utilisateurs WHERE id = $this->idUtilisateur");
        $allInfo -> execute();
        $result = $allInfo->fetch(PDO::FETCH_ASSOC);
        $auteur=$result ['prenom']." ".$result ['nom'];
        echo "Le nom d'auteur est ".$auteur;
    }

    public function getArticles()
    {
        $sql = "SELECT articles.id AS article_id, 
                articles.titre AS article_titre, 
                articles.contenu AS article_contenu, 
                articles.image AS article_image, 
                articles.categorie AS article_categorie, 
                articles.date AS article_date, 
                utilisateurs.id AS utilisateur_id, 
                utilisateurs.nom AS utilisateur_nom, 
                utilisateurs.prenom AS utilisateur_prenom
                FROM articles
                INNER JOIN utilisateurs 
                ON articles.id_utilisateur = utilisateurs.id";
        $sql_select = $this->db->prepare($sql);
        $sql_select->execute();
        $results = $sql_select->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }

    public function getUniqueArticle($id)
    {
        $sql = "SELECT *
            FROM articles
            WHERE id = :id";
        $sql_select = $this->db->prepare($sql);
        $sql_select->bindValue(':id', $id, PDO::PARAM_INT);
        $sql_select->execute();
        return $sql_select->fetch(PDO::FETCH_ASSOC);
    }

}
?>  