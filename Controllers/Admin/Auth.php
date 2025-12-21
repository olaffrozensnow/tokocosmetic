<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->attemptLogin();
        }

        return view('admin/login');
    }

    public function attemptLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Query your admin table
        $admin = $this->db->table('admin')
            ->where('username', $username)
            ->get()
            ->getRow();

        if ($admin && password_verify($password, $admin->password)) {
            session()->set([
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'isAdminLoggedIn' => true
            ]);

            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}