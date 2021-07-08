<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Under_process_coil extends Model
{
     use SoftDeletes;
	
	protected $table = 'under_process_coil';
    protected $primaryKey = 'under_process_coil_id';
    
    protected $dates = ['deleted_at'];

    public function coil_data(){

    	 return $this->hasOne('App\Models\RawMaterial\coil_detail','id','coil_size_id');;
    }

    public function inward_coil_data(){

         return $this->hasOne('App\Models\RawMaterial\CoilInward','inward_coil_id','inward_coil_id');;
    }

   /* public function inward_underprocess_data(){

    	 return $this->hasMany('App\Models\RawMaterial\Inward_underprocess','inward_underprocess_id','inward_underprocess_id');;
    }*/

    public function underprocess_coil_data(){

    	 return $this->hasMany('App\Models\RawMaterial\Processed_coil_detail','under_process_coil_id','under_process_coil_id');;
    }
  
}

