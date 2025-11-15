<?php

class TeacherRegister extends Controller
{
    public function index()
    {
        $data = []; 

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email'])) {
            
            $accountModel = new Account();
            
            if ($accountModel->validate($_POST)) {
                
                $data = [
                    'email' => $_POST['email'],
                    'password_hash' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'account_type'  => $_POST['role']

                ];

                $account_id = $accountModel->insert($data); 

                if($account_id) {
                    $newlyCreatedAccount = $accountModel->first(['email' => $data['email']]);
                    $_SESSION['new_account_id'] = $newlyCreatedAccount->account_id;
                    $_SESSION['new_account_role'] = $_POST['role']; 

                    $this->view('teacher_register');
                    return; 
                } else {
                    $data['errors'] = ['account' => 'Database error. Could not create account.'];
                }

            } else {
                // 4. If validation fails, get the errors
                $data['errors'] = $accountModel->validation_errors;
            }
            
            // 5. If we are here, it's because validation or insert failed.
            $this->view('signup', $data);

        } else {
            // GET request
            $this->view('teacher_register');
        }
    }
}