<?php

return [
  "app" => [
    "name" => getenv("APP_NAME") ?: "Mizuki",
    "env" => getenv("APP_ENV") ?: "production",
    "debug" => filter_var(getenv("APP_DEBUG") ?: false, FILTER_VALIDATE_BOOLEAN),
    "url" => getenv("APP_URL") ?: "http://localhost:8000",
  ],

  'database' => [
    'host' => getenv("MYSQL_HOST") ?: '127.0.0.1',
    'port' => getenv("MYSQL_PORT") ?: '3306',
    'name' => getenv("MYSQL_DATABASE") ?: 'mizuki',
    'user' => getenv("MYSQL_USER") ?: 'root',
    'password' => getenv("MYSQL_PASSWORD") ?: '',
  ]
];
