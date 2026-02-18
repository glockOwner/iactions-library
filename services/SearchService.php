<?php
include_once 'models/Reader.php';

class SearchService
{
    public static function searchBook($queryData)
    {
        $db = Db::getConnection();
        $filter = new BookFilter($queryData, $db);
        $books = Book::filter($filter);
        foreach ($books as $book) {
            Reader::createReader($book->getId());
        }

        return $books;
    }
}