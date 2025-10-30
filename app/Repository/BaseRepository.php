<?php

namespace App\Repository;

use App\Contract\Repository\IBaseRepository;
use Core\Database;

/**
 * @template TEntity of object
 * @implements IBaseRepository<TEntity>
 */
abstract class BaseRepository implements IBaseRepository
{
    protected \PDO $db;
    /** @var TEntity */
    protected object $entity;

    private ?string $tableName = null;
    private ?string $primaryKey = null;
    private ?array $columns = null;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->initializeMetadata();
    }

    /** @return TEntity[] */
    public function all(): array
    {
        $columns = implode(', ', array_map(fn ($col) => "{$col['name']} AS {$col['prop']}", $this->columns));
        $stmt = $this->db->prepare("SELECT {$columns} FROM {$this->tableName}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_class($this->entity)) ?: [];
    }

    /** @return TEntity|null */
    public function find(string $id): ?object
    {
        $columns = implode(', ', array_map(fn ($col) => "{$col['name']} AS {$col['prop']}", $this->columns));
        $stmt = $this->db->prepare("SELECT {$columns} FROM {$this->tableName} WHERE {$this->primaryKey} = :{$this->primaryKey} LIMIT 1");
        $stmt->execute([":{$this->primaryKey}" => $id]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_class($this->entity))[0] ?? null;
    }

    /** @param TEntity $entity */
    public function create(object $entity): void
    {
        $names = array_column($this->columns, 'name');
        $placeholders = array_map(fn ($n) => ":$n", $names);

        $values = [];
        foreach ($this->columns as $col) {
            $values[":{$col['name']}"] = $entity->{$col['prop']};
        }

        $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (" . implode(', ', $names) . ") VALUES (" . implode(', ', $placeholders) . ")");
        $stmt->execute($values);
    }

    /** @param TEntity $entity */
    public function update(string $id, object $entity): void
    {
        $setClauses = [];
        $values = [];
        foreach ($this->columns as $col) {
            if ($col['primary']) {
                continue;
            }
            $setClauses[] = "{$col['name']} = :{$col['name']}";
            $values[":{$col['name']}"] = $entity->{$col['prop']};
        }
        $values[":{$this->primaryKey}"] = $id;

        $stmt = $this->db->prepare("UPDATE {$this->tableName} SET " . implode(', ', $setClauses) . " WHERE {$this->primaryKey} = :{$this->primaryKey}");
        $stmt->execute($values);
    }

    public function delete(string $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :{$this->primaryKey}");
        $stmt->execute([":{$this->primaryKey}" => $id]);
    }

    private function initializeMetadata(): void
    {
        $reflection = new \ReflectionClass($this->entity);

        $entityAttr = $reflection->getAttributes(\Core\Attribute\Entity::class)[0] ?? null;
        $this->tableName = $entityAttr?->newInstance()?->tableName ?? throw new \Exception("Entity attribute missing");

        $this->columns = [];
        foreach ($reflection->getProperties() as $prop) {
            $fieldAttr = $prop->getAttributes(\Core\Attribute\Field::class)[0] ?? null;
            if ($fieldAttr) {
                $field = $fieldAttr->newInstance();
                $this->columns[] = ['name' => $field->name, 'prop' => $prop->getName(), 'type' => $field->type, 'primary' => $field->primary];
                if ($field->primary) {
                    $this->primaryKey = $field->name;
                }

            }
        }

        if (!$this->primaryKey) {
            throw new \Exception("Primary key not defined for entity " . get_class($this->entity));
        }
    }
}
