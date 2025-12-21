<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'FeedbackID';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'FeedbackID',
        'userID',
        'isiFeedback',
        'rating',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'FeedbackID' => 'required|max_length[5]',
        'userID' => 'required|max_length[5]',
        'isiFeedback' => 'required|max_length[200]',
        'rating' => 'permit_empty|integer'
    ];

    protected $validationMessages = [
        'FeedbackID' => [
            'required' => 'Feedback ID harus diisi',
            'max_length' => 'Feedback ID maksimal 5 karakter'
        ],
        'userID' => [
            'required' => 'User ID harus diisi',
            'max_length' => 'User ID maksimal 5 karakter'
        ],
        'isiFeedback' => [
            'required' => 'Isi feedback harus diisi',
            'max_length' => 'Isi feedback maksimal 200 karakter'
        ],
        'rating' => [
            'integer' => 'Rating harus berupa angka'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function getAllFeedbacks()
    {
       return $this->select('feedback.*, pengguna.UserName, pengguna.Email') 
        ->join('pengguna', 'pengguna.UserID = feedback.userID', 'left')
        ->orderBy('feedback.created_at', 'DESC')
        ->findAll();
    }

    public function getFeedbackByUser($userID)
    {
        return $this->where('userID', $userID)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getLastFeedback()
    {
        return $this->orderBy('FeedbackID', 'DESC')->first();
    }

    public function getAverageRating()
    {
        $result = $this->selectAvg('rating')->first();
        return $result['rating'] ? round($result['rating'], 1) : 0;
    }

    public function getTotalFeedback()
    {
        return $this->countAll();
    }
    public function getRatingDistribution()
    {
        return $this->select('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating', 'DESC')
            ->findAll();
    }
}