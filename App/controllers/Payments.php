<?php

class Payments extends Controller
{
    public function options($class_id)
    {
        $student_id = $_SESSION['student_id'];

        $enrollmentModel = new EnrollmentModel();
        $enrollment = $enrollmentModel->getEnrollment($student_id, $class_id);

        $showFreeTrial = false;

        if (!$enrollment) {
            // First time joining
            $showFreeTrial = true;
        } elseif ($enrollment->status === 'trial') {
            $trialEnd = date('Y-m-d', strtotime($enrollment->enrollment_date . ' +14 days'));
            if (date('Y-m-d') <= $trialEnd) {
                $showFreeTrial = true;
            }
        }

        $this->view('payments/options', [
            'class_id' => $class_id,
            'showFreeTrial' => $showFreeTrial
        ]);
    }

    public function startTrial($class_id)
    {
        $student_id = $_SESSION['student_id'];

        $enrollmentModel = new EnrollmentModel();
        $existing = $enrollmentModel->getEnrollment($student_id, $class_id);

        if (!$existing) {
            $enrollmentModel->startFreeTrial($student_id, $class_id);
        }

        redirect('studentprofile/mycourses');
    }

    public function invoice()
{
    // 1. Check login
    if (!isset($_SESSION['USER']['account_id'])) {
        redirect('login');
        exit;
    }

    // 2. Validate GET parameter
    if (!isset($_GET['payment_id'])) {
        die('Invalid invoice request');
    }

    $payment_id = $_GET['payment_id'];

    // 3. Load models
    $paymentModel = new StudentPaymentModel();
    $studentModel = new Student();
    $classModel   = new ClassModel();

    // 4. Get payment
    $payment = $paymentModel->first([
        'payment_id' => $payment_id
    ]);

    if (!$payment) {
        die('Invoice not found');
    }

    // 5. Get student
    $student = $studentModel->first([
        'student_id' => $payment->student_id
    ]);

    // 6. Get class
    $class = $classModel->first([
        'class_id' => $payment->class_id
    ]);

    // 7. Load invoice view
    $this->view('payments/invoice', [
        'payment' => $payment,
        'student' => $student,
        'class'   => $class
    ]);
}

}
