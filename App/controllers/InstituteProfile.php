<?php

class InstituteProfile  extends Controller
{
    public function index()
    {
        $institute = new Institute();
        $classes = new ClassModel();
        $students = new Student();
        $communities =  new ClassCommunity();

        $institute_id = $_SESSION['USER']['institute_id'];

        $section = $_GET['section'] ?? 'setting';


        //Fetch institute info
        $instituteData = $institute->first(['institute_id' => $institute_id]);
        $instituteName = $instituteData->institute_name;
        $avatar = strtoupper($instituteData->institute_name[0]);


        //Fetch number of classes
        $totalClasses = $classes->count(['institute_id' => $institute_id]); 

        //Fetch number of teachers
        $totalTeachers = $classes->countTeachersByInstitutes($institute_id);   


        //Fetch number of students
        $totalStudents = $classes->countStudentsByInstitute($institute_id);

        //Update Profile pic
        $avatarImage = (!empty($instituteData->logo_path)) ? ROOT . "/uploads/institutes/" . $instituteData->logo_path : null;

        //My classes section
        $instituteClasses = $classes->getClassesByInstituteWithTeacher($institute_id);

        //List and search communities by teacher id
        $section = $_GET['section'] ?? 'community';
        
        
        $searchKeyword = $_GET['search'] ?? null; // FIXED: $_GET not $GET
        $communitiesList = [];

            if ($searchKeyword ) {
                // Make sure this method exists in your ClassCommunity model
                $communitiesList = $communities->searchInstituteCommunities($institute_id, $searchKeyword);
            } else {
                $communitiesList = $communities->getCommunitiesByInstitute($institute_id);
            }

        

        $this->view('institute_profile',[


            'institute' => $instituteData,
            'instituteName' => $instituteName,
            'avatar' => $avatar,
            'avatarImage' => $avatarImage,
            'totalClasses' => $totalClasses,
            'totalTeachers' => $totalTeachers,
            'totalStudents' => $totalStudents,
            'instituteClasses' => $instituteClasses,
            'section' => $section,
            'communities' => $communitiesList
        ]);
    }

    public function uploadPhoto(){



    if(isset($_FILES['logo_path']['name']) && !empty($_FILES['logo_path']['name'])){

        if ($_FILES['logo_path']['error'] !== 0) {
            echo "File upload error: " . $_FILES['logo_path']['error'];
            exit;
        }

        $institute = new Institute();
        $institute_id = $_SESSION['USER']['institute_id'];

        // Upload folder
        $folder = __DIR__ . "/../../Public/uploads/institutes/";
        if (!file_exists($folder)){
            mkdir($folder, 0777, true);
        }

        // File name
        $fileName = time() . "_" . $_FILES['logo_path']['name'];
        $targetPath = $folder . $fileName;

        // Save file
        if (move_uploaded_file($_FILES['logo_path']['tmp_name'], $targetPath)){
 
            // Update DB
            $institute->updateByInstituteId(
                $institute_id,
                ['logo_path' => $fileName]
            );

            redirect('InstituteProfile?section=edit-profile');

        } else {
            echo "Failed to move uploaded file.";
            exit;
        }

    } else {
        redirect('InstituteProfile?section=edit-profile');
    }
}

public function updateProfile(){
    $institute = new Institute();

    $institute_id = $_SESSION['USER']['institute_id'];

    $data = [
        'institute_name' => $_POST['institute_name'],
        'location' => $_POST['location'],
        'contact_email' => $_POST['contact_email'],
        'contact_phone' => $_POST['contact_phone'],
        'open_time' => $_POST['open_time']
    ]; 

    //Validate using Institute model rules
    if(!$institute->validateProfileUpdate($data)){

        //Pass validation errors back to view
        $_SESSION['errors'] = $institute->validation_errors;
        return;

    }

    //Update database
    $institute->updateByInstituteId($institute_id, $data);

    redirect('InstituteProfile?section=edit-profile');


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
                'institute_id' => $_SESSION['USER']['institute_id'],
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

        

            redirect('InstituteProfile?section=community');
        }
    }


}
