<?php

class AssignmentSubmissionsModel extends Model
{
    protected $table = "assignment_submissions";

    protected $allowedColumns = [
        'assignment_id',
        'student_id',
        'submission_path',
        'submitted_at'
    ];

    protected $rules = [
        'assignment_id'   => 'required|numeric',
        'student_id'      => 'required|numeric',
        'submission_path' => 'required'
    ];
}