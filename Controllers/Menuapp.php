<?php

namespace App\Controllers;

class Menuapp extends BaseController
{
    public function index()
    {
        return view('pengguna/menuapp');
    }

     public function pengunjung()
    {
        return view('menuapp');
    }

     public function logout()
    {
        session()->destroy();
        return redirect()->to('/menuapp')->with('success', 'Logout berhasil!');
    }
}