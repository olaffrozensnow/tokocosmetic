<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Users extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    public function index($page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $dataUsers = $this->penggunaModel->getAllUsers($limit, $offset);
        $totalUsers = $this->penggunaModel->countAllUsers();
        $data = [
            'title' => 'Data Pengguna',
            'pesanan' => $dataUsers,
            'page' => $page,
            'totalPages' => ceil($totalUsers / $limit)
        ];

        return view('admin/users', $data);
    }
}