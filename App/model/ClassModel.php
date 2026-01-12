<?php

class ClassModel extends Model
{
    protected $table = 'classes';

    // Validation rules
    protected $rules = [
        'class_name'       => 'required|max:255',
        'description'      => 'max:1000',
        'duration_hours'   => 'required|integer',
        'subject_name'     => 'required|max:255',
        'grade_level_name' => 'required|max:100',
        'category_name'    => 'max:255',
        'language_name'    => 'max:100',
        'thumbnail_path'   => 'max:512',
        'trailer_path'     => 'max:512',
        'max_students'     => 'required|integer',
        'monthly_fee'      => 'required|decimal',
        'target_audience'  => 'max:1000',
        'prerequisites'    => 'max:1000',
        'welcome_message'  => 'max:1000',
        'congrats_message' => 'max:1000',
        'teacher_id'       => 'required|integer',
        'day'              => 'required|max:20',
        'start_time'       => 'required',   
        'end_time'         => 'required',
        'institute_id'     => 'integer'
    ];

    // Allowed columns for insert/update
    public $allowedColumns = [
        'class_name',
        'description',
        'duration_hours',
        'day',
        'start_time',
        'end_time',
        'subject_name',
        'grade_level_name',
        'category_name',
        'language_name',
        'thumbnail_path',
        'trailer_path',
        'max_students',
        'monthly_fee',
        'target_audience',
        'prerequisites',
        'welcome_message',
        'congrats_message',
        'teacher_id',
        'institute_id',
        'created_at'
    ];

    public function getClassesByTeacher($teacher_id){
    $query = "
        SELECT c.*,
               CASE 
                   WHEN c.institute_id IS NOT NULL THEN 'institute'
                   ELSE 'individual'
               END AS class_type,
               IFNULL(e.total_students, 0) AS total_students,
               (c.monthly_fee * IFNULL(e.total_students, 0)) AS revenue
        FROM {$this->table} c
        LEFT JOIN (
            SELECT class_id, COUNT(*) AS total_students
            FROM enrollments
            GROUP BY class_id
        ) e ON c.class_id = e.class_id
        WHERE c.teacher_id = :teacher_id
        ORDER BY c.class_id DESC
    ";
    return $this->query($query, ['teacher_id' => $teacher_id]);
    }


    // Fetch classes with optional subject filter, ordered by class_id
    public function getClasses($subject = null)
    {
        // Temporarily remove limit/offset for this query
        $originalLimit = $this->limit;
        $originalOffset = $this->offset;

        $this->limit = null;
        $this->offset = null;

        if ($subject) {
            
            $items = $this->where(['subject_name' => $subject]); 
        } else {
            $items = $this->where([]);
        }

        // Restore original limit/offset for other queries
        $this->limit = $originalLimit;
        $this->offset = $originalOffset;

        // Sort by class_id manually if your where() doesn’t support ORDER BY
        usort($items, function($a, $b){
            return $a->class_id <=> $b->class_id;
        });

        return $items;
    }

    public function countTeachersByInstitutes($institute_id)
    {
        $query = "
                SELECT COUNT(DISTINCT teacher_id) AS total_teachers
                FROM classes
                WHERE institute_id = :institute_id
        ";

        $result = $this->query($query, [
                'institute_id' => $institute_id
        ]);

        return (!empty($result)) ? (int)$result[0]->total_teachers : 0;
    }

    public function countStudentsByInstitute($institute_id)
    {
        $query = "
                SELECT COUNT(DISTINCT e.student_id) AS total_students
                FROM enrollments e
                INNER JOIN classes c ON e.class_id = c.class_id
                WHERE c.institute_id = :institute_id
        ";

        $result = $this->query($query, [
            'institute_id' => $institute_id
       ]);

       return (!empty($result)) ? (int)$result[0]->total_students : 0;
    }

    public function getClassesByInstituteWithTeacher($institute_id)
    {
    $query = "
        SELECT 
            c.*,
            i.location AS institute_location,
            t.first_name AS teacher_first_name,
            t.last_name  AS teacher_last_name,
            IFNULL(e.total_students, 0) AS total_students,
            (c.monthly_fee * IFNULL(e.total_students, 0)) AS revenue
        FROM classes c
        INNER JOIN institutes i 
            ON c.institute_id = i.institute_id
        LEFT JOIN teachers t 
            ON c.teacher_id = t.teacher_id
        LEFT JOIN (
            SELECT class_id, COUNT(*) AS total_students
            FROM enrollments
            GROUP BY class_id
        ) e ON c.class_id = e.class_id
        WHERE c.institute_id = :institute_id
        ORDER BY c.class_id DESC
    ";

    return $this->query($query, [
        'institute_id' => $institute_id
    ]);
    }


    






    



}