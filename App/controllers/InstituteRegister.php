<?php

class InstituteRegister extends Controller
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
                    $newAccountId = $newlyCreatedAccount->account_id;
                    $_SESSION['new_account_id'] = $newAccountId;
                    $_SESSION['new_account_role'] = $data['account_type']; 

                    $this->view('institute_register');
                    return; 
                } else {
                    $data['errors'] = ['account' => 'Database error. Could not create account.'];
                }

            } else {
                $data['errors'] = $accountModel->validation_errors;
            }
            
           print_r($data['errors']);
            $this->view('signup', $data);

        } else {
            $this->view('institute_register');
        }
    }
}