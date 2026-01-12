<?php

class ClassScheduleModel extends Model
{
    protected $table = 'class_schedules';

    protected $rules = [
        'class_id'   => 'required|numeric',
        'day_of_week'=> 'required',
        'start_time' => 'required',
        'end_time'   => 'required',
        'place'      => 'required',
        'link'       => 'required'
    ];

    public $allowedColumns = [
        'class_id', 'day_of_week', 'start_time', 'end_time','place','link'
    ];

    public function getAllowedColumns()
    {
        return $this->allowedColumns;
    }
}
