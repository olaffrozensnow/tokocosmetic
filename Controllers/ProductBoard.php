<?php
namespace App\Controllers;

use App\Models\catADMModel;
use App\Models\detailPRDModel;
use App\Models\productADMModel;

class ProductBoard extends BaseController
{
    protected $catADMModel;
    protected $detailPRDModel;
    protected $productADMModel;

    public function __construct()
    {
        $this->catADMModel = new catADMModel();
        $this->detailPRDModel   = new detailPRDModel();
        $this->productADMModel  = new productADMModel();
    }

    public function create()
    {
        $data['category']      = $this->catADMModel->findAll();
        $data['detailproduct'] = $this->detailPRDModel->findAll();

        
    // ambil semua produk (ganti nama key jadi 'product' agar cocok dengan view)
    $data['product'] = $this->productADMModel
                            ->orderBy('productID', 'DESC')
                            ->findAll();

        return view('admin/createproducts', $data);
    }

    public function save()
    {

        // --- Generate ProductID otomatis ---
    $lastProduct = $this->productADMModel->orderBy('productID', 'DESC')->first();

    if ($lastProduct) {
        // ambil angka setelah huruf "P"
        $lastId = intval(substr($lastProduct['productID'], 1));
        $newId = 'P' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT); 
        // hasil: P0001, P0002, dst.
    } else {
        $newId = 'P0001'; // kalau belum ada data
    }
    
    $file = $this->request->getFile('GambarProduct');
    $gambar = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName(); // kasih nama unik
        $file->move('uploads/products', $newName); // pindahkan ke folder public/uploads/products
        $gambar = $newName;
    }

        $this->productADMModel->insert([
            'productName' => $this->request->getPost('productName'),
            'categoryID'  => $this->request->getPost('categoryID'),
            'detailID'    => $this->request->getPost('detailID'),
            'Harga'       => $this->request->getPost('Harga'),
            'merk'       => $this->request->getPost('merk'),
            'Stok'       => $this->request->getPost('Stok'),
      'GambarProduct' => $gambar, // simpan nama file, bukan object
        ]);

        return redirect()->to('admin/createproducts');
    }

  public function edit($id)
{
    $product = $this->productADMModel->find($id);

    if (!$product) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk tidak ditemukan");
    }

    $data['category']      = $this->catADMModel->findAll();
    $data['detailproduct'] = $this->detailPRDModel->findAll();
    $data['product']       = $product; // lempar data produk ke view

    return view('admin/createproducts', $data);
}

public function update($id)
{
    $file = $this->request->getFile('GambarProduct');
    $gambar = $this->request->getPost('oldImage'); // gambar lama

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('uploads/products', $newName);
        $gambar = $newName; // pakai gambar baru
    }

    $this->productADMModel->update($id, [
        'productName'   => $this->request->getPost('productName'),
        'categoryID'    => $this->request->getPost('categoryID'),
        'detailID'      => $this->request->getPost('detailID'),
        'Harga'         => $this->request->getPost('Harga'),
        'merk'          => $this->request->getPost('merk'),
        'Stok'          => $this->request->getPost('Stok'),
        'GambarProduct' => $gambar,
    ]);

    return redirect()->to('/createproduct');
}


}
