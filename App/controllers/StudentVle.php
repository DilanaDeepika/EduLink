<?php

class StudentVle extends Controller
{
    public function index()
    {
        $class_id   = $_GET['id'] ?? null;
        $student_id = $_SESSION['USER']['student_id'] ?? null;

        
        if (!$student_id) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        
        $enrollmentModel = new EnrollmentModel();

        $enrollment = $enrollmentModel->first([
            'student_id' => $student_id,
            'class_id'   => $class_id
        ]);

      
        if (!$enrollment) {
            header("Location: " . ROOT . "/ClassPage?id=" . $class_id);
            exit;
        }

      
        if (
            $enrollment->status === 'trial' &&
            strtotime($enrollment->trial_end) < time()
        ) {
            header("Location: " . ROOT . "/ClassPage?id=" . $class_id);
            exit;
        }

        $data = [];

      
        $scheduleModel = new ClassScheduleModel();
        $data['schedules'] = $scheduleModel->where([
            'class_id' => $class_id
        ]);

        
        $contentModel = new ClassContent();
        $data['contents'] = $contentModel->where([
            'class_id' => $class_id
        ]);
  $data['now'] = time();

        $pastSchedules = [];
if (!empty($data['schedules'])) {
    foreach ($data['schedules'] as $row) {
        // Combine today's date with schedule times
        $today = date('Y-m-d');
        $start = strtotime($today . ' ' . $row->start_time);
        $end   = strtotime($today . ' ' . $row->end_time);

        // If the end time is in the past, consider it a past class
        if ($end < $data['now']) {
            $pastSchedules[] = $row;
        }
    }
}

$data['pastSchedules'] = $pastSchedules;
        // Assignments
$assignmentModel = new AssignmentModel();
$data['assignments'] = $assignmentModel->where([
    'class_id' => $class_id
]);

$submissionModel = new AssignmentSubmissionModel();

$submittedAssignments = $submissionModel->where([
    'student_id' => $student_id
]);

$submittedMap = [];
$submissionFiles = [];

if ($submittedAssignments) {
    foreach ($submittedAssignments as $sub) {

        // mark assignment as submitted
        $submittedMap[$sub->assignment_id] = true;

        // store files per assignment
        $submissionFiles[$sub->assignment_id][] = $sub;
    }
}

$data['submittedMap']   = $submittedMap;
$data['submissionFiles'] = $submissionFiles;



       
        $data['marks'] = [];
        $data['overall'] = 0;
        $data['exams_completed'] = 0;


        // ====================
// QUIZZES
// ====================

// In the index() method, replace the quiz fetching section:

// ====================
// QUIZZES
// ====================

$quizModel = new QuizModel();
$questionModel = new QuizQuestionModel();
$optionModel = new QuizOptionModel();

// Get quizzes for this class
$quizzes = $quizModel->where([
    'class_id' => $class_id
]);

$quizData = [];

if ($quizzes) {
    foreach ($quizzes as $quiz) {

        $questions = $questionModel->where([
            'quiz_id' => $quiz->quiz_id
        ]);

        foreach ($questions as $q) {

            $options = $optionModel->where([
                'question_id' => $q->question_id
            ]);

            $quizData[$quiz->quiz_id][] = [
                'question_id' => $q->question_id,
                'question_text' => $q->question_text,
                'options' => $options
            ];
        }
    }
}

$data['quizzes'] = $quizzes;
$data['quizData'] = $quizData;


// ====================
// PAPERS & GRADES
// ====================

$paperModel     = new PaperModel();
$paperMarkModel = new PaperMarkModel();

// Get all papers for this class
$papers = $paperModel->where([
    'class_id' => $class_id
]);

$papers_with_marks = [];
$total_marks = 0;
$graded_count = 0;

if ($papers) {
    foreach ($papers as $paper) {
        $mark = $paperMarkModel->first([
            'paper_id' => $paper->paper_id,
            'student_id' => $student_id
        ]);

        $paperData = new stdClass();
        $paperData->paper_title = $paper->title;

        if ($mark) {
            $paperData->marks_obtained = $mark->marks_obtained ?? null;

            // Determine status
            if ($mark->marks_obtained !== null) {
                $paperData->status = 'graded';  // Attempted + marks allocated
                $total_marks += $mark->marks_obtained;
                $graded_count++;
            } else {
                $paperData->status = 'not_graded'; // Attempted but marks not allocated
            }
        } else {
            // No attempt exists → Not completed
            $paperData->marks_obtained = null;
            $paperData->status = 'not_completed';
        }

        $papers_with_marks[] = $paperData;

        $pending_grading = 0;
$not_completed = 0;

foreach ($papers_with_marks as $p) {
    if ($p->status === 'not_graded') $pending_grading++;
    if ($p->status === 'not_completed') $not_completed++;
}

$data['pending_grading'] = $pending_grading;
$data['not_completed'] = $not_completed;

    }
}

// Overall average calculation
$overall = $graded_count > 0 ? round($total_marks / $graded_count, 2) : 0;

$data['papers_with_marks'] = $papers_with_marks;
$data['overall'] = $overall;
$data['exams_completed'] = $graded_count;


// =============================
// ANALYSIS SECTION
// =============================

$analysisData = [];
$myScores = [];

/* ---------------------------------
   1️⃣ Get Quiz Scores
----------------------------------*/

$quizAttemptModel = new QuizAttemptModel();

$quizAttempts = $quizAttemptModel->query(
    "SELECT q.title, qa.score, qa.completed_at
     FROM quiz_attempts qa
     JOIN quizzes q ON q.quiz_id = qa.quiz_id
     WHERE qa.student_id = :student_id
     AND q.class_id = :class_id
     ORDER BY qa.completed_at ASC",
    [
        ':student_id' => $student_id,
        ':class_id'   => $class_id
    ]
);

if ($quizAttempts) {
    foreach ($quizAttempts as $attempt) {
        $myScores[] = [
            'label' => $attempt->title,
            'type'  => 'quiz',
            'score' => (float)$attempt->score
        ];
    }
}

/* ---------------------------------
   2️⃣ Get Paper Scores
----------------------------------*/

$paperScores = $paperMarkModel->query(
    "SELECT p.title, pm.marks_obtained
     FROM paper_marks pm
     JOIN papers p ON p.paper_id = pm.paper_id
     WHERE pm.student_id = :student_id
     AND p.class_id = :class_id
     AND pm.marks_obtained IS NOT NULL",
    [
        ':student_id' => $student_id,
        ':class_id'   => $class_id
    ]
);

if ($paperScores) {
    foreach ($paperScores as $paper) {
        $myScores[] = [
            'label' => $paper->title,
            'type'  => 'paper',
            'score' => (float)$paper->marks_obtained
        ];
    }
}

$analysisData['myScores'] = $myScores;

/* ---------------------------------
   3️⃣ Class Score Distribution
----------------------------------*/

$classAverages = $paperMarkModel->query(
    "SELECT pm.student_id, AVG(pm.marks_obtained) as avg_score
     FROM paper_marks pm
     JOIN papers p ON p.paper_id = pm.paper_id
     WHERE p.class_id = :class_id
     AND pm.marks_obtained IS NOT NULL
     GROUP BY pm.student_id",
    [':class_id' => $class_id]
);

$buckets = [
    "0–9"=>0,"10–19"=>0,"20–29"=>0,"30–39"=>0,
    "40–49"=>0,"50–59"=>0,"60–69"=>0,"70–79"=>0,
    "80–89"=>0,"90–100"=>0
];

if ($classAverages) {
    foreach ($classAverages as $row) {
        $score = (float)$row->avg_score;
        $index = floor($score / 10);
        if ($index >= 10) $index = 9;

        $keys = array_keys($buckets);
        $buckets[$keys[$index]]++;
    }
}

$analysisData['classHistogram'] = $buckets;
/* ---------------------------------
   4️⃣ Class Rank
----------------------------------*/

$rankQuery = $paperMarkModel->query(
    "SELECT pm.student_id, AVG(pm.marks_obtained) as avg_score
     FROM paper_marks pm
     JOIN papers p ON p.paper_id = pm.paper_id
     WHERE p.class_id = :class_id
     AND pm.marks_obtained IS NOT NULL
     GROUP BY pm.student_id
     ORDER BY avg_score DESC",
    [':class_id' => $class_id]
);

$classRank = null;
$totalStudents = 0;

if ($rankQuery) {
    $totalStudents = count($rankQuery);

    foreach ($rankQuery as $index => $row) {
        if ($row->student_id == $student_id) {
            $classRank = $index + 1;
            break;
        }
    }
}

$analysisData['classRank'] = $classRank;
$analysisData['totalStudents'] = $totalStudents;
$data['analysisData'] = $analysisData;



   
        $this->view('student_vle', $data);
    }
    
   public function submit_assignment()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit;
    }

    $assignment_id = $_POST['assignment_id'] ?? null;
    $student_id    = $_SESSION['USER']['student_id'] ?? null;

    if (!$assignment_id || !$student_id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid submission']);
        exit;
    }

    if (empty($_FILES['submission_files']['name'][0])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No files selected']);
        exit;
    }

    $uploadDir = "uploads/assignments/{$student_id}/{$assignment_id}/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $submissionModel = new AssignmentSubmissionModel();
    $savedFiles = [];

    foreach ($_FILES['submission_files']['name'] as $index => $originalName) {

    $tmpName = $_FILES['submission_files']['tmp_name'][$index];
    $error   = $_FILES['submission_files']['error'][$index];
    if ($error !== UPLOAD_ERR_OK) continue;

    $ext = pathinfo($originalName, PATHINFO_EXTENSION);

    // get custom name
    $customName = $_POST['custom_names'][$index] ?? pathinfo($originalName, PATHINFO_FILENAME);
    $customName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $customName); // clean filename

    // make unique filename for storage
    $safeName = $customName . '_' . uniqid() . '.' . $ext;

    $destination = $uploadDir . $safeName;

    if (move_uploaded_file($tmpName, $destination)) {
        $id = $submissionModel->insert([
            'assignment_id'   => $assignment_id,
            'student_id'      => $student_id,
            'submission_path' => $destination,
            'display_name'    => $customName . '.' . $ext, // store custom name
            'submitted_at'    => date('Y-m-d H:i:s'),
            'finalized'       => 1
        ]);

        $savedFiles[] = [
            'submission_id' => $id,
            'filename'      => $customName . '.' . $ext,
            'submission_path' => ROOT . '/' . str_replace('\\','/',$destination),
            'delete_url'    => ROOT . "/StudentVle/delete_submission?file_id={$id}&assignment_id={$assignment_id}"
        ];
    }
}

    echo json_encode(['success' => true, 'files' => $savedFiles]);
    exit;
}


