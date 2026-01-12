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
        $communities = new ClassCommunity();
        $eventModel = new Event();

        $teacher_id = $_SESSION['USER']['teacher_id'];
        
         

        
        //Fetch teacher info
        $teacherData = $teacher->first(['teacher_id' => $teacher_id]);
        $teacherName = $teacherData->first_name . ' ' . $teacherData->last_name;
        $avatar = strtoupper($teacherData->first_name[0] . $teacherData->last_name[0]);

        //Fetch number of classes
        $totalClasses =$classes->count(['teacher_id'=> $teacher_id]);

        //Fetch number of students
        $totalStudents = $students->countStudentsforTeachers($teacher_id);

        //Monthly Revenue
        $classRevenues = $classes->getClassesByTeacher($teacher_id);
        $monthlyRevenue = 0;
        
        foreach ($classRevenues as $class) {
            $monthlyRevenue += $class->revenue;
    
        }

        //Update Profile pic
        $avatarImage = (!empty($teacherData->profile_photo)) ? ROOT . "/uploads/teachers/" . $teacherData->profile_photo : null;

        $section = $_GET['section'] ?? 'setting';

        $validation_errors= $_SESSION['validation_errors'] ?? [];
        unset($_SESSION['validation_errors']);

        //My Classes section
        $teacherClasses = $classes->getClassesByTeacher($teacher_id);

        //List and search communities by teacher id
        //$section = $_GET['section'] ?? 'community';
        
        
        $searchKeyword = $_GET['search'] ?? null; // FIXED: $_GET not $GET
        $communitiesList = [];

            if ($searchKeyword) {
                // Make sure this method exists in your ClassCommunity model
                $communitiesList = $communities->searchCommunities($teacher_id, $searchKeyword);
            } else {
                $communitiesList = $communities->getCommunitiesByTeacher($teacher_id);
            }

        
        
        
        

        /*Calendar: teacher-> classes in schedule
        $calendarEvents = [];
        foreach ($teacherClasses as $class) {
            $calendarEvents[] = [
                'id' => $class->class_id,
                'event_title' => $class->class_name,
                'event_date' => $class->start_date,
                'event_time' => $class->start_time ?? '',
                'url' => ROOT . "/Class/view/" . $class->class_id
            ];
        }*/

        $accountId = $_SESSION['USER']['account_id'];
    
        $eventModel = new Event();
        $events = $eventModel->where(['account_id' => $accountId]);

        // Ensure it's always an array
        if (!$events) $events = [];

        // 4️⃣ Pass events to the view
        $data['events'] = $events;
        
        $this->view('teacher_profile',[
            'teacher' => $teacherData,
            'teacherName' => $teacherName,
            'avatar' => $avatar,
            'totalClasses' => $totalClasses,
            'totalStudents' => $totalStudents,
            'monthlyRevenue' => $monthlyRevenue,
            'avatarImage' => $avatarImage,
            'section' => $section,
            'validation_errors' => $validation_errors,
            'teacherClasses' => $teacherClasses,
            'classRevenues' => $classRevenues,
            'communities' => $communitiesList,
            'events' => $events    

    
            
             
        ]);
    }
    public function uploadPhoto(){
        
        if(isset($_FILES['profile_photo']['name']) && !empty($_FILES['profile_photo']['name'])){

            if ($_FILES['profile_photo']['error'] !== 0) {
                echo "File upload error: " . $_FILES['profile_photo']['error'];
                exit;
            }

            $teacher = new Teacher();
            $teacher_id = $_SESSION['USER']['teacher_id'];

            //Upload folder
            $folder = __DIR__ . "/../../Public/uploads/teachers/";
            if (!file_exists($folder)){
                mkdir($folder, 0777, true);
            }
        

            //File Name
            $fileName = time() . "_" . $_FILES['profile_photo']['name'];
            $targetPath = $folder . $fileName;
        
            //Save File
            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $targetPath)){

                //Update database
                $teacher->updateByTeacherId($teacher_id, ['profile_photo' => $fileName]);

                redirect('TeacherProfile?section=edit-profile');
            }else {
                echo "Failed to move uploaded file.";
                exit;
            }
        }else {
        // File not uploaded, redirect to edit-profile
        redirect('TeacherProfile?section=edit-profile');
        }
        
        redirect('TeacherProfile?section=edit-profile');
    
        
    }

    public function updateProfile(){
        $teacher = new Teacher();

        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
        ];

        if(!$teacher->validateUpdate($data)){
            $_SESSION['validation_errors'] = $teacher->validation_errors;
            redirect('TeacherProfile?section=edit-profile');
        }

         $teacher_id = $_SESSION['USER']['teacher_id'];

        $teacher->updateByTeacherId($teacher_id,$data);

        redirect('TeacherProfile?section=edit-profile');
        
    }

    public function createCommunity()
    {



        $communities = new ClassCommunity();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $imageName = null;

            if(!empty($_FILES['image']['name'])){
                $folder = __DIR__ . "/../../Public/uploads/communities/";
                if (!file_exists($folder)){
                    mkdir($folder, 0777, true);
                }

                $imageName = time() . "_" . $_FILES['image']['name'];
                $targetPath = $folder . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
            }

            $data = [
                'teacher_id' => $_SESSION['USER']['teacher_id'],
                'community_name' => $_POST['community_name'],
                'description'=> $_POST['description'],
                'image'          => $imageName,
                'created_at' => date('Y-m-d H:i:s')
            ];

            if(!$communities->validate($data)){
                $_SESSION['validation_errors'] = $communities->validation_errors;
                redirect('TeacherProfile?section=community');
            }

            $communities->insert($data);

        

            redirect('TeacherProfile?section=community');
        }
    }

    

}