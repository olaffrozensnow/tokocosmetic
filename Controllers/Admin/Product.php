<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Product',
            'products' => $this->productModel->getProductWithCategory()
        ];

        return view('admin/product/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Product',
            'categories' => $this->categoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/product/create', $data);
    }

    public function store()
    {
        $rules = [
            'productID' => 'required|max_length[5]|is_unique[product.productID]',
            'productName' => 'required|max_length[50]',
            'merk' => 'required|max_length[20]',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
            'categoryID' => 'required',
            'Deskripsi' => 'required|max_length[100]',
            'GambarProduct' => 'uploaded[GambarProduct]|max_size[GambarProduct,2048]|is_image[GambarProduct]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

       
        $detailID = 'DT' . substr($this->request->getPost('productID'), 2);

     
        $file = $this->request->getFile('GambarProduct');
        $imageBase64 = '';
        
        if ($file->isValid() && !$file->hasMoved()) {
            $imageData = file_get_contents($file->getTempName());
            $imageBase64 = base64_encode($imageData);
        }


        $detailData = [
            'detailID' => $detailID,
            'Deskripsi' => $this->request->getPost('Deskripsi')
        ];

        $detailProductModel = new \App\Models\DetailProductModel();
        $detailProductModel->insert($detailData);

       
        $productData = [
            'productID' => $this->request->getPost('productID'),
            'productName' => $this->request->getPost('productName'),
            'merk' => $this->request->getPost('merk'),
            'GambarProduct' => $imageBase64,
            'Harga' => $this->request->getPost('Harga'),
            'Stok' => $this->request->getPost('Stok'),
            'categoryID' => $this->request->getPost('categoryID'),
            'detailID' => $detailID
        ];

        $this->productModel->insert($productData);

        return redirect()->to('/admin/product')->with('success', 'Product berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Product',
            'product' => $this->productModel->getProductWithDetail($id),
            'categories' => $this->categoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        if (!$data['product']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product tidak ditemukan');
        }

        return view('admin/product/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'productName' => 'required|max_length[50]',
            'merk' => 'required|max_length[20]',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
            'categoryID' => 'required',
            'Deskripsi' => 'required|max_length[100]',
            'GambarProduct' => 'max_size[GambarProduct,2048]|is_image[GambarProduct]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $product = $this->productModel->find($id);
        
        $imageBase64 = $product['GambarProduct'];
        $file = $this->request->getFile('GambarProduct');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageData = file_get_contents($file->getTempName());
            $imageBase64 = base64_encode($imageData);
        }

 
        $detailData = [
            'Deskripsi' => $this->request->getPost('Deskripsi')
        ];

        $detailProductModel = new \App\Models\DetailProductModel();
        $detailProductModel->update($product['detailID'], $detailData);

       
        $productData = [
            'productName' => $this->request->getPost('productName'),
            'merk' => $this->request->getPost('merk'),
            'GambarProduct' => $imageBase64,
            'Harga' => $this->request->getPost('Harga'),
            'Stok' => $this->request->getPost('Stok'),
            'categoryID' => $this->request->getPost('categoryID')
        ];

        $this->productModel->update($id, $productData);

        return redirect()->to('/admin/product')->with('success', 'Product berhasil diupdate');
    }

    public function delete($id)
{
    $db = \Config\Database::connect();
    $db->query('SET FOREIGN_KEY_CHECKS=0;');

    $product = $this->productModel->find($id);
    if ($product) {
        $detailProductModel = new \App\Models\DetailProductModel();
        $detailProductModel->delete($product['detailID']);
        $this->productModel->delete($id);
    }

    $db->query('SET FOREIGN_KEY_CHECKS=1;');
    return redirect()->to('/admin/product')->with('success', 'Product berhasil dihapus');
}



}