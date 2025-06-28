<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $tableUsers = 'users';
    protected $db;

    public function __construct($group = null)
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getUsers(array $where = [], array $filter = ['*'], $groupBy = false)
    {
        try {
            $search = $this->db->table($this->tableUsers)
                ->select($filter)
                ->where($where)
                ->get();
            $response = $groupBy == false ? $search->getResultObject() : $search->getFirstRow();

            return (object)["result" => true, "message" => "success", "response" => $response];
        } catch (\Exception $e) {
            return (object)["result" => false, "message" => $e->getMessage()];
        }
    }

    public function createUser(array $data)
    {
        try {
            $this->db->table($this->tableUsers)->insert($data);
            $response = $this->db->insertID();

            return (object)["result" => true, "message" => "success", "response" => $response];
        } catch (\Exception $e) {
            return (object)["result" => false, "message" => $e->getMessage()];
        }
    }

    public function updateUser(array $where = [], array $columns = [])
    {
        try {
            $response = $this->db->table($this->tableUsers)
                ->set($columns)
                ->where($where)
                ->update();

            return (object)["result" => true, "message" => "success", "response" => $response];
        } catch (\Exception $e) {
            return (object)["result" => false, "message" => $e->getMessage()];
        }
    }

    public function deleteUser(array $data)
    {
        try {
            $response = $this->db->table($this->tableUsers)->delete($data);

            return (object)["result" => true, "message" => "success", "response" => $response];
        } catch (\Exception $e) {
            return (object)["result" => false, "message" => $e->getMessage()];
        }
    }
}
