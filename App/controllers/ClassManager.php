<?php

class ClassManager extends Controller
{
    public function index()
    {
      
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['USER'])) {
            redirect('login');
            exit();
        }

        $role = $_SESSION['USER']['role'] ?? null; 
        $classModel = new ClassModel();
        $adModel = new AdvertisementRequest(); 
        $classes = [];
        $ads = [];
        $enrolls =[];
        $data =[]; 

        if ($role === 'teacher' && isset($_SESSION['USER']['teacher_id'])) {
            $teacherId = $_SESSION['USER']['teacher_id'];
            $classes = $classModel->where(['teacher_id' => $teacherId]);
            $ads = $adModel->where(['account_id' => $_SESSION['USER']['account_id']]);
            $data['classes'] = $classes;
            $data['ads'] = $ads;
            $this->view('teacher_class_dashboard', $data);

        } elseif ($role === 'institute' && isset($_SESSION['USER']['institute_id'])) {
            $instituteId = $_SESSION['USER']['institute_id'];
            $classes = $classModel->where(['institute_id' => $instituteId]);
            $ads = $adModel->where(['account_id' => $_SESSION['USER']['account_id']]);
            $data['classes'] = $classes;
            $data['ads'] = $ads;
            $this->view("institute_class_dashboard", $data);

        } elseif ($role === 'student' && isset($_SESSION['USER']['student_id'])) {
            $studentId = $_SESSION['USER']['student_id'];
            
    
            $enrollmentModel = new EnrollmentModel();
            $enrolls = $enrollmentModel->where(['student_id'=>$studentId]);

       
            $enrolledClasses = [];

            if (!empty($enrolls)) {
                if (is_object($enrolls[0])) {
                    $enrolls = json_decode(json_encode($enrolls), true);
                }
                
                foreach ($enrolls as $enrollment) {
                    $classId = $enrollment['class_id'];
                    
                    $classDetails = $classModel->first(['class_id' => $classId]);

                    if ($classDetails) {
                        if (is_object($classDetails)) {
                            $classDetails = (array) $classDetails;
                        }

                        $classDetails['enrollment_status'] = $enrollment['status'];
                        $enrolledClasses[] = $classDetails;
                    }
                }
            }
            
            $data['classes'] = $enrolledClasses;
            
            $this->view('student_class_dashboard', $data);
        }
    }

    public function leave_class($class_id)
    {
        if (session_status() === PHP_SESSION_NONE) 
            { 
                session_start(); 
            }

        if (!isset($_SESSION['USER']) || ($_SESSION['USER']['role'] ?? '') !== 'student' || !isset($_SESSION['USER']['student_id'])) {
            redirect('login');
            exit();
        }

        $studentId = $_SESSION['USER']['student_id'];
        $conditions = [
            'student_id' => $studentId,
            'class_id' => $class_id
        ];
        $enrollmentModel = new EnrollmentModel();
        $enrollmentModel->delete($conditions); 
        redirect("classManager");
    }

    public function save_advertisement_request()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (session_status() === PHP_SESSION_NONE) session_start();
            $adModel = new AdvertisementRequest();

            // Handle poster upload using the helper
            $uploadedFiles = handleFileUploads('ad_poster', 'ads');
            $posterPath = !empty($uploadedFiles) ? $uploadedFiles[0] : null;

            // Prepare data from POST inputs
            $data = [
                'account_id'        => $_SESSION['USER']['account_id'],
                'advertiser_contact' => $_POST['advertiser_contact'] ?? '',
                'placement_option'   => $_POST['placement'] ?? '',
                'start_time'         => $_POST['start_time'] ?? '',
                'end_time'           => $_POST['end_time'] ?? '',
                'poster_path'        => $posterPath,
                'status'             => 'Pending'
            ];

        if (empty($data['advertiser_contact']) || empty($data['placement_option'])) {
            $_SESSION['error'] = "Please fill in all required fields.";
            redirect('ClassManager/index');
            exit;
        }

         
            $adModel->insert($data);

            $_SESSION['success'] = "Advertisement request submitted successfully.";

            redirect('ClassManager/index');
        } else {
            redirect('ClassManager/index');
        }
    }

    public function delete_advertisement_request($ad_id)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

    
        if (!isset($_SESSION['USER'])) {
            redirect('login');
            exit();
        }

        $accountId = $_SESSION['USER']['account_id'] ?? null;

        if (!$accountId) {
            $_SESSION['error'] = "Unauthorized action.";
            redirect('ClassManager/index');
            exit();
        }

        
        $adModel = new AdvertisementRequest();

    
        $conditions = [
            'id' => $ad_id,           
            'account_id' => $accountId   
        ];

        $deleted = $adModel->delete($conditions);

        redirect('ClassManager/index');
    }

    //
    // --- THIS IS THE NEW FUNCTION YOU NEEDED ---
    //
    public function get_ad_details($ad_id = null)
    {
        header('Content-Type: application/json');

        if (!$ad_id) {
            echo json_encode(['success' => false, 'message' => 'No ID provided.']);
            exit;
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $accountId = $_SESSION['USER']['account_id'] ?? null;
        if (!$accountId) {
            echo json_encode(['success' => false, 'message' => 'Not logged in.']);
            exit;
        }

        $adModel = new AdvertisementRequest();
        
        // Security Check: Make sure the user owns this ad
        $ad = $adModel->first([
            'id' => $ad_id,
            'account_id' => $accountId
        ]);

        if ($ad) {
            echo json_encode(['success' => true, 'ad' => $ad]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ad not found or permission denied.']);
        }
        exit;
    }

    //
    // --- THIS IS THE CORRECTED, SECURE UPDATE FUNCTION ---
    //
    public function update_advertisement_request($ad_id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (session_status() === PHP_SESSION_NONE) session_start();

            // 1. Get User ID and Ad ID
            $accountId = $_SESSION['USER']['account_id'] ?? null;
            if (!$ad_id || !$accountId) {
                $_SESSION['error'] = "Invalid request.";
                redirect('ClassManager/index');
                exit;
            }

            $adModel = new AdvertisementRequest();

            // 2. SECURITY CHECK: Verify the user owns this ad
            $ad = $adModel->first([
                'id' => $ad_id,
                'account_id' => $accountId
            ]);

            if (!$ad) {
                $_SESSION['error'] = "Permission denied.";
                redirect('ClassManager/index');
                exit;
            }

            // 3. Handle file upload (if a new file is provided)
            $posterPath = null;
            if (!empty($_FILES['ad_poster']['name'])) {
                $uploadedFiles = handleFileUploads('ad_poster', 'ads');
                $posterPath = !empty($uploadedFiles) ? $uploadedFiles[0] : null;
            }

            // 4. Prepare data for update
            $data = [
                'placement_option' => $_POST['placement'] ?? '',
                'start_time'       => $_POST['start_time'] ?? '',
                'end_time'         => $_POST['end_time'] ?? '',
                'status'           => 'Pending' // Reset status on edit
            ];

            // Only add poster path to data if a new one was uploaded
            if ($posterPath) {
                $data['poster_path'] = $posterPath;
            }

            // 5. Update ad by ID using the correct function signature
            $adModel->update($ad_id, $data, 'id'); 

            $_SESSION['success'] = "Advertisement updated successfully.";
            redirect('ClassManager/index');
        } else {
            redirect('ClassManager/index');
        }
    }

}