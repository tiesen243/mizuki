<?php

use Core\Kernel\Router;

Router::get('/', [App\Controller\HomeController::class, 'index']);

Router::get('/register', [App\Controller\AuthController::class, 'register']);
Router::post('/register', [App\Controller\AuthController::class, 'register']);
Router::get('/login', [App\Controller\AuthController::class, 'login']);
Router::post('/login', [App\Controller\AuthController::class, 'login']);
Router::post('/logout', [App\Controller\AuthController::class, 'logout']);

Router::get('/posts', [App\Controller\PostController::class, 'index']);
Router::get('/posts/create', [App\Controller\PostController::class, 'create']);
Router::post('/posts/create', [App\Controller\PostController::class, 'create']);
Router::get('/posts/:id', [App\Controller\PostController::class, 'show']);
Router::get('/posts/:id/edit', [App\Controller\PostController::class, 'edit']);
Router::post('/posts/:id/edit', [App\Controller\PostController::class, 'edit']);
Router::post('/posts/:id/delete', [App\Controller\PostController::class, 'delete']);
