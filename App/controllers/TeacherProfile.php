<?php

class TeacherProfile extends Controller
{
    public function index()
    {
        // 1️⃣ Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2️⃣ Check login
        if (!isset($_SESSION['USER'])) {
            redirect('login');
            exit();
        }

        $teacher = new Teacher();
        $classes = new ClassModel();
        $students = new Student();
        $eventModel = new Event();
        $enrollmentModel = new EnrollmentModel();
        $community = new CommunityModel();
        $accountModel = new Account();
        $paymentModel = new PaymentModel();
        $scheduleModel   = new ClassScheduleModel();


        $teacher_id = $_SESSION['USER']['teacher_id'];
        $accountId = $_SESSION['USER']['account_id'];

        // Fetch teacher info
        $teacherData = $teacher->first(['teacher_id' => $teacher_id]);
        $teacherName = $teacherData->first_name . ' ' . $teacherData->last_name;
        $avatar = strtoupper($teacherData->first_name[0] . $teacherData->last_name[0]);


        if (!empty($teacherData->account_id)) {
            $accountData = $accountModel->first(['account_id' => $teacherData->account_id]);
            
            $teacherData->email = $accountData ? $accountData->email : '';
        } else {
            $teacherData->email = '';
        }

        // Fetch number of classes (Keep this for the stats card)
        $totalClasses = $classes->count(['teacher_id'=> $teacher_id]);

        
        

        // Fetch number of students
        $totalStudents = $enrollmentModel->countStudentsforTeachers($teacher_id);

        // Update Profile pic
        $avatarImage = (!empty($teacherData->profile_photo_path)) ? ROOT . "/" . $teacherData->profile_photo_path : null;

        // communityDetails
        $communityDetails = $community->where(['owner_id'=> $accountId]);

        //teacherClasses
        $teacherClasses = $classes->where(['teacher_id'=> $teacher_id]);

        foreach ($teacherClasses as $class) {

            // 1) enrolled student count (real count)
            $enrolls = $enrollmentModel->where(['class_id' => $class->class_id]);
            $class->studentCount = is_array($enrolls) ? count($enrolls) : 0;

            // 2) schedule row for this class
            $sch = $scheduleModel->first(['class_id' => $class->class_id]);

            if ($sch) {
                $class->day = $sch->day_of_week;      // Monday
                $class->start_time = $sch->start_time; // 08:00:00
                $class->end_time   = $sch->end_time;   // 12:00:00
            } else {
                $class->day = null;
                $class->start_time = null;
                $class->end_time = null;
            }

            // 3) type (optional if you already have class_type)
            $class->class_type = empty($class->institute_id) ? 'individual' : 'institute';
        }

        $section = $_GET['section'] ?? 'setting';
        $validation_errors = $_SESSION['validation_errors'] ?? [];
        unset($_SESSION['validation_errors']);

        // Fetch Events
        $events = $eventModel->where(['account_id' => $accountId]);
        if (!$events) $events = [];


        // profit 
        $SelectMonth = $_GET['month'] ?? date('Y-m');
        $monthEnd    = date('Y-m-t', strtotime($SelectMonth . '-01'));

        $maxRevenue = 0;

        // split classes
        $individualClasses = array_values(array_filter($teacherClasses, fn($c) => empty($c->institute_id)));
        $instituteClasses  = array_values(array_filter($teacherClasses, fn($c) => !empty($c->institute_id)));

        // -------------------- INDIVIDUAL --------------------
        $individualRevenue = 0;
        $individualClassRevenues = [];
        $individualUnpaidStd = [];

        foreach ($individualClasses as $class) {

            $classTotal = 0;

            $classEnrollments = $enrollmentModel->where(['class_id' => $class->class_id]);
            $enrollCount = count($classEnrollments);

            // expected (max) for this individual class
            $maxRevenue += $enrollCount * (float)$class->monthly_fee;

            foreach ($classEnrollments as $enrollment) {

                $payments = $paymentModel->where([
                    'enrollment_id' => $enrollment->enrollment_id,
                    'status' => 'completed'
                ]);

                // collected in selected month
                foreach ($payments as $p) {
                    if (!empty($p->payment_date) && date('Y-m', strtotime($p->payment_date)) === $SelectMonth) {
                        $amt = (float)$p->amount;
                        $classTotal += $amt;
                        $individualRevenue += $amt;
                    }
                }

                // latest paid_until
                $latestPaidUntil = null;
                foreach ($payments as $p) {
                    if (!empty($p->paid_until)) {
                        if ($latestPaidUntil === null || $p->paid_until > $latestPaidUntil) {
                            $latestPaidUntil = $p->paid_until;
                        }
                    }
                }

                // unpaid if not covered to month end
                if ($latestPaidUntil === null || $latestPaidUntil < $monthEnd) {
                    $studentRow = $students->first(['student_id' => $enrollment->student_id]);
                    $stdName = $studentRow ? trim(($studentRow->first_name ?? '') . ' ' . ($studentRow->last_name ?? '')) : '';

                    $individualUnpaidStd[] = (object)[
                        'class_name'      => $class->class_name,
                        'std_name'        => $stdName,
                        'type'            => 'individual',
                        'last_paid_until' => $latestPaidUntil,
                    ];
                }
            }

            $individualClassRevenues[] = (object)[
                'class_id'   => $class->class_id,
                'class_name' => $class->class_name,
                'revenue'    => $classTotal
            ];
        }

        // -------------------- INSTITUTE --------------------
        $instituteRevenue = 0;
        $instituteClassRevenues = [];
        $instituteUnpaidStd = [];

        foreach ($instituteClasses as $class) {

            $paymentsCount = 0;

            $classEnrollments = $enrollmentModel->where(['class_id' => $class->class_id]);
            $enrollCount = count($classEnrollments);

           
            $maxRevenue += $enrollCount * (float)$class->teacher_fee;

            foreach ($classEnrollments as $enrollment) {

                $payments = $paymentModel->where([
                    'enrollment_id' => $enrollment->enrollment_id,
                    'status' => 'completed'
                ]);

                // count payments in selected month (cash-in-month)
                foreach ($payments as $p) {
                    if (!empty($p->payment_date) && date('Y-m', strtotime($p->payment_date)) === $SelectMonth) {
                        $paymentsCount++;
                    }
                }

                // latest paid_until
                $latestPaidUntil = null;
                foreach ($payments as $p) {
                    if (!empty($p->paid_until)) {
                        if ($latestPaidUntil === null || $p->paid_until > $latestPaidUntil) {
                            $latestPaidUntil = $p->paid_until;
                        }
                    }
                }

                // unpaid if not covered to month end
                if ($latestPaidUntil === null || $latestPaidUntil < $monthEnd) {
                    $studentRow = $students->first(['student_id' => $enrollment->student_id]);
                    $stdName = $studentRow ? trim(($studentRow->first_name ?? '') . ' ' . ($studentRow->last_name ?? '')) : '';

                    $instituteUnpaidStd[] = (object)[
                        'class_name'      => $class->class_name,
                        'std_name'        => $stdName,
                        'type'            => 'institute',
                        'last_paid_until' => $latestPaidUntil,
                    ];
                }
            }

            // collected institute revenue = paymentsCount * teacher_fee
            $classRevenue = $paymentsCount * (float)$class->teacher_fee;
            $instituteRevenue += $classRevenue;

            $instituteClassRevenues[] = (object)[
                'class_id'   => $class->class_id,
                'class_name' => $class->class_name,
                'revenue'    => $classRevenue
            ];
        }

        $totalRevenue = $individualRevenue + $instituteRevenue;



        $data = [
            'events' => $events,
            'teacher' => $teacherData,
            'teacherName' => $teacherName,
            'avatar' => $avatar,
            'totalClasses' => $totalClasses,
            'totalStudents' => $totalStudents,
            'avatarImage' => $avatarImage,
            'section' => $section,
            'validation_errors' => $validation_errors,
            'teacherClasses' => $teacherClasses, 
            'community_details' => $communityDetails,
            'selectedMonth'  => $SelectMonth,
            'individualRevenue' => $individualRevenue,
            'instituteRevenue' => $instituteRevenue,
            'totalRevenue' => $totalRevenue,
            'maxRevenue' => $maxRevenue,
            'individualClassRevenues' => $individualClassRevenues,
            'instituteClassRevenues' => $instituteClassRevenues,
            'individualUnpaidStd' => $individualUnpaidStd,
            'instituteUnpaidStd' => $instituteUnpaidStd
        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        

        $this->view('teacher_profile', $data);
    }
        public function uploadPhoto()
{
    if (!isset($_SESSION['USER']['teacher_id'])) {
        redirect('login');
    }

    $teacher_id = $_SESSION['USER']['teacher_id'];
    $teacher = new Teacher();

    $uploadedFiles = handleFileUploads('profile_photo', 'teacher'); 

    if (!empty($uploadedFiles)) {
        $newLogo = $uploadedFiles[0];
        $data = [
            'profile_photo_path' => $newLogo
        ];
        $teacher->update($teacher_id, $data, 'teacher_id');
    }
    redirect('TeacherProfile?section=edit-profile');
}

    public function updateProfile()
    {
        $teacher = new Teacher();

        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
        ];

        if (!$teacher->validateUpdate($data)) {
            $_SESSION['validation_errors'] = $teacher->validation_errors;
            redirect('TeacherProfile?section=edit-profile');
        }

        $teacher_id = $_SESSION['USER']['teacher_id'];
        $teacher->updateByTeacherId($teacher_id, $data);

        redirect('TeacherProfile?section=edit-profile');
    }

public function communityCreate()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['USER']['account_id'])) {
        redirect('signup');
        exit;
    }

    $community = new CommunityModel();
    $communityMember = new CommunityMemberModel();
    $enrollmentModel = new EnrollmentModel();
    $classModel = new ClassModel();

    $classId = $_POST['class_id'];

    $class = $classModel->first([
        'class_id' => $classId
    ]);

    if (!$class) {
        redirect('TeacherProfile?error=invalid_class');
        exit;
    }

    $commId = $community->insertAndGetId([
        'owner_id'    => $_SESSION['USER']['account_id'],
        'name'        => $_POST['communityName'],
        'description' => $_POST['communityDesc'],
        'type'        => 'institute_class',
        'class_id'    => $classId
    ]);

    // Add teacher as owner
    $communityMember->insert([
        'community_id' => $commId,
        'user_id'      => $_SESSION['USER']['account_id'],
        'role'         => 'owner'
    ]);

    // Add students
    $classMembers = $enrollmentModel->where(['class_id' => $classId]);

    if ($classMembers) {
        foreach ($classMembers as $member) {
            $communityMember->insert([
                'community_id' => $commId,
                'user_id'      => $member->student_account_id,
                'role'         => 'member'
            ]);
        }
    }

    redirect('TeacherProfile?section=community');
    exit;
}

