<?php

class ClassObjectiveModel extends Model
{
    protected $table = 'class_objectives';

    protected $rules = [
        'class_id'      => 'required|numeric',
        'objective_text'=> 'required|max:512'
    ];

    public $allowedColumns = [
        'class_id', 'objective_text'
    ];

    public function getAllowedColumns()
    {
        return $this->allowedColumns;
    }
}
