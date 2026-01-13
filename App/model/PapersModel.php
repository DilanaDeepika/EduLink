<?php

class PapersModel extends Model
{
    protected $table = "papers";

    protected $allowedColumns = [
        'class_id',
        'title'
    ];

    protected $rules = [
        'class_id' => 'required|numeric',
        'title'    => 'required'
    ];
}