<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class LappingObservation extends Model
{
    use SoftDeletes;
	
	protected $table = 'lapping_observation';
    protected $primaryKey = 'lapping_observation_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $lapping_observation_id = '')
    {
        return Validator::make($data, [            
            //'supplier_id' => 'required',
            //'invoice_no' => 'required',
            //'coilsize_id' => 'required',            
            //'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }    

}
