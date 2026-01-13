<?php
class FreeCardApplication extends Model
{
    protected $table = 'free_card_applications';

    protected $rules = [
        'student_id' => 'required|numeric',
        'documentation_path' => 'required'
    ];

        protected $allowedFields = [
        'student_id',
        'documentation_path',
        'status',
        'application_date'
    ];
}
