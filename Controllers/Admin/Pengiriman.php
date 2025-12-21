<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengirimanModel;

class Pengiriman extends BaseController
{
    protected $pengirimanModel;

    public function __construct()
    {
        $this->pengirimanModel = new PengirimanModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $db = \Config\Database::connect();

        // Query yang diperbaiki dengan explicit column selection
        $sql = "
            SELECT 
                o.orderID,
                o.userID,
                o.TanggalOrder,
                o.TotalHarga,
                o.StatusOrder,
                o.alamatID,
                p.pengirimanID, 
                p.jasaPengiriman,
                p.NoResi,
                u.UserName AS nama_pengguna,
                CONCAT(COALESCE(a.Jalan, ''), ', ', COALESCE(a.Kota, ''), ', ', 
                       COALESCE(a.Provinsi, ''), ' ', COALESCE(a.KodePos, '')) AS alamat_lengkap
            FROM `order` AS o
            LEFT JOIN pengguna AS u ON u.userID = o.userID
            LEFT JOIN alamat AS a ON a.alamatID = o.alamatID
            LEFT JOIN pengiriman AS p ON p.orderID = o.orderID
            WHERE o.StatusOrder = 'Sukses'
            ORDER BY o.TanggalOrder DESC
        ";

        $query = $db->query($sql);
        $orders = $query->getResultArray();


        log_message('debug', 'Orders data: ' . print_r($orders, true));

        $stats = [
            'pending' => 0,
            'terkirim' => 0
        ];

        foreach ($orders as $order) {
            if (empty($order['jasaPengiriman']) || $order['jasaPengiriman'] === null) {
                $stats['pending']++;
            } else {
                $stats['terkirim']++;
            }
        }

        $data = [
            'title'  => 'Data Pengiriman Barang',
            'orders' => $orders,
            'stats'  => $stats
        ];

        return view('admin/pengiriman', $data);
    }

    public function store()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $orderID = $this->request->getPost('orderID');
        $jasaPengiriman = $this->request->getPost('jasaPengiriman');
        $NoResi = $this->request->getPost('NoResi');

   
        if (empty($orderID) || empty($jasaPengiriman)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak lengkap!'
            ]);
        }


        $existingPengiriman = $this->pengirimanModel
            ->where('orderID', $orderID)
            ->first();

        if ($existingPengiriman) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Order ini sudah memiliki data pengiriman!'
            ]);
        }

      
        $lastPengiriman = $this->pengirimanModel
            ->orderBy('pengirimanID', 'DESC')
            ->first();

        if ($lastPengiriman) {
            $lastNumber = intval(substr($lastPengiriman['pengirimanID'], 1));
            $newNumber = $lastNumber + 1;
            $pengirimanID = 'P' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $pengirimanID = 'P0001';
        }

        $adminID = session()->get('adminID');
        
        if (!$adminID) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Session admin tidak ditemukan. Silakan login kembali!'
            ]);
        }

        $data = [
            'pengirimanID'   => $pengirimanID,
            'adminID'        => $adminID,
            'orderID'        => $orderID,
            'jasaPengiriman' => $jasaPengiriman,
            'NoResi' => $NoResi,
        ];

        if ($this->pengirimanModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data pengiriman berhasil ditambahkan!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data pengiriman!'
            ]);
        }
        
    }

    public function update()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $pengirimanID = $this->request->getPost('pengirimanID');
        $jasaPengiriman = $this->request->getPost('jasaPengiriman');
        $NoResi = $this->request->getPost('NoResi');



        if (empty($pengirimanID) || empty($jasaPengiriman)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak lengkap!'
            ]);
        }

        $data = [
            'jasaPengiriman' => $jasaPengiriman,
            'NoResi'        => $NoResi
];

    

        if ($this->pengirimanModel->update($pengirimanID, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data pengiriman berhasil diupdate!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengupdate data pengiriman!'
            ]);
        }
    }

    public function delete($pengirimanID)
    {
        if (empty($pengirimanID)) {
            session()->setFlashdata('error', 'ID Pengiriman tidak valid!');
            return redirect()->to('admin/pengiriman');
        }

        if ($this->pengirimanModel->delete($pengirimanID)) {
            session()->setFlashdata('success', 'Data pengiriman berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data pengiriman!');
        }

        return redirect()->to('admin/pengiriman');
    }
    

    public function debug()
    {
        $db = \Config\Database::connect();
        

        $pengiriman = $db->query("SELECT * FROM pengiriman")->getResultArray();
        

        $orders = $db->query("
            SELECT o.orderID, o.StatusOrder, p.pengirimanID, p.jasaPengiriman
            FROM `order` o
            LEFT JOIN pengiriman p ON p.orderID = o.orderID
            WHERE o.StatusOrder = 'sukses'
        ")->getResultArray();
        
        echo "<h3>Data Pengiriman:</h3>";
        echo "<pre>";
        print_r($pengiriman);
        echo "</pre>";
        
        echo "<h3>Data Orders dengan Pengiriman:</h3>";
        echo "<pre>";
        print_r($orders);
        echo "</pre>";
    }
}