<?php

namespace App\Models;

use CodeIgniter\Model;

class Categories extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'categoryID';
    protected $allowedFields = ['categoryID', 'categoryName'];
    protected $useTimestamps = false;
    

    public function generateCategoryID()
    {
    
        $categories = $this->orderBy('categoryID', 'DESC')->findAll();
        
        if (empty($categories)) {
            return 'CAT01';
        }
        
   
        $maxNumber = 0;
        foreach ($categories as $category) {
            $number = (int) substr($category['categoryID'], 3);
            if ($number > $maxNumber) {
                $maxNumber = $number;
            }
        }
        
        $newNumber = $maxNumber + 1;
      
        return 'CAT' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
    }
    

    public function isIDExists($categoryID)
    {
        return $this->where('categoryID', $categoryID)->countAllResults() > 0;
    }
}