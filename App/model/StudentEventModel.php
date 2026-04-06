<?php

class StudentEventModel extends Model
{
    protected $table = 'student_events';
    protected $allowedColumns = [
        'student_id',
        'event_date',
        'event_time',
        'event_title',
        'event_description',
        'created_at'
    ];
}
