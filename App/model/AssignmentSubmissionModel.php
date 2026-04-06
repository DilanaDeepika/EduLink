<?php

class AssignmentSubmissionModel extends Model
{
    protected $table = 'assignment_submissions';

    protected $allowedColumns = [
        'assignment_id',
        'student_id',
        'submission_path',
        'submitted_at',
        'finalized'
    ];
}

