<?php

return [
    'spring' => [
        'base_uri' => env('API_BASE_URL'),
        'timeout' => env('API_TIMEOUT', 30),
        'retries' => env('API_RETRIES', 3),
        'auth' => [
            'type' => 'bearer',
            'token' => env('API_AUTH_TOKEN')
        ]
    ]
];
