<?php

namespace App\Provider;

use Core\Abtract\Provider;
use Core\Container;

class AppProvider extends Provider
{
    public static function register(Container $container): void
    {
        $container->bind(
            \App\Contract\Repository\IPostRepository::class,
            \App\Repository\PostRepository::class
        );
    }
}
