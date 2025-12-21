<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'adminID';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['adminID', 'AdminName', 'Password'];

    public function login($adminID, $password)
    {
        return $this->where('adminID', $adminID)
                    ->where('Password', $password)
                    ->first();
    }

    public function getAdminById($adminID)
    {
        return $this->find($adminID);
    }

    public function getAllAdmin()
    {
        return $this->findAll();
    }

    public function updateAdmin($adminID, $data)
    {
        return $this->update($adminID, $data);
    }

    public function deleteAdmin($adminID)
    {
        return $this->delete($adminID);
    }
}