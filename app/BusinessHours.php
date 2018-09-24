<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
	protected $fillable =[
		'business_id',
		'monday_hours',
		'tuesday_hours',
        'wednesday_hours',
        'thursday_hours',
        'friday_hours',
        'saturday_hours',
        'sunday_hours',
        'bank_hours' ,
	];

    public function business()
    {
    	return $this->belongsTo(Business::class);
    }
}
