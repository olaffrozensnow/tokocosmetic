<?php

namespace App\Controllers;

use App\Models\ProductModel;

class productpages extends BaseController
{
    public function halamanproduk()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();

        // arahkan ke Views/pengguna/productpage.php
        return view('pengguna/productpage', $data);
    }
}
