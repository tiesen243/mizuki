<?php

namespace Core;

use PDO;

class Database
{
    private static $instance = null;
    private PDO $connection;

    private function __construct(
        string $host,
        string $dbName,
        string $username,
        string $password
    ) {
        $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
        $this->connection = new PDO($dsn, $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function connect(string $host, string $dbName, string $username, string $password): static
    {
        if (self::$instance === null) {
            self::$instance = new self($host, $dbName, $username, $password);
        }
        return self::$instance;
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            throw new \Exception("Database instance not created. Call createInstance() first.");
        }
        return self::$instance->connection;
    }
}
