<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table      = 'Pengguna'; 
    protected $primaryKey = 'UserID';

    protected $allowedFields = [
        'UserID', 'UserName', 'TanggalLahir', 'Email', 'noHP', 'Password'
    ];

    
    public function getAllUsers($limit = 10, $offset = 0)
    {
          $sql = "SELECT 
                    a.UserID,
                    a.UserName, 
                    a.Email, 
                    a.noHP, 
                    COALESCE(b.Jalan, 'Belum mengisi alamat') AS Alamat
                FROM pengguna a
                LEFT JOIN alamat b ON a.UserID = b.userID AND b.IsPrimary = 1
                LIMIT $limit OFFSET $offset";

        return $this->db->query($sql)->getResultArray();
    }

     public function countAllUsers()
    {
        $sql = "SELECT COUNT(a.UserID) AS total FROM pengguna a";
        return $this->db->query($sql)->getRow()->total;
    }
    


}