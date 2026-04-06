<?php

class Student extends Model
{
    protected $table = 'students';
    
protected $rules = [
    'first_name' => 'required|max:255',
    'last_name'  => 'max:255',
    'school_name'=> 'required|max:255',
    'address'    => 'required|max:500',
];


   
}