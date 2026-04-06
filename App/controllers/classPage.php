<?php

class ClassPage extends Controller
{
    public function index()
    {
         // Get class_id  from URL
         //Class Details
        $class_id = $_GET['id'] ?? null;
        $data = [];
        $classModel = new ClassModel();
        $classdetails = $classModel->where(['class_id' => $class_id]);

    
        $data['class_details'] = $classdetails;

        if (!empty($classdetails[0]->institute_id)) {
         $data['class_type'] = 'Institute Class';
          } else {
         $data['class_type'] = 'Group Class';
         }
        
        $isInstituteClass = !empty($classdetails[0]->institute_id);
$data['is_institute_class'] = $isInstituteClass;

$isRegisteredToInstitute = false;

if ($isInstituteClass && isset($_SESSION['USER']['account_id'])) {

    $studentModel = new Student();
    $student = $studentModel->first([
        'account_id' => $_SESSION['USER']['account_id']
    ]);

    if ($student) {
        $studentInstituteModel = new StudentInstituteModel();
        $record = $studentInstituteModel->first([
            'student_id' => $student->student_id,
            'institute_id' => $classdetails[0]->institute_id
        ]);

        $isRegisteredToInstitute = $record ? true : false;
    }
}

$data['is_registered_to_institute'] = $isRegisteredToInstitute;

// --- TRIAL & PAYMENT LOGIC ---
$showFreeTrial = false;
$isTrialActive = false;
$allowPayment = true; // whether "Pay Now" can be clicked

if (isset($_SESSION['USER']['account_id'])) {
    $studentModel = new Student();
    $student = $studentModel->first([
        'account_id' => $_SESSION['USER']['account_id']
    ]);

    if ($student) {
        $enrollmentModel = new EnrollmentModel();
        $enrollment = $enrollmentModel->getEnrollment($student->student_id, $class_id);

        if (!$enrollment) {
            // Student never joined → show free trial
            $showFreeTrial = true;
            $allowPayment = true; // payment is clickable even before trial
        } else {
            if ($enrollment->status === 'trial') {
                $trialEndTime = strtotime($enrollment->trial_end);

                if ($trialEndTime >= time()) {
                    // Trial still active
                    $isTrialActive = true;
                    $showFreeTrial = true;
                    $allowPayment = false; // during trial, payment disabled
                } else {
                    // Trial expired → update status
                    $enrollmentModel->update($enrollment->enrollment_id, ['status' => 'expired'], 'enrollment_id');
                    $isTrialActive = false;
                    $showFreeTrial = false;
                    $allowPayment = true; // payment enabled after trial
                }
            } elseif ($enrollment->status === 'expired') {
                // Trial expired → payment enabled
                $showFreeTrial = false;
                $isTrialActive = false;
                $allowPayment = true;
            } else {
                // Paid enrollment → no trial
                $showFreeTrial = false;
                $isTrialActive = false;
                $allowPayment = false;
            }
        }
    }
}

// Pass to view
$data['showFreeTrial'] = $showFreeTrial;
$data['is_trial_active'] = $isTrialActive;
$data['allowPayment'] = $allowPayment;


$showFreeTrial = false;

if (isset($_SESSION['USER']['account_id'])) {
    $studentModel = new Student();
    $student = $studentModel->first([
        'account_id' => $_SESSION['USER']['account_id']
    ]);

    if ($student) {
        $enrollmentModel = new EnrollmentModel();
        $enrollment = $enrollmentModel->getEnrollment($student->student_id, $class_id);

        if (!$enrollment) {
            // First time joining
            $showFreeTrial = true;
        } elseif ($enrollment->status === 'trial') {
            $trialEnd = strtotime($enrollment->enrollment_date . ' +14 days');
            if (time() <= $trialEnd) {
                $showFreeTrial = true;
            }
        }
    }
}

$data['showFreeTrial'] = $showFreeTrial;




        
        
        $teacherModel = new Teacher();
        $teacherId = $classdetails[0]->teacher_id;
        $teacherdetails = $teacherModel ->where(['teacher_id' => $teacherId]);
        $data['teacher_details'] =  $teacherdetails;

        $ClassScheduleModel = new ClassScheduleModel();
        $classID = $classdetails[0]->class_id;
        $Scheduledetails = $ClassScheduleModel ->where(['class_id' => $class_id]);
        $data['Schedule_details'] = $Scheduledetails;
       
        $ClassObjectiveModel = new ClassObjectiveModel();
        $classID = $classdetails[0]->class_id;
        $Objectivedetails = $ClassObjectiveModel ->where(['class_id' => $class_id]);
        $data['Objective_details'] = $Objectivedetails;
       
        //Star rating
        
        $ratingModel = new ClassRatingsModel();

        $ratings = $ratingModel->where(['class_id' => $class_id]);

        $totalRatings = count($ratings);
        $sumRatings = 0;
        $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings as $r) {
        $sumRatings += $r->rating;
        $ratingCounts[$r->rating]++;
        }

        $averageRating = $totalRatings ? round($sumRatings / $totalRatings, 1) : 0;

        $ratingPercentages = [];
        foreach ($ratingCounts as $star => $count) {
          $ratingPercentages[$star] = $totalRatings ? round(($count / $totalRatings) * 100) : 0;
        }
        
