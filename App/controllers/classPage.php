<?php

class ClassPage extends Controller
{
    public function index()
    {
        $class_id = $_GET['id'] ?? null;
        if (!$class_id) {
            $_SESSION['error'] = "Invalid class.";
            header("Location: " . ROOT);
            exit;
        }

        $classModel = new ClassModel();
        $studentModel = new Student();
        $studentInstituteModel = new StudentInstituteModel();
        $enrollmentModel = new EnrollmentModel();
        $teacherModel = new Teacher();
        $scheduleModel = new ClassScheduleModel();
        $objectiveModel = new ClassObjectiveModel();
        $ratingModel = new ClassRatingsModel();
        $studentModel = new Student();
        $institute = new InstituteModel();

        /* ================= CLASS DETAILS ================= */
        
        $class = $classModel->first(['class_id' => $class_id]);

        if (!$class) {
            $_SESSION['error'] = "Class not found.";
            header("Location: " . ROOT);
            exit;
        }

        $data['class_details'] = $class;

        $isInstituteClass = !empty($class->institute_id);
        $data['is_institute_class'] = $isInstituteClass;
        $data['class_type'] = $isInstituteClass ? 'Institute Class' : 'Group Class';

        /* ================= STUDENT ================= */
        $student = null;
        if (isset($_SESSION['USER']['account_id'])) {
            
            $student = $studentModel->first([
                'account_id' => $_SESSION['USER']['account_id']
            ]);
        }

        /* ================= INSTITUTE REGISTRATION ================= */
        $isRegisteredToInstitute = false;

        if ($isInstituteClass && $student) {
        
            $record = $studentInstituteModel->first([
                'student_id'   => $student->student_id,
                'institute_id' => $class->institute_id
            ]);
            $isRegisteredToInstitute = $record ? true : false;
        }

        $data['is_registered_to_institute'] = $isRegisteredToInstitute;

        /* ================= ENROLLMENTS DETAILS ================= */
        
        $enrollment = $enrollmentModel->first(['student_id' => $student->student_id]);
         $data['enrollment'] = $enrollment ;

        /* ================= TRIAL & PAYMENT LOGIC ================= */
        $showFreeTrial = false;
        $isTrialActive = false;
        $allowPayment  = false;

        if ($student) {
            $enrollment = $enrollmentModel->getEnrollment($student->student_id, $class_id);

            if (!$enrollment) {
                $showFreeTrial = true;
                $allowPayment  = true;
            } elseif ($enrollment->status === 'trial') {
                $trialEnd = strtotime($enrollment->trial_end);

                if ($trialEnd >= time()) {
                    $showFreeTrial = true;
                    $isTrialActive = true;
                    $allowPayment  = false;
                } else {
                    $enrollmentModel->update($enrollment->enrollment_id,['status' => 'expired'],'enrollment_id');
                    $allowPayment = true;
                }
            } elseif ($enrollment->status === 'expired') {
                $allowPayment = true;
            }
        }

        $data['showFreeTrial']   = $showFreeTrial;
        $data['is_trial_active'] = $isTrialActive;
        $data['allowPayment']    = $allowPayment;

        /* ================= TEACHER ================= */
        
        $data['teacher_details'] = $teacherModel->where([
            'teacher_id' => $class->teacher_id
        ]);


        /* ================= INSTITUTE ================= */
        $data['institute_details']  = $institute->first([
            'institute_id' => $class->institute_id
        ]);

        /* ================= SCHEDULE ================= */
        
        $data['Schedule_details'] = $scheduleModel->where([
            'class_id' => $class_id
        ]);

        /* ================= OBJECTIVES ================= */
        
        $data['Objective_details'] = $objectiveModel->where([
            'class_id' => $class_id
        ]);

        /* ================= RATINGS ================= */
        
        $ratings = $ratingModel->where(['class_id' => $class_id]);

        $totalRatings = count($ratings);
        $sumRatings = 0;
        $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings as $r) {
            $sumRatings += $r->rating;
            if (isset($ratingCounts[$r->rating])) {
                $ratingCounts[$r->rating]++;
            }
        }

        $data['average_rating'] = $totalRatings ? round($sumRatings / $totalRatings, 1) : 0;
        $data['total_ratings']  = $totalRatings;

        $ratingPercentages = [];
        foreach ($ratingCounts as $star => $count) {
            $ratingPercentages[$star] = $totalRatings
                ? round(($count / $totalRatings) * 100)
                : 0;
        }
        $data['rating_percentages'] = $ratingPercentages;

