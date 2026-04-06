<?php

class ContentVle extends Controller
{
    public function index()
    {

        $this->view('content_vle');
    }
    public function uploadDocument()
    {
            echo "<pre>";
            print_r("error");
            die();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $classContentModel = new ClassContent();

        // Handle file upload
        $uploadFiles = handleFileUpload('docName', 'class_content');

        // Combine multiple file paths into one string
        $filePaths = !empty($uploadFiles) ? implode(',', $uploadFiles) : '';

        // Prepare data for database
        $data = [
            'title' => $_POST['docName'] ?? '',
            'description' => $_POST['docDescription'] ?? '',
            'class_id' => 1, // dynamic class id if needed
            'content_type' => $_POST['linkType'] ?? 'note',
            'content_path' => $filePaths
        ];

        $classContentModel->insert($data);
        redirect('TeacherVle');
    }else{echo "<pre>";
        echo "error";}
        
    
    }

}





