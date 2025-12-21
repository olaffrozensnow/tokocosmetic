<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table            = 'cartitem';
    protected $primaryKey       = 'cartitemID';
    protected $allowedFields    = ['cartitemID', 'userID', 'productID', 'Quantity', 'Harga', 'Selected'];
    protected $useAutoIncrement = false;

    protected function generateID()
{
    $prefix = 'CART-';

    $last = $this->select('cartitemID')
                 ->like('cartitemID', $prefix, 'after')
                 ->orderBy('cartitemID', 'DESC')
                 ->first();

    if ($last) {
        $lastNumber = (int) substr($last['cartitemID'], strlen($prefix));
        $newNumber  = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }
    return $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
}


    public function insertCartItem(array $data)
    {
        $data['cartitemID'] = $this->generateID();
        return $this->insert($data);
    }

    public function getSelectedCartItems(string $userID, array $cartItemIDs): array
    {
        if (empty($cartItemIDs)) {
            return [];
        }

        return $this->select('cartitem.*, product.productName, product.GambarProduct')
            ->join('product', 'product.productID = cartitem.productID')
            ->where('cartitem.userID', $userID)
            ->whereIn('cartitem.cartitemID', $cartItemIDs)
            ->findAll();
    }
}