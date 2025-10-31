<?php

use App\Controller\HomeController;
use App\Controller\PostController;
use Core\Kernel\Router;

/*
 * Home Routes
 * ----------------
 * / - Home Page
 */

Router::get('/', [HomeController::class, 'index']);

/*
 * Posts Routes
 * ----------------
 * /posts            - List all posts
 * /posts/:id        - View a specific post
 * /posts/create     - Create new post
 * /posts/:id/delete - Delete a specific post
 * /api/posts        - Search posts (Query Parameter: q)
 */

Router::get('/posts', [PostController::class, 'index']);

Router::get('/posts/create', [PostController::class, 'create']);
Router::post('/posts/create', [PostController::class, 'create']);

Router::get('/posts/:id', [PostController::class, 'show']);

Router::get('/posts/:id/edit', [PostController::class, 'edit']);
Router::post('/posts/:id/edit', [PostController::class, 'edit']);

Router::post('/posts/:id/delete', [PostController::class, 'delete']);

Router::get('/api/posts', [PostController::class, 'search']);
