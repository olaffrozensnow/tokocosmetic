<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Categories as CategoriesModel;

class Categories extends BaseController
{
    protected $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = new CategoriesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Category',
            'categories' => $this->categoriesModel->findAll()
        ];

        return view('admin/categories', $data);
    }

    public function create()
    {
        try {
           
            $newID = $this->categoriesModel->generateCategoryID();
            
        
            $validation = \Config\Services::validation();
            $validation->setRules([
                'categoryName' => 'required|min_length[2]|max_length[50]'
            ]);
            
            $categoryName = $this->request->getPost('categoryName');
            
            if (!$validation->run(['categoryName' => $categoryName])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validation->getErrors()
                ]);
            }
            
           
            $data = [
                'categoryID' => $newID,
                'categoryName' => $categoryName
            ];
            
       
            $this->categoriesModel->insert($data);
            
           
            if ($this->categoriesModel->errors()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan kategori',
                    'errors' => $this->categoriesModel->errors()
                ]);
            }
            
         
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function update()
    {
        try {
            $categoryID = $this->request->getPost('categoryID');
            $categoryName = $this->request->getPost('categoryName');
            
           
            $validation = \Config\Services::validation();
            $validation->setRules([
                'categoryName' => 'required|min_length[2]|max_length[50]'
            ]);

            if (!$validation->run(['categoryName' => $categoryName])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validation->getErrors()
                ]);
            }
            
            $data = [
                'categoryName' => $categoryName
            ];

            $this->categoriesModel->update($categoryID, $data);
            
          
            if ($this->categoriesModel->errors()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate kategori',
                    'errors' => $this->categoriesModel->errors()
                ]);
            }
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kategori berhasil diupdate'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            if ($this->categoriesModel->delete($id)) {
                session()->setFlashdata('success', 'Kategori berhasil dihapus');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus kategori');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
        
        return redirect()->to('admin/categories');
    }
}