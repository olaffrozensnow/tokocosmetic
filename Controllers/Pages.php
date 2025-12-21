<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
    //    echo 'Hello World';
        echo view('Layout/template');
    }

     public function landingpage()
    {
    //    echo 'Hello World';
        echo view('pengguna/Landing_Page');
    }

       public function aboutus()
    {
    //    echo 'Hello World';
        echo view('pengguna/AboutUs');
    }
    
       public function quiz()
    {
    //    echo 'Hello World';
        echo view('pengguna/quiz');
    }

 public function detailProduct($id)
{
    $model = new \App\Models\detailpagesModel();
    $product = $model->getProductWithDetail($id);

    if (!$product) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Product dengan ID $id tidak ditemukan");
    }

    return view('pengguna/detailProduct', ['product' => $product]);
}

 public function checkout()
{
 

    return view('pengguna/checkout');
}


}
