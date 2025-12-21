<?php
namespace App\Models;

use CodeIgniter\Model;

class productADMModel extends Model {
    protected $table = 'product';
    protected $primaryKey = 'productID';
    protected $allowedFields = [
        'productName','merk','GambarProduct','Harga','Stok','categoryID','detailID'
    ];
}
