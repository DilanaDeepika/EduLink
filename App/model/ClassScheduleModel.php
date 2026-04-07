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

    //Teacher Calendar
    public function getTeacherCalendar($teacher_id){
        $sql = "SELECT 
                    cs.id, 
                    c.class_name AS title,
                    s.day_of_week,
                    cs.start_time,
                    cs.end_time
                FROM Class_Schedules cs
                JOIN classes c ON cs.class_id = c.id
                WHERE c.teacher_id = :teacher_id
        ";

        return $this->query($sql, [
            'teacher_id' => teacher_id
        ]);
    }

    // Institute calendar
    public function getInstituteCalendar($institute_id)
    {
        $sql = "
            SELECT 
                cs.id,
                c.class_name AS title,
                cs.day_of_week,
                cs.start_time,
                cs.end_time
            FROM Class_Schedules cs
            JOIN classes c ON cs.class_id = c.id
            WHERE c.institute_id = :institute_id
        ";

        return $this->query($sql, [
            'institute_id' => $institute_id
        ]);
    }
    
}
