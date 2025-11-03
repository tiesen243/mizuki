<?php

declare(strict_types=1);

namespace Core\Attribute;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Field
{
  public function __construct(public string $name) {
  }
}
