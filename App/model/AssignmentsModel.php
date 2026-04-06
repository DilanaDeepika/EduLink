<?php

class AssignmentsModel extends Model
{
    protected $table = "assignments";

    protected $allowedColumns = [
        'class_id',
        'title',
        'description',
        'due_date',
        'created_at'
    ];

    protected $rules = [
        'class_id' => 'required|numeric',
        'title'    => 'required',
        'due_date' => 'required'
    ];
}