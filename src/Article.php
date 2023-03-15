<?php

#[AllowDynamicProperties]
class Article
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
        strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh') !== false ? $password_db = 'root' : $password_db = '';

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
                'date' => htmlspecialchars($date),
                'id_utilisateur' => htmlspecialchars($idUtilisateur),
                'image' => htmlspecialchars($image),
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


    public function manageArticles()
    {
        $managearticles = "SELECT articles.id, 
                articles.titre, 
                articles.contenu, 
                articles.image, 
                articles.categorie 
                FROM articles";
        $sql_select = $this->db->prepare($managearticles);
        $sql_select->execute();
        $results = $sql_select->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($results);
        for ($i = 0; $i <= (count($results)-1); $i++) {
        echo " <form id='admin_article_form' action='' method='get'>
        <h3>Modération des articles</h3>
        <input name='id_article' id='id_article' value='".$results[$i]['id']."' readonly>
        <label for='newtitre'>Titre</label>
        <input type='text' name='newtitre' id='newtitre' value=".$results[$i]['titre']." minlength='3'>
        <label for='contenu'>Contenu</label>
            <textarea name='contenu' value=".$results[$i]['contenu'].">".$results[$i]['contenu']."</textarea>
        <label for='categorie'>Catégorie</label>
        <select name='categorie' id='categorie'>
                <option value=''>".$results[$i]['categorie']."</option>
                <option value='reconversion'>Reconversion</option>
                <option value='autoformation'>Autoformation</option>
                <option value='actu'>Actu</option>
                <option value='divers'>Divers</option>
                <option value='jsepa'>Je ne sais pas</option>
        </select>

        <input class='updateArticle' id='submit' name='submit' type='submit' value='Appliquer le changement'>
        </form>";
        }
    }

    public function updateTitre(int $idarticle, $newtitre){
        $sqlupdate = $this -> db -> prepare("UPDATE articles SET titre = '$newtitre' WHERE id = :idarticle");
        $sqlupdate->execute([
            'idarticle' => $idarticle,
        ]);
    }

    public function updateContent(int $idarticle, $newcontent){
        $sqlupdate = $this -> db -> prepare("UPDATE articles SET contenu = :newcontent WHERE id = :idarticle");
        $sqlupdate->execute([
            'idarticle' => $idarticle,
            'newcontent' => $newcontent,
        ]);
    }

    public function updateCategorie(int $idarticle, $newcategorie){
        $sqlupdate = $this -> db -> prepare("UPDATE articles SET categorie = '$newcategorie' WHERE id = :idarticle");
        $sqlupdate->execute([
            'idarticle' => $idarticle,
        ]);
    }


}
?>  