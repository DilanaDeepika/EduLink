<?php
class CommunityMessageModel extends Model
{
    protected $table = "community_messages";

    protected $allowedColumns = [
        'community_id',
        'user_id',
        'message',
        'created_at'
    ];

    protected $rules = [
        'community_id' => 'required',
        'user_id'      => 'required',
        'message'      => 'required'
    ];
}
