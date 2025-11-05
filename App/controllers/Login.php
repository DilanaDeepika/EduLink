<?php

class Login extends Controller
{
public function index() 
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $userModel = new Account();
        $user = $userModel->first(['email' => $email]);

        if ($user) {
            if (password_verify($password, $user->password_hash)) {

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['USER'] = [
                    'account_id' => $user->account_id,
                    'email'      => $user->email,
                    'role'       => $user->account_type,
                ];

                $role = $_SESSION['USER']['role'];

                switch ($role) {
                    case 'student':
                        $studentModel = new Student();
                        $student = $studentModel->first(['account_id' => $user->account_id]);
                        if ($student) {
                            $_SESSION['USER']['student_id'] = $student->student_id;
                        }                
                        redirect('Home');
                        break;

                    case 'teacher':
                        $teacherModel = new Teacher();
                        $teacher = $teacherModel->first(['account_id' => $user->account_id]);
                        if ($teacher) {
                            $_SESSION['USER']['teacher_id'] = $teacher->teacher_id;
                        }
                      
                        redirect('Home');
                        break;

                    case 'institute':
                        $instituteModel = new Institute();
                        $institute = $instituteModel->first(['account_id' => $user->account_id]);
                        if ($institute) {
                            $_SESSION['USER']['institute_id'] = $institute->institute_id;
                        }
                        redirect('Home');
                        break;

                    case 'admin':
                        $adminModel = new AdminModel();
                        $admin = $adminModel->first(['account_id' => $user->account_id]);
                        if ($admin) {
                            $_SESSION['USER']['admin_id'] = $admin->admin_id;
                        }
                        redirect('Home');
                        break;

                    default:
                        redirect('Home');
                        break;
                }

            } else {
                $data['error'] = "Incorrect password.";
            }
        } else {
            $data['error'] = "No account found with that email.";
        }
    }

    $this->view('login', isset($data) ? $data : []);
}

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();     
        session_destroy();   

        redirect('login');
    }

}
