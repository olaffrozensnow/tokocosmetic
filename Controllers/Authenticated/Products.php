<?php

namespace App\Controllers\Authenticated;

use App\Controllers\BaseController;
use App\Models\ProductModel;


class Products extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getProductWithCategory();

        return view('auth/products', $data); // kirim data ke view
    }

  
    public function detail($id)
    {
        $productModel = new ProductModel();
        $data['product'] = $productModel->getProductWithDetail($id); // DETAIL

        // tidak ada $products
        return view('auth/products', $data);
    }

}