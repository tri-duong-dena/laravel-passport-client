<?php

return [
    'consumer' =>[
        'callback' => env('OAUTH_CONSUMER_CALLBACK', 'http://localhost:8000/oauth/callback'),
    ],
    'provider' => [
        'authorize' => env('OAUTH_PROVIDER_AUTHORIZE', 'http://localhost:8001/oauth/authorize'),
        'token' => env('OAUTH_PROVIDER_TOKEN', 'http://localhost:8001/oauth/token'),
        'api_user' => env('OAUTH_PROVIDER_API_USER', 'http://localhost:8001/api/user'),
    ],
    'grant_type' => env('OAUTH_GRANT_TYPE', 'authorization_code'),
    'client_id' => env('OAUTH_CLIENT_ID', '3'),
    'client_secret' => env('OAUTH_CLIENT_SECRET', 'WIy4uZFt1B8sUdOg902kwDwHTw73BAwovejpslaK'),
];
