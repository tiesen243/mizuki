<?php

$basePath = dirname(__DIR__);

require_once $basePath.'/vendor/autoload.php';
require_once $basePath.'/src/helpers.php';

$application = new \Core\Application($basePath);
$application->register([
    \App\Provider\AppProvider::class,
])->run();
