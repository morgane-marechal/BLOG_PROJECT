<?php

#[AllowDynamicProperties] class Pagination
{
    public $currentPage = null;
    public ?int $nbrOfPages = null;
    public ?int $nbrOfArticles = null;
    public ?int $nbrOfArticlesPerPage = 5;

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

    function countPages()
    {
        $this->nbrOfPages = ceil( $this->nbrOfArticles / $this->nbrOfArticlesPerPage);

        return $this->nbrOfPages;
    }
}






