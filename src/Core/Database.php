<?php

namespace Core;

use PDO;
use PDOStatement;

class Database
{
    public PDO $connection;
    public PDOStatement $statement;

    public function __construct(array $config, string $username = 'root', string $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            // PDO::ATTR_EMULATE_PREPARES => true,
        ]);
    }

    public function query(string $stmt, array $params = []): PDOStatement
    {
        $this->statement = $this->connection->prepare($stmt);

        foreach ($params as $name => $value) {
            if (is_array($value)) {
                $this->statement->bindValue(":$name", $value[0], $value[1]);
            } else {
                $this->statement->bindValue(":$name", $value);
            }
        }

        $this->statement->execute();

        return $this->statement;
    }

    public function queryPositional(string $stmt, array $params = []): PDOStatement
    {
        $this->statement = $this->connection->prepare($stmt);

        foreach ($params as $i => $value) {
            if (is_array($value)) {
                $this->statement->bindValue($i + 1, $value[0], $value[1]);
            } else {
                $this->statement->bindValue($i + 1, $value);
            }
        }

        $this->statement->execute();

        return $this->statement;
    }
}
