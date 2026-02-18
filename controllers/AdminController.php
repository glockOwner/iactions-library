<?php
include_once 'models/Book.php';
include_once 'models/Author.php';

class AdminController
{
    public function actionIndex()
    {
        $books = Book::findAll();

        require_once ROOT . "/views/admin/books.php";

        return true;
    }

    public function actionDeleteBook($bookId)
    {
        Book::deleteBook($bookId);

        header('Location: /admin/books?isBookDeleted=1');

        return true;
    }

    public function actionUpdateBook($bookId)
    {
        $book = Book::getBookById($bookId);
        $authors = Author::findAll();

        if ($_POST['update'])
        {
            $bookName = $_POST['book_name'];
            $authorId = $_POST['author'];

            if ($bookName && $authorId) {
                $result = Book::updateBook($bookId, ['title' => $bookName, 'author_id' => $authorId]);
                $author = Author::getById($authorId);
                $book->setTitle($bookName);
                $book->setAuthor($author);
                if (!$result) {
                    $error = 'Заполните поля правильно!';
                }
            } elseif ($authorId === '0') {
                $error = 'Выберите автора';
            } else {
                $error = 'Заполните все поля';
            }
        }

        require_once ROOT . "/views/admin/edit/book.php";

        return true;
    }

    public function actionCreateBook()
    {
        $authors = Author::findAll();

        if ($_POST['create'])
        {
            $bookName = $_POST['book_name'];
            $authorId = $_POST['author'];

            if ($bookName && $authorId) {
                $result = Book::createBook(['title' => $bookName, 'author_id' => $authorId]);
                if (!$result) {
                    $error = 'Заполните поля правильно!';
                }
            } elseif ($authorId === '0') {
                $error = 'Выберите автора';
            } else {
                $error = 'Заполните все поля';
            }
        }

        require_once ROOT . "/views/admin/create/book.php";

        return true;
    }

    public function actionAuthors()
    {
        $authors = Author::findAll();

        require_once ROOT . "/views/admin/authors.php";

        return true;
    }

    public function actionUpdateAuthor($authorId)
    {
        $author = Author::getById($authorId);

        if ($_POST['update'])
        {
            $authorName = $_POST['author_name'];

            if ($authorName) {
                $result = Author::updateAuthor($authorId, ['name' => $authorName]);
                if (!$result) {
                    $error = 'Заполните поля правильно!';
                }
                $author->setName($authorName);
            } else {
                $error = 'Заполните все поля';
            }
        }

        require_once ROOT . "/views/admin/edit/author.php";

        return true;
    }

    public function actionDeleteAuthor($authorId)
    {
        Author::deleteAuthor($authorId);

        header('Location: /admin/authors?isAuthorDeleted=1');

        return true;
    }

    public function actionCreateAuthor()
    {
        if ($_POST['create'])
        {
            $authorName = $_POST['author_name'];

            if ($authorName) {
                $result = Author::createAuthor(['name' => $authorName]);
                if (!$result) {
                    $error = 'Заполните поля правильно!';
                }
            } else {
                $error = 'Заполните все поля';
            }
        }

        require_once ROOT . "/views/admin/create/author.php";

        return true;
    }
}