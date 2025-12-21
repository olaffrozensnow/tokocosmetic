<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'orderID';
    protected $allowedFields = ['userID', 'TanggalOrder', 'StatusOrder', 'TotalHarga', 'alamatID'];

    public function getUserOrders($userId)
    {
        return $this->select('a.orderID, a.TanggalOrder, a.StatusOrder, a.TotalHarga, e.metodePembayaran')
                    ->from('order a')
                    ->join('pengguna b', 'a.userId = b.UserID', 'left')

                    ->join('detailorder c', 'c.orderID = a.orderID', 'left')
                    ->join('product d', 'd.productID = c.productID', 'left')
                    ->join('pembayaran e', 'e.orderID = a.orderID', 'left')
                    ->where('a.userID', $userId)

                    ->groupBy('a.orderID')
                    ->orderBy('a.StatusOrder', 'ASC')
                    ->orderBy('a.TanggalOrder', 'DESC')
                    ->findAll();
    }

    public function getOrderDetails($orderID, $userId)
    {
        return $this->select('d.productName, d.Harga, c.jumlahItem as Kuantitas, (d.Harga * c.jumlahItem) as SubTotal, a.TotalHarga, a.StatusOrder, a.TanggalOrder, e.metodePembayaran, b.UserName, b.Email, f.alamatLengkap, f.kota, f.kodePos')
                    ->from('order a')
                    ->join('pengguna b', 'a.userId = b.UserID', 'left')
                    ->join('detailorder c', 'c.orderID = a.orderID', 'left')
                    ->join('product d', 'd.productID = c.productID', 'left')
                    ->join('pembayaran e', 'e.orderID = a.orderID', 'left')
                    ->join('alamat f', 'f.alamatID = a.alamatID', 'left') 
                    ->where('a.orderID', $orderID)
                   ->where('a.userID', $userId)
                    ->findAll();
    }

    public function getOrderHeader($orderID, $userId)
    {
        return $this->select('a.orderID, a.TanggalOrder, a.StatusOrder, a.TotalHarga, e.metodePembayaran')
                    ->from('order a')
                    ->join('pembayaran e', 'e.orderID = a.orderID', 'left')
                    ->where('a.orderID', $orderID)
                    ->where('a.userID', $userId)

                    ->first();
    }

    public function getOrderStats($userId)
    {
        $stats = $this->select('StatusOrder, COUNT(*) as count')
                      ->where('userID', $userId)

                      ->groupBy('StatusOrder')
                      ->findAll();

        $result = [
            'Diproses' => 0,
            'Menunggu Pembayaran' => 0,
            'Gagal' => 0,
            'Sukses' => 0,
            'Refund' => 0,
            'Refund Sebagian' => 0,
            'Menunggu Verifikasi' => 0,
            'total' => 0
        ];

        foreach ($stats as $stat) {
            $result[$stat['StatusOrder']] = $stat['count'];
            $result['total'] += $stat['count'];
        }

        return $result;
    }

    public function getStatusBadge($status)
    {
        $badges = [
            'Menunggu Pembayaran' => 'bg-warning',
            'Menunggu Verifikasi' => 'bg-info',
            'Diproses'            => 'bg-primary',
            'Sukses'              => 'bg-success',
            'Gagal'               => 'bg-danger',
            'Refund'              => 'bg-secondary',
            'Refund Sebagian'     => 'bg-secondary'
        ];

        return $badges[$status] ?? 'bg-secondary';
    }

    public function getStatusText($status)
    {
        $texts = [
            'Menunggu Pembayaran' => 'Menunggu Pembayaran',
            'Menunggu Verifikasi' => 'Menunggu Verifikasi',
            'Diproses'            => 'Diproses',
            'Sukses'              => 'Pembayaran Berhasil',
            'Gagal'               => 'Pembayaran Gagal',
            'Refund'              => 'Di-refund',
            'Refund Sebagian'     => 'Di-refund Sebagian'
        ];

        return $texts[$status] ?? 'Status Tidak Dikenal';
    }

    /**
     * Insert order dengan detail items
     * Membuat order baru dan menyimpan detail order ke tabel detailorder
     */
    public function insertOrder($data)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $items = $data['items'] ?? [];
            unset($data['items']);

            // Insert data order utama
            $orderData = [
                'userID'       => $data['userID'],

                'alamatID'     => $data['alamatID'],
                'TotalHarga'   => $data['TotalHarga'],
                'StatusOrder'  => $data['StatusPesanan'] ?? 'Menunggu Pembayaran',
                'TanggalOrder' => $data['TanggalPesan'] ?? date('Y-m-d H:i:s')
            ];

            $orderID = $this->insert($orderData);

            if (!$orderID) {
                throw new \Exception('Gagal membuat order');
            }

            // Insert detail order untuk setiap item
            $detailOrderModel = new \App\Models\DetailOrderModel();
            foreach ($items as $item) {
                $detailData = [
                    'orderID'   => $orderID,
                    'productID' => $item['productID'],
                    'Kuantitas' => $item['Quantity'],
                    'Harga'     => $item['Harga']
                ];

                if (!$detailOrderModel->insert($detailData)) {
                    throw new \Exception('Gagal menyimpan detail order');
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return false;
            }

            return $orderID;

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Insert Order Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get order dengan items berdasarkan orderID
     */
    public function getOrderWithItems($orderID)
    {
        $order = $this->select('order.*, alamat.*')
                      ->join('alamat', 'alamat.alamatID = order.alamatID', 'left')
                      ->where('order.orderID', $orderID)
                      ->first();

        if (!$order) {
            return null;
        }

        // Get detail order items
        $detailOrderModel = new \App\Models\DetailOrderModel();
        $items = $detailOrderModel->select('detailorder.*, product.productName, product.Stock')
                                  ->join('product', 'product.productID = detailorder.productID')
                                  ->where('detailorder.orderID', $orderID)
                                  ->findAll();

        $order['items'] = $items;

        return $order;
    }

    /**
     * Restore stock saat order dibatalkan
     */
    public function restoreOrderStock($orderID)
    {
        $detailOrderModel = new \App\Models\DetailOrderModel();
        $productModel = new \App\Models\ProductModel();

        $orderItems = $detailOrderModel->where('orderID', $orderID)->findAll();

        foreach ($orderItems as $item) {
            $product = $productModel->find($item['productID']);
            if ($product) {
                $newStock = $product['Stock'] + $item['Kuantitas'];
                $productModel->update($item['productID'], ['Stock' => $newStock]);
            }
        }

        return true;
    }
// public function getTotalBetween($startDate, $endDate)
// {
//     return $this->where('TanggalOrder >=', $startDate . ' 00:00:00')
//                 ->where('TanggalOrder <=', $endDate . ' 23:59:59')
//                 ->selectSum('TotalHarga')
//                 ->get()
//                 ->getRow()
//                 ->TotalHarga ?? 0;
// }
// public function getTotalBetween($startDate, $endDate)
// {
//     return $this->where('TanggalOrder >=', $startDate . ' 00:00:00')
//                 ->where('TanggalOrder <=', $endDate . ' 23:59:59')
//                 ->where('StatusOrder', 'Sukses')   
//                 ->selectSum('TotalHarga')
//                 ->get()
//                 ->getRow()
//                 ->TotalHarga ?? 0;
// }
public function getTotalBetween($startDate, $endDate, $status = null)
    {
        $builder = $this->builder();
        $builder->selectSum('TotalHarga', 'totalPendapatan')
                ->where('TanggalOrder >=', $startDate . ' 00:00:00')
                ->where('TanggalOrder <=', $endDate . ' 23:59:59');

        if (!empty($status) && $status !== 'all') {
            $builder->where('StatusOrder', $status);
        }

        $row = $builder->get()->getRowArray();
        return ($row && isset($row['totalPendapatan'])) ? (float)$row['totalPendapatan'] : 0;
    }

// public function getPesananBetween($startDate, $endDate)
// {
//     return $this->where('TanggalOrder >=', $startDate . ' 00:00:00')
//                 ->where('TanggalOrder <=', $endDate . ' 23:59:59')
//                 ->orderBy('TanggalOrder', 'DESC')
//                 ->findAll();
// }

// public function countPesananBetween($startDate, $endDate)
// {
//     return $this->where('TanggalOrder >=', $startDate . ' 00:00:00')
//                 ->where('TanggalOrder <=', $endDate . ' 23:59:59')
//                 ->countAllResults();
// }
// Fungsi mengambil Data Pesanan (List Tabel)
    public function getPesananBetween($startDate, $endDate, $status = null)
    {
        $this->select('order.*, pengguna.UserName');
        $this->join('pengguna', 'pengguna.UserID = order.userID');

        // Filter Tanggal
        $this->where('TanggalOrder >=', $startDate . ' 00:00:00');
        $this->where('TanggalOrder <=', $endDate . ' 23:59:59');

        // Filter Status (INI YANG KEMUNGKINAN HILANG DI KODEMU)
        if (!empty($status) && $status !== 'all') {
            $this->where('StatusOrder', $status);
        }

        return $this->orderBy('TanggalOrder', 'DESC')->findAll();
    }

    // Fungsi menghitung Jumlah Pesanan (Angka Dashboard)
    public function countPesananBetween($startDate, $endDate, $status = null)
    {
        // Filter Tanggal
        $this->where('TanggalOrder >=', $startDate . ' 00:00:00');
        $this->where('TanggalOrder <=', $endDate . ' 23:59:59');

        // Filter Status
        if (!empty($status) && $status !== 'all') {
            $this->where('StatusOrder', $status);
        }

        return $this->countAllResults();
    }

    
}
