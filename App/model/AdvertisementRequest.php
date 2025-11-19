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
        'account_id',
        'advertiser_name',
        'advertiser_contact',
        'placement_option',
        'start_datetime',
        'end_datetime',
        'poster_path',
        'status',
        'is_paid',
        'admin_message'
    ];
    public function checkConflict($placement, $start, $end)
    {
        $sql = "SELECT * FROM $this->table 
                WHERE placement_option = :placement
                AND status = 'Active'
                AND start_datetime < :end
                AND end_datetime > :start";

        return $this->query($sql, [
            'placement' => $placement,
            'start' => $start,
            'end' => $end
        ]);
    }

}
