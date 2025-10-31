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
    // Static cache for metadata per entity class
    private static array $metadataCache = [];

    protected \PDO $db;
    /** @var TEntity */
    protected object $entity;
    protected ?string $tableName = null;
    protected ?string $primaryKey = null;
    protected ?array $columns = null;

    public function __construct(object $entity)
    {
        $this->entity = $entity;
        $this->db = Database::getInstance();
        $this->initializeMetadata();
    }

    /** @return TEntity[] */
    public function all(): array
    {
        $columns = $this->getSelectColumns();
        $stmt = $this->db->prepare("SELECT {$columns} FROM {$this->tableName}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_class($this->entity));
    }

    /** @return TEntity|null */
    public function find(string $id): ?object
    {
        $columns = $this->getSelectColumns();
        $stmt = $this->db->prepare("SELECT {$columns} FROM {$this->tableName} WHERE {$this->primaryKey} = :pk LIMIT 1");
        $stmt->execute([':pk' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_class($this->entity))[0] ?? null;
    }

    /** @param TEntity $entity */
    public function store(object $entity): void
    {
        $names = array_column($this->columns, 'name');
        $placeholders = array_map(fn ($n) => ":$n", $names);
        $primaryKeyValue = $entity->{$this->getPrimaryKeyProp()};

        $values = [];
        foreach ($this->columns as $col) {
            $values[":{$col['name']}"] = $entity->{$col['prop']};
        }

        if (empty($primaryKeyValue)) {
            $values[":{$this->primaryKey}"] = createId();
            $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (" . implode(', ', $names) . ") VALUES (" . implode(', ', $placeholders) . ")");
        } else {
            $updateAssignments = implode(', ', array_map(fn ($n) => "{$n} = :{$n}", $names));
            $stmt = $this->db->prepare("UPDATE {$this->tableName} SET {$updateAssignments} WHERE {$this->primaryKey} = :{$this->primaryKey}");
        }

        $stmt->execute($values);
    }

    public function delete(string $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :pk");
        $stmt->execute([':pk' => $id]);
    }

    private function initializeMetadata(): void
    {
        $class = get_class($this->entity);
        if (!isset(self::$metadataCache[$class])) {
            $reflection = new \ReflectionClass($this->entity);

            $entityAttr = $reflection->getAttributes(\Core\Attribute\Entity::class)[0] ?? null;
            $tableName = $entityAttr?->newInstance()?->tableName ?? throw new \Exception("Entity attribute missing");

            $columns = [];
            $primaryKey = null;
            foreach ($reflection->getProperties() as $prop) {
                $fieldAttr = $prop->getAttributes(\Core\Attribute\Field::class)[0] ?? null;
                if ($fieldAttr) {
                    $field = $fieldAttr->newInstance();
                    $columns[] = [
                        'name' => $field->name,
                        'prop' => $prop->getName(),
                        'type' => $field->type,
                        'primary' => $field->primary
                    ];
                    if ($field->primary) {
                        $primaryKey = $field->name;
                    }
                }
            }

            if (!$primaryKey) {
                throw new \Exception("Primary key not defined for entity " . $class);
            }

            self::$metadataCache[$class] = [
                'tableName' => $tableName,
                'primaryKey' => $primaryKey,
                'columns' => $columns,
                'primaryKeyProp' => array_column($columns, 'prop', 'name')[$primaryKey] ?? $primaryKey,
            ];
        }

        $meta = self::$metadataCache[$class];
        $this->tableName = $meta['tableName'];
        $this->primaryKey = $meta['primaryKey'];
        $this->columns = $meta['columns'];
    }

    protected function getSelectColumns(): string
    {
        return implode(', ', array_map(fn ($col) => "{$col['name']} AS {$col['prop']}", $this->columns));
    }

    private function getPrimaryKeyProp(): string
    {
        foreach ($this->columns as $col) {
            if ($col['primary']) {
                return $col['prop'];
            }
        }
        return $this->primaryKey;
    }

}
