<?php

class Calendar extends Controller
{
    public function index()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    
    $accountId = $_SESSION['USER']['account_id'] ?? null;
    if (!$accountId) {
        $_SESSION['error'] = "User not identified.";
        redirect($this->getDashboardPath());
        exit;
    }

    $eventModel = new Event();
    $events = $eventModel->where(['account_id' => $accountId]);

    if (!$events) $events = [];

    $data['events'] = $events;

    // Determine which view to load based on role
    $role = $_SESSION['USER']['role'] ?? 'student';
    switch ($role) {
        case 'teacher':
            $this->view('teacher_calendar', $data);
            break;
        case 'istitute':
            $this->view('institute_calendar', $data);
            break;
        default:
            $this->view('student_calendar', $data);
            break;
    }
}

    private function getDashboardPath() {
    $role = $_SESSION['USER']['role'] ?? 'student'; // assuming 'role' is stored in session
    return match($role) {
        'teacher' => 'TeacherProfile?section=my-calendar',
        'istitute'   => 'InstituteProfile?section=my-calendar',
        default   => 'StudentProfile?section=my-calendar',
    };
    }

    public function save_event() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $accountId = $_SESSION['USER']['account_id'] ?? null;

        if (!$accountId) {
            echo "error: user not identified";
            exit;
        }

        $eventModel = new Event();
        $data = [
            'account_id' => $accountId,
            'event_date' => $_POST['event_date'] ?? date('Y-m-d'),
            'event_title' => $_POST['event_title'] ?? '',
            'event_time' => $_POST['event_time'] ?? '',
            'event_description' => $_POST['event_description'] ?? '',
        ];

        if ($eventModel->validate($data)) {
            $newId = $eventModel->insert($data);
            echo "success";  // <-- important for JS
        } else {
            echo "error: " . implode(", ", $eventModel->validation_errors);
        }
        exit;
    }
}


   public function update_event()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "error: invalid request";
        exit;
    }

    $accountId = $_SESSION['USER']['account_id'] ?? null;
    $eventId   = $_POST['event_id'] ?? null;

    if (!$accountId || !$eventId) {
        echo "error: missing data";
        exit;
    }

    $eventModel = new Event();

    // Ownership check
    $event = $eventModel->first([
        'id'         => $eventId,
        'account_id' => $accountId
    ]);

    if (!$event) {
        echo "error: permission denied";
        exit;
    }

    $data = [
        'event_title'       => $_POST['event_title'] ?? $event['event_title'],
        'event_date'        => $_POST['event_date'] ?? $event['event_date'],
        'event_time'        => $_POST['event_time'] ?? null,
        'event_description' => $_POST['event_description'] ?? $event['event_description'],
    ];

    if ($eventModel->update($eventId, $data) !== false) {
        echo "success";
    } else {
        echo "error: update failed";
    }

    exit;
}


public function delete_event()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    $accountId = $_SESSION['USER']['account_id'] ?? null;
    $eventId   = $_POST['event_id'] ?? null;

    if (!$accountId || !$eventId) {
        $_SESSION['error'] = "Missing data";
        redirect($this->getDashboardPath());
        exit;
    }

    $eventModel = new Event();
    $event = $eventModel->first([
        'id' => $eventId,
        'account_id' => $accountId
    ]);

    if ($event) {
        $eventModel->delete(['id' => $eventId, 'account_id' => $accountId]);
        $_SESSION['success'] = "Event deleted successfully.";
    } else {
        $_SESSION['error'] = "Permission denied";
    }

    redirect($this->getDashboardPath());
}


}
