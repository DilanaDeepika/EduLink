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

        $allTeacher   = $teacher->where([]);
        $teacherCount = count($allTeacher);

        $allInstitute = $institute->where([]);
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

        $data["home_request_details"] = $homeReqDetails;
        $data["comm_request_details"] = $commReqDetails;


    //    $conflict = $adReq->checkConflict(
    //     $_POST['placement_option'],
    //     $_POST['start_datetime'],
    //     $_POST['end_datetime']
    // );

         // data for the community 

         $community = new CommunityModel();
         $communityDetails = $community->where(['owner_id'=> $_SESSION['USER']['account_id']]);
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
}


