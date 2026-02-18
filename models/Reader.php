<?php
include_once 'models/Book.php';

class Reader implements \JsonSerializable
{
    /** @var int */
    private $id;

    /** @var Book */
    private $book;

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
     * @return Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setBook(Book $book)
    {
        $this->book = $book;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public static function createReader($bookId)
    {
        $db = Db::getConnection();

        $sql = "INSERT INTO readers (book_id)
        VALUES (:book_id)";

        $result = $db->prepare($sql);
        $result->bindValue(':book_id', $bookId, PDO::PARAM_INT);
        $result->execute();

        return $result;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}