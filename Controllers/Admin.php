<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $adminModel;
    protected $db;
    
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->db = \Config\Database::connect();
        helper(['form', 'url']);
    }

    public function index()
    {
        if (!session()->get('adminID')) {
            return redirect()->to('/admin/login');
        }
        
        return redirect()->to('/admin/dashboard');
    }

    public function login()
    {
        if (session()->get('adminID')) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Login Admin',
            'validation' => \Config\Services::validation() 
        ];

        return view('admin/login', $data);
    }

    public function attemptLogin()
    {
        $rules = [
            'adminID' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $adminID = $this->request->getPost('adminID');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->login($adminID, $password);

        if ($admin) {
            session()->set([
                'adminID' => $admin['adminID'],
                'adminName' => $admin['AdminName'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/admin/dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Admin ID atau Password salah!');
        }
    }

    public function dashboard()
    {
        if (!session()->get('adminID')) {
            return redirect()->to('/admin/login');
        }

        $adminName = session()->get('adminName') ?? 'Admin';

        $filterType = $this->request->getGet('filter') ?? 'all';
        $startDate = $this->request->getGet('startDate') ?? date('Y-m-d');
        $endDate = $this->request->getGet('endDate') ?? date('Y-m-d');

        $totalProduk = $this->db->table('product')->countAll();
        $totalPesanan = $this->db->table('order')->countAll();
        $totalPengguna = $this->db->table('pengguna')->countAll();

        $totalPendapatan = $this->getTotalPendapatanByFilter($filterType, $startDate, $endDate);
        $pesananTerbaru = $this->getPesananByFilter($filterType, $startDate, $endDate);

        $pesanan = $this->db->table('order')
            ->get()
            ->getResultArray();

        $produk = $this->db->table('product')
            ->get()
            ->getResultArray();

        $produkTerlaris = $this->getProdukTerlarisWithFilter($filterType, $startDate, $endDate);

        $data = [
            'title' => 'Admin Dashboard',
            'adminName' => $adminName,
            'totalProduk' => $totalProduk,
            'totalPesanan' => $totalPesanan,
            'totalPengguna' => $totalPengguna,
            'totalPendapatan' => $totalPendapatan,
            'pesananTerbaru' => $pesananTerbaru,
            'pesanan' => $pesanan,
            'produk' => $produk,
            'produkTerlaris' => $produkTerlaris,
            'filterType' => $filterType,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'filterLabel' => $this->getFilterLabel($filterType, $startDate, $endDate)
        ];

        return view('admin/dashboard', $data);
    }

    private function getDateRange($filterType, $startDate, $endDate)
    {
        switch ($filterType) {
            case 'today':
                return [date('Y-m-d'), date('Y-m-d')];
            case 'month':
                $startOfMonth = date('Y-m-01');
                $endOfMonth = date('Y-m-t');
                return [$startOfMonth, $endOfMonth];
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
                $query->where('DATE(TanggalOrder) >=', $start);
                $query->where('DATE(TanggalOrder) <=', $end);
            }
        }

        $result = $query->selectSum('TotalHarga')->get()->getRow();

        return $result->TotalHarga ?? 0;
    }

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
                $query->where('DATE(order.TanggalOrder) >=', $start);
                $query->where('DATE(order.TanggalOrder) <=', $end);
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
                $query->where('DATE(order.TanggalOrder) >=', $start);
                $query->where('DATE(order.TanggalOrder) <=', $end);
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

    private function getFilterLabel($filterType, $startDate, $endDate)
    {
        switch ($filterType) {
            case 'today':
                return 'Hari Ini';
            case 'month':
                return 'Bulan ' . date('F Y');
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

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login')->with('success', 'Logout berhasil!');
    }

    
}