<?php

namespace Core\Abtract;

use Core\Container;

abstract class Provider
{
    abstract public static function register(Container $container): void;
}
