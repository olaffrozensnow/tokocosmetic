<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatModel extends Model
{
    protected $table            = 'alamat';
    protected $primaryKey       = 'alamatID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['alamatID', 'Jalan', 'Kota', 'Provinsi', 'KodePos', 'userID', 'Label', 'IsPrimary'];
    
    protected $useTimestamps    = false;
    
    public function getAlamatByUser($userID)
    {
        return $this->where('userID', $userID)
                    ->orderBy('IsPrimary', 'DESC')
                    ->orderBy('alamatID', 'DESC')
                    ->findAll();
    }
    
    public function getPrimaryAlamat($userID)
    {
        return $this->where('userID', $userID)
                    ->where('IsPrimary', 1)
                    ->first();
    }
    
    public function setPrimaryAlamat($alamatID, $userID)
    {
        $this->where('userID', $userID)->set('IsPrimary', 0)->update();
        
        return $this->update($alamatID, ['IsPrimary' => 1]);
    }
}