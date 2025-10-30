<?php

return [
  "app" => [
    "name" => getenv("APP_NAME") ?: "Mizuki",
    "description" => getenv("APP_DESCRIPTION") ?: "Mizuki is a lightweight, open-source blogging platform designed for simplicity and ease of use.",
    "env" => getenv("APP_ENV") ?: "development",
    "url" => getenv("APP_URL") ?: "http://localhost:8000",
    "viteUrl" => "http://[::1]:5173",
  ],

  'database' => [
    'driver' => 'mysql',
    'host' => getenv("MYSQL_HOST") ?: '127.0.0.1',
    'port' => getenv("MYSQL_PORT") ?: '3306',
    'name' => getenv("MYSQL_DATABASE") ?: 'mizuki',
    'user' => getenv("MYSQL_USER") ?: 'root',
    'password' => getenv("MYSQL_PASSWORD") ?: '',
  ]
];
