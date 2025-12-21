<?php
namespace App\Controllers;

use App\Models\UserADMModel;
// use App\Models\OrderModel;
// use App\Models\ProductModel;

class Dashboard extends BaseController
{
    protected $UserADMModel;
    public function dboard()
    {
        $userModel = new UserADMModel();
        // $orderModel = new OrderModel();
        // $productModel = new ProductModel();

        // hitung data
        $data['total_users']   = $userModel->countAll();
        // $data['total_orders']  = $orderModel->countAll();
        // $data['total_products'] = $productADMModel->countAll();
        // $data['total_revenue'] = $orderModel->selectSum('total')->get()->getRow()->total ?? 0;

        // // ambil 5 order terbaru
        // $data['recent_orders'] = $orderModel
        //     ->orderBy('created_at', 'DESC')
        //     ->findAll(5);

        return view('admin/dboard', $data);
    }
}
 