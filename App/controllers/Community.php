<?php

class Community extends Controller
{
    private $community_id = null;

    public function index()
    {
        $community_id = isset($_GET['community_id']) ? $_GET['community_id'] : null;

        if (!$community_id) {
            echo "Community ID is required";
            return;
        }
        if ($community_id) {
            $this->checkAndPostAds($community_id);
        }
        
        $community = new CommunityModel();
        $communityMember = new CommunityMemberModel();
        $post = new CommunityPostModel();

        $memCommunities = $communityMember->where(['user_id' => $_SESSION['USER']['account_id']]);

        $communityDetails = [];
        $postList = [];

        foreach ($memCommunities as $memCommunity) {

            $result = $community->where(['id' => $memCommunity->community_id]);

            if (!empty($result)) {

                // Store community details
                $communityDetails[] = $result[0];

                // If user is owner → collect posts
                if ($result[0]->owner_id == $_SESSION['USER']['account_id']) {

                    $posts = $post->where(['community_id' => $result[0]->id,'status' => 'pending']);

                    // Merge posts into main list
                    if (!empty($posts)) {
                        $postList = array_merge($postList, $posts);
                    }
                }
            }
        }

        $data['community_details'] = $communityDetails;
        $data['post_list'] = $postList;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();

        $this->view('community', $data);
    }

    

    public function fetchMessages() {
        header("Content-Type: application/json");

        $community_id = isset($_GET['community_id']) ? intval($_GET['community_id']) : 0;
        
        // Default to a very old date if no time is provided
        $last_time = isset($_GET['last_time']) ? $_GET['last_time'] : '1970-01-01 00:00:00';

        if (!$community_id) {
            echo json_encode([]);
            exit;
        }

        $communityMessage = new CommunityMessageModel();
        $communityPost = new CommunityPostModel();
        $accountModel = new Account();

        // 1. Fetch Messages
        $messages = $communityMessage->query(
            "SELECT id, user_id, message, created_at, 'message' as type 
                FROM community_messages 
                WHERE community_id = :cid AND created_at > :ltime ORDER BY created_at ASC",
            ['cid' => $community_id, 'ltime' => $last_time]
        );

        // 2. Fetch Posts
        $posts = $communityPost->query(
            "SELECT id, user_id, description as message, file_path, created_at, 'post' as type 
                FROM community_posts 
                WHERE community_id = :cid AND status = 'approved' AND created_at > :ltime",
            ['cid' => $community_id, 'ltime' => $last_time]
        );

        if (empty($messages)) $messages = [];
        if (empty($posts)) $posts = [];

        // 3. Merge
        $allContent = array_merge($messages, $posts);

        // 4. Sort
        usort($allContent, function($a, $b) {
            return strtotime($a->created_at) - strtotime($b->created_at);
        });

        // 5. Add Usernames
        foreach ($allContent as &$item) {
            $account = $accountModel->where(['account_id' => $item->user_id]);
            
            if (!$account || !isset($account[0])) {
                $item->username = "Unknown";
                continue;
            }
            $account = $account[0];

            $name = '';
            switch ($account->account_type) {
                case 'student':
                    $studentModel = new Student();
                    $user = $studentModel->where(['account_id' => $item->user_id]);
                    if ($user && isset($user[0])) { $user = $user[0]; $name = $user->first_name . ' ' . $user->last_name; }
                    break;
                case 'teacher':
                    $teacherModel = new Teacher();
                    $user = $teacherModel->where(['account_id' => $item->user_id]);
                    if ($user && isset($user[0])) { $user = $user[0]; $name = $user->first_name . ' ' . $user->last_name; }
                    break;
                case 'institute':
                    $instituteModel = new Institute();
                    $user = $instituteModel->where(['account_id' => $item->user_id]);
                    if ($user && isset($user[0])) $name = $user[0]->institute_name;
                    break;
                case 'admin':
                    $name = $account->email;
                    break;
            }
            $item->username = $name; 
        } // End Foreach Loop

        // 6. Send Response
        echo json_encode($allContent);
        exit;
    } // End Function

