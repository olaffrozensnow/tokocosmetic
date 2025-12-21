<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;


class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $adminName = session('admin_name') ?? 'Admin';

        // $filterType = $this->request->getGet('filter') ?? 'all';
        // $startDate = $this->request->getGet('startDate') ?? date('Y-m-d');
        // $endDate = $this->request->getGet('endDate') ?? date('Y-m-d');
        // ambil 30 hari terakhir (termasuk hari ini)
    $status = $this->request->getGet('status') ?? 'all';
    $endDate = date('Y-m-d'); 
    $startDate = date('Y-m-d', strtotime('-29 days')); // total 30 hari: hari ini + 29 hari sebelum


        $totalProduk = $this->db->table('product')->countAll();
        $totalPesanan = $this->db->table('order')->countAll();
        $totalPengguna = $this->db->table('pengguna')->countAll();

        $orderModel = new OrderModel();

    // $totalPendapatan = $orderModel->getTotalBetween($startDate, $endDate, $status);
    // $pesananTerbaru = $orderModel->getPesananBetween($startDate, $endDate);
    // $jumlahPesananTerbaru = $orderModel->countPesananBetween($startDate, $endDate);
    // ✅ Total Pendapatan (Sudah Benar)
$totalPendapatan = $orderModel->getTotalBetween($startDate, $endDate, $status);

// ✅ Daftar Pesanan & Jumlah (HARUS ditambah $status juga)
$pesananTerbaru = $orderModel->getPesananBetween($startDate, $endDate, $status);
$jumlahPesananTerbaru = $orderModel->countPesananBetween($startDate, $endDate, $status);

