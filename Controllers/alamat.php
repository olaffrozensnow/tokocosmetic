<?php

namespace App\Controllers;

use App\Models\AlamatModel;
use CodeIgniter\API\ResponseTrait;

class Alamat extends BaseController
{
    use ResponseTrait;

    public function save()
    {
        $session = session();
        $userID = $session->get('UserID') ?? $session->get('userID') ?? $session->get('user_id') ?? $session->get('id');

        if (!$userID) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $alamatModel = new AlamatModel();

        $data = [
            'userID' => $userID,
            'Label' => $this->request->getPost('label'),
            'Jalan' => $this->request->getPost('street'),
            'Kota' => $this->request->getPost('city'),
            'Provinsi' => $this->request->getPost('province'),
            'KodePos' => $this->request->getPost('postalCode'),
            'IsPrimary' => 0
        ];

        $existingAddresses = $alamatModel->getAlamatByUser($userID);
        if (empty($existingAddresses)) {
            $data['IsPrimary'] = 1;
        }

        if ($alamatModel->insert($data)) {
            return redirect()->back()->with('success', 'Alamat berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan alamat.');
        }
    }

    public function update()
    {
        $session = session();
        $userID = $session->get('UserID') ?? $session->get('userID') ?? $session->get('user_id') ?? $session->get('id');

        if (!$userID) {
            return $this->failUnauthorized('Silakan login terlebih dahulu.');
        }

        $alamatID = $this->request->getPost('alamatID');
        $alamatModel = new AlamatModel();
        
        $alamat = $alamatModel->find($alamatID);
        
        if (!$alamat || $alamat['userID'] != $userID) {
            return $this->failNotFound('Alamat tidak ditemukan.');
        }

        $data = [
            'Label' => $this->request->getPost('label'),
            'Jalan' => $this->request->getPost('street'),
            'Kota' => $this->request->getPost('city'),
            'Provinsi' => $this->request->getPost('province'),
            'KodePos' => $this->request->getPost('postalCode')
        ];

        if ($alamatModel->update($alamatID, $data)) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Alamat berhasil diperbarui.'
            ]);
        } else {
            return $this->fail('Gagal memperbarui alamat.');
        }
    }

    public function delete()
    {
        $session = session();
        $userID = $session->get('UserID') ?? $session->get('userID') ?? $session->get('user_id') ?? $session->get('id');

        if (!$userID) {
            return $this->failUnauthorized('Silakan login terlebih dahulu.');
        }

        $alamatID = $this->request->getPost('alamatID');
        $alamatModel = new AlamatModel();
        
        $alamat = $alamatModel->find($alamatID);
        
        // FIXED: Changed 'UserID' to 'userID' to match the field name used elsewhere
        if (!$alamat || $alamat['userID'] != $userID) {
            return $this->failNotFound('Alamat tidak ditemukan.');
        }

        if ($alamat['IsPrimary'] == 1) {
            $otherAddresses = $alamatModel->where('userID', $userID)
                                          ->where('alamatID !=', $alamatID)
                                          ->first();
            
            if ($otherAddresses) {
                $alamatModel->update($otherAddresses['alamatID'], ['IsPrimary' => 1]);
            }
        }

        if ($alamatModel->delete($alamatID)) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Alamat berhasil dihapus.'
            ]);
        } else {
            return $this->fail('Gagal menghapus alamat.');
        }
    }

    public function setPrimary()
    {
        $session = session();
        $userID = $session->get('UserID') ?? $session->get('userID') ?? $session->get('user_id') ?? $session->get('id');

        if (!$userID) {
            return $this->failUnauthorized('Silakan login terlebih dahulu.');
        }

        $alamatID = $this->request->getPost('alamatID');
        $alamatModel = new AlamatModel();
        
        $alamat = $alamatModel->find($alamatID);
        
        if (!$alamat || $alamat['userID'] != $userID) {
            return $this->failNotFound('Alamat tidak ditemukan.');
        }

        if ($alamatModel->setPrimaryAlamat($alamatID, $userID)) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Alamat utama berhasil diubah.'
            ]);
        } else {
            return $this->fail('Gagal mengubah alamat utama.');
        }
    }
}