    public function sendMessage()
    {


        // Get JSON input
        $data = json_decode(file_get_contents("php://input"), true);

        $community_id = isset($data['community_id']) ? intval($data['community_id']) : 0;
        $user_id = isset($data['user_id']) ? intval($data['user_id']) : 0;
        $message = isset($data['message']) ? trim($data['message']) : '';

        if (!$community_id || !$user_id || $message === '') {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid input']);
            return;
        }

        $communityMessage = new CommunityMessageModel();

        $data = [
            'community_id' => $community_id,
            'user_id' => $user_id,
            'message' => $message
        ];
        // Insert new message into the database
          $insertedId = $communityMessage-> insertAndGetId($data);

        if ($insertedId) {
            echo json_encode(['success' => true, 'id' => $insertedId]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to send message']);
        }
    }


    public function postSend(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['USER']['account_id'])) {
            $uploadedFiles = handleFileUploads('attachment', 'community_post');
            $filePaths = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

            $createPost = new CommunityPostModel();
            $data=[
                'community_id'   =>  $_GET['community_id'],
                'user_id'        =>  $_SESSION['USER']['account_id'],
                'name'           =>  $_POST['name'],
                'description'    =>  $_POST['description'],
                'file_path'      =>  $filePaths,
                'status'         =>  ('admin' == $_SESSION['USER']['role'])? 'approved': 'pending'

                ];

            $createPost->insert($data);
            redirect( "/community?community_id=" . $_GET['community_id']);

        }else{
            redirect('signup');
        }
    }
        public function approvedPost(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $postId = $_POST['post_id']; 
                $status = $_POST['status'];  

                $data = [
                    'status' => $status,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $commId = isset($_POST['comm_id']) ?? null;

                $CommunityPostModel = new CommunityPostModel(); 
                $CommunityPostModel->update($postId, $data,);

                redirect("/community?community_id=" . $commId);
        }

    }


    // 1. Submit a Comment
    public function submitComment() {
        // echo "<pre>";
        // print_r("submit Comment");
        // echo "</pre>";
        // die();

        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!isset($data['post_id']) || !isset($data['comment'])) {
            echo json_encode(['error' => 'Invalid input']);
            return;
        }

        $replyModel = new CommunityPostReplyModel();
        
        $insertData = [
            'post_id' => intval($data['post_id']),
            'user_id' => $_SESSION['USER']['account_id'],
            'reply' => trim($data['comment'])
        ];

        if($replyModel->insert($insertData)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed']);
        }
    }

    // 2. Fetch Comments for a specific Post
    public function getComments() {
        $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
        // echo "<pre>";
        // print_r( $post_id);
        // echo "</pre>";
        // die();
        $replyModel = new CommunityPostReplyModel();
        $accountModel = new Account();

        // Fetch comments for this post
        $comments = $replyModel->where(['post_id' => $post_id]);
        
        if(!$comments) {
            echo json_encode([]);
            return;
        }

        // Add User Names (Simpler version of your existing logic)
        foreach($comments as &$c) {
            $user = $accountModel->where(['account_id' => $c->user_id]);
            if($user) {
                // For simplicity, using email or first part of email as name
                // You can copy your full switch/case logic here if you want perfect names
                $c->username = explode('@', $user[0]->email)[0]; 
            } else {
                $c->username = "Unknown";
            }
        }

        echo json_encode($comments);
    }

    public function getMembers() {
        header("Content-Type: application/json");
        $community_id = isset($_GET['community_id']) ? intval($_GET['community_id']) : 0;

        if (!$community_id) { echo json_encode([]); exit; }

        $memberModel = new CommunityMemberModel();
        $accountModel = new Account();
        
        // 1. Get all members of this community
        $members = $memberModel->where(['community_id' => $community_id]);
        
        if(!$members) { echo json_encode(['count'=>0, 'list'=>[]]); exit; }

        $memberList = [];

        // 2. Loop and find names (Reusing your logic)
        foreach ($members as $mem) {
            $account = $accountModel->where(['account_id' => $mem->user_id]);
            if (!$account) continue;
            $account = $account[0];

            $name = "Unknown";
            $role = $account->account_type;

            switch ($role) {
                case 'student':
                    $s = new Student();
                    $u = $s->where(['account_id' => $mem->user_id]);
                    if($u) $name = $u[0]->first_name . ' ' . $u[0]->last_name;
                    break;
                case 'teacher':
                    $t = new Teacher();
                    $u = $t->where(['account_id' => $mem->user_id]);
                    if($u) $name = $u[0]->first_name . ' ' . $u[0]->last_name;
                    break;
                case 'institute':
                    $i = new Institute();
                    $u = $i->where(['account_id' => $mem->user_id]);
                    if($u) $name = $u[0]->institute_name;
                    break;
                case 'admin':
                    $name = "Admin";
                    break;
            }

            $memberList[] = [
                'name' => $name,
                'role' => ucfirst($role) // Capitalize role (e.g., Student)
            ];
        }

        echo json_encode([
            'count' => count($memberList),
            'list' => $memberList
        ]);
        exit;
    }


    // In app/controllers/Community.php

private function checkAndPostAds($community_id) {
    $adModel = new AdvertisementRequest();
    $postModel = new CommunityPostModel(); 
    
    $pendingAds = $adModel->where([
        'community_id'      => $community_id,
        'placement_option'  => 'community_poster',
        'status'            => 'Active',
        'is_posted'         => 0
    ]);

    $currentDate = date('Y-m-d H:i:s');

    if ($pendingAds) {
        foreach ($pendingAds as $ad) {
            if ($ad->start_datetime <= $currentDate) {
                
                $postData = [
                    'name'         => $ad->advertiser_name,
                    'community_id' => $ad->community_id,
                    'user_id'      => $ad->account_id,
                    'description'      => $ad->description ?? "none",
                    'file_path'        => $ad->poster_path, 
                    'status'           => 'approved'
                ];
                
                // Save the post
                $postModel->insert($postData);

                // 3. Mark ad as posted so we don't do it again
                $adModel->update($ad->id, ['is_posted' => 1]);
            }
        }
    }
}

}
