<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class HeadingObservation extends Model
{
    use SoftDeletes;
	
	protected $table = 'heading_observation';
    protected $primaryKey = 'heading_observation_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $heading_observation_id = '')
    {
        return Validator::make($data, [            
            //'supplier_id' => 'required',
            //'invoice_no' => 'required',
            //'coilsize_id' => 'required',            
            //'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }
    public function qc_data()
    {   
        return $this->hasOne('App\Models\RawMaterial\Qcinward','inward_id','id');
    }

}
