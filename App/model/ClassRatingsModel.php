<?php

class ClassRatingsModel extends Model
{
    protected $table = "class_ratings";

    Public $allowedColumns = [
        'class_id',
        'account_id',
        'rating',
        'review_text',
        'created_at' ,
    ];

    protected $rules = [
        'rating' => 'required|numeric',
        'class_id' => 'required|numeric',
        'account_id' => 'required|numeric',
    ];

    public function getAllowedColumns()
    {
        return $this->allowedColumns;
    }
}
