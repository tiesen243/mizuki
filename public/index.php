<?php

use Core\Application;

$basePath = dirname(__DIR__);

require_once $basePath.'/vendor/autoload.php';
require_once $basePath.'/src/helpers.php';

$application = new Application($basePath);
$application->run();
