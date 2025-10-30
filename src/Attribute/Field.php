<?php

namespace Core\Attribute;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Field
{
    public function __construct(
        public string $name,
        public string $type,
        public bool $nullable,
        public bool $primary = false
    ) {
    }
}
