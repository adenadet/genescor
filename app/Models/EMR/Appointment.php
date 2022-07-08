<?php

namespace App\Models\EMR;

use App\Models\Structure;

class Appointment extends Structure
{
    protected $primaryKey = 'id';
    protected $table = 'emr_appointments';
    protected $fillable = array('user_id', 'hospital_id', 'doctor_id', 'status', 'complaint', 'preferred_date', 'preferred_time', 'fixed_time', 'deleted_by', 'deleted_at');

    public function doctor(){
    	return $this->belongsTo('App\Models\EMR\Doctor', 'doctor_id', 'id');
	}

    public function hospital(){
    	return $this->belongsTo('App\Models\EMR\Hospital', 'hospital_id', 'id');
	}

    public function patient(){
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}
}
