<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'productID';
    protected $allowedFields = ['productID', 'productName', 'merk', 'GambarProduct', 'Harga', 'Stok', 'categoryID', 'detailID'];

    public function getProductWithCategory()
    {
        return $this->select('product.*, category.categoryName, detailproduct.Deskripsi')
                    ->join('category', 'category.categoryID = product.categoryID', 'left')
                    ->join('detailproduct', 'detailproduct.detailID = product.detailID', 'left')
                    ->findAll();
    }

    public function getProductWithDetail($id)
    {
        return $this->select('product.*, category.categoryName, detailproduct.Deskripsi')
                    ->join('category', 'category.categoryID = product.categoryID', 'left')
                    ->join('detailproduct', 'detailproduct.detailID = product.detailID', 'left')
                    ->where('product.productID', $id)
                    ->first();
    }



    public function updateStok($productID, $quantity)
    {
        $product = $this->find($productID);
        
        if (!$product) {
            return false;
        }

        $newStok = $product['Stok'] - $quantity;
        
        if ($newStok < 0) {
            return false;
        }

        return $this->update($productID, ['Stok' => $newStok]);
    }
}

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'categoryID';
    protected $allowedFields = ['categoryID', 'categoryName'];
}

class DetailProductModel extends Model
{
    protected $table = 'detailproduct';
    protected $primaryKey = 'detailID';
    protected $allowedFields = ['detailID', 'Deskripsi'];
}