<?php

use Core\Kernel\Router;

Router::get('/', [\App\Controller\HomeController::class, 'index']);

Router::get('/register', [\App\Controller\AuthController::class, 'register']);
Router::post('/register', [\App\Controller\AuthController::class, 'register']);
Router::get('/login', [\App\Controller\AuthController::class, 'login']);
Router::post('/login', [\App\Controller\AuthController::class, 'login']);
Router::post('/logout', [\App\Controller\AuthController::class, 'logout']);
