<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 


class LappingObsCount extends Model
{
    use SoftDeletes;
	
	protected $table = 'lapping_obs_count';
    protected $primaryKey = 'lapping_obs_count_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $lapping_obs_count_id = '')
    {
        return Validator::make($data, [            
            //'processed_coil_id' => 'required',
            //'invoice_no' => 'required',
            //'coilsize_id' => 'required',            
            //'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }
     public function lappingobs()
    {   
        return $this->hasMany('App\Models\Production\LappingObservation','lapping_obs_count_id','lapping_obs_count_id');
    }     
   
      
}
