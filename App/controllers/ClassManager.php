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
        $community = new CommunityModel();
        $classes = [];
        $ads = [];
        $enrolls =[];
        $data =[]; 



        if ($role === 'teacher' && isset($_SESSION['USER']['teacher_id'])) {
            $teacherId = $_SESSION['USER']['teacher_id'];
            $classes = $classModel->where(['teacher_id' => $teacherId]);
            $ads = $adModel->where(['account_id' => $_SESSION['USER']['account_id']]);
            $communityDetails = $community->where(['owner_id'=> 65]);
            $data["community_details"] = $communityDetails;
            $data['classes'] = $classes;
            $data['ads'] = $ads;

            // echo "<pre>";
            // print_r( $data);
            // echo "</pre>";
            // die();

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

    public function saveReq()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            
            if (session_status() === PHP_SESSION_NONE) session_start();
            $adModel = new AdvertisementRequest();

            // Handle poster upload using the helper
            $uploadedFiles = handleFileUploads('ad_poster', 'ads');
            $posterPath = !empty($uploadedFiles) ? $uploadedFiles[0] : null;


            $startDate = $_POST['start_date'] ?? '';
            $startTime = $_POST['start_time'] ?? '';
            $endDate   = $_POST['end_date'] ?? '';
            $endTime   = $_POST['end_time'] ?? '';
            $comId     = $_POST['community_id'] ?? null;
            $classId     = $_POST['class_id'] ?? null;

            $fullStartDatetime = ($startDate && $startTime) ? "$startDate $startTime:00" : null;
            $fullEndDatetime   = ($endDate && $endTime)     ? "$endDate $endTime:00"     : null;
            // Prepare data from POST inputs
            $data = [
                'account_id'      => $_SESSION['USER']['account_id'],
                'advertiser_name' => $_POST['advertiser_name'] ?? '', 
                'placement_option'=> $_POST['placement'] ?? '',
                'start_datetime'  => $fullStartDatetime,
                'end_datetime'    => $fullEndDatetime,
                'poster_path'     => $posterPath,
                'community_id'   => $comId,
                'class_id'       => $classId,
                'status'          => 'Pending',
                'description' => $_POST['description'] ?? null
            ];
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // die();



        if (empty($data['advertiser_name']) || empty($data['placement_option'])) {
            $_SESSION['error'] = "Please fill in all required fields.";
            redirect('ClassManager');
            exit;
        }

         
            $adModel->insert($data);

            $_SESSION['success'] = "Advertisement request submitted successfully.";


            
            redirect('ClassManager');
        } else {
            redirect('ClassManager');
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
            redirect('ClassManager');
            exit();
        }

        
        $adModel = new AdvertisementRequest();

    
        $conditions = [
            'id' => $ad_id,           
            'account_id' => $accountId   
        ];

        $deleted = $adModel->delete($conditions);

        redirect('ClassManager');
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

 public function getBookedSlots()
{
    $adModel = new AdvertisementRequest();
    
    $placement = $_GET['placement'] ?? 'homepage_poster'; 
    $community_id = $_GET['community_id'] ?? null;

    $conditions = [
        'placement_option' => $placement,
        'status' => 'Pending' 
    ];


    if ($placement === 'community_poster') {
        if (!$community_id) {
            echo json_encode([]); 
            exit;
        }
        $conditions['community_id'] = $community_id;
    }

    $bookings = $adModel->where($conditions);

    $bookedDB = [];

    if ($bookings) {
        foreach ($bookings as $booking) {
            $start = new DateTime($booking->start_datetime);
            $end   = new DateTime($booking->end_datetime);

            while ($start < $end) {
                $dateKey = $start->format('Y-m-d');
                $timeVal = $start->format('H:i');

                if (!isset($bookedDB[$dateKey])) $bookedDB[$dateKey] = [];
                if (!isset($bookedDB[$dateKey][$timeVal])) $bookedDB[$dateKey][$timeVal] = 0;

                // Increment the count for this hour
                $bookedDB[$dateKey][$timeVal]++;

                $start->modify('+1 hour');
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($bookedDB);
    exit;
}
}