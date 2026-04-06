<?php

class PaperMarksModel extends Model
{
    protected $table = "paper_marks";

    protected $allowedColumns = [
        'paper_id',
        'student_id',
        'marks_obtained'
    ];

    protected $rules = [
        'paper_id'       => 'required|numeric',
        'student_id'     => 'required|numeric',
        'marks_obtained' => 'required|numeric'
    ];


public function getStudentRankingsByClass($class_id)
{
    $query = "SELECT 
                m.student_id, 
                s.first_name,  
                s.last_name, 
                SUM(m.marks_obtained) as total_score, 
                ROUND(AVG(m.marks_obtained), 2) as avg_score 
              FROM paper_marks m 
              JOIN papers p ON m.paper_id = p.paper_id      
              JOIN students s ON m.student_id = s.student_id 
              WHERE p.class_id = :class_id              
              GROUP BY m.student_id 
              ORDER BY avg_score DESC";

    return $this->query($query, ['class_id' => $class_id]);
}
}