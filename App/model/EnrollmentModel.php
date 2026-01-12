<?php
class EnrollmentModel extends Model
{
    protected $table = "Enrollments"; 

    protected $allowedColumns = [
        'enrollment_id',
        'student_id',
        'class_id',
        'enrollment_date',
        'status',
        'trial_start',
        'trial_end'
    ];

    public function getEnrollment($student_id, $class_id)
    {
        return $this->first([
            'student_id' => $student_id,
            'class_id' => $class_id
        ]);
    }

    public function startFreeTrial($student_id, $class_id)
{
    return $this->insert([
        'student_id'      => $student_id,
        'class_id'        => $class_id,
        'enrollment_date' => date('Y-m-d'),
        'trial_start'     => date('Y-m-d'),
        'trial_end'       => date('Y-m-d', strtotime('+14 days')),
        'status'          => 'trial'
    ]);
}

}