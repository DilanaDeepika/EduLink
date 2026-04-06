<?php


class TeacherVle extends Controller
{
    public function createQuiz(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $quizModel = new QuizModel();


        $data = [];

        $data = [
            'class_id' => $_POST['class_id'],
            'title' => $_POST['docName'],
            'description' => $_POST['docDescription'],
            'time_limit_minutes' => $_POST['duration']
        ];

        $quiz_id = $quizModel->insert($data);

        $data['quiz_id'] = $quiz_id;
        

        $this->view('quiz_builder',$data);
    }
}
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
        $classSessionsModel = new ClassSessionsModel();

        $quizModel = new QuizModel();
        $assignmentsModel = new AssignmentsModel();

        $classSessionsModel->ensureMonthlySessionsExist($class_id);

        $class = $classModel->first([
            'class_id' => $class_id
        ]);

        if (!$class) {
            $_SESSION['error'] = "You do not have permission to access this class.";
            redirect('ClassManager');
            exit();
        }

        $all_content = $classContentModel->where(['class_id' => $class_id]);

        $all_quizs = $quizModel->where(['class_id' => $class_id]);

        $all_assignments = $assignmentsModel->where(['class_id' => $class_id]);

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

        if (!empty($all_quizs)) {
            foreach ($all_quizs as $item) {
                $type = 'Quiz'; 
                    
                if (!isset($grouped_content[$type])) {
                    $grouped_content[$type] = [];
                }
                    
                $grouped_content[$type][] = $item;
            }
        }

        if (!empty($all_assignments)) {
            foreach ($all_assignments as $item) {
                $type = 'assignment'; 
                    
                if (!isset($grouped_content[$type])) {
                    $grouped_content[$type] = [];
                }
                    
                $grouped_content[$type][] = $item;
            }
        }
        // echo "<pre>";
        // print_r($grouped_content);
        // echo "</pre>";
        
        // die();
        $session_details = [];
        $session_details = $classSessionsModel->where(['class_id' => $class_id]);


        // monitoring data fetching  

        $monitoring = [];

        $enrollmentModel = new EnrollmentModel();
        $studentModel = new Student();
        $classAttendanceModel = new ClassAttendanceModel(); 
        // $paymentModel = new PaymentModel(); 

        $enrollments = $enrollmentModel->where(['class_id' => $class_id]);
        $all_sessions = $classSessionsModel->where(['class_id' => $class_id]);
        $total_sessions = !empty($all_sessions) ? count($all_sessions) : 0;

        if (!empty($enrollments)) {
            foreach ($enrollments as $enrollRow) {
                
                // Get the student ID from the enrollment row
                $student_id = $enrollRow->student_id;
                
                // A. Fetch Student Personal Details
                $student = $studentModel->first(['student_id' => $student_id]);
                
                if ($student) {
                    
                    // B. Calculate Attendance
                    $attended_count = 0;
                    // Fetch all attendance for this student
                    $my_attendance = $classAttendanceModel->where(['student_id' => $student_id]);
                    
                    if(!empty($my_attendance) && !empty($all_sessions)) {
                        // Extract session IDs for this class
                        $class_session_ids = array_column($all_sessions, 'session_id');
                        
                        foreach($my_attendance as $att) {
                            if(in_array($att->session_id, $class_session_ids)) {
                                $attended_count++;
                            }
                        }
                    }

                    // Format Percentage (e.g., "80%")
                    $attendance_pct = ($total_sessions > 0) 
                        ? round(($attended_count / $total_sessions) * 100) . '%' 
                        : '0%';


                    // C. Get Last Payment (Placeholder Logic)
                    // Assuming you have a payments table. If not, we show "N/A"
                    $last_payment_date = "N/A";
                    
                    /* -- UNCOMMENT WHEN YOU HAVE A PAYMENTS TABLE --
                    $last_pay_record = $paymentModel->query(
                        "SELECT * FROM payments WHERE student_id = :sid AND class_id = :cid ORDER BY created_at DESC LIMIT 1", 
                        ['sid' => $student_id, 'cid' => $class_id]
                    );
                    if(!empty($last_pay_record)) {
                        $last_payment_date = $last_pay_record[0]->created_at; // or amount
                    }
                    */

                    // D. Build the Data Row for the View
                    $monitoring[] = [
                        'full_name'    => $student->first_name . ' ' . $student->last_name,
                        'phone_number' => $student->parent_phone_number ??  'No Number',
                        'attendance'   => $attendance_pct . " ($attended_count/$total_sessions)",
                        'last_payment' => $last_payment_date
                    ];
                }
            }
        }
        //analysis data fetching
        $paperMarksModel = new PaperMarksModel();
        $allStudents = $paperMarksModel->getStudentRankingsByClass($class_id);

        $top_students = [];
        $interested_students = [];

        if ($allStudents) {
            foreach ($allStudents as $index => $student) {
                $student->rank = $index + 1; 
            }

          
            $top_students = array_slice($allStudents, 0, 5);

            $bottomStudents = array_slice($allStudents, -5);
            $interested_students = array_reverse($bottomStudents);
            
        }
        // echo "<pre>";
        // print_r( $data);
        // echo "</pre>";
        // die();

        // grading data fetching 

        $papersModel = new PapersModel();

        $papers = $papersModel->where(['class_id' => $class_id], [], ['paper_id' => 'DESC']);

        $data = [
            'class' => $class,
            'content' => $grouped_content,
            'session_details' => $session_details,
            'monitoring' => $monitoring,
            'papers' => $papers,
            'top_students' =>$top_students,
            'interested_students' => $interested_students
        ];

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();

        $this->view('vle_teacher', $data);
    }

    public function scheduleLiveSession(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $class_sessions  = new ClassSessionsModel();
        $class_id = $_GET['index'];
        $raw_date = $_POST['date'];         
        $raw_start = $_POST['start_time'];   
        $raw_end   = $_POST['end_time'];     
        $place     = $_POST['place'];
        $typeName = $_POST['type_name'];

        $db_start_time = $raw_date . ' ' . $raw_start . ':00'; 
        $db_end_time   = $raw_date . ' ' . $raw_end . ':00';

        $generated_link = "Class_" . $class_id . "_" . uniqid();

        $data =[ 
            'class_id' => $class_id,
            'title' => $_POST['topic'],
            'start_time' => $db_start_time,
            'end_time' =>  $db_end_time,
            'session_type' => $typeName,
            'place' => $place,
            'meeting_link' => $generated_link

        ];
        
        if( $class_sessions->insert($data)){
            redirect('TeacherVle/' . $class_id);
        }else{
            echo "Error saving schedule.";
        }
    }
    }
    public function updateSession() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $class_sessions = new ClassSessionsModel(); 

        $session_id = $_POST['session_id'];
        $class_id = isset($_GET['index']) ? $_GET['index'] : null;

       
        $raw_date  = $_POST['date'];         
        $raw_start = $_POST['start_time'];   
        $raw_end   = $_POST['end_time'];     
        $place     = $_POST['place'];
        $typeName  = $_POST['type_name'];    
        $topic     = $_POST['topic'];

        $db_start_time = date('Y-m-d H:i:s', strtotime("$raw_date $raw_start"));
        $db_end_time   = date('Y-m-d H:i:s', strtotime("$raw_date $raw_end"));

        $data = [
            'title'        => $topic,
            'start_time'   => $db_start_time,
            'end_time'     => $db_end_time,
            'session_type' => $typeName,
            'place'        => $place
        ];
        
        if ($class_sessions->update($session_id, $data, 'session_id')) {
            redirect('TeacherVle/' . $class_id);
        } else {
            echo "Error updating schedule.";
        }
    }
}

    public function deleteSession(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('TeacherVle/' . $class_id);
    }

    if (session_status() === PHP_SESSION_NONE) session_start();

    $session_id = $_POST['session_id'] ?? null;
    $class_id   = $_POST['class_id']   ?? null;

    if ($session_id && $class_id) {
        $classSessionsModel = new ClassSessionsModel();
        
        $classSessionsModel->delete(['session_id' => $session_id]);
    }

    redirect('TeacherVle/' . $class_id);
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
            
            redirect('TeacherVle/' . $class_id); 
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
            redirect('TeacherVle/' . $class_id);
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
            
            redirect('TeacherVle/' . $class_id);
        }
    }
    public function saveQuizQuestions()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            
            $quizQuestionsModel = new QuizQuestionsModel();
            $quizOptionsModel = new QuizOptionsModel();

            $quizQuestionsModel->setLimit(1);

            $quiz_id = $_POST['quiz_id'] ?? null; 
            $class_id = $_POST['class_id'] ?? null;
            
            $questions = $_POST['questions'] ?? [];



            if ($quiz_id && !empty($questions)) {
                
                foreach ($questions as $index => $qData) {
                    
                    $questionInsertData = [
                        'quiz_id'       => $quiz_id,
                        'question_text' => $qData['text']
                    ];

                    if($quizQuestionsModel->insert($questionInsertData)) {
                        
                        

                        $result = $quizQuestionsModel->where(
                            ['quiz_id' => $quiz_id],     
                            [],                            
                            ['question_id' => 'DESC']      
                        );

                        $question_id = !empty($result) ? $result[0]->question_id : null;

                        if ($question_id) {
                            $correctOptionIndex = $qData['correct']; 
                            $optionsList = $qData['options'];    

                            foreach ($optionsList as $optIndex => $optText) {
                                
                                $isCorrect = ($optIndex == $correctOptionIndex) ? 1 : 0;

                                $optionInsertData = [
                                    'question_id' => $question_id,
                                    'option_text' => $optText,
                                    'is_correct'  => $isCorrect
                                ];

                                $quizOptionsModel->insert($optionInsertData);
                            }
                        }
                    }
                }
            }

            redirect('TeacherVle/' . $class_id);
        }
    }


    public function uploadLink(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $assignmentsModel = new AssignmentsModel();

            $data = [];
            $class_id = $_POST["class_id"];

            $raw_date = $_POST["docExpire"];

            $formatted_date = str_replace('T', ' ', $raw_date);
            $data =[
                'class_id' => $class_id,
                'title'  => $_POST["docName"],
                'description' => $_POST["docDescription"],
                'due_date' => $formatted_date
            ];


            $assignmentsModel->insert($data);

            redirect('TeacherVle/' . $class_id);
        }else{
            redirect('ClassManager');
        }
    }

    public function downloadGradeTemplate($class_id, $paper_id) {



    
        $enrollmentModel = new EnrollmentModel();
        $studentModel = new Student();
        $papersModel = new PapersModel();

        
        $paper = $papersModel->first(['paper_id' => $paper_id]);

        $paperName = $paper ? str_replace(' ', '_', $paper->title) : 'Paper';

        $enrollments = $enrollmentModel->where(['class_id' => $class_id]);

        if (!$enrollments) {
            die();
            redirect('TeacherVle/' . $class_id);
            exit();
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="Marks_' . $paperName . '.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['Student ID', 'Full Name', 'Marks (0-100)']);

        foreach ($enrollments as $row) {
            $student = $studentModel->first(['student_id' => $row->student_id]);
            
            if ($student) {
                fputcsv($output, [
                    $student->student_id,                      
                    $student->first_name . ' ' . $student->last_name,
                    ''                                      
                ]);
            }
        }

        fclose($output);
        exit();
    }
    public function uploadGrades() {
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['gradeFile'])) {
            
            $paper_id = $_POST['paper_id'];
            $class_id = $_POST['class_id'];
            
 
            $file = $_FILES['gradeFile'];
            $filename = $file['tmp_name'];
            
            // Check if file is a CSV
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            if ($ext !== 'csv') {
                echo "Error: Please upload a valid CSV file.";
                exit();
            }

            $paperMarksModel = new PaperMarksModel();
            $papersModel = new PapersModel();

            //  Open the File
            if ($file['size'] > 0) {
                $handle = fopen($filename, "r");

                //  Skip the Header Row 
                fgetcsv($handle);

                // Loop through the rows
                while (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                    
                    // CSV Mapping based on download function:
                    
                    $student_id = $column[0];
                    $marks = $column[2];

                    if (!empty($student_id) && is_numeric($marks)) {
                        
                        $existing = $paperMarksModel->first([
                            'paper_id' => $paper_id,
                            'student_id' => $student_id
                        ]);

                        if ($existing) {
                            $paperMarksModel->update($existing->mark_id, ['marks_obtained' => $marks], 'mark_id');
                        } else {
                            $paperMarksModel->insert([
                                'paper_id'       => $paper_id,
                                'student_id'     => $student_id,
                                'marks_obtained' => $marks
                            ]);
                        }
                    }
                }
                
                fclose($handle);
                $papersModel->update($paper_id, ['is_released' => 1], 'paper_id');


                redirect('TeacherVle/' . $class_id);
            }
        }
    }

