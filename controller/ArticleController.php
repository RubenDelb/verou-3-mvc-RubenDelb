<?php

declare(strict_types = 1);

class ArticleController
{
    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        // Prepare the database connection
        // Note: you might want to use a re-usable databaseManager class - the choice is yours
        require 'Model/DatabaseManager.php';
        require 'config.php';
        $databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
        $databaseManager->connect();
        // Fetch all articles as $rawArticles (as a simple array)
        $query = "SELECT title, `description`, publish_date FROM articles";
        $result = $databaseManager->connection->prepare($query);
        $result->execute();
        $rawArticles = $result->fetchAll(PDO::FETCH_ASSOC);
        // $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
        }

        return $articles;
    }

    public function show()
    {
        // TODO: this can be used for a detail page
    }
}