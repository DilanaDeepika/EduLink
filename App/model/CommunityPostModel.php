<?php

class CommunityPostModel extends Model
{
    protected $table = "community_posts";

    protected $allowedColumns = [
        'community_id',
        'user_id',
        'name', 
        'description',   
        'file_path',    
        'status',
        'created_at'
    ];

    protected $rules = [
        'community_id' => 'required',
        'user_id'      => 'required',
        'name'         => 'required',
        'description'      => 'required'
    ];
}
