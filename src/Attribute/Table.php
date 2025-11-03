<?php

declare(strict_types=1);

namespace Core\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Table
{
  public function __construct(public string $name, public string $primaryKey) {
  }
}
