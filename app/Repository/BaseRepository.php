<?php

namespace App\Repository;

use App\Contract\Repository\IBaseRepository;
use Core\Kernel\Database;

/**
 * @template TEntity of object
 * @implements IBaseRepository<TEntity>
 */
abstract class BaseRepository implements IBaseRepository
{
    protected \PDO $db;

    protected string $entity;
    protected string $tableName;
    protected string $primaryKey;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /** @return TEntity[] */
    public function all(): array
    {
        $columns = implode(', ', array_map(fn ($col) => "{$col['name']} AS {$col['property']}", $this->getColumns()));
        $stmt = $this->db->prepare("SELECT {$columns} FROM {$this->tableName}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->entity);
    }

    /** @return TEntity|null */
    public function find(string $id): ?object
    {
        $columns = implode(', ', array_map(fn ($col) => "{$col['name']} AS {$col['property']}", $this->getColumns()));
        $stmt = $this->db->prepare("SELECT {$columns} FROM {$this->tableName} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->entity)[0] ?? null;
    }

    /** @param TEntity $entity */
    public function store(object $entity): bool
    {
        $columns = array_map(fn ($col) => $col['name'], $this->getColumns());
        if (empty($entity->{$this->primaryKey})) {
            $entity->{$this->primaryKey} = createId();
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->tableName} (" . implode(', ', $columns) . ")
                 VALUES (:" . implode(', :', $columns) . ")"
            );
        } else {
            $setClause = implode(', ', array_map(fn ($col) => "{$col} = :{$col}", $columns));
            $stmt = $this->db->prepare(
                "UPDATE {$this->tableName} SET {$setClause}
                 WHERE {$this->primaryKey} = :{$this->primaryKey}"
            );
            $stmt->bindValue($this->primaryKey, $entity->{$this->primaryKey});
        }

        foreach ($this->getColumns() as $col) {
            $stmt->bindValue($col['name'], $entity->{$col['property']});
        }

        return $stmt->execute();
    }

    public function delete(string $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :id");
        return $stmt->execute(['id' => $id]);
    }

    private function getColumns(): array
    {
        $columns = [];
        $reflection = new \ReflectionClass($this->entity);
        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(\Core\Attribute\Field::class);
            if (!empty($attributes)) {
                $columns[] = [
                  'name' => $attributes[0]->newInstance()->name,
                  'property' => $property->getName(),
                ];
            }
        }
        return $columns;
    }
}
