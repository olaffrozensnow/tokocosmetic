<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class Feedback extends BaseController
{
    protected $feedbackModel;

    public function __construct()
    {
        $this->feedbackModel = new FeedbackModel();
    }

    public function feed()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $data = [
            'title' => 'Feedback',
            'feedbacks' => $this->feedbackModel->getAllFeedbacks()
        ];

        return view('feedback/feed', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $data = [
            'title' => 'Buat Feedback'
        ];

        return view('feedback/create', $data);
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        $validation = $this->validate([
            'isiFeedback' => 'required|min_length[10]|max_length[200]',
            'rating' => 'required|in_list[1,2,3,4,5]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

 
        $userID = session()->get('UserID');
        if (empty($userID)) {
            die("DEBUG ERROR: userID tidak ditemukan dalam sesi. Pastikan Anda sudah login dan 'userID' disetel."); 
        }
       

        $lastFeedback = $this->feedbackModel->getLastFeedback();
        if ($lastFeedback) {
            $lastNumber = intval(substr($lastFeedback['FeedbackID'], 1));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $feedbackID = 'F' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        $data = [
            'FeedbackID' => $feedbackID,
            'userID' => $userID,
            'isiFeedback' => $this->request->getPost('isiFeedback'),
            'rating' => $this->request->getPost('rating'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

  


        if ($this->feedbackModel->insert($data)) {
            return redirect()->to('/feedback')->with('success', 'Feedback berhasil dikirim!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim feedback');
        }
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $feedback = $this->feedbackModel->find($id);
        
        if (!$feedback) {
            return redirect()->to('/feedback')->with('error', 'Feedback tidak ditemukan');
        }

        if ($feedback['userID'] != session()->get('userID') && session()->get('role') != 'admin') {
            return redirect()->to('/feedback')->with('error', 'Anda tidak memiliki akses untuk menghapus feedback ini');
        }

        if ($this->feedbackModel->delete($id)) {
            return redirect()->to('/feedback')->with('success', 'Feedback berhasil dihapus');
        } else {
            return redirect()->to('/feedback')->with('error', 'Gagal menghapus feedback');
        }
    }
}