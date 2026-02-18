<?php
include_once 'models/Author.php';
include_once 'models/Reader.php';
include_once 'models/traits/Filterable.php';

class Book implements \JsonSerializable
{
    use Filterable;

    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var Author */
    private $author;

    /** @var Reader[] */
    private $readers = [];

    /** @var string */
    private $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getReaders()
    {
        return $this->readers;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setReaders(array $readers)
    {
        $this->readers = $readers;
    }

    public static function findAll()
    {
        $db = Db::getConnection();

        $sql = "SELECT b.id AS book_id,
                b.author_id,
                title,
                b.created_at AS book_created_at,
                name,
                a.created_at AS author_created_at
                FROM books b INNER JOIN authors a ON a.id = b.author_id";
        $result = $db->query($sql);

        return Book::hydrateBooks($result, $db);
    }

    public static function deleteBook($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM books WHERE  id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT );

        return $result->execute();
    }

    public static function getBookById($id)
    {
        $db = Db::getConnection();

        $sql = "SELECT b.id AS book_id,
                b.author_id,
                title,
                b.created_at AS book_created_at,
                name,
                a.created_at AS author_created_at
                FROM books b INNER JOIN authors a ON a.id = b.author_id WHERE b.id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT );
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['title']);
        $book->setCreatedAt($row['book_created_at']);

        $author = new Author();
        $author->setId($row['author_id']);
        $author->setName($row['name']);
        $author->setCreatedAt($row['author_created_at']);

        $book->setAuthor($author);

        return $book;
    }

    public static function updateBook($id, array $data)
    {
        $db = Db::getConnection();

        $sql = "UPDATE books SET title=:title, author_id=:author_id
        WHERE id = :id;";

        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $data['title'], PDO::PARAM_STR);
        $result->bindParam(':author_id', $data['author_id'], PDO::PARAM_INT);

        return $result->execute();
    }

    public static function createBook(array $data)
    {
        $db = Db::getConnection();

        $sql = "INSERT INTO books (title, author_id)
        VALUES (:title, :author_id)";

        $result = $db->prepare($sql);
        $result->bindParam(':title', $data['title'], PDO::PARAM_STR);
        $result->bindParam(':author_id', $data['author_id'], PDO::PARAM_INT);
        $result->execute();

        return $result;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }

    public static function hydrateBooks(PDOStatement $result, PDO $db)
    {
        /**
         * @var Book[] $books
         */
        $books = [];
        $bookIds = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $book = new Book();
            $book->setId($row['book_id']);
            $book->setTitle($row['title']);
            $book->setCreatedAt($row['book_created_at']);

            $author = new Author();
            $author->setId($row['author_id']);
            $author->setName($row['name']);
            $author->setCreatedAt($row['author_created_at']);

            $book->setAuthor($author);
            $books[] = $book;
            $bookIds[] = $book->getId();
        }

        $sql = "SELECT * FROM readers;";
        $result = $db->query($sql);

        if ($result->rowCount() > 0){
            $readers = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($books as $key => $book) {
                $bookReaders = array_filter($readers, function ($reader) use ($book) {
                    return $book->getId() == $reader['book_id'];
                });
                $book->setReaders($bookReaders);
            }
        }

        return $books;
    }
}