<?php

include_once 'filters/AbstractFilter.php';

class BookFilter extends AbstractFilter
{
    public $sql = "SELECT b.id AS book_id,
                b.author_id,
                title,
                b.created_at AS book_created_at,
                name,
                a.created_at AS author_created_at
                FROM books b INNER JOIN authors a ON a.id = b.author_id";
    public const BOOK_TITLE = 'title';
    public const AUTHOR_ID = 'author_id';


    protected function getCallbacks(): array
    {
        return [
            self::BOOK_TITLE => [$this, 'title'],
            self::AUTHOR_ID => [$this, 'author_id'],
        ];
    }

    public function title($value)
    {
        $this->sql .= " WHERE b.title LIKE :title";
    }

    public function author_id($value)
    {
        $this->sql .= " AND b.author_id = :author_id";
    }

    public function apply()
    {
        $stmt = parent::apply();
        $books = Book::hydrateBooks($stmt, $this->db);

        usort($books, function ($a, $b) {
            $qtyReadersOfA = count($a->getReaders());
            $qtyReadersOfB = count($b->getReaders());
            if ($qtyReadersOfA == $qtyReadersOfB) {
                return 0;
            }

            return ($qtyReadersOfA < $qtyReadersOfB) ? 1 : -1;
        });

        return $books;
    }
}
