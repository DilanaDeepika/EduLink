<?php

class StudentInstituteModel extends Model
{
    protected $table = 'student_institutes';
    protected $allowedColumns = [
        'student_id',
        'institute_id',
        'created_at'
    ];
}

