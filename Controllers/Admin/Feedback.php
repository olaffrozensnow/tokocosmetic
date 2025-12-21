<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;

class Feedback extends BaseController
{
    protected $feedBackModel;

    public function __construct()
    {
       $this->feedBackModel = new FeedbackModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Feedback',
            'feedbacks' => $this->feedBackModel->getAllFeedbacks(),
            'averageRating' => $this->feedBackModel->getAverageRating(),
            'totalFeedback' => $this->feedBackModel->getTotalFeedback(),
            'ratingDistribution' => $this->feedBackModel->getRatingDistribution()
        ];

        return view('admin/feedback', $data);
    }
}