<?php
class Database
{
    public $connection;

    public function __construct($config)
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        try {
            $this->connection = new PDO($dsn);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function executenow($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        return $statement->execute($params);
    }
}

