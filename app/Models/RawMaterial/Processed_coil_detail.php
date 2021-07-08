<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Processed_coil_detail extends Model
{
     use SoftDeletes;
	
	protected $table = 'processed_coli_detail';
    protected $primaryKey = 'id';
    
    protected $dates = ['deleted_at'];

    public function inward_underprocess_data(){

    	 return $this->hasMany('App\Models\RawMaterial\Inward_underprocess','inward_underprocess_id','inward_underprocess_id');;
    }

    public function underprocess_coil_data(){

    	 return $this->hasMany('App\Models\RawMaterial\Under_process_coil','under_process_coil_id','under_process_coil_id');;
    }
}