public function deleteCommunity()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 1️⃣ Validate input
    $community_id = $_GET['id'] ?? null;
    if (!$community_id || empty($_SESSION['USER']['account_id'])) {
        redirect('TeacherProfile?section=community');
        exit;
    }

    // 2️⃣ Initialize models
    $communityModel = new CommunityModel();
    $memberModel    = new CommunityMemberModel();
    $postModel      = new CommunityPostModel();
    $replyModel     = new CommunityPostReplyModel();
    $messageModel   = new CommunityMessageModel();

    // 3️⃣ Ownership check (VERY IMPORTANT)
    $community = $communityModel->first([
        'id' => $community_id,
        'owner_id' => $_SESSION['USER']['account_id']
    ]);

    if (!$community) {
        redirect('TeacherProfile?error=unauthorized');
        exit;
    }

    // 4️⃣ Delete replies → posts
    $posts = $postModel->where(['community_id' => $community_id]);
    if ($posts) {
        foreach ($posts as $post) {
            $replyModel->delete(['post_id' => $post->id]);
        }
    }

    // 5️⃣ Delete posts
    $postModel->delete(['community_id' => $community_id]);

    // 6️⃣ Delete messages
    $messageModel->delete(['community_id' => $community_id]);

    // 7️⃣ Delete members
    $memberModel->delete(['community_id' => $community_id]);

    // 8️⃣ Delete community
    $communityModel->delete(['id' => $community_id]);

    redirect('TeacherProfile?section=community');
    exit;
}

}