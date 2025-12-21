<?php
namespace App\Models;

use CodeIgniter\Model;

class detailPRDModel extends Model
{
    protected $table      = 'detailproduct';
    protected $primaryKey = 'detailID';
    protected $allowedFields = [
        'Deskripsi'
    ];
}
