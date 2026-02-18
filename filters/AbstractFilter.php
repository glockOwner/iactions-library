<?php

include_once 'filters/FilterInterface.php';
include_once 'models/Book.php';

abstract class AbstractFilter implements FilterInterface
{
    /** @var array */
    protected $queryParams = [];

    /** @var PDO */
    protected $db;

    /** @var string */
    protected $sql = "";

    /**
     * AbstractFilter constructor.
     *
     * @param array $queryParams
     */
    public function __construct(array $queryParams, PDO $db)
    {
        $this->queryParams = $queryParams;
        $this->db = $db;
    }

    abstract protected function getCallbacks(): array;

    public function apply()
    {
        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                call_user_func($callback, $this->queryParams[$name]);
            }
        }

        $stmt = $this->db->prepare($this->sql);

        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                $var = ($name == 'title') ? $this->queryParams[$name].'%' : $this->queryParams[$name];

                $stmt->bindValue(":$name", $var);
            }
        }

        $stmt->execute();

        return $stmt;
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * @param string[] $keys
     *
     * @return AbstractFilter
     */
    protected function removeQueryParam(string ...$keys)
    {
        foreach ($keys as $key) {
            unset($this->queryParams[$key]);
        }

        return $this;
    }
}
