<?php

class Comments
{
    private ?int $id = null;
    private ?string $contenu = null;
    private ?string $date = null;
    private ?int $id_utilisateur = null;

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

    public function registerComments($contenu, $date, $id_utilisateur)
    {
        $id_utilisateur = $_SESSION['id'];
        $sql = "INSERT INTO commentaires  (id, contenu, date, id_utilisateur) VALUES (:id, :contenu, :date, :id_utilisateur)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'contenu' => htmlspecialchars($contenu),
            'date' => htmlspecialchars($date),
            'id_utilisateur' => htmlspecialchars($id_utilisateur),
        ]);

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
     * @return Comments
     */
    public function setId(?int $id): Comments
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    /**
     * @param string|null $contenu
     * @return Comments
     */
    public function setContenu(?string $contenu): Comments
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     * @return Comments
     */
    public function setDate(?string $date): Comments
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    /**
     * @param int|null $id_utilisateur
     * @return Comments
     */
    public function setIdUtilisateur(?int $id_utilisateur): Comments
    {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }

}