<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class Flashing extends Model
{
    use SoftDeletes;
	
	protected $table = 'flashing';
    protected $primaryKey = 'flashing_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $flashing_id = '')
    {
        return Validator::make($data, [            
            //'processed_coil_id' => 'required',
            //'invoice_no' => 'required',
            //'coilsize_id' => 'required',            
            //'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }
    public function flashing_obsdata()
    {   
        return $this->hasMany('App\Models\Production\FlashingObservation','flashing_id','flashing_id');
    }
   
    public function Ball_data(){

        return $this->belongsTo('App\Models\RawMaterial\Ball_Diameter','ball_diameter');
    }
     public function masterbatch_data(){

        return $this->hasOne('App\Models\Production\MasterBatchNo','batch_id','batch_id');
    }
   
      
}
