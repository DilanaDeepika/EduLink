<?php
class EnrollmentModel extends Model
{
    protected $table = "enrollments"; 

    protected $allowedColumns = [
        'enrollment_id',
        'student_id',
        'class_id',
        'enrollment_date',
        'status',
        'trial_start',
        'trial_end'
    ];

    public function getEnrollment($student_id, $class_id)
    {
        return $this->first([
            'student_id' => $student_id,
            'class_id' => $class_id
        ]);
    }

    public function startFreeTrial($student_id, $class_id)
{
    return $this->insert([
        'student_id'      => $student_id,
        'class_id'        => $class_id,
        'enrollment_date' => date('Y-m-d'),
        'trial_start'     => date('Y-m-d'),
        'trial_end'       => date('Y-m-d', strtotime('+14 days')),
        'status'          => 'trial'
    ]);
}

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

  public function getEnrolledStudentsByClass($class_id)
{
    $sql = "SELECT s.student_id, s.first_name, s.last_name, s.phone_number, 
                   s.school_name, s.stream,s.profile_picture,
                   COALESCE(p.status, 'pending') AS payment_status
            FROM enrollments e
            JOIN students s ON e.student_id = s.student_id
            LEFT JOIN payments p ON p.enrollment_id = e.enrollment_id
            WHERE e.class_id = :class_id AND e.status = 'enrolled'
            ORDER BY s.student_id ASC";

    return $this->query($sql, ['class_id' => $class_id]);
}


}