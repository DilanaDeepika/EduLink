<?php

class StudentProfile extends Controller
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
    $accountId = $_SESSION['USER']['account_id'];
    
    $eventModel = new Event();
    $events = $eventModel->where(['account_id' => $accountId]);

    // Ensure it's always an array
    if (!$events) $events = [];

    // 4️⃣ Pass events to the view
    $data['events'] = $events;
    $this->view('student_profile', $data);
}


public function save_event()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (session_status() === PHP_SESSION_NONE) session_start();
        error_log("Save Event Called. Session User: " . print_r($_SESSION['USER'] ?? 'Not Set', true));
        $accountId = $_SESSION['USER']['account_id'] ?? null;
         

        if (!$accountId) {
            $_SESSION['error'] = "User not identified.";
            redirect('StudentProfile/index');
            exit;
        }

        $eventModel = new Event();

        $data = [
            'account_id'        => $accountId,
            'event_date'        => $_POST['event_date'] ?? date('Y-m-d'),
            'event_title'       => $_POST['event_title'] ?? '',
            'event_time'        => $_POST['event_time'] ?? '',
            'event_description' => $_POST['event_description'] ?? '',
        ];

        if ($eventModel->validate($data)) {
            $eventModel->insert($data);
            $_SESSION['success'] = "Event saved successfully.";
        } else {
            $_SESSION['error'] = $eventModel->validation_errors;
        }

        redirect('StudentProfile/index');
    } else {
        redirect('StudentProfile/index');
    }
}
public function delete_event()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    $accountId = $_SESSION['USER']['account_id'] ?? null;  
    $eventId   = $_POST['event_id'] ?? null; 

    if (!$accountId || !$eventId) {
        echo "Missing data";
        return;
    }

    $eventModel = new Event();
    
    $conditions = [
        'account_id' => $accountId,
        'id' => $eventId
    ];

 
    $eventModel->delete($conditions); 

    echo "success";
    
    exit; 
}
public function update_event()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request";
        exit;
    }

    $accountId = $_SESSION['USER']['account_id'] ?? null;
    $eventId   = $_POST['event_id'] ?? null;

    if (!$accountId || !$eventId) {
        echo "Missing data";
        exit;
    }

    $eventModel = new Event();

    $event = $eventModel->first([
        'id' => $eventId,
        'account_id' => $accountId
    ]);

    if ($event) {
        
        $data = [
            'event_title'       => $_POST['event_title'] ?? '',
            'event_time'        => empty($_POST['event_time']) ? null : $_POST['event_time'],
            'event_description' => $_POST['event_description'] ?? '',
            'event_date'        => $_POST['event_date'] ?? date('Y-m-d'),
        ];

        if ($eventModel->update($eventId, $data) !== false) {
            echo "success";
        } else {
            echo "Failed to update";
        }
    } else {
        echo "Permission denied";
    }

    exit; // prevent extra HTML
}


}
