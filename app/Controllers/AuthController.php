<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Libraries\JwtService;

class AuthController extends ResourceController
{
    public function login()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['EMAIL']) || empty($data['PASSWORD'])) {
            return $this->failValidationErrors([
                'EMAIL' => 'Email is required',
                'PASSWORD' => 'Password is required'
            ]);
        }

        $model = new UserModel();
        $user = $model->getUsers(['EMAIL'=> $data['EMAIL']],["PASSWORD","ID","EMAIL","HASH","FK_USER_TYPE"],true)->response;
        if (!$user || !password_verify($data['PASSWORD'], $user->PASSWORD)) {
            return $this->failUnauthorized('Invalid email or password');
        }

        $jwt = new JwtService();

        $token = $jwt->generate([
            'id' => $user->ID,
            'email' => $user->EMAIL,
            'hash' => $user->HASH,
            'user_type' => $user->FK_USER_TYPE,
        ]);

        return $this->respond([
            'message' => 'Login successful',
            'token' => $token,
            'result' => true
        ]);
    }
}