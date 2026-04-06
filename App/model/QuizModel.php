<?php

class QuizModel extends Model
{
    protected $table = "quizzes";

    protected $allowedColumns = [
        'class_id',
        'title',
        'description',
        'time_limit_minutes'
    ];

    protected $rules = [
        'class_id' => 'required|numeric',
        'title'    => 'required',

    ];
}