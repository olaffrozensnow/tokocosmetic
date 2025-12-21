<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOrderModel extends Model
{
    protected $table = 'detailorder';
    protected $primaryKey = 'detailOrderID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'orderID',
        'productID',
        'Kuantitas',
        'Harga'
    ];

    protected $useTimestamps = false;
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    /**
     * Get detail order dengan informasi produk
     */
    public function getDetailByOrderID($orderID)
    {
        return $this->select('detailorder.*, product.productName, product.GambarProduct')
                    ->join('product', 'product.productID = detailorder.productID')
                    ->where('detailorder.orderID', $orderID)
                    ->findAll();
    }

    /**
     * Get total kuantitas untuk produk tertentu dalam order
     */
    public function getTotalQuantityByProduct($orderID, $productID)
    {
        $result = $this->select('SUM(Kuantitas) as total')
                       ->where('orderID', $orderID)
                       ->where('productID', $productID)
                       ->first();

        return $result['total'] ?? 0;
    }

    /**
     * Delete semua detail order berdasarkan orderID
     */
    public function deleteByOrderID($orderID)
    {
        return $this->where('orderID', $orderID)->delete();
    }
}