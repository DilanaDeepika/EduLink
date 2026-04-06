<?php

class Admin extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $data = [];

        $student   = new Student();
        $teacher   = new Teacher();
        $institute = new Institute();
        $class     = new ClassModel();
        $accountModel = new Account();

        $allTeacher   = $teacher->where([]);
        $pendingTeachers = $teacher->where(['approval_status' => 'pending']);
        $teacherCount = count($allTeacher);

        $allInstitute = $institute->where([]);
        $pendingInstitute = $institute->where(['approval_status' => 'pending']);
        $InstCount    = count($allInstitute);

        $allStudents = $student->where([]);
        $stdCount    = count($allStudents);

        $allClass   = $class->where([]);
        $classCount = count($allClass);

        $analyticsDetails = [
            $stdCount,
            $classCount,
            $InstCount,
            $teacherCount
        ];

        $data['analytics_details'] = $analyticsDetails;


        // data collect for chart

        $loginLog = new LoginLog();
        $LoginCounts = $loginLog-> getWeeklyLoginCounts();
        $data['Weekly_login_counts'] =  $LoginCounts;


        // data for the Advertiment request 

        $adReq = new AdvertisementRequest();
        $homeReqDetails = $adReq->where(['placement_option' => 'homepage_poster','status' => 'Pending'], [], [
            "start_datetime" => "ASC",
            "created_at" => "ASC"
        ]);

        $commReqDetails = $adReq->where(['placement_option' => 'community_poster'], [], [
            "start_datetime" => "ASC",
            "created_at" => "ASC"
        ]);


        foreach($pendingInstitute as $key => $singleInstitute){


        
            $pendingInstituteAcc = $accountModel->where(['account_id' => $singleInstitute->account_id]); 
            
            if(!empty($pendingInstituteAcc)) {
                
                $pendingInstitute[$key]->account_info = $pendingInstituteAcc[0]; 
            } else {
                $pendingInstitute[$key]->account_info = null;
            }
        }

        foreach($pendingTeachers as $key => $singleTeacher){
        
            $pendingTeacherAcc = $accountModel->where(['account_id' => $singleTeacher->account_id]); 
            
            if(!empty($pendingTeacherAcc)) {
                
                $pendingTeachers[$key]->account_info = $pendingTeacherAcc[0]; 
            } else {
                $pendingTeachers[$key]->account_info = null;
            }
        }

// Debug to see the result
// echo "<pre>";
// print_r($commReqDetails); 
// echo "</pre>";
// die;

        $data["institute_pending_req"] =  $pendingInstitute;
        $data["teacher_pending_req"] =  $pendingTeachers;

        $data["home_request_details"] = $homeReqDetails;
        $data["comm_request_details"] = $commReqDetails;


    //    $conflict = $adReq->checkConflict(
    //     $_POST['placement_option'],
    //     $_POST['start_datetime'],
    //     $_POST['end_datetime']
    // );

         // data for the community 

         $community = new CommunityModel();
         $communityDetails = $community->where(['owner_id'=> 65]);
         $data["community_details"] = $communityDetails;
         
        $this->view('admin', $data);
    }

        public function communityCreate(){

          if (session_status() === PHP_SESSION_NONE) {
            session_start();
          }
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['USER']['account_id'])){
            $community = new CommunityModel();
            $communityMember = new CommunityMemberModel();
            



             $dataForCommunity = [
            'owner_id'             => $_SESSION['USER']['account_id'],
            'name'             => $_POST['communityName'],
            'description'             => $_POST['communityDesc'],
            'type'             => 'global',
            'class_id'         => null
            ];

            $community->insert($dataForCommunity);
            $communityDetails = $community->where(['name'=> $_POST['communityName']]);

            $dataForMember =[
            'community_id'     => $communityDetails[0]->id,
            'user_id'         => $_SESSION['USER']['account_id'],
            'role'            => 'owner'
            ];

            $communityMember->insert($dataForMember);
            redirect('admin');

        }else{
            redirect('signup');
        }
    }

    public function reviewSend(){

        if (session_status() === PHP_SESSION_NONE) session_start();
        $adModel = new AdvertisementRequest();

        $status = $_POST['status'] ?? "";
        $price = $_POST['total_cost'] ?? null;
        $admin_message = $_POST['admin_message'] ?? "";
        $ad_id = $_POST['ad_id'] ?? 0;

        $date = [
            'status' => $status,
            'price'  => $price,
            'admin_message'  => $admin_message

        ];


        $adModel->update($ad_id,$date);
        redirect('admin');


    }

    public function aprovelSend(){


        if (session_status() === PHP_SESSION_NONE) session_start();

        $userModel = new Account();
        $teacherModel = new Teacher();
        $instituteModel = new Institute();


        $userId = $_POST['user_id'] ?? 0;
        $userEmail = $_POST['user_email'] ?? null;
        $status = $_POST['status']  ?? "";
        $adminMessage = $_POST['admin_message']  ?? "";

        $date = [
            'approval_status' => $status

        ];
        $checkType = $userModel->first(['account_id'=> $userId]);

        // didn't test mail part 
        if ($userEmail) {
            $subject = "EduLink Account Acception";

            if ($status == 'Rejected') {
                $message = "Hello,\n\nWe regret to inform you that your document submission for EduLink has been rejected.";
                
                if (!empty($adminMessage)) {
                    $message .= "\n\nReason from Admin:\n" . $adminMessage;
                }

                $message .= "\n\nPlease check your documents and try again.";
                
            } else if ($status == 'approved') {
                $message = "Hello,\n\nCongratulations! Your documents have been approved. You can now log in to your EduLink account.";
            }

            if ($message !== "") {
                $headers = "From: dilanasuwendra@gmail.com";
                
                mail($userEmail, $subject, $message, $headers);
            }
        }

        print_r($message);
        die();

        if($checkType){
            if($checkType->account_type == 'teacher'){
                $teacherModel->update($userId,$date,'account_id');
                redirect('admin');
            }else if($checkType->account_type == 'institute'){
                $instituteModel->update($userId,$date,'account_id');
                redirect('admin');
            }
        }
        






    }
}


