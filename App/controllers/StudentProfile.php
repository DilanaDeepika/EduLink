<?php
class StudentProfile extends Controller
{
    public function index()
{
    // 1. Check login
    if (!isset($_SESSION['USER']['account_id'])) {
        header("Location: " . ROOT . "/login");
        exit;
    }

    // 2. Load Student model
    $studentModel = new Student();
    $student = $studentModel->first([
        'account_id' => $_SESSION['USER']['account_id']
    ]);

    if (!$student) die("Student not found");


    $classModel = new ClassModel();
        $paymentModel = new StudentPaymentModel();

        // Get student payments
        $payments = $paymentModel->where([
            'student_id' => $student->student_id
        ]);

        // Add class names to payments
        foreach ($payments as $payment) {
            $class = $classModel->first(['class_id' => $payment->class_id]);
            $payment->class_name = $class ? $class->class_name : 'Unknown';
        }

        $data = [
            'student' => $student,
            'payments' => $payments
        ];


        // Get student payments
$payments = $paymentModel->where([
    'student_id' => $student->student_id
]);

// Calculate total spent
$totalSpent = 0;
foreach ($payments as $payment) {
    if ($payment->payment_status === 'paid') {
        $totalSpent += $payment->amount;
    }
}

// Pass it to the view
$data['totalSpent'] = $totalSpent;

    // 3. Load EnrollmentModel, ClassModel, Teacher, Institute
    $enrollmentModel = new EnrollmentModel();
    $classModel = new ClassModel();
    $teacherModel = new Teacher();
    $instituteModel = new Institute();

    // Get all enrollments for the student
$allEnrollments = $enrollmentModel->where(['student_id' => $student->student_id]);

// Count enrolled and completed courses
$enrolledCount = 0;
$completedCount = 0;

foreach ($allEnrollments as $enroll) {
    if ($enroll->status === 'enrolled') $enrolledCount++;
    if ($enroll->status === 'completed') $completedCount++;
}

// Pass to view
$data['enrolledCount'] = $enrolledCount;
$data['completedCount'] = $completedCount;


    // 4. Get enrolled classes
    $enrollments = $enrollmentModel->where([
    'student_id' => $student->student_id
]);

$classes = [];
$classModel = new ClassModel();
$teacherModel = new Teacher();

foreach ($enrollments as $enroll) {
    $class = $classModel->first(['class_id' => $enroll->class_id]);
    if (!$class) continue;

    // VLE access
    $canAccessVLE = false;
    if ($enroll->status === 'enrolled') $canAccessVLE = true;
    if ($enroll->status === 'trial' && !empty($enroll->trial_end) && strtotime($enroll->trial_end) >= time()) {
        $canAccessVLE = true;
    }

    // Teacher name
    $teacher = $teacherModel->first(['teacher_id' => $class->teacher_id]);
    $class->teacher_name = $teacher ? ($teacher->first_name . ' ' . $teacher->last_name) : 'Unknown';

    // Progress
    $class->progress = $enroll->progress ?? 0;

    // Other enrollment info
    $class->enrollment_status = $enroll->status;
    $class->trial_end = $enroll->trial_end;
    $class->can_access_vle = $canAccessVLE;

    $classes[] = $class;
}


$data['classes'] = $classes;



    $data['student'] = $student;
    $data['classes'] = $classes;

    $eventModel = new StudentEventModel();
$events = $eventModel->where(['student_id' => $student->student_id]);
$data['events'] = $events;


    $this->view('student_profile', $data);
}

   public function update()
{
    if (!isset($_SESSION['USER']['account_id'])) {
        header("Location: " . ROOT . "/login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $studentModel = new Student();
        $student = $studentModel->first(['account_id' => $_SESSION['USER']['account_id']]);

        if (!$student) die("Student not found");

        $data = [
            'first_name' => $_POST['first_name'] ?? '',
            'last_name'  => $_POST['last_name'] ?? '',
            'nic'        => $_POST['nic'] ?? '',
            'age'        => $_POST['age'] ?? null,
            'school_name'=> $_POST['school_name'] ?? '',
            'email'      => $_POST['email'] ?? '',
            'phone_number'=> $_POST['phone_number'] ?? '',
            'address'    => $_POST['address'] ?? '',
            'parent_name'=> $_POST['parent_name'] ?? '',
            'parent_phone_number'=> $_POST['parent_phone_number'] ?? ''
        ];

        if (!empty($_FILES['profile_picture']['name'])) {
    $uploadDir = __DIR__ . '/../../public/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $fileName = time() . '_' . basename($_FILES['profile_picture']['name']);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
        $data['profile_picture'] = $fileName;

        // Optional: Delete old profile picture
        if (!empty($student->profile_picture) && file_exists($uploadDir . $student->profile_picture)) {
            unlink($uploadDir . $student->profile_picture);
        }
    }
}

        $studentModel->update($student->student_id, $data, 'student_id');

        header("Location: " . ROOT . "/StudentProfile");
        exit;
    }
}

public function save_event()
{
    if (!isset($_SESSION['USER']['account_id'])) {
        echo json_encode(['status' => 'unauthorized']);
        exit;
    }

    $student = (new Student())->first([
        'account_id' => $_SESSION['USER']['account_id']
    ]);

    if (!$student) {
        echo json_encode(['status' => 'student_not_found']);
        exit;
    }

$eventModel = new StudentEventModel();
$data = [
    'student_id' => $student->student_id,
    'event_date' => $_POST['event_date'],
    'event_time' => $_POST['event_time'],
    'event_title' => $_POST['event_title'],
    'event_description' => $_POST['event_description']
];

if ($eventModel->insert($data)) {
    // Fetch the last inserted event safely
    $lastEvent = $eventModel->first([
        'student_id' => $student->student_id,
        'event_date' => $_POST['event_date'],
        'event_time' => $_POST['event_time'],
        'event_title' => $_POST['event_title']
    ], []); // optional: order by event_id DESC if supported

    if ($lastEvent) {
        echo json_encode([
            'status' => 'success',
            'event' => $lastEvent
        ]);
    } else {
        echo json_encode(['status' => 'success', 'event' => $data]);
    }
} else {
    echo json_encode(['status' => 'error']);
}
exit;

}


public function update_event()
{
    $eventModel = new StudentEventModel();

    $eventModel->update(
        $_POST['event_id'],
        [
            'event_title' => $_POST['event_title'],
            'event_time' => $_POST['event_time'],
            'event_description' => $_POST['event_description']
        ],
        'event_id'
    );

    echo "success";
    exit;
}

public function delete_event()
{
    $eventModel = new StudentEventModel();

    $eventModel->delete([
        'event_id' => $_POST['event_id']
    ]);

    echo "success";
    exit;
}

} 




