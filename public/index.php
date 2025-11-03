<?php

declare(strict_types=1);

$basePath = dirname(__DIR__);

require_once $basePath.'/vendor/autoload.php';
require_once $basePath.'/src/helpers.php';

session_start();
$application = new Core\Application($basePath);
$application->register(function (Core\Kernel\Container $container) {
  $container->bind(
    App\Contract\Repository\IPostRepository::class,
    App\Repository\PostRepository::class
  );
  $container->bind(
    App\Contract\Repository\IUserRepository::class,
    App\Repository\UserRepository::class
  );
})->run();