public function delete_submission()
{
    header('Content-Type: application/json');

    $file_id = $_GET['file_id'] ?? null;
    $student_id = $_SESSION['USER']['student_id'] ?? null;

    if (!$file_id || !$student_id) {
        echo json_encode(['success' => false]);
        exit;
    }

    $submissionModel = new AssignmentSubmissionModel();

    $file = $submissionModel->first([
        'submission_id' => $file_id,
        'student_id' => $student_id
    ]);

    if ($file) {

        if (file_exists($file->submission_path)) {
            unlink($file->submission_path);
        }

        $submissionModel->delete([
            'submission_id' => $file_id,
            'student_id' => $student_id
        ]);

        echo json_encode(['success' => true]);
        exit;
    }

    echo json_encode(['success' => false]);
    exit;
}

public function submit_quiz()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false]);
        exit;
    }

    $student_id = $_SESSION['USER']['student_id'] ?? null;
    $quiz_id    = $_POST['quiz_id'] ?? null;

    if (!$student_id || !$quiz_id) {
        echo json_encode(['success' => false]);
        exit;
    }

    $attemptModel = new QuizAttemptModel();
    $answerModel  = new QuizStudentAnswerModel();
    $optionModel  = new QuizOptionModel();

    // 1️⃣ Insert Attempt
    $inserted = $attemptModel->insert([
        'student_id'   => $student_id,
        'quiz_id'      => $quiz_id,
        'score'        => 0,
        'completed_at' => date('Y-m-d H:i:s')
    ]);

    if (!$inserted) {
        echo json_encode(['success' => false, 'message' => 'Attempt failed']);
        exit;
    }

    // 2️⃣ Get LAST attempt ID manually
    $latestAttempt = $attemptModel->query(
        "SELECT attempt_id FROM quiz_attempts 
         WHERE student_id = :student_id 
         AND quiz_id = :quiz_id 
         ORDER BY attempt_id DESC LIMIT 1",
        [
            ':student_id' => $student_id,
            ':quiz_id'    => $quiz_id
        ]
    );

    if (!$latestAttempt) {
        echo json_encode(['success' => false, 'message' => 'No attempt found']);
        exit;
    }

    $attempt_id = $latestAttempt[0]->attempt_id;

    // 3️⃣ Save Answers
    $correct = 0;
    $total   = 0;

    foreach ($_POST as $key => $value) {

        if (strpos($key, 'question_') === 0 && !empty($value)) {

            $question_id      = str_replace('question_', '', $key);
            $chosen_option_id = $value;

            $answerModel->insert([
                'attempt_id'      => $attempt_id,
                'question_id'     => $question_id,
                'chosen_option_id'=> $chosen_option_id
            ]);

            $option = $optionModel->first([
                'option_id' => $chosen_option_id
            ]);

            if ($option && $option->is_correct == 1) {
                $correct++;
            }

            $total++;
        }
    }

    // 4️⃣ Calculate Score
    $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

    // 5️⃣ Update Attempt Score
    $attemptModel->update($attempt_id, [
        'score' => $score
    ], 'attempt_id');

    echo json_encode([
        'success'    => true,
        'score'      => $score,
        'correct'    => $correct,
        'total'      => $total,
        'attempt_id' => $attempt_id
    ]);

    exit;
}

}

