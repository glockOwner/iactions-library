<?php
include_once 'models/Book.php';
include_once 'filters/BookFilter.php';
include_once 'services/SearchService.php';
include_once 'models/Author.php';

class IndexController
{
    public function actionIndex()
    {
        $authors = Author::findAll();
        require_once ROOT . '/views/index/search.php';

        return true;
    }

    public function actionSearch()
    {
        $data = $_GET;
        $books = SearchService::searchBook($data);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($books, JSON_PRETTY_PRINT);

        return true;
    }
}