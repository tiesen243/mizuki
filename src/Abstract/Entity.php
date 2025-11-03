<?php

namespace Core\Abstract;

abstract class Entity
{
    abstract public function validate(array $fields): array;
}
