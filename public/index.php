<?php

$basePath = dirname(__DIR__);

require_once $basePath.'/vendor/autoload.php';
require_once $basePath.'/src/helpers.php';

$application = new \Core\Kernel\Application($basePath);
$application->register(function (\Core\Kernel\Container $container) {
    $container->bind(
        \App\Contract\Repository\IPostRepository::class,
        \App\Repository\PostRepository::class
    );
})->run();
