<?php

namespace App\Models\EMR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialty extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'emr_doctor_specialities';
    protected $fillable = array('id', 'name', 'deleted_by', 'deleted_at');

    public function confirmer(){
    	return $this->belongsTo('App\Models\User', 'confirmed_by', 'id');
	}

}
