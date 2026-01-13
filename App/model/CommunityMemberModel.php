<?php

class CommunityMemberModel extends Model
{
    protected $table = "community_members";

    protected $allowedColumns = [
        'community_id',
        'user_id',
        'role',
        'joined_at'
    ];

    protected $rules = [
        'community_id' => 'required',
        'user_id'      => 'required',
        'role'         => 'required'
    ];
}