public function StudentMarks() {

    $class_id = $_GET['index'] ?? null;
    $paper_id = $_GET['paperID'] ?? null;

    if (!$class_id || !$paper_id) {
        die("Missing Class ID or Paper ID");
    }

    $paper = new PapersModel();      
    $paperMarks = new PaperMarksModel(); 

    
    $paperDetails = $paper->where(['paper_id' => $paper_id]);
    $studentMarks = $paperMarks->where(['paper_id' => $paper_id]);

    
    $paperTitle = "Unknown Paper";
    if (!empty($paperDetails)) {
        $paperTitle = $paperDetails[0]->title;
    }

    $data = [
        'paper_name' => $paperTitle,
        'student_marks' => $studentMarks
    ];


    $this->view("student_marks", $data);
}

public function quizManager($quiz_id = null) {
    
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['USER']) || $_SESSION['USER']['role'] !== 'teacher') {
        redirect('login');
    }


    $quizModel = new QuizModel();
    $quizAttemptModel = new QuizAttemptModel();
    $quizQuestionsModel = new QuizQuestionsModel();


    $quiz = $quizModel->first(['quiz_id' => $quiz_id]);
    
    if (!$quiz) {
        die("Quiz not found");
    }


    $student_marks = $quizAttemptModel->getLeaderboard($quiz_id);
    $analysis = $quizQuestionsModel->getErrorAnalysis($quiz_id);

    $data = [
        'quiz' => $quiz,
        'marks' => $student_marks,
        'analysis' => $analysis
    ];

    $this->view("quiz_manager", $data);
}
public function assignmentManager($assignment_id = null) {
    if (!$assignment_id) {
        echo "Assignment ID missing."; 
        return;
    }

    $assignmentsSubmissionsModel = new AssignmentSubmissionsModel();
    $studentModel = new Student();

    $submissions = $assignmentsSubmissionsModel->where(['assignment_id' => $assignment_id]);

    if ($submissions) {
        foreach ($submissions as $key => $submission) {
            
            $student = $studentModel->first(['student_id' => $submission->student_id]);
            
            if ($student) {
               
                $submissions[$key]->student_name = $student->first_name . ' ' . $student->last_name;
            } else {
                $submissions[$key]->student_name = "Unknown Student";
            }
        }
    }

    $data['assignmentsSubmissions'] = $submissions;

    $this->view("assignments_manager", $data);
}
public function addPaper() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $paperModel = new PapersModel();

      
        $class_id = $_POST['class_id'];
        $paperTitle = $_POST['paper_title'];

        
        if (empty($paperTitle)) {
           
            redirect('TeacherVle/' . $class_id); 
            return;
        }

        $data = [
            'class_id'    => $class_id,
            'title'       => $paperTitle,
            'is_released' => 0
        ];


        $paperModel->insert($data);


        redirect('TeacherVle/' . $class_id); 
    }
}


}