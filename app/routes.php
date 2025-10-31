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
 * Web Endpoints
 * /posts            - List all posts
 * /posts/:id        - View a specific post
 * /posts/create     - Create new post
 * /posts/:id/delete - Delete a specific post
 *
 * API Endpoints
 * /api/posts            - List all posts (GET), Create new post (POST)
 * /api/posts/:id        - View a specific post (GET)
 * /api/posts/:id/delete - Delete a specific post (POST)
 */
Router::get('/posts', [PostController::class, 'index']);

Router::get('/posts/create', [PostController::class, 'create']);
Router::post('/posts/create', [PostController::class, 'create']);

Router::get('/posts/:id', [PostController::class, 'show']);
Router::post('/posts/:id/delete', [PostController::class, 'delete']);

Router::get('/api/posts', [PostController::class, 'all']);
Router::post('/api/posts', [PostController::class, 'store']);
Router::get('/api/posts/:id', [PostController::class, 'one']);
Router::post('/api/posts/:id/edit', [PostController::class, 'update']);
Router::post('/api/posts/:id/delete', [PostController::class, 'destroy']);
