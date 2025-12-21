<?php

namespace App\Controllers;

use App\Models\CartModel;

class cartpage extends BaseController
{
    protected $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    public function add()
    {
        $product_id   = $this->request->getPost('productID');
        $product_name = $this->request->getPost('productName');
        $price        = $this->request->getPost('Harga');

        // cek apakah produk sudah ada di cart
        $existing = $this->cartModel
            ->where('productID', $product_id)
            ->where('userID', session()->get('userID')) // jangan lupa filter user juga
            ->first();

        if ($existing) {
            // update quantity kalau sudah ada
            $this->cartModel->update($existing['cartItemID'], [
                'Quantity' => $existing['Quantity'] + 1
            ]);
        } else {
            // generate ID baru
            $newCartID = $this->cartModel->generateCartItemID();

            // insert kalau belum ada
            $this->cartModel->insert([
                'cartItemID' => $newCartID,
                'productID'  => $product_id,
                'userID'     => session()->get('userID'), // ambil dari session login user
                'Harga'      => $price,
                'Quantity'   => 1,
                'Selected'   => 1
            ]);
        }

        return redirect()->to('pengguna/cart'); // arahkan ke halaman cart
    }

    public function index()
    {
        $data['cartItems'] = $this->cartModel->getCartWithProduct();
        return view('pengguna/cart', $data);
    }
}