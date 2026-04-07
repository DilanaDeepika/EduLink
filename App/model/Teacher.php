<?php

class Teacher extends Model
{
    protected $table = 'teachers';

    
    // Rules for the text fields
    protected $rules = [
        'first_name'       => 'required|max:255',
        'last_name'        => 'max:255',
        'email'            => 'required|email|max:255', 
        'phone'            => 'required|max:20', 
        'subjects_taught'  => 'required', 
    ];

    // Allowed columns for insert/update
    protected $allowedColumns = [
        'teacher_id',
        'account_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'subjects_taught',
        'approval_status',
        'approval_document_path',
        'approved_by_admin_id',
        'profile_photo'
    ];
        public function getAllowedColumns()
    {
        return $this->allowedColumns;
    }


    // Override validate() to add the file check
    public function validate($data)
    {
        // 1. Run generic rules for text fields
        parent::validate($data);

        // 2. Check for the file upload
        // (This assumes your file input is named 'approval_document')
        $file_input_name = 'approval_document';

        if (empty($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] == UPLOAD_ERR_NO_FILE) {
            $this->validation_errors[$file_input_name] = 'An approval document is required.';
        } 
        elseif ($_FILES[$file_input_name]['error'] != UPLOAD_ERR_OK) {
            $this->validation_errors[$file_input_name] = 'There was an error uploading your file. Please try again.';
        }
        // You could add more checks here (file size, file type)

        return empty($this->validation_errors);
    }

    public function validateUpdate($data)
    {
    // Only validate the fields the user can update
    $rules = [
        'first_name' => 'required|max:255',
        'last_name'  => 'max:255',
        'email'      => 'required|email|max:255',
        'phone'   => 'required|max:20',
    ];

    $this->validation_errors = [];

    foreach ($rules as $field => $rule) {
        $value = $data[$field] ?? '';

        // Check required
        if (strpos($rule, 'required') !== false && empty($value)) {
            $this->validation_errors[$field] = "$field is required";
        }

        // Check max length
        if (preg_match('/max:(\d+)/', $rule, $matches)) {
            $max = $matches[1];
            if (strlen($value) > $max) {
                $this->validation_errors[$field] = "$field must be at most $max characters";
            }
        }

        // Check email format
        if (strpos($rule, 'email') !== false && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->validation_errors[$field] = "Invalid email format";
        }
    }

    return empty($this->validation_errors);
   }


    public function updateByTeacherId($teacher_id, $data)
    {
        // Call the generic update function in Model.php
        return $this->update($teacher_id, $data, 'teacher_id');
    }
    public function getTeacherRevenueByMonth($teacher_id, $yearMonth)
{
    $monthStart = $yearMonth . '-01';
    $monthEnd   = date('Y-m-t', strtotime($monthStart)); 

    $query = "
        SELECT COALESCE(SUM(p.amount), 0) AS revenue
        FROM payments p
        INNER JOIN enrollments e ON e.enrollment_id = p.enrollment_id
        INNER JOIN classes c ON c.class_id = e.class_id
        WHERE c.teacher_id = :teacher_id
          AND p.status = 'completed'
          AND p.payment_date >= :month_start
          AND p.payment_date < DATE_ADD(:month_end, INTERVAL 1 DAY)
    ";

    return $this->query($query, [
        'teacher_id'  => $teacher_id,
        'month_start' => $monthStart,
        'month_end'   => $monthEnd,
    ]);
}

public function getTeachersByInstituteAndSubject($institute_id, $subject)
    {
    $query = "
        SELECT DISTINCT t.*
        FROM teachers t
        INNER JOIN classes c ON t.teacher_id = c.teacher_id
        WHERE c.institute_id = :institute_id
          AND c.subject_name LIKE :subject
        ORDER BY t.first_name, t.last_name
    ";

    return $this->query($query, [
        'institute_id' => $institute_id,
        'subject' => '%' . $subject . '%'
    ]);
    }

    public function getTeachersBySubject($subject)
    {
    $query = "SELECT * FROM teachers 
              WHERE subjects_taught LIKE :subject";

    return $this->query($query, [
        'subject' => '%' . $subject . '%'
    ]);

    }
    public function getTeachersByInstituteSubjectAndSearch($institute_id, $subject, $search)
{
    $query = "
        SELECT DISTINCT t.*
        FROM teachers t
        INNER JOIN classes c ON c.teacher_id = t.teacher_id
        WHERE c.institute_id = :institute_id
        AND c.subject_name = :subject
        AND (
            t.first_name LIKE :search
            OR t.last_name LIKE :search
        )
    ";

    return $this->query($query, [
        'institute_id' => $institute_id,
        'subject' => $subject,
        'search' => '%' . $search . '%'
    ]);
}
    public function searchTeachersByInstitute($institute_id, $search)
    {
    $query = "
        SELECT DISTINCT t.*
        FROM teachers t
        INNER JOIN classes c ON c.teacher_id = t.teacher_id
        WHERE c.institute_id = :institute_id
        AND (
            t.first_name LIKE :search
            OR t.last_name LIKE :search
        )
    ";

    return $this->query($query, [
        'institute_id' => $institute_id,
        'search' => '%' . $search . '%'
    ]);
    }

    public function getTeachersByInstitute($institute_id)
    {
    $query = "
        SELECT DISTINCT t.*
        FROM teachers t
        INNER JOIN classes c ON t.teacher_id = c.teacher_id
        WHERE c.institute_id = :institute_id
        ORDER BY t.first_name, t.last_name
    ";

    return $this->query($query, [
        'institute_id' => $institute_id
    ]);
    }





}