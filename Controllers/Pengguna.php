<?php

    namespace App\Controllers;

    use App\Models\PenggunaModel;

    class Pengguna extends BaseController
    {
        protected $penggunaModel;

        public function __construct()
        {
            $this->penggunaModel = new PenggunaModel();
        }

        public function register()
        {
            return view('pengguna/register');
        }

    //     public function save()
    //     {
    //         $lastUser = $this->penggunaModel->orderBy('UserID', 'DESC')->first();

    //         if ($lastUser) {
    //             $lastId = intval(substr($lastUser['UserID'], 1));
    //             $newId = 'U' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
    //         } else {
    //             $newId = 'U0001';
    //         }

    //         $data = [
    //             'UserID'       => $newId,
    //             'UserName'     => $this->request->getVar('UserName'),
    //             'TanggalLahir' => $this->request->getVar('TanggalLahir'),
    //             'Email'        => $this->request->getVar('Email'),
    //             'noHP'         => $this->request->getVar('noHP'),
    //             'Password'     => password_hash($this->request->getVar('Password'), PASSWORD_DEFAULT),
    //         ];
            

    //         $this->penggunaModel->insert($data);
    //          // Buat session login otomatis
    // $session = session();
    // $session->set([
    //     'UserID'   => $newId,
    //     'UserName' => $data['UserName'],
    //     'logged_in' => true
    // ]);
    //         return redirect()->to('pengguna/menuapp'); 
    //         // return redirect()->to('/')->with('success', 'Registrasi berhasil! Selamat datang, ' . $data['UserName'] . '!');
    // // return redirect()->to('/')->with('success', 'Registrasi berhasil!');
    //     }


    public function save()
{
    // 1. CEK VALIDASI DULU
    // Rule 'is_unique[pengguna.UserName]' artinya:
    // Cek di tabel 'pengguna' kolom 'UserName', datanya harus unik.
    $rules = [
        'UserName' => [
            'rules' => 'required|is_unique[pengguna.UserName]',
            'errors' => [
                'required' => 'Username harus diisi.',
                'is_unique' => 'Username ini sudah terpakai, silakan ganti yang lain.'
            ]
        ],
        'Email' => [
            'rules' => 'required|valid_email|is_unique[pengguna.Email]',
            'errors' => [
                'required' => 'Email harus diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique' => 'Email ini sudah terdaftar.'
            ]
        ],
        // Validasi password opsional, tapi disarankan
        'Password' => [
            'rules' => 'required|min_length[6]',
            'errors' => [
                'min_length' => 'Password minimal 6 karakter.'
            ]
        ],

        'TanggalLahir' => [
    'rules' => [
        'required',
        'valid_date[Y-m-d]',
        function ($value, $data, &$error) {
            $tglLahir = new \DateTime($value);
            $today = new \DateTime();
            $umur = $today->diff($tglLahir)->y;

            if ($umur < 17) {
                $error = 'Usia minimal 17 tahun untuk mendaftar.';
                return false;
            }
            return true;
        }
    ]
]

];


    // Jalankan Validasi
    if (!$this->validate($rules)) {
        // Jika gagal, kembalikan ke halaman register dengan input sebelumnya & pesan error
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // ---------------------------------------------------------
    // JIKA LOLOS VALIDASI, BARU JALANKAN PROSES INSERT DI BAWAH
    // ---------------------------------------------------------

    $lastUser = $this->penggunaModel->orderBy('UserID', 'DESC')->first();

    if ($lastUser) {
        $lastId = intval(substr($lastUser['UserID'], 1));
        $newId = 'U' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $newId = 'U0001';
    }

    $data = [
        'UserID'       => $newId,
        'UserName'     => $this->request->getVar('UserName'),
        'TanggalLahir' => $this->request->getVar('TanggalLahir'),
        'Email'        => $this->request->getVar('Email'),
        'noHP'         => $this->request->getVar('noHP'),
        'Password'     => password_hash($this->request->getVar('Password'), PASSWORD_DEFAULT),
    ];

    $this->penggunaModel->insert($data);

    // Buat session login otomatis
    $session = session();
    $session->set([
        'UserID'    => $newId,
        'UserName'  => $data['UserName'],
        'logged_in' => true
    ]);

    return redirect()->to('pengguna/menuapp');
}
        public function login()
    {
        if ($this->request->getMethod() === 'post') {
            // Ambil input sesuai name di form (huruf besar)
            $email = trim($this->request->getVar('Email'));
            $password = $this->request->getVar('Password');

            // Cek user di database
            $user = $this->penggunaModel->where('Email', $email)->first();
            

            if ($user && password_verify($password, $user['Password'])) {
                // Set session
                session()->set([
                    'UserID'   => $user['UserID'],
                    'UserName' => $user['UserName'],
                    'Email'    => $user['Email'],
                    'logged_in'=> true
                ]);

                return redirect()->to('pengguna/menuapp'); 
            } else {
                return redirect()->back()->with('error', 'Email atau Password salah!');
            }
        }

        return view('pengguna/login');
    }

        

        


        public function logout()
        {
            session()->destroy();
            return redirect()->to('pengguna/menuapp')->with('success', 'Anda sudah logout.');
        }
    }