<?php

class Home extends Controller
{
    public function index()
    {
        $data = [];
        
        if (isset($_SESSION['user_id'])) {
            
            $user_id = $_SESSION['user_id'];
            
            $user_type = $_SESSION['user_role'];
            
            $specific_model = null;

            if ($user_type === 'student') {
                $specific_model = new Student();
            } elseif ($user_type === 'teacher') {
                $specific_model = new Teacher();
            } elseif ($user_type === 'institute') {
                $specific_model = new Institute();
            }
            
            // Find the user by their 'account_id'
            if ($specific_model) {
                $data['user'] = $specific_model->first(['account_id' => $user_id]);
            }
        }
        
        // Pass the $data array (with or without user info) to the view
        $this->view('home', $data);
    }
}