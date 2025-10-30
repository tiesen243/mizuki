<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/src/helpers.php';

$application = new \Core\Kernel\Application(__DIR__);
$application->cli(function (\Core\Http\Request $request, \PDO $db) {
    $command = $request->getArgv(1);

    switch ($command) {
        case 'new':
            $name = $request->getArgv(2);
            if (!$name) {
                echo "Please provide a name for the new entity.\n";
                return;
            }
            newEntity($name);
            echo "Entity class '$name' created successfully.\n";
            break;
        case 'generate':
            generateMigration();
            echo "Migration file generated successfully.\n";
            break;
        case 'migrate':
            runMigrations($db);
            echo "Migrations executed successfully.\n";
            break;
        case 'show':
            $tableName = $request->getArgv(2);
            if ($tableName) {
                showTable($db, $tableName);
            } else {
                showTables($db);
            }
            break;
        case 'help':
        default:
            echo "Usage: php console.php [command] [options]\n";
            echo "Commands:\n";
            echo "  new [name]         Create a new entity class with the specified name.\n";
            echo "  generate           Generate a new migration file based on entity definitions.\n";
            echo "  migrate            Execute all pending migrations.\n";
            echo "  show [table_name]  Show all tables or the structure of a specific table.\n";
            echo "  help               Display this help message.\n";
            break;
    }
});

function generateMigration()
{
    $sqlStatements = [];

    $entityPath = glob(__DIR__.'/app/Entity/*.php');
    foreach ($entityPath as $path) {
        require_once $path;
    }

    foreach (get_declared_classes() as $class) {
        $entityAttr = (new ReflectionClass($class))->getAttributes(\Core\Attribute\Entity::class);
        if (!$entityAttr) {
            continue;
        }
        $tableName = $entityAttr[0]->getArguments()['tableName'] ?? strtolower((new ReflectionClass($class))->getShortName());
        $fields = [];
        foreach ((new ReflectionClass($class))->getProperties() as $prop) {
            $fieldAttr = $prop->getAttributes(\Core\Attribute\Field::class);
            if (!$fieldAttr) {
                continue;
            }
            $args = $fieldAttr[0]->getArguments();
            $col = "`{$args['name']}` {$args['type']}";
            if (!$args['nullable']) {
                $col .= " NOT NULL";
            }
            if (!empty($args['primary'])) {
                $col .= " PRIMARY KEY";
            }
            $fields[] = $col;
        }
        $sqlStatements[] = "CREATE TABLE IF NOT EXISTS `$tableName` (\n  " . implode(",\n  ", $fields) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    }

    $date = date('Ymd_His');
    $migrationFile = __DIR__."/migrations/migration-{$date}.sql";
    file_put_contents($migrationFile, implode("\n\n", $sqlStatements));
}

function runMigrations(\PDO $db)
{
    $migrationFiles = glob(__DIR__.'/migrations/migration-*.sql');
    foreach ($migrationFiles as $file) {
        $sql = file_get_contents($file);
        $db->exec($sql);
    }
}

function showTables(\PDO $db)
{
    $stmt = $db->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        echo $table . "\n";
    }
}

function showTable(\PDO $db, string $tableName)
{
    $stmt = $db->query("DESCRIBE `$tableName`");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    printf("| %-20s | %-20s | %-10s |\n", "Field", "Type", "Key");
    printf("|-%'-20s-|-%'-20s-|-%'-10s-|\n", '', '', '');
    foreach ($columns as $column) {
        printf(
            "| %-20s | %-20s | %-10s |\n",
            $column['Field'],
            $column['Type'],
            $column['Key']
        );
    }
}

function newEntity(string $name): void
{
    $fields = [];
    echo "Define fields for entity '$name'.\n";
    while (true) {
        echo "What's field name? (leave blank to create entity): ";
        $fieldName = trim(fgets(STDIN));
        if ($fieldName === '') {
            break;
        }
        echo "Field type (string, number, bool, date, etc.): ";
        $fieldType = trim(fgets(STDIN));
        if ($fieldType === '') {
            $fieldType = 'string';
        }
        echo "SQL type (e.g. VARCHAR(255), INT, DATETIME): ";
        $sqlType = trim(fgets(STDIN));
        if ($sqlType === '') {
            $sqlType = 'VARCHAR(255)';
        }
        echo "Nullable? (yes/no, default: no): ";
        $nullableInput = strtolower(trim(fgets(STDIN)));
        $nullable = ($nullableInput === 'yes' || $nullableInput === 'y') ? 'true' : 'false';

        $fields[] = [
            'name' => $fieldName,
            'type' => $fieldType,
            'sql' => strtoupper($sqlType),
            'nullable' => $nullable,
        ];
    }

    $fieldsCode = "    #[Field(name: 'id', type: 'VARCHAR(24)', nullable:false, primary: true)]\n    public string \$id;\n";
    foreach ($fields as $field) {
        $phpType = match($field['type']) {
            'number' => 'int',
            'bool', 'boolean' => 'bool',
            'date', 'datetime' => '\\DateTime',
            default => 'string',
        };
        $fieldsCode .= "\n    #[Field(name: '" . strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $field['name'])) . "', type: '{$field['sql']}', nullable:{$field['nullable']})]\n    public {$phpType} \${$field['name']};\n";
    }

    $entityTemplate = <<<EOT
<?php

namespace App\Entity;

use Core\Attribute\{Entity,Field};

#[Entity(tableName: '%s')]
class %s
{
%s
    public function __construct()
    {
        \$this->id = createId();
    }
}
EOT;

    $className = ucfirst($name);
    $tableName = strtolower($name).'s';
    $entityContent = sprintf($entityTemplate, $tableName, $className, $fieldsCode);

    $entityFile = __DIR__."/app/Entity/{$className}.php";
    file_put_contents($entityFile, $entityContent);
}
