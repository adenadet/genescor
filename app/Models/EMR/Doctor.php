<?php

namespace App\Models\EMR;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'emr_doctors';
    protected $fillable = array('user_id', 'hospital_id', 'annual_license_number', 'license_expiry', 'confirmed_by', 'deleted_by', 'deleted_at');

    public function confirmer(){
    	return $this->belongsTo('App\Models\User', 'confirmed_by', 'id');
	}

    public function hospital(){
    	return $this->belongsTo('App\Models\EMR\Hospital', 'hospital_id', 'id');
	}

    public function subscriptions(){
    	return $this->hasMany('App\Models\EMR\Subscription', 'doctor_id', 'id');
	}

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}
}
