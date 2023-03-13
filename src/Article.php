<?php
require_once ("src/User.php");
#[AllowDynamicProperties] class Article
{
    public ?int $id = null;
    public ?string $nom = null;
    public ?string $prenom = null;
    public ?string $contenu = null;
    public ?string $titre = null;
    public ?string $categorie= null;
    public ?string $date = null;
     public ?User $author = null;
    public $image;
    private ?string $idUtilisateur= null;

    private PDO $db;

    public function __construct()
    {
        $db_dsn = 'mysql:host=localhost; dbname=blog_js';
        $username = 'root';
        $password_db = '';

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

    public function getUniqueArticle($id): Article
    {
        $sql = "SELECT articles.*, utilisateurs.*, articles.id AS id
            FROM articles
            INNER JOIN utilisateurs 
            ON articles.id_utilisateur = utilisateurs.id
            WHERE articles.id = :id";
        $sql_select = $this->db->prepare($sql);
        $sql_select->bindValue(':id', $id, PDO::PARAM_INT);
        $sql_select->execute();
        $result = $sql_select->fetch(PDO::FETCH_ASSOC);
        var_dump($result);

        // On instancie un nouvel objet de la classe Article nommé $article et on lui assigne les valeurs de $result (qui est un tableau associatif)
        $article = new Article();
        $article->author = new User();
        $article->author->id = $result['id_utilisateur'];
        $article->author->login = $result['login'];
        $article->author->bio = $result['bio'];
        $article->id = $result['id'];
        $article->nom = $result['nom'];
        $article->prenom = $result['prenom'];
        $article->titre = $result['titre'];
        $article->image = $result['image'];
        $article->contenu = $result['contenu'];
        $article->categorie = $result['categorie'];
        $article->date = $result['date'];
        $article->idUtilisateur = $result['id_utilisateur'];
        return $article;
    }

}
?>  