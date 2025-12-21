<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cartItemID';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $allowedFields = ['cartItemID', 'userID', 'productID', 'Quantity'];
    protected $useTimestamps = false;

    public function getCartItemsWithProductDetails($userID)
    {
        return $this->select('cart.*, products.productName, products.Harga, products.GambarProduct')
                    ->join('products', 'products.productID = cart.productID')
                    ->where('cart.userID', $userID)
                    ->findAll();
    }
}