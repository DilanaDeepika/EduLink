<?php

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $allowedColumns = [
        'account_id',
        'first_name',
        'last_name',
        'phone',
        'profile_image', 
    ];

    protected $rules = [
        'first_name' => 'required|max:255',
        'last_name' => 'max:255', 
        'account_id' => 'required|unique', 
    ];
}
