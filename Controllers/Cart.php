<?php

namespace App\Controllers;

use App\Models\AlamatModel;
use App\Models\CartItemModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class Cart extends BaseController
{
    use ResponseTrait;

    public function add()
    {
        $userID = session()->get('UserID');

        if (!$userID) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login untuk menambahkan produk ke keranjang.');
        }

        $productID = $this->request->getPost('productID');
        $productModel = new ProductModel();
        $product = $productModel->find($productID);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
        
        if ($product['Stok'] <= 0) {
            return redirect()->back()->with('error', 'Stok produk ini habis dan tidak dapat ditambahkan ke keranjang.');
        }

        $cartItemModel = new CartItemModel();
        
        $existingItem = $cartItemModel
            ->where('userID', $userID)
            ->where('productID', $productID)
            ->first();

        $requestedQuantity = 1;

        if ($existingItem) {
            $newQuantity = $existingItem['Quantity'] + $requestedQuantity;
            
            if ($newQuantity > $product['Stok']) {
                return redirect()->back()->with('error', 'Gagal: Jumlah total item di keranjang melebihi stok yang tersedia (Stok: ' . $product['Stok'] . ').');
            }
            
            $cartItemModel->update($existingItem['cartitemID'], ['Quantity' => $newQuantity]);
            return redirect()->back()->with('success', 'Kuantitas produk berhasil diperbarui!');
        } else {
            if ($requestedQuantity > $product['Stok']) {
                 return redirect()->back()->with('error', 'Gagal: Stok produk ini hanya ' . $product['Stok'] . '.');
            }
            
            $cartItemModel->insertCartItem([
                'userID'    => $userID,
                'productID' => $productID,
                'Harga'     => $product['Harga'],
                'Quantity'  => $requestedQuantity,
                'Selected'  => 1,
            ]);
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        }
    }

    public function index()
    {
        $userID = session()->get('UserID');

        if (!$userID) {
            return redirect()->to(base_url('login'));
        }

        $cartItemModel = new CartItemModel();
        $alamatModel = new AlamatModel();

        $data['cartItems'] = $cartItemModel
            ->select('cartitem.*, product.productName, product.GambarProduct')
            ->join('product', 'product.productID = cartitem.productID')
            ->where('cartitem.userID', $userID)
            ->findAll();

        $total = 0;
        foreach ($data['cartItems'] as $item) {
            $total += $item['Harga'] * $item['Quantity'];
        }
        $data['totalHarga'] = $total;

        $data['alamatList'] = $alamatModel->getAlamatByUser($userID);
        $data['alamat'] = $alamatModel->getPrimaryAlamat($userID);

        return view('pengguna/cart', $data);
    }
    
    public function updateQuantity()
    {
        $userID = session()->get('UserID');
        if (!$userID) {
            return $this->failUnauthorized('Silakan login untuk mengubah keranjang.');
        }

        $cartItemID = $this->request->getPost('cartItemID');
        $newQuantity = $this->request->getPost('newQuantity');

        if (!$cartItemID || !is_numeric($newQuantity) || $newQuantity < 1) {
            return $this->failValidationErrors('Data tidak valid.');
        }
        
        $cartItemModel = new CartItemModel();
        $cartItem = $cartItemModel->find($cartItemID);

        if (!$cartItem || $cartItem['userID'] != $userID) {
            return $this->failNotFound('Item keranjang tidak ditemukan.');
        }

        $productModel = new ProductModel();
        $product = $productModel->find($cartItem['productID']);

        if (!$product || $newQuantity > $product['Stok']) {
             return $this->failValidationErrors('Gagal memperbarui: Kuantitas melebihi stok yang tersedia (' . $product['Stok'] . ').');
        }

        $cartItemModel->update($cartItemID, ['Quantity' => $newQuantity]);

        return $this->respond([
            'status'  => 'success',
            'message' => 'Kuantitas berhasil diperbarui.'
        ]);
    }

    public function removeItem()
    {
        $userID = session()->get('UserID');
        if (!$userID) {
            return $this->failUnauthorized('Silakan login untuk menghapus item.');
        }

        $cartItemID = $this->request->getPost('cartItemID');
        
        if (!$cartItemID) {
            return $this->failValidationErrors('ID keranjang tidak valid.');
        }

        $cartItemModel = new CartItemModel();
        $cartItem = $cartItemModel->find($cartItemID);

        if (!$cartItem || $cartItem['userID'] != $userID) {
            return $this->failNotFound('Item keranjang tidak ditemukan.');
        }

        $cartItemModel->delete($cartItemID);

        return $this->respond([
            'status'  => 'success',
            'message' => 'Item berhasil dihapus dari keranjang.'
        ]);
    }
}