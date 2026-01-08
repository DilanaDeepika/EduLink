<?php

class ClassContent extends Model
{
    protected $table = 'class_content';
    
    // Validation rules
    protected $rules = [
        'class_id'     => 'required|integer',
        'title'        => 'required|max:255',
        'description'  => 'nullable',
        'content_type' => 'required|in:video_recording,note,past_paper,model_paper,external_link',
        'content_path' => 'required|max:512',
    ];

    // Allowed columns for insert/update
    protected $allowedColumns = [
        'class_id',
        'title',
        'description',
        'content_type',
        'content_path',
        'uploaded_at'
    ];
}
