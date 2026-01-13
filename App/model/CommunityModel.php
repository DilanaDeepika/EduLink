<?php
class CommunityModel extends Model
{
    protected $table = 'communities';

    protected $rules = [
        'community_name' => 'required|max:255',
        'description'    => 'required|max:1000',
        'owner_id'       => 'required|numeric',
        'type_id'        => 'required|numeric',
    ];

    protected $allowedColumns = [
        'community_name',
        'description',
        'owner_id',   
        'type_id',   
        'created_at'
    ];
}
