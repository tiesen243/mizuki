<?php

return [
  "app" => [
    "name" => getenv("APP_NAME") ?: "",
    "description" => getenv("APP_DESCRIPTION") ?: "",
    "env" => getenv("APP_ENV") ?: "development",
    "url" => getenv("APP_URL") ?: "",
    "viteUrl" => "http://[::1]:5173",
  ],

  'cors' => [
    'allowed_origins' => explode(',', getenv("CORS_ALLOWED_ORIGINS") ?: '*'),
    'allowed_methods' => explode(',', getenv("CORS_ALLOWED_METHODS") ?: ''),
    'allowed_headers' => explode(',', getenv("CORS_ALLOWED_HEADERS") ?: ''),
    'allow_credentials' => filter_var(getenv("CORS_ALLOW_CREDENTIALS") ?: 'false', FILTER_VALIDATE_BOOLEAN),
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
