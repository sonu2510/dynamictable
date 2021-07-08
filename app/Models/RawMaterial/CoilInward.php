<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class CoilInward extends Model
{
     use SoftDeletes;
	
	protected $table = 'inward_coil_detail';
    protected $primaryKey = 'inward_coil_id';
    
    protected $dates = ['deleted_at'];

    public function issue_inwards_data(){

    	 return $this->hasMany('App\Models\RawMaterial\Inward','id','inward_id');;
    }
     public function coil_data(){

    	 return $this->hasOne('App\Models\RawMaterial\coil_detail','id','coilsize_id');;
    }
}

