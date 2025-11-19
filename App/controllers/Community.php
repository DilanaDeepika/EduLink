<?php

class Community extends Controller
{
    public function index()
    {
        $community_id = isset($_GET['community_id']) ? $_GET['community_id'] : null;

        if (!$community_id) {
            echo "Community ID is required";
            return;
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

                    $posts = $post->where(['community_id' => $result[0]->id]);

                    // Merge posts into main list
                    if (!empty($posts)) {
                        $postList = array_merge($postList, $posts);
                    }
                }
            }
        }

        $data['community_details'] = $communityDetails;
        $data['post_list'] = $postList;

        $this->view('community', $data);
    }

    public function fetchMessages() {
        header("Content-Type: application/json");

        $community_id = isset($_GET['community_id']) ? intval($_GET['community_id']) : 0;
        $last_message_id = isset($_GET['last_message_id']) ? intval($_GET['last_message_id']) : 0;

        if (!$community_id) {
            echo json_encode([]);
            exit;
        }

        $communityMessage = new CommunityMessageModel();
        $accountModel = new Account();

        $messages = $communityMessage->query(
            "SELECT * FROM community_messages WHERE community_id = :cid AND id > :last_id ORDER BY id ASC",
            ['cid' => $community_id, 'last_id' => $last_message_id]
        );

        foreach ($messages as &$msg) {
            $account = $accountModel->where(['account_id' => $msg->user_id]);
            if (!$account || !isset($account[0])) continue;
            $account = $account[0];

            $name = '';
            switch ($account->account_type) {
                case 'student':
                    $studentModel = new Student();
                    $user = $studentModel->where(['account_id' => $msg->user_id]);
                    if ($user && isset($user[0])) {
                        $user = $user[0];
                        $name = $user->first_name . ' ' . $user->last_name;
                    }
                    break;
                case 'teacher':
                    $teacherModel = new Teacher();
                    $user = $teacherModel->where(['account_id' => $msg->user_id]);
                    if ($user && isset($user[0])) {
                        $user = $user[0];
                        $name = $user->first_name . ' ' . $user->last_name;
                    }
                    break;
                case 'institute':
                    $instituteModel = new Institute();
                    $user = $instituteModel->where(['account_id' => $msg->user_id]);
                    if ($user && isset($user[0])) $name = $user[0]->institute_name;
                    break;
                case 'admin':
                    $name = $account->email;
                    break;
            }

            $msg->username = $name; // use -> for object
        }

        echo json_encode($messages);
        exit;
    }


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

}
