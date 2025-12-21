<?php
namespace App\Models;

use CodeIgniter\Model;

class detailpagesModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'productID'; // VARCHAR
    protected $allowedFields = ['productName', 'price', 'image', 'detailID'];

    
    public function getProductWithDetail(string $id) // tipe hint string karena VARCHAR
    {
        return $this->db->table($this->table)
            ->select('product.*, detailproduct.Deskripsi')
            ->join('detailproduct', 'detailproduct.detailID = product.detailID', 'left')
            ->where('product.productID', $id) 
            ->get()
            ->getRowArray();
    }

    public function getAllProductsWithDetail()
    {
        return $this->db->table($this->table)
            ->select('product.*, detailproduct.Deskripsi')
            ->join('detailproduct', 'detailproduct.detailID = product.detailID', 'left')
            ->get()
            ->getResultArray();
    }
}