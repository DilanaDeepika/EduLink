<?php

class ClassModel extends Model
{
    protected $table = 'Classes';

    // Validation rules
    protected $rules = [
        'class_name'       => 'required|max:255',
        'description'      => 'max:1000',
        'duration_hours'   => 'required|integer',
        'subject_name'     => 'required|max:255',
        'grade_level_name' => 'required|max:100',
        'category_name'    => 'max:255',
        'language_name'    => 'max:100',
        'thumbnail_path'   => 'max:512',
        'trailer_path'     => 'max:512',
        'max_students'     => 'required|integer',
        'monthly_fee'      => 'required|decimal',
        'target_audience'  => 'max:1000',
        'prerequisites'    => 'max:1000',
        'welcome_message'  => 'max:1000',
        'congrats_message' => 'max:1000',
        'teacher_id'       => 'required|integer',
        'institute_id'     => 'integer'
    ];

    // Allowed columns for insert/update
    public $allowedColumns = [
        'class_name',
        'description',
        'duration_hours',
        'subject_name',
        'grade_level_name',
        'category_name',
        'language_name',
        'thumbnail_path',
        'trailer_path',
        'max_students',
        'monthly_fee',
        'target_audience',
        'prerequisites',
        'welcome_message',
        'congrats_message',
        'teacher_id',
        'institute_id',
        'created_at'
    ];


    public function getAllowedColumns()
    {
        return $this->allowedColumns;
    }



}