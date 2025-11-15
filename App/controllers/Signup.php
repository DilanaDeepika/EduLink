<?php

class Signup extends Controller
{

    public function index()
    {
        $data = []; 
        $this->view('signup', $data);
    }

    public function save_student_details()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['new_account_id'])) {


            $studentModel = new Student(); // This line will now work
            $data = [
                'account_id' => $_SESSION['new_account_id'],
                'first_name' => $_POST['first_name'],
                'last_name'  => $_POST['last_name'],
                'school_name' => $_POST['school'], // ✅ match model
                'address'    => $_POST['address'],
                'stream'     => $_POST['stream']
            ];

            $studentModel->insert($data);
           
        $_SESSION['USER'] = [
            'account_id' => $_SESSION['new_account_id'],
            'role' => $_SESSION['new_account_role'],
            'first_name' => $_POST['first_name'] ?? ($_POST['institute_name'] ?? 'User') 
        ];
        $student = $studentModel->first(['account_id' => $_SESSION['USER']['account_id']]);
        if ($student)
        {
            $_SESSION['USER']['student_id'] = $student->student_id;
        }                
        // Unset the temporary variables
        unset($_SESSION['new_account_id']);
        unset($_SESSION['new_account_role']);

        redirect('home');
        } else {

            redirect('signup');
        }
    }

public function save_teacher_details()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['new_account_id'])) {

        $teacherModel = new Teacher();
        $uploadedFiles = handleFileUploads('files', 'teachers');
        $filePaths = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

      
        $data = [
            'account_id'             => $_SESSION['new_account_id'],
            'first_name'             => $_POST['first_name'],
            'last_name'              => $_POST['last_name'],
            'email'                  => $_POST['contact_email'], 
            'phone'                  => $_POST['phone'],
            'subjects_taught'        => $_POST['subject'],
            'approval_status'        => 'approved',
            'approval_document_path' => $filePaths,
            'approved_by_admin_id'   => null
        ];
        $data = array_intersect_key($data, array_flip($teacherModel->getAllowedColumns()));
        $teacherModel->insert($data);
        $_SESSION['USER'] = [
            'account_id' => $_SESSION['new_account_id'],
            'role' => $_SESSION['new_account_role'],
            'first_name' => $_POST['first_name'] ?? ($_POST['institute_name'] ?? 'User') 

        ];
        $teacher = $teacherModel->first(['account_id' => $_SESSION['USER']['account_id']]);
        if ($teacher)
        {
            $_SESSION['USER']['teacher_id'] = $teacher->teacher_id;
        }      

        unset($_SESSION['new_account_id']);
        unset($_SESSION['new_account_role']);

        redirect('home');
    } else {
        redirect('signup');
    }
}

   public function save_institute_details()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['new_account_id'])) {

        $instituteModel = new Institute();

        // 1️⃣ Handle file uploads using global function
        $uploadedFiles = handleFileUploads('files', 'institutes');
        $filePaths = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : null;

        // 2️⃣ Collect form data
        $data = [
            'account_id'             => $_SESSION['new_account_id'],
            'institute_name'         => $_POST['institute_name'],
            'location'               => $_POST['address'], 
            'contact_email'          => $_POST['contact_email'],
            'contact_phone'          => $_POST['phone'],
            'approval_status'        => 'approved',
            'approval_document_path' => $filePaths,
            'approved_by_admin_id'   => null
        ];

        $data = array_intersect_key($data, array_flip($instituteModel->getAllowedColumns()));


        $instituteModel->insert($data);

        $_SESSION['USER'] = [
            'account_id' => $_SESSION['new_account_id'],
            'role' => $_SESSION['new_account_role'],
            'first_name' => $_POST['first_name'] ?? ($_POST['institute_name'] ?? 'User') 
        ];
        $institute = $instituteModel->first(['account_id' => $_SESSION['USER']['account_id']]);
        if ($institute)
        {
            $_SESSION['USER']['institute_id'] = $institute->institute_id;
        }      


        unset($_SESSION['new_account_id']);
        unset($_SESSION['new_account_role']);

        redirect('home');

    } else {
        redirect('signup');
    }
}

}