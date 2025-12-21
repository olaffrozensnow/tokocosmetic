<?php

namespace App\Controllers;

class Kuis extends BaseController
{
    public function index()
    {
        $data['hasil'] = null;
        
        if ($this->request->getMethod() === 'post') {
            $q1 = $this->request->getPost('q1');
            $q2 = $this->request->getPost('q2');
            $q3 = $this->request->getPost('q3');
            $q4 = $this->request->getPost('q4');
            $q5 = $this->request->getPost('q5');
            $q6 = $this->request->getPost('q6');
            $q7 = $this->request->getPost('q7');
            $q8 = $this->request->getPost('q8');

            $scores = [
                'oily' => 0,
                'dry' => 0,
                'combo' => 0,
                'normal' => 0,
                'sensitive' => 0
            ];

            $answers = [$q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8];
            
            foreach ($answers as $answer) {
                if (isset($scores[$answer])) {
                    $scores[$answer]++;
                }
            }

            $data['hasil'] = array_search(max($scores), $scores);
        }
        
        return view('quiz', $data);
    }
}   