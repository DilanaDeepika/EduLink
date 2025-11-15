<?php

class Event extends Model
{
    protected $table = 'account_events'; 

    protected $allowedColumns = [
        'account_id',
        'event_date',
        'event_title',
        'event_time',
        'event_description',
    ];

    protected $rules = [
        'account_id'        => 'required|numeric',
        'event_date'        => 'required|date',
        'event_title'       => 'required|max:255',
        'event_time'        => 'required',
        'event_description' => 'max:1000',
    ];

    public function validate($data)
    {
        parent::validate($data);
        return empty($this->validation_errors);
    }
}
