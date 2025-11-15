<?php

class AdvertisementRequest extends Model
{
    protected $table = 'advertisement_requests';
    
    protected $rules = [
        'account_id'         => 'required|integer',
        'advertiser_contact' => 'required|max:255',
        'placement_option'   => 'required',
        'start_time'         => 'required',
        'end_time'           => 'required',
    ];

    protected $allowedColumns = [
        'account_id',
        'advertiser_contact',
        'placement_option',
        'start_time',
        'end_time',
        'poster_path',
        'status'
    ];
}

