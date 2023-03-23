<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            // PDO::ATTR_EMULATE_PREPARES => true,
        ]);
    }

    public function query($stmt, $params = [])
    {
        $this->statement = $this->connection->prepare($stmt);

        $this->statement->execute($params);

        return $this->statement;
    }
}
