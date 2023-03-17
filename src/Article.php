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
    private ?string $idUtilisateur = null;
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


    /* Méthode pour enregistrer un article en base de données
        La méthode attend des paramètres comme l'idUtilisateur, le titre, contenu etc
        idUtilisateur est égal à l'id session
        On insert le tout en liant les paramètres entrés à des variables
        On renvoie un json selon la réussite ou l'échec de l'insert
    */
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

    /* Méthode qui sert à récupérer tous les articles de la base de données
        On sélectionne les quelques infos de la table articles et utilisateurs
        On fetch le résultat et on le place dans une variable pour ensuite le return en json
        Ce json va permettre d'afficher les articles avec le javascript

    */

    /* Méthode pour compter le nombre d'articles en base de données
    On compte tout dans la table articles
    On return le résultat de la première colonne du fetch num
    */
    function countArticles(): int
    {
        $sql = "SELECT count(*) FROM articles";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute();
        $results = $sql_exe->fetch(PDO::FETCH_NUM)[0];
        return (int) $results;
    }

    public function getArticles(Pagination $pagination)
    {
        $offset = intval($pagination->nbrOfArticlesPerPage) * intval(($pagination->currentPage - 1));
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
            ON articles.id_utilisateur = utilisateurs.id
            ORDER BY date DESC 
            LIMIT $pagination->nbrOfArticlesPerPage
            OFFSET $offset";
        $sql_select = $this->db->prepare($sql);
        $sql_select->execute();
        $results = $sql_select->fetchAll(PDO::FETCH_ASSOC);

//        $art = new Article();
//        $art->contenu = $results['article_contenu'];
//        $art->titre = $results['article_titre'];
//        $art->image = $results['article_image'];
//        $art->categorie = $results['article_categorie'];
//        $art->nom = $results['article_categorie'];

        //return json_encode($results);
        return $results;
    }


    /* Méthode qui va permettre de récupérer l'article avec l'ID passé en paramètre pour pouvoir l'afficher
         On récupère tout dans la table article, utilisateurs et on donne un alias à id de l'article pour éviter d'être confus
         On join la classe utilisateur et l'on dit l'id utilisateur dans la table article est égale à l'id de la table utilisateur
         On récupère les infos là où articles.id est égal à l'id qui est récupéré en paramètre de la fonction
         public function getUniqueArticle($id): Article
    */
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
        echo "<h2>Modération des articles</h2>";
        for ($i = 0; $i <= (count($results)-1); $i++) {
        echo " <form class='admin-article' id='admin_article_form' action='' method='get'>
        <input type='hidden' name='id_article' id='id_article' value='".$results[$i]['id']."' readonly>
        <label for='newtitre'>Titre</label>
        <input type='text' name='newtitre' id='newtitre' value=".$results[$i]['titre']." minlength='3'>
        <p><label for='contenu'>Contenu</label></p>
        <p><textarea name='contenu' class='manage-content' value=".$results[$i]['contenu'].">".$results[$i]['contenu']."</textarea></p>
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
        </form>
        <button type='submit' class='del-article' id='".$results[$i]['id']."' href=admin_articles.php?delete-article=".$results[$i]['id']." >Supprimer l'article</button>";
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

    public function deleteArticle(int $idDelete){
        $delete= $this->db->prepare("DELETE from articles WHERE id = '$idDelete'");
        $delete->execute();
    }
}
?>  