<?php


class TeacherVle extends Controller
{
   public function index($class_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION['USER']) || $_SESSION['USER']['role'] !== 'teacher') {
            redirect('login');
            exit();
        }
        
        if (!$class_id) {
            redirect('ClassManager'); 
            exit();
        }

        $classModel = new ClassModel();
        $classContentModel = new ClassContent();

        $class = $classModel->first([
            'class_id' => $class_id
        ]);

        if (!$class) {
            $_SESSION['error'] = "You do not have permission to access this class.";
            redirect('ClassManager');
            exit();
        }

        $all_content = $classContentModel->where(['class_id' => $class_id]);

        $grouped_content = [];

        if (!empty($all_content)) {
            foreach ($all_content as $item) {
                $type = $item->content_type; 
                
                if (!isset($grouped_content[$type])) {
                    $grouped_content[$type] = [];
                }
                
                $grouped_content[$type][] = $item;
            }
        }

        $data = [
            'class' => $class,
            'content' => $grouped_content 
        ];
        
        $this->view('vle_teacher', $data);
    }
    public function uploadDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            $class_id = $_POST['class_id'] ?? null; 

            if (!$class_id) {
                redirect('ClassManager');
                exit;
            }

            $classContentModel = new ClassContent();
            $uploadFiles = handleFileUploads('docUpload', 'class_content');
            $filePaths = !empty($uploadFiles) ? implode(',', $uploadFiles) : '';

            $data = [
                'title' => $_POST['docName'] ?? '',
                'description' => $_POST['docDescription'] ?? '',
                'class_id' => $class_id,
                'content_type' => $_POST['linkType'] ?? 'note',
                'content_path' => $filePaths
            ];

            $classContentModel->insert($data);
            
            redirect('TeacherVle/index/' . $class_id); 
        }
    }
    public function updateDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // 1. Get the IDs from the form
            $class_id = $_POST['class_id'] ?? null;
            $content_id = $_POST['content_id'] ?? null;

            // 2. Security Check
            if (!$class_id || !$content_id || !isset($_SESSION['USER']) || $_SESSION['USER']['role'] !== 'teacher') {
                redirect('ClassManager');
                exit;
            }

            $classContentModel = new ClassContent();

            // 3. Prepare data for update
            $data = [
                'title' => $_POST['docName'] ?? '',
                'description' => $_POST['docDescription'] ?? '',
                'content_type' => $_POST['linkType'] ?? 'note'
            ];

            // 4. Check if a new file is being uploaded
            if (isset($_FILES['docUpload']) && $_FILES['docUpload']['error'] == 0) {
                
                // (Optional: Delete the old file from your server)
                // $old_content = $classContentModel->first(['content_id' => $content_id]);
                // if ($old_content && !empty($old_content->content_path) && file_exists($old_content->content_path)) {
                //     unlink($old_content->content_path);
                // }

                // Upload the new file
                $uploadFiles = handleFileUploads('docUpload', 'class_content');
                $filePaths = !empty($uploadFiles) ? implode(',', $uploadFiles) : '';
                
                // Add the new file path to the data
                if (!empty($filePaths)) {
                    $data['content_path'] = $filePaths;
                }
            }

            // 5. Perform the update in the database
            $classContentModel->update($content_id, $data, 'content_id');
            
            // 6. Redirect back
            redirect('TeacherVle/index/' . $class_id);
        }
    }


    public function deleteDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $class_id = $_POST['class_id'] ?? null;
            $content_id = $_POST['content_id'] ?? null;

            if (!$class_id || !$content_id || !isset($_SESSION['USER']) || $_SESSION['USER']['role'] !== 'teacher') {
                redirect('ClassManager');
                exit;
            }

            $classContentModel = new ClassContent();

   

           $classContentModel->delete(['content_id' => $content_id]);
            
            redirect('TeacherVle/index/' . $class_id);
        }
    }


}