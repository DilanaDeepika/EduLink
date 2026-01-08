<?php

class AdvertisementRequest extends Model
{
    protected $table = 'advertisement_requests';

    protected $rules = [
        'account_id'       => 'required|integer',
        'advertiser_contact' => 'required|max:255',
        'placement_option' => 'required',
        'start_datetime'   => 'required|datetime',
        'end_datetime'     => 'required|datetime',

    ];

    protected $allowedColumns = [
        'id',
        'account_id',
        'advertiser_name',
        'advertiser_contact',
        'placement_option',
        'start_datetime',
        'end_datetime',
        'poster_path',
        'status',
        'is_paid',
        'admin_message',
        'price',
        'community_id',
        'class_id',
        'description'
    ];
}