        /* ================= REVIEWS ================= */
        $reviews = $ratings; // same table
        if ($reviews) {
            
            foreach ($reviews as $r) {
                $s = $studentModel->first(['account_id' => $r->user_id]);
                $r->username = $s ? $s->first_name . ' ' . $s->last_name : 'Student';
            }
        }
        $data['reviews'] = $reviews;


        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();


        $this->view('class', $data);
    }

    /* ================= SUBMIT REVIEW ================= */
public function submit_review()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

    if (!isset($_SESSION['USER']['account_id'])) {
        $_SESSION['error'] = "Login required.";
        header("Location: " . ROOT . "/ClassPage?id=" . $_POST['class_id']);
        exit;
    }

    $reviewModel = new ClassRatingsModel();
    $accountId = $_SESSION['USER']['account_id'];
    $classId = $_POST['class_id'];
    $rating = (int)($_POST['rating'] ?? 0);

    $data = [
        'class_id'    => $classId,
        'user_id'  => $accountId,
        'review_text' => $_POST['review_text'] ?? null,
        'rating'      => $rating
    ];

    // Validate (Ensure rating is 1-5 and text is provided)
    if (!$reviewModel->validate($data)) {
        $_SESSION['error'] = implode(', ', $reviewModel->validation_errors);
        header("Location: " . ROOT . "/ClassPage?id=" . $classId);
        exit;
    }

    // Check if user already rated/reviewed this class
    $existing = $reviewModel->first([
        'class_id'   => $classId,
        'user_id' => $accountId
    ]);

    if ($existing) {
        // Update existing record
        $reviewModel->update($existing->rating_id, [
            'review_text' => $data['review_text'],
            'rating'      => $data['rating']
        ], 'rating_id');
    } else {
        // Insert new record
        $reviewModel->insert($data);
    }

    $_SESSION['success'] = "Review submitted successfully!";
    header("Location: " . ROOT . "/ClassPage?id=" . $classId);
    exit;
}

    /* ================= START FREE TRIAL ================= */
    public function startTrial($class_id = null)
    {
        if (!$class_id) {
            $_SESSION['error'] = "Invalid class.";
            header("Location: " . ROOT);
            exit;
        }

        if (!isset($_SESSION['USER']['account_id'])) {
            $_SESSION['error'] = "Login required.";
            header("Location: " . ROOT . "/ClassPage?id=" . $class_id);
            exit;
        }

        $studentModel = new Student();
        $student = $studentModel->first([
            'account_id' => $_SESSION['USER']['account_id']
        ]);

        if (!$student) {
            $_SESSION['error'] = "Student not found.";
            header("Location: " . ROOT);
            exit;
        }

        $enrollmentModel = new EnrollmentModel();
        if ($enrollmentModel->getEnrollment($student->student_id, $class_id)) {
            $_SESSION['error'] = "Already enrolled.";
            header("Location: " . ROOT . "/StudentProfile#my-courses");
            exit;
        }

        $enrollmentModel->startFreeTrial($student->student_id, $class_id);
        $_SESSION['success'] = "Free trial started!";
        header("Location: " . ROOT . "/StudentProfile#my-courses");
        exit;
    }

    /* ================= FREE CARD ================= */
public function applyFreeCard()
{
    if (!isset($_SESSION['USER']['account_id'])) {
        $_SESSION['error'] = "Login required.";
        redirect('login');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $class_id = $_POST['class_id'];
        
        $studentModel = new Student();
        $applicationModel = new FreeCardApplication();
        
        $student = $studentModel->first(['account_id' => $_SESSION['USER']['account_id']]);

        $existing = $applicationModel->first([
            'student_id' => $student->student_id, 
            'status'     => 'pending'
        ]);

        if ($existing) {
            $_SESSION['error'] = "You already have a pending application. Please wait for Admin review.";
        } else {
            $uploadedFiles = handleFileUploads('proof_document', 'free_cards');
            $filePaths = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : null;


            if ($filePaths) {
                $applicationModel->insert([
                    'student_id'         => $student->student_id,
                    'documentation_path' => $filePaths,
                    'status'             => 'pending',
                    'application_date'   => date('Y-m-d')
                ]);

                $_SESSION['success'] = "Free card application submitted for verification.";
            } else {
                $_SESSION['error'] = "Please upload valid documentation proof.";
            }
        }
    }

    $class_id = $_POST['class_id'] ?? '';
    redirect("ClassPage?id=" . $class_id);
}
}