        $data['average_rating'] = $averageRating;
        $data['total_ratings'] = $totalRatings;
        $data['rating_percentages'] = $ratingPercentages;

        //Review 
       $reviewModel = new ClassRatingsModel();
       $reviews = $reviewModel->where(['class_id' => $class_id]);
       $studentModel = new Student();

       foreach ($reviews as $r) {
       $student = $studentModel->first(['account_id' => $r->account_id]);

       if ($student) {
        $r->username = $student->first_name . " " . $student->last_name;
      } else {
        $r->username = "Student";
      }
}

       $data['reviews'] = $reviews;


        $this->view('class', $data);
    }


    public function submit_review()
 {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        

        if (!isset($_SESSION['USER']['account_id'])) {
        $_SESSION['error'] = 'You must be logged in to submit a review.';
        header("Location: " . ROOT . "/ClassPage?id=" . $_POST['class_id']);
        exit;
        }

        $reviewModel = new ClassRatingsModel();

        $reviewdata = [
            'class_id'    => $_POST['class_id'],
            'account_id'     => $_SESSION['USER']['account_id'],
            'review_text' => $_POST['review_text'] ?? NULL,
            'rating'      => 0,
            'created_at' => date('Y-m-d H:i:s')

        ];

        if (!$reviewModel->validate($reviewdata)) {
            $_SESSION['error'] = implode(', ', $reviewModel->validation_errors);
            header("Location: " . ROOT . "/ClassPage?id=" . $_POST['class_id']);
            exit;
        }


        $reviewModel->insert($reviewdata);

        $_SESSION['success'] = 'Review submitted successfully!';
        header("Location: " . ROOT . "/ClassPage?id=" . $_POST['class_id']);
        exit;
    }
 }

 public function save_rating()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['USER']['account_id'])) {
        $_SESSION['error'] = 'You must be logged in to submit a review.';
        header("Location: " . ROOT . "/ClassPage?id=" . $_POST['class_id']);
        exit;
        }

        $ratingModel = new ClassRatingsModel();

        $data = [
            'class_id'   => $_POST['class_id'],
            'account_id' => $_SESSION['USER']['account_id'],
            'rating'     => $_POST['rating'],
        ];
         

        
        // if user already rated, update instead of insert
        $existing = $ratingModel->first([
            'class_id'   => $_POST['class_id'],
            'account_id' => $_SESSION['USER']['account_id']
        ]);

        if ($existing) {
            $ratingModel->update($existing->rating_id, ['rating' => $_POST['rating']], 'rating_id');
        } else {
 
            $ratingModel->insert($data);
        } 


        echo json_encode(['status' => 'success', 'message' => 'Rating saved']);
        exit;
    }
  }

  public function startTrial($class_id = null)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Ensure the student is logged in
        if (!isset($_SESSION['USER']['account_id'])) {
            $_SESSION['error'] = "You must be logged in to start a free trial.";
            header("Location: " . ROOT . "/ClassPage?id=" . $class_id);
            exit;
        }

        $studentModel = new Student();
        $student = $studentModel->first([
            'account_id' => $_SESSION['USER']['account_id']
        ]);

        if (!$student) {
            $_SESSION['error'] = "Student not found.";
            header("Location: " . ROOT . "/ClassPage?id=" . $class_id);
            exit;
        }

        $enrollmentModel = new EnrollmentModel();

        // Check if already enrolled
        $existing = $enrollmentModel->getEnrollment($student->student_id, $class_id);
        if ($existing) {
            $_SESSION['error'] = "You are already enrolled in this class.";
            header("Location: " . ROOT . "/StudentProfile#my-courses");
            exit;
        }

        // Start trial
        $enrollmentModel->startFreeTrial($student->student_id, $class_id);

        $_SESSION['success'] = "Free trial started successfully!";
        header("Location: " . ROOT . "/StudentProfile#my-courses");
        exit;
    }
}



public function applyFreeCard()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_SESSION['USER']['account_id'])) {
            $_SESSION['error'] = "You must be logged in to apply for a free card.";
            header("Location: " . ROOT);
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

        if (!isset($_FILES['proof_document']) || $_FILES['proof_document']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "Please upload a valid document.";
            header("Location: " . ROOT);
            exit;
        }

        // Handle file upload
        $uploadDir = __DIR__ . '/../public/uploads/students/free_cards/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = time() . '_' . basename($_FILES['proof_document']['name']);
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['proof_document']['tmp_name'], $targetFile)) {

            $applicationModel = new FreeCardApplication();

            $data = [
                'student_id' => $student->student_id,
                'documentation_path' => 'public/uploads/students/free_cards/' . $filename,
                'status' => 'pending',
                'application_date' => date('Y-m-d')
            ];

            if ($applicationModel->insert($data)) {
                $_SESSION['success'] = "Free card application submitted successfully!";
            } else {
                $_SESSION['error'] = "Failed to save your application. Try again.";
            }

        } else {
            $_SESSION['error'] = "Failed to upload the document.";
        }

        $class_id = $_POST['class_id'] ?? null; // get the class ID from the form
header("Location: " . ROOT . "/ClassPage?id=" . $class_id);
exit;

    }
}



}

