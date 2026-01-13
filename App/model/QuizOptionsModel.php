<?php

class QuizOptionsModel extends Model
{
    protected $table = "quiz_options";

    protected $allowedColumns = [
        'question_id',
        'option_text',
        'is_correct'
    ];

    protected $rules = [
        'question_id' => 'required|numeric',
        'option_text' => 'required',
        'is_correct'  => 'required' 
    ];
}