<?php

namespace Core\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Entity
{
    public function __construct(
        public string $tableName
    ) {
    }
}
