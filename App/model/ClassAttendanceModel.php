<?php

class ClassAttendanceModel extends Model
{
    protected $table = "class_attendance";

    protected $allowedColumns = [
        'student_id',
        'class_id',
        'session_id',
        'attendance_type'
    ];

    protected $rules = [
        'student_id'      => 'required|numeric',
        'class_id'        => 'required|numeric',
        'session_id'      => 'required|'
    ];
    }