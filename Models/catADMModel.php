<?php
namespace App\Models;

use CodeIgniter\Model;

class catADMModel extends Model {
    protected $table = 'category';
    protected $primaryKey = 'categoryID';
    protected $allowedFields = [
        'categoryName'
    ];
}
