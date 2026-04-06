<?php

class AssignmentModel extends Model
{
    protected $table = 'assignments';

    // Validation rules
    protected $rules = [
        'class_id'     => 'required|numeric',
        'title'        => 'required|max:255',
        'description'  => 'nullable',
        'due_date'     => 'nullable',
        'content_path' => 'nullable|max:512',
    ];

    // Allowed columns for insert/update
    protected $allowedColumns = [
        'class_id',
        'title',
        'description',
        'due_date',
        'content_path',
        'created_at'
    ];
}
