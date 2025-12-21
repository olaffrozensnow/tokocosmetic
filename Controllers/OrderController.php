<?php

namespace App\Controllers;

use App\Models\OrderModel;

class OrderController extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $userId = session()->get('UserID'); 
        
        if (!$userId) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login untuk menambahkan produk ke keranjang.');
        }

        $data = [
            'title' => 'My Orders',
            'orders' => $this->orderModel->getUserOrders($userId),
            'orderModel' => $this->orderModel // Pass the model instance to the view
        ];

        return view('orders/index', $data);
    }

    public function detail($orderID)
    {
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $orderDetails = $this->orderModel->getOrderDetails($orderID, $userId);
        
        if (empty($orderDetails)) {
            return redirect()->to('/orders')->with('error', 'Order tidak ditemukan');
        }

        $data = [
            'title' => 'Order Detail',
            'orderDetails' => $orderDetails,
            'orderID' => $orderID,
            'orderModel' => $this->orderModel
        ];

        return view('orders/detail', $data);
    }
}