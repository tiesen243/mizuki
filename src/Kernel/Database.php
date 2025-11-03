<?php

declare(strict_types=1);

namespace Core\Kernel;

class Database
{
  private static $instance;
  private \PDO $connection;

  private function __construct(array $config) {
    $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['name']};charset=utf8mb4";
    $this->connection = new \PDO($dsn, $config['user'], $config['password']);
    $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  }

  public static function connect(array $config): static {
    if (null === self::$instance) {
      self::$instance = new self($config);
    }

    return self::$instance;
  }

  public static function getInstance(): \PDO {
    if (null === self::$instance) {
      throw new \Exception('Database instance not created. Call createInstance() first.');
    }

    return self::$instance->connection;
  }
}
