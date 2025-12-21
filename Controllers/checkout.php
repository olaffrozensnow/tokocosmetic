<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\PenggunaModel;
use App\Models\AlamatModel;

class Checkout extends BaseController
{
    protected $cartModel;
    protected $penggunaModel;
    // protected $alamatModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->penggunaModel = new PenggunaModel();
        // $this->alamatModel = new AlamatModel();
    }

    public function index()
    {
        $userId = session()->get('UserID');

        // Data user
        $user = $this->penggunaModel->find($userId);

        $items = $this->cartModel
            ->select('cartitem.*, product.productName, product.Harga')
            ->join('product', 'product.productID = cartitem.productID')
            ->where('cartitem.userID', $userId)
            ->where('cartitem.Selected', 1) 
            ->findAll();

        return view('pengguna/checkout', [
            'user' => $user,
            // 'alamatList' => $alamatList,
            'items' => $items
        ]);
    }
}