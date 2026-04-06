<?php
class Institute extends Controller
{
    public function register()
    {  
        // 1. Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Must be logged in
        if (!isset($_SESSION['USER']['account_id'])) {
            redirect('login');
            exit;
        }

        // 3. Get logged-in student
        $studentModel = new Student();
        $student = $studentModel->first([
            'account_id' => $_SESSION['USER']['account_id']
        ]);

        if (!$student) {
            die("Student not found");
        }

        // 4. Get institute_id from POST
        $institute_id = $_POST['institute_id'] ?? null;
        if (!$institute_id) {
            die("Institute ID missing.");
        }

        $studentInstituteModel = new StudentInstituteModel();

        // 5. Check if already registered
        $existing = $studentInstituteModel->first([
            'student_id'   => $student->student_id,
            'institute_id' => $institute_id
        ]);

        // 6. Insert only if not registered
        if (!$existing) {
            $insertData = [
                'student_id'   => $student->student_id,
                'institute_id' => $institute_id,
                'created_at'   => date('Y-m-d H:i:s')
            ];

            $result = $studentInstituteModel->insert($insertData);

            if (!$result) {
                die("Insert failed! Check database connection and table structure.");
            }
        }

        // 7. Redirect back to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
