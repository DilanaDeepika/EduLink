<?php

class Student extends Model
{
    protected $table = 'students';
    
    protected $rules = [
        'first_name' => 'required|max:255',
        'last_name' => 'max:255',
        'school_name' => 'required|max:255', 
        'address' => 'required|max:500',
        'stream' => 'required',
    ];


    public function countStudentsforTeachers($teacher_id)
    {
    // SQL: join classes and enrollments, count students for this teacher
    $query = "
        SELECT COUNT(DISTINCT e.student_id) AS student_count
        FROM enrollments e
        INNER JOIN classes c ON e.class_id = c.class_id
        WHERE c.teacher_id = :teacher_id
    ";

    $result = $this->query($query, [
        'teacher_id' => $teacher_id
    ]);

    return $result ? $result[0]->student_count : 0;
   
   
    }

}