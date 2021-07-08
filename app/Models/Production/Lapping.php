<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 


class Lapping extends Model
{
    use SoftDeletes;
	
	protected $table = 'lapping';
    protected $primaryKey = 'lapping_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $lapping_id = '')
    {
        return Validator::make($data, [            
            //'processed_coil_id' => 'required',
            //'invoice_no' => 'required',
            //'coilsize_id' => 'required',            
            //'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }
    public function lapping_obsdata()
    {   
        return $this->hasMany('App\Models\Production\LappingObservation','lapping_id','lapping_id');
    }
    public function lapping_spacification()
    {   
        return $this->hasMany('App\Models\Production\LappingSpecification','lapping_specification_id','lapping_specification_id');
    }
   
    public function balldia_data(){

        return $this->hasOne('App\Models\RawMaterial\Ball_Diameter','id','ball_diameter');
    }
    public function masterbatch_data(){

        return $this->hasOne('App\Models\Production\MasterBatchNo','batch_id','batch_id');
    }
   
      
}
