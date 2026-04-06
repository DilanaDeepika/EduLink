<?php

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $rules = [
        'class_name'       => 'required|max:255',
        'description'      => 'max:1000',
        'type'             => 'required|max:255',
        'subject_name'     => 'required|max:255',
        'grade_level_name' => 'required|max:100',
        'category_name'    => 'max:255',
        'language_name'    => 'max:100',
        'thumbnail_path'   => 'max:512',
        'trailer_path'     => 'max:512',
        'max_students'     => 'required|integer',
        'monthly_fee'      => 'required|numeric',
        
        'teacher_fee'      => 'numeric',
        'marking_fee'      => 'numeric',

        'bank_name'        => 'max:100',
        'branch_name'      => 'max:100',
        'account_name'     => 'max:255',
        'account_number'   => 'max:50',
        'payment_instructions' => 'max:1000',

        'target_audience'  => 'max:1000',
        'prerequisites'    => 'max:1000',
        'welcome_message'  => 'max:1000',
        'congrats_message' => 'max:1000',
        'teacher_id'       => 'required|integer',
        'institute_id'     => 'integer'
    ];

    public $allowedColumns = [
        'class_name',
        'description',
        'type',
        'subject_name',
        'grade_level_name',
        'category_name',
        'language_name',
        'thumbnail_path',
        'trailer_path',
        'max_students',
        'monthly_fee',
        'teacher_fee',
        'marking_fee',
        'bank_name',
        'branch_name',
        'account_name',
        'account_number',
        'payment_instructions',

        'target_audience',
        'prerequisites',
        'welcome_message',
        'congrats_message',
        'teacher_id',
        'institute_id',
        'created_at'
    ];

    public function getAllowedColumns()
    {
        return $this->allowedColumns;
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

    public function getClassesByInstituteWithTeacher($institute_id)
    {
    $query = "
        SELECT 
            c.*,
            i.location AS institute_location,
            t.first_name AS teacher_first_name,
            t.last_name  AS teacher_last_name,
            IFNULL(e.total_students, 0) AS total_students
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