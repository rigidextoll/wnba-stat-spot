<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:5173',
        'http://localhost:3000',
        'https://wnba-stat-spot.onrender.com',
        env('APP_URL', 'http://localhost')
    ],
    'allowed_origins_patterns' => [
        '*.onrender.com',
        'localhost:*'
    ],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
