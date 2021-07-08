<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Inward_underprocess extends Model
{
     use SoftDeletes;
	
	protected $table = 'inward_underprocess';
    protected $primaryKey = 'inward_underprocess_id';
    
    protected $dates = ['deleted_at'];

    public function underprocess_coil(){

    	 return $this->hasMany('App\Models\RawMaterial\Under_process_coil','inward_underprocess_id','inward_underprocess_id');;
    }

    public function coilstatus_check(){

        $coil_status=Under_process_coil::with('inward_coil_data')
                                         ->whereHas('inward_coil_data', function($query) {
                                                $query->where('coil_status', '=', 2);
                                             })->get();
        $processed_coil_id=array();
        foreach($coil_status as $coils){
            $processed_coil_id[]=$coils->under_process_coil_id;
        } 
        $under_process_coil_id=implode(',',$processed_coil_id);
    //dd($processed_coil_id);                               
                                         //dd($coil_status->under_process_coil_id);
         return $under_process_coil_id;                                
    }
   

}

