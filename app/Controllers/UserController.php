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
        helper(['UUIDv4', "validations", "auth"]);
        parent::initController($request, $response, $logger);
        $this->usersModel = new \App\Models\UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function getAllUsers()
    {
        $result = $this->usersModel->getUsers([], ["users.HASH", "NAME", "EMAIL", "PHONE", "tu.DESCRIPTION","FK_USER_TYPE AS TYPE","tu.HASH AS TYPE_HASH"]);
        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }
        return $this->respond($result);
    }

    public function getUser($uuid = '')
    {
        $result = $this->usersModel->getUsers(["users.HASH" => $uuid], ["users.HASH", "NAME", "EMAIL", "PHONE", "DESCRIPTION","FK_USER_TYPE AS TYPE"]);
        if (!$result->result) {
            return $this->fail($result->message, 500);
        }
        if (count($result->response) === 0) {
            return $this->failNotFound("User not found", 404);
        }
        return $this->respond($result->response[0]);
    }

    public function createUser()
    {
        $data = $this->request->getJSON(true);
        $loggedUser = authUser();

        $this->validation->setRules([
            'NAME'  => 'required|min_length[2]',
            'EMAIL' => 'required|valid_email|is_unique[users.EMAIL]',
            'PASSWORD' => passwordValidationRule(),
            'USER_TYPE' => userTypeValidationRule(),
        ]);

        if (!$this->validation->run($data)) {
            return $this->failValidationErrors($this->validation->getErrors(), 403);
        }

        $data['HASH'] = UUIDv4();

        $data['PASSWORD'] = password_hash($data['PASSWORD'], PASSWORD_DEFAULT);

        $data["USER_INSERT"] = $loggedUser->id;

        $userType = $this->usersModel->getUserTypes(['HASH' => $data['USER_TYPE']]);
        if (!$userType->result || count($userType->response) === 0) {
            return $this->failNotFound("User type not found.", 404);
        }
        $data['FK_USER_TYPE'] = $userType->response[0]->ID;
        unset($data['USER_TYPE']);


        $result = $this->usersModel->createUser($data);

        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }

        return $this->respondCreated([
            'message' => 'User created successfully',
            'user' => $data['HASH'],
            'result'=>true
        ]);
    }

    public function updateUser($uuid = '')
    {

        $loggedUser = authUser();                                                 
        $data = $this->request->getJSON(true);

        $existing = $this->usersModel->getUsers(['users.HASH' => $uuid], ["users.ID", "EMAIL"]);
        if (!$existing->result || count($existing->response) === 0) {
            return $this->failNotFound("User not found.", 404);
        }

        $user = $existing->response[0];

        if (isset($data['NAME'])) {
            $rules['NAME'] = 'min_length[2]';
        }
        
        if (isset($data['EMAIL'])) {
            $rules['EMAIL'] = 'valid_email';
            if ($data['EMAIL'] !== $user->EMAIL) {
                $rules['EMAIL'] .= '|is_unique[users.EMAIL]';
            }
        }

        if (isset($data['PASSWORD'])) {
            $rules['PASSWORD'] = passwordValidationRule();
        }

        if (isset($data['USER_TYPE'])) {
            $rules['USER_TYPE'] = userTypeValidationRule();
        }

        $this->validation->setRules($rules);

        if (!$this->validation->run($data)) {
            return $this->failValidationErrors($this->validation->getErrors(), 403);
        }

        if (isset($data['PASSWORD'])) {
            $data['PASSWORD'] = password_hash($data['PASSWORD'], PASSWORD_DEFAULT);
        } else {
            unset($data['PASSWORD']);
        }

        if (isset($data['USER_TYPE'])) {
            $userType = $this->usersModel->getUserTypes(['HASH' => $data['USER_TYPE']]);
            if (!$userType->result || count($userType->response) === 0) {
            return $this->failNotFound("User type not found.", 404);
            }
            $data['FK_USER_TYPE'] = $userType->response[0]->ID;
            unset($data['USER_TYPE']);
        }


        $data["USER_UPDATE"] = $loggedUser->id;
        $data["DTHR_UPDATE"] =  date('Y-m-d H:i:s');
        $result = $this->usersModel->updateUser(["HASH"=>$uuid], $data);

        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }

        return $this->respond(['message' => 'User updated successfully', 'result'=>true],200);
    }

    public function deleteUser($uuid = '')
    {
        $existing = $this->usersModel->getUsers(['users.HASH' => $uuid], ["users.ID"]);
        if (!$existing->result || count($existing->response) === 0) {
            return $this->failNotFound("User not found.", 404);
        }

        $result = $this->usersModel->deleteUser(["HASH" =>  $uuid]);

        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }

        return $this->respondDeleted(['message' => 'User deleted successfully', 'result'=>true], 202);
    }

    public function getMe()
    {
        $loggedUser = authUser();

        $result = $this->usersModel->getUsers(["users.HASH" => $loggedUser->hash], ["users.HASH", "users.NAME", "users.EMAIL", "users.PHONE","DESCRIPTION","FK_USER_TYPE AS TYPE" ]);
        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }
        return $this->respond($result);
    }

    public function getUserTypes()
    {
        $result = $this->usersModel->getUserTypes();
        if (!$result->result) {
            return $this->failServerError($result->message, 500);
        }
        return $this->respond($result);
    }
}
