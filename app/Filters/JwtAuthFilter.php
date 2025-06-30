<?php

namespace App\Filters;

use App\Libraries\JwtService;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class JwtAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()
                ->setStatusCode(401)
                ->setJSON(['error' => 'Missing or invalid Authorization header','result'=>false]);
        }

        $token = trim(str_replace('Bearer', '', $authHeader));

        $jwt = new JwtService();
        $payload = $jwt->validate($token);

        if (!$payload) {
            return response()
                ->setStatusCode(401)
                ->setJSON(['error' => 'Invalid or expired token','result'=>false]);
        }

        $request->user = $payload;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}