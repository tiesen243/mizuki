<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/src/helpers.php';

$application = new \Core\Kernel\Application(__DIR__);
$application->cli(function (\Core\Http\Request $request, \PDO $db) {
    $command = $request->getArgv(1);

    switch ($command) {
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
            echo "Usage: php console.php [command]\n";
            echo "Commands:\n";
            echo "  generate   Generate a new migration file based on entity definitions.\n";
            echo "  migrate    Execute all pending migrations.\n";
            echo "  show       Show all tables in the database.\n";
            echo "  help       Display this help message.\n";
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
