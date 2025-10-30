<?php

namespace Core\Kernel;

class Database
{
    private static $instance = null;
    private \PDO $connection;

    private function __construct(array $config)
    {
        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['name']};charset=utf8mb4";
        $this->connection = new \PDO($dsn, $config['user'], $config['password']);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function connect(array $config): static
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public static function getInstance(): \PDO
    {
        if (self::$instance === null) {
            throw new \Exception("Database instance not created. Call createInstance() first.");
        }
        return self::$instance->connection;
    }
}
