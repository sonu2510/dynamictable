<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class Grinding extends Model
{
    use SoftDeletes;
	
	protected $table = 'grinding';
    protected $primaryKey = 'grinding_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $grinding_id = '')
    {
        return Validator::make($data, [            
            //'processed_coil_id' => 'required',
            //'invoice_no' => 'required',
            //'coilsize_id' => 'required',            
            //'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }
    public function grinding_obsdata()
    {   
        return $this->hasMany('App\Models\Production\GrindingObservation','grinding_id','grinding_id');
    }
   
    public function balldia_data(){

        return $this->hasOne('App\Models\RawMaterial\Ball_Diameter','id','ball_diameter');
    }
     public function masterbatch_data(){

        return $this->hasOne('App\Models\Production\MasterBatchNo','batch_id','batch_id');
    }
   
      
}
