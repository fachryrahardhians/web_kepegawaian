<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\JWT as JWTConfig;

function generate_jwt(array $payload): string
{
    $config = new JWTConfig();

    $time = time();

    $token = [
        'iat' => $time,                         // issued at
        'exp' => $time + $config->ttl,          // expired
        'data' => $payload                     // custom data
    ];

    return JWT::encode(
        $token,
        $config->key,
        $config->alg
    );
}
