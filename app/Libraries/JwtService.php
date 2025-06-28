<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtService
{
    private $key;
    private $algo = 'HS256';

    public function __construct()
    {
        $this->key = getenv('JWT_SECRET') ?? 'default_secret_key';
    }

    public function generate(array $payload): string
    {
        $issuedAt = time();
        $expire = $issuedAt + 3600;

        $payload = array_merge($payload, [
            'iat' => $issuedAt,
            'exp' => $expire
        ]);
        
        return JWT::encode($payload, $this->key, $this->algo);
    }

    public function validate(string $token): ?object
    {
        try {
            return JWT::decode($token, new Key($this->key, $this->algo));
        } catch (Exception $e) {
            return null;
        }
    }
}