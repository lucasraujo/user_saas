<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    private $usersModel;
    private $validation;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        helper(['UUIDv4']);
        parent::initController($request, $response, $logger);
        $this->usersModel = new \App\Models\UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function getAllClients()
    {
        $result = $this->usersModel->getUsers([], ["HASH", "NAME", "EMAIL", "PHONE"]);
        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }
        return $this->respond($result);
    }

    public function getClient($uuid = '')
    {
        $result = $this->usersModel->getUsers(["HASH" => $uuid], ["HASH", "NAME", "EMAIL", "PHONE"]);
        if (!$result->result) {
            return $this->fail($result->message, 500);
        }
        if (count($result->response) === 0) {
            return $this->failNotFound("User not found", 404);
        }
        return $this->respond($result->response[0]);
    }

    public function createClient()
    {
        $data = $this->request->getJSON(true);

        $this->validation->setRules([
            'NAME'  => 'required|min_length[2]',
            'EMAIL' => 'required|valid_email|is_unique[users.EMAIL]',
            'PASSWORD' => [
                'label' => 'Password',
                'rules' => [
                    'min_length[8]',
                    'max_length[72]',
                    'regex_match[/[A-Z]/]',
                    'regex_match[/[a-z]/]',
                    'regex_match[/[0-9]/]',
                    'regex_match[/[\W]/]'
                ],
                'errors' => [
                    'min_length' => 'The {field} must be at least 8 characters.',
                    'max_length' => 'The {field} cannot exceed 72 characters.',
                    'regex_match' => 'The {field} must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
                ]
            ]
        ]);

        if (!$this->validation->run($data)) {
            return $this->failValidationErrors($this->validation->getErrors(), 403);
        }

        $data['HASH'] = UUIDv4();

        $data['PASSWORD'] = password_hash($data['PASSWORD'], PASSWORD_DEFAULT);

        $result = $this->usersModel->createUser($data);

        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }

        return $this->respondCreated([
            'message' => 'User created successfully',
            'user' => $data['HASH']
        ], 201);
    }

    public function updateClient($uuid = '')
    {
        $data = $this->request->getJSON(true);

        $existing = $this->usersModel->getUsers(['HASH' => $uuid], ["ID", "EMAIL"]);
        if (!$existing->result || count($existing->response) === 0) {
            return $this->failNotFound("User not found.", 404);
        }

        $user = $existing->response[0];

        if (isset($data['NAME'])) {
            $rules['NAME'] = 'min_length[2]';
        }
        
        if (isset($data['EMAIL'])) {
            $rules['EMAIL'] = 'valid_email';
            if ($data['EMAIL'] !== $user['EMAIL']) {
                $rules['EMAIL'] .= '|is_unique[users.EMAIL]';
            }
        }


        if (!empty($data['PASSWORD'])) {
            $rules['PASSWORD'] = [
                'label' => 'Password',
                'rules' => [
                    'min_length[8]',
                    'max_length[72]',
                    'regex_match[/[A-Z]/]',
                    'regex_match[/[a-z]/]',
                    'regex_match[/[0-9]/]',
                    'regex_match[/[\W]/]'
                ],
                'errors' => [
                    'min_length' => 'The {field} must be at least 8 characters.',
                    'max_length' => 'The {field} cannot exceed 72 characters.',
                    'regex_match' => 'The {field} must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
                ]
            ];
        }

        $this->validation->setRules($rules);

        if (!$this->validation->run($data)) {
            return $this->failValidationErrors($this->validation->getErrors(), 403);
        }

        if (!empty($data['PASSWORD'])) {
            $data['PASSWORD'] = password_hash($data['PASSWORD'], PASSWORD_DEFAULT);
        } else {
            unset($data['PASSWORD']);
        }

        $result = $this->usersModel->updateUser($uuid, $data);

        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }

        return $this->respond(['message' => 'User updated successfully']);
    }

    public function deleteClient($uuid = '')
    {
        $existing = $this->usersModel->getUsers(['HASH' => $uuid], ["ID"]);
        if (!$existing->result || count($existing->response) === 0) {
            return $this->failNotFound("User not found.", 404);
        }

        $result = $this->usersModel->deleteUser($uuid);

        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }

        return $this->respondDeleted(['message' => 'User deleted successfully'], 202);
    }
}
