<?php
return [
    'host' => getenv('DB_HOST') ?: 'db',
    'port' => getenv('DB_PORT') ?: 3306,
    'user' => getenv('DB_USER') ?: 'root',
    'pass' => getenv('DB_PASS') ?: 'root',
    'dbname' => getenv('DB_NAME') ?: 'autokool',
    'charset' => 'utf8mb4',
];
