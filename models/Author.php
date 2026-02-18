<?php

class Author implements \JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

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
    public function getName()
    {
        return $this->name;
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

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public static function findAll()
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM authors;";
        $result = $db->prepare($sql);
        $result->execute();

        $authors = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $author = new Author();
            $author->setId($row['id']);
            $author->setName($row['name']);
            $author->setCreatedAt($row['created_at']);

            $authors[] = $author;
        }

        return $authors;
    }

    public static function getById($id)
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM authors WHERE id = :id;";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $author = new Author();
        $author->setId($row['id']);
        $author->setName($row['name']);
        $author->setCreatedAt($row['created_at']);

        return $author;
    }

    public static function createAuthor(array $data)
    {
        $db = Db::getConnection();

        $sql = "INSERT INTO authors (name)
        VALUES (:name)";

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->execute();

        return $result;
    }

    public static function updateAuthor($id, array $data)
    {
        $db = Db::getConnection();

        $sql = "UPDATE authors SET name=:name
        WHERE id = :id;";

        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);

        return $result->execute();
    }

    public static function deleteAuthor($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM authors WHERE  id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT );

        return $result->execute();
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}