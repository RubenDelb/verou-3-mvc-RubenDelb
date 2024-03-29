<?php

declare(strict_types = 1);

class ArticleController
{
    private DatabaseManager $database;

    public function __construct()
    {
        require 'Controller/DatabaseManager.php';
        require 'config.php';
        $this->database = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
        $this->database->connect();
    }

    public function index()
    {
        $articles = $this->getArticles();
        
        require 'View/articles/index.php';
    }

    public function getArticlesByAuthor()
    {
        $articles = $this->getArticles();

        require 'View/author.php';
    }

    private function getArticles()
    {
        $query = "SELECT * FROM articles";
        $result = $this->database->connection->prepare($query);
        $result->execute();
        $rawArticles = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['author'], $rawArticle['image_link']);
        }
        return $articles;
    }

    public function show()
    {
        $query = "SELECT * FROM articles WHERE id=(SELECT min(id) FROM articles WHERE id >=  '{$_GET['id']}');";
        $result = $this->database->connection->prepare($query);
        $result->execute();
        $rawArticle = $result->fetch(PDO::FETCH_ASSOC);
        
        $article = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['author'], $rawArticle['image_link']);        

        require 'View/articles/show.php';
    }

    public function getNextId($id){
        $lastId = $this->getLastId();
        $firstId = $this->getFirstId();
        if($id >= $lastId){
            $id = $firstId - 1;
        }        

        $query = "SELECT id FROM articles WHERE id = (SELECT min(id) FROM articles WHERE id > $id);";
        $result=$this->database->connection->prepare($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getPreviousId($id){
        $lastId = $this->getLastId();
        $firstId = $this->getFirstId();
        if($id <= $firstId){
            $id = $lastId + 1;
        }

        $query = "SELECT id FROM articles WHERE id = (select max(id) from articles where id < $id)";
        $result = $this->database->connection->prepare($query);
        $result->execute();
        $fetched = $result->fetch(PDO::FETCH_ASSOC)['id'];
        return $fetched;
    }

    public function getLastId()
    {
        $query = "SELECT id FROM articles ORDER BY id DESC LIMIT 1";
        $result = $this->database->connection->prepare($query);
        $result->execute();
        $lastId = $result->fetch(PDO::FETCH_ASSOC)['id'];
        return $lastId;
    }

    public function getFirstId()
    {
        $query = "SELECT id FROM articles ORDER BY id LIMIT 1";
        $result = $this->database->connection->prepare($query);
        $result->execute();
        $firstId = $result->fetch(PDO::FETCH_ASSOC)['id'];
        return $firstId;
    }
}