<?php
class EnrollmentModel extends Model
{
    protected $table = "Enrollments"; 

    protected $allowedColumns = [
        'enrollment_id',
        'student_id',
        'class_id',
        'enrollment_date',
        'status'
    ];

}