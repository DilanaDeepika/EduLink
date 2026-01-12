<?php

class Institute extends Model
{
    protected $table = 'Institutes';
    
    // Validation rules
    protected $rules = [
        'institute_name' => 'required|max:255',
        'location'       => 'required|max:500', 
        'contact_email'  => 'required|email|max:255',
        'contact_phone'  => 'required|max:20',
    ];

    // Allowed columns for insert/update
    protected $allowedColumns = [
        'account_id',
        'institute_name',
        'logo_path',
        'location',
        'contact_email',
        'contact_phone',
        'open_time',
        'close_time',
        'approval_status',
        'approval_document_path',
        'approved_by_admin_id'
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
        $file_input_name = 'approval_document';

        if (empty($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] == UPLOAD_ERR_NO_FILE) {
            $this->validation_errors[$file_input_name] = 'An approval document is required.';
        } 
        elseif ($_FILES[$file_input_name]['error'] != UPLOAD_ERR_OK) {
            $this->validation_errors[$file_input_name] = 'There was an error uploading your file. Please try again.';
        }

        return empty($this->validation_errors);
    }

    public function validateProfileUpdate($data){
        
        parent::validate($data);
        return empty($this->validation_errors);
    }

    public function getPriorityInstitutes($limit = 5)
    {
        $limit = (int)$limit; // ensure it is an integer

        $sql = "SELECT i.* 
                FROM institutes i
                JOIN institutes_priority p ON i.institute_id = p.institute_id
                ORDER BY p.priority ASC
                LIMIT $limit"; // inject the integer directly

        return $this->query($sql); 
    }

    public function updateByInstituteId($institute_id, $data)
    {
        // Call the generic update function in Model.php
        return $this->update($institute_id, $data, 'institute_id');
    }

    
}