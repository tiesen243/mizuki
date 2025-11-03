<?php

$basePath = dirname(__DIR__);

require_once $basePath.'/vendor/autoload.php';
require_once $basePath.'/src/helpers.php';

session_start();
$application = new \Core\Application($basePath);
$application->register(function (\Core\Kernel\Container $container) {
    //  Bind Repositories
    $container->bind(
        \App\Contract\Repository\IPostRepository::class,
        \App\Repository\PostRepository::class
    );
    $container->bind(
        \App\Contract\Repository\IUserRepository::class,
        \App\Repository\UserRepository::class
    );

    // Bind Services
    $container->bind(
        \App\Contract\Service\IAuthService::class,
        \App\Service\AuthService::class
    );
})->run();