// ✅ Variabel $pesanan (HARUS pakai data yang sudah difilter)
// Jangan pakai query baru lagi, pakai saja hasil dari $pesananTerbaru
$pesanan = $pesananTerbaru;

        // $totalPendapatan = $this->getTotalPendapatanByFilter($filterType, $startDate, $endDate);
        // $pesananTerbaru = $this->getPesananByFilter($filterType, $startDate, $endDate);

        // $pesanan = $this->db->table('order')
        //     ->get()
        //     ->getResultArray();

        // $produk = $this->db->table('product')
        //     ->get()
        //     ->getResultArray();

        // $produkTerlaris = $this->getProdukTerlarisWithFilter($filterType, $startDate, $endDate);
        // $pesanan = $this->db->table('order')->get()->getResultArray();
    $produk = $this->db->table('product')->get()->getResultArray();
    $produkTerlaris = $this->getProdukTerlarisWithFilter('all', $startDate, $endDate);


        $data = [
            'adminName' => $adminName,
             'status' => $status,
            'totalProduk' => $totalProduk,
            'totalPesanan' => $totalPesanan,
            'totalPengguna' => $totalPengguna,
            'totalPendapatan' => $totalPendapatan,
            'pesananTerbaru' => $pesananTerbaru,
            'pesanan' => $pesanan,
            'produk' => $produk,
            'produkTerlaris' => $produkTerlaris,
            'filterType' => '30days',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'filterLabel' => '30 Hari Terkahir'
        ];

  
        return view('admin/dashboard', $data);
    }

    private function getDateRange($filterType, $startDate, $endDate)
    {
        switch ($filterType) {
            case 'today':
                return [date('Y-m-d'), date('Y-m-d')];
            case 'week':
                $startOfWeek = date('Y-m-d', strtotime('monday this week'));
                $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
                return [$startOfWeek, $endOfWeek];
            case 'month':
                $startOfMonth = date('Y-m-01');
                $endOfMonth = date('Y-m-t');
                return [$startOfMonth, $endOfMonth];
            case 'year':
                return [date('Y-01-01'), date('Y-12-31')];
            case 'custom':
                return [$startDate, $endDate];
            default:
                return [null, null];
        }
    }

    private function getTotalPendapatanByFilter($filterType, $startDate, $endDate)
    {
        $query = $this->db->table('order');

        list($start, $end) = $this->getDateRange($filterType, $startDate, $endDate);

        if ($start && $end) {
            if ($start === $end) {
                $query->where('DATE(TanggalOrder)', $start);
            } else {
                $query->where("DATE(TanggalOrder) >= ?", [$start]);
                $query->where("DATE(TanggalOrder) <= ?", [$end]);
            }
        }

        $result = $query->selectSum('TotalHarga')
            ->get()
            ->getRow()
            ->TotalHarga ?? 0;

        return $result;
    }
    //     private function getTotalPendapatanByFilter($filterType, $startDate, $endDate)
    // {
    //     $query = $this->db->table('order');

    //     list($start, $end) = $this->getDateRange($filterType, $startDate, $endDate);

    //     if ($start && $end) {

    //         if ($start === $end) {
    //             $query->where("DATE(TanggalOrder)", $start);
    //         } else {
    //             $query->where("DATE(TanggalOrder) >=", $start);
    //             $query->where("DATE(TanggalOrder) <=", $end);
    //         }
    //     }

    //     // FILTER STATUS SUKSES
    //     $query->where('StatusOrder', 'Sukses');

    //     return $query->selectSum('TotalHarga')
    //                  ->get()
    //                  ->getRow()
    //                  ->TotalHarga ?? 0;
    // }


    private function getPesananByFilter($filterType, $startDate, $endDate)
    {
        $query = $this->db->table('order')
            ->select('order.orderID, order.TanggalOrder, order.TotalHarga, order.StatusOrder, pengguna.UserName')
            ->join('pengguna', 'pengguna.UserID = order.userID');

        list($start, $end) = $this->getDateRange($filterType, $startDate, $endDate);

        if ($start && $end) {
            if ($start === $end) {
                $query->where('DATE(order.TanggalOrder)', $start);
            } else {
                $query->where("DATE(order.TanggalOrder) >= ?", [$start]);
                $query->where("DATE(order.TanggalOrder) <= ?", [$end]);
            }
        }

        return $query->orderBy('order.TanggalOrder', 'DESC')
            ->get()
            ->getResultArray();
    }

    private function getProdukTerlarisWithFilter($filterType, $startDate, $endDate)
    {
        $query = $this->db->table('product')
            ->select('product.productID, product.productName, product.merk, product.Harga, product.Stok, SUM(detailorder.jumlahItem) as totalTerjual')
            ->join('detailorder', 'detailorder.productID = product.productID', 'left')
            ->join('order', 'order.orderID = detailorder.orderID', 'left');

        list($start, $end) = $this->getDateRange($filterType, $startDate, $endDate);

        if ($start && $end) {
            if ($start === $end) {
                $query->where('DATE(order.TanggalOrder)', $start);
            } else {
                $query->where("DATE(order.TanggalOrder) >= ?", [$start]);
                $query->where("DATE(order.TanggalOrder) <= ?", [$end]);
            }
        }

        $produkTerlaris = $query->groupBy('product.productID')
            ->orderBy('totalTerjual', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        foreach ($produkTerlaris as &$prod) {
            if ($prod['totalTerjual'] === null) {
                $prod['totalTerjual'] = 0;
            }
        }

        return $produkTerlaris;
    }

    // private function getFilterLabel($filterType, $startDate, $endDate)
    // {
    //     switch ($filterType) {
    //         case 'today':
    //             return 'Hari Ini';
    //         case 'week':
    //             return 'Minggu Ini';
    //         case 'month':
    //             return 'Bulan ' . date('F Y');
    //         case 'year':
    //             return 'Tahun ' . date('Y');
    //         case 'custom':
    //             if ($startDate === $endDate) {
    //                 return 'Tanggal ' . date('d M Y', strtotime($startDate));
    //             } else {
    //                 return date('d M Y', strtotime($startDate)) . ' - ' . date('d M Y', strtotime($endDate));
    //             }
    //         default:
    //             return 'Semua Data';
    //     }
    // }

    private function getFilterLabel($filterType, $startDate, $endDate, $status = null)
{
    // 🔥 Jika user filter berdasarkan status pesanan
    if (!empty($status) && $status !== 'all') {
        return "Status: " . $status;
    }

    // 🔥 Jika filter berdasarkan tanggal
    switch ($filterType) {
        case 'today':
            return 'Hari Ini';

        case 'week':
            return 'Minggu Ini';

        case 'month':
            return 'Bulan ' . date('F Y');

        case 'year':
            return 'Tahun ' . date('Y');

        case 'custom':
            if ($startDate === $endDate) {
                return 'Tanggal ' . date('d M Y', strtotime($startDate));
            } else {
                return date('d M Y', strtotime($startDate)) . ' - ' . date('d M Y', strtotime($endDate));
            }

        default:
            return 'Semua Data';
    }
}


}