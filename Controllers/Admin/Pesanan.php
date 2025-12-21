<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class Pesanan extends BaseController
{
    protected $pesananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pesanan',
            'pesanan' => $this->pesananModel->getAllOrders()
        ];

        return view('admin/pesanan', $data);
    }

    public function getDetail($orderID)
    {
        try {
           
            $orderInfo = $this->pesananModel->getOrderInfo($orderID);
            
         
            $orderItems = $this->pesananModel->getOrderDetail($orderID);
            
            return $this->response->setJSON([
                'orderInfo' => $orderInfo,
                'items' => $orderItems
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'error' => true,
                'message' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}