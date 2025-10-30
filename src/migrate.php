<?php

$basePath = dirname(__DIR__);
require_once $basePath.'/vendor/autoload.php';
require_once $basePath.'/src/helpers.php';

foreach (glob(dirname(__DIR__).'/app/Entity/*.php') as $file) {
    require_once $file;
}

$application = new Core\Application($basePath);
$application->cli(function (\PDO $db) {
    $entityAttrClass = Core\Attribute\Entity::class;
    $fieldAttrClass = Core\Attribute\Field::class;
    $sqlStatements = [];

    foreach (get_declared_classes() as $entity) {
        $reflection = new ReflectionClass($entity);
        $entityAttrs = $reflection->getAttributes($entityAttrClass);
        if (empty($entityAttrs)) {
            continue;
        }

        $entityAttr = $entityAttrs[0]->newInstance();
        $tableName = $entityAttr->tableName;
        $fields = [];
        $primary = null;

        foreach ($reflection->getProperties() as $property) {
            $fieldAttrs = $property->getAttributes($fieldAttrClass);
            if (empty($fieldAttrs)) {
                continue;
            }

            $fieldInstance = $fieldAttrs[0]->newInstance();
            $fields[] = "`{$fieldInstance->name}` {$fieldInstance->type}";
            if (!empty($fieldInstance->primary)) {
                $primary = $fieldInstance->name;
            }

        }

        if ($primary !== null) {
            $fields[] = "PRIMARY KEY (`$primary`)";
        }

        $fieldsSql = implode(",\n  ", $fields);
        $sqlStatements[] = "CREATE TABLE IF NOT EXISTS `$tableName` (\n  $fieldsSql\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    }

    if ($sqlStatements) {
        $db->exec(implode("\n\n", $sqlStatements));
    }
});
