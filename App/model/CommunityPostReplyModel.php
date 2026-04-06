<?php

class CommunityPostReplyModel extends Model
{
    protected $table = "community_post_replies";

    protected $allowedColumns = [
        'post_id',
        'user_id',
        'reply',
        'created_at'
    ];

    protected $rules = [
        'post_id' => 'required',
        'user_id' => 'required',
        'reply'   => 'required'
    ];
}
