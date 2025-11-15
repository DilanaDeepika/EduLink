<?php

class ClassScheduleModel extends Model
{
    protected $table = 'Class_Schedules';

    protected $rules = [
        'class_id'   => 'required|numeric',
        'day_of_week'=> 'required',
        'start_time' => 'required',
        'end_time'   => 'required'
    ];

    public $allowedColumns = [
        'class_id', 'day_of_week', 'start_time', 'end_time'
    ];

    public function getAllowedColumns()
    {
        return $this->allowedColumns;
    }
}
