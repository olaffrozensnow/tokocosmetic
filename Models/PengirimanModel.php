<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'pengirimanID';
    protected $useAutoIncrement = false;
    
    protected $allowedFields = ['pengirimanID', 'adminID', 'orderID', 'jasaPengiriman', 'NoResi'];
    
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'pengirimanID' => 'required|max_length[5]',
        'adminID' => 'required|max_length[5]',
        'orderID' => 'required|max_length[200]',
        'jasaPengiriman' => 'required|max_length[10]',
        'NoResi' => 'required|max_length[10]'
    ];
    
    protected $validationMessages = [
        'pengirimanID' => [
            'required' => 'ID Pengiriman harus diisi',
            'max_length' => 'ID Pengiriman maksimal 5 karakter'
        ],
        'adminID' => [
            'required' => 'ID Admin harus diisi',
            'max_length' => 'ID Admin maksimal 5 karakter'
        ],
        'orderID' => [
            'required' => 'ID Order harus diisi',
            'max_length' => 'ID Order maksimal 200 karakter'
        ],
        'jasaPengiriman' => [
            'required' => 'Jasa Pengiriman harus diisi',
            'max_length' => 'Jasa Pengiriman maksimal 10 karakter'
        ],
        'NoResi' => [
            'required' => 'Jasa Pengiriman harus diisi',
            'max_length' => 'Jasa Pengiriman maksimal 10 karakter'
        ]
    ];
    
    protected $skipValidation = false;
}