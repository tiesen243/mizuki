<?php

namespace Core\Abstract;

abstract class Entity
{
    public static string $tableName;
    public static string $primaryKey;

    abstract public function validate(): array;
}
