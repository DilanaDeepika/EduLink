<?php
class EnrollmentModel extends Model
{
    protected $table = "enrollments"; 

    protected $allowedColumns = [
        'enrollment_id',
        'student_id',
        'class_id',
        'enrollment_date',
        'status'
    ];

}