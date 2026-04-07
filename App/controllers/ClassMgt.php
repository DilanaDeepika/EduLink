<?php

class ClassMgt extends Controller
{
    
    
    public function index($class_id = null)
    {
      
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Optional: check if institute/teacher/student is logged in
        if (!isset($_SESSION['USER'])) {
            redirect('login');
            exit();
        }

        $classModel = new ClassModel();
        $teacherModel = new Teacher();
        $scheduleModel = new ClassScheduleModel();
        $markingPanelModel = new MarkingPanel();
        $accountModel = new Account();
        $paperModel = new PapersModel();
        $paperMarksModel = new PaperMarksModel();
        $enrollmentModel = new EnrollmentModel();
        $paymentModel = new PaymentModel();



        //Fetch the class
        $class = $classModel->first(['class_id' => $class_id]);
        if (!$class) die("Class not found");

        
        //Fetch teacher details
        $teacher = $teacherModel->first(['teacher_id' => $class->teacher_id]);

        //Enrolled Students
        $enrolledStudents = $enrollmentModel->count([
            'class_id' => $class_id,
            'status' => 'enrolled'
        ]);


        //Table data
        $studentsTableData = $enrollmentModel->getEnrolledStudentsByClass($class_id);

        // Fetch schedules
        $schedules = $scheduleModel->where(['class_id' => $class_id]);

        //payment status for students
        $paymentCounts = $paymentModel->getPaymentCountsByClass($class_id);

        $paymentsCompleted = $paymentCounts->completed ?? 0;

        $paymentsPending = $paymentCounts->pending ?? 0;
        // Fetch marking panel members for this class
        $panelMembers = $markingPanelModel->getPanelMembersByClass($class_id);

        // Fetch papers conducted
        $papersConducted = $paperModel->countReleasedPapersByClass($class_id);

        //Fetch corrected papers
        $papersCorrected = $paperMarksModel->countCorrectedPapersByClass($class_id);

        //Total papers in a class
        $totalPapers = $paperModel->count(['class_id' => $class_id]);

        //Precentage of papers conducted
        $percentage = 0;

        if ($totalPapers > 0) {
            $percentage = round(($papersConducted / $totalPapers) * 100);
        }


        $data = [
            'class' => $class,
            'teacher' => $teacher,
            'enrolledStudents' => $enrolledStudents,
            'studentsTableData' => $studentsTableData,
            'schedules' => $schedules,
            'paymentsCompleted' => $paymentsCompleted,
            'paymentsPending' => $paymentsPending,
            'panelMembers' => $panelMembers,
            'papersConducted' => $papersConducted,
            'papersCorrected' => $papersCorrected,
            'totalPapers' => $totalPapers,
            'percentage' => $percentage,
            
        ];


        $this->view('class_details', $data);
    }

    public function export($class_id = null)
    {
    if (!$class_id) {
        die("Class ID missing");
    }

    $enrollmentModel = new EnrollmentModel();
    $students = $enrollmentModel->getEnrolledStudentsByClass($class_id);

    if (empty($students)) {
        die("No students found");
    }

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=class_'.$class_id.'_students.csv');

    $output = fopen('php://output', 'w');

    // CSV column headers
    fputcsv($output, ['Student ID', 'First Name', 'Last Name', 'Phone', 'School', 'Stream']);

    // CSV data rows
    foreach ($students as $student) {
        fputcsv($output, [
            $student->student_id,
            $student->first_name,
            $student->last_name,
            $student->phone_number,
            $student->school_name,
            $student->stream
        ]);
    }

    fclose($output);
    exit();
    }

    public function getStudent($student_id = null)
{
    if (session_status() === PHP_SESSION_NONE) session_start(); 
    // Return JSON
    header('Content-Type: application/json');

    // Check login
    if (!isset($_SESSION['USER'])) {
        echo json_encode(['error' => 'Unauthorized access']);
        exit();
    }

    // Validate ID
    if (!$student_id || !is_numeric($student_id)) {
        echo json_encode(['error' => 'Invalid student ID']);
        exit();
    }

    $studentModel = new Student();
    $accountModel = new Account();
    $enrollmentModel = new EnrollmentModel();

    $student = $studentModel->first(['student_id' => $student_id]);


    if (!$student) {
        echo json_encode(['error' => 'Student not found']);
        exit();
    }

    // Get email from account table
   $account = $accountModel->first(['account_id' => $student->account_id]);
    $enrollment = $enrollmentModel->first(['student_id' => $student_id]);

    $response = [
        'student_id' => $student->student_id,
        'profile_picture' => $student->profile_picture ?? null,
        'first_name' => $student->first_name,
        'last_name' => $student->last_name,
        'phone_number' => $student->phone_number,
        'email' => $account ? $account->email : null,
        'stream' => $student->stream,
        'address' => $student->address,
        'nic' => $student->nic,
        //'date_of_birth' => $student->date_of_birth,
        //'gender' => $student->gender,
        'school_name' => $student->school_name,
        'guardian_name' => $student->parent_name,
        'guardian_contact' => $student->parent_phone_number,
        //'attendance' => 88, // You can calculate dynamically later
        'enrollment_date' => $enrollment ? $enrollment->enrollment_date : null
        
    ];

    echo json_encode($response);
    exit();
}





    



}
