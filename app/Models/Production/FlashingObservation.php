<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class FlashingObservation extends Model
{
    use SoftDeletes;
	
	protected $table = 'flashing_observation';
    protected $primaryKey = 'flashing_observation_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $flashing_observation_id = '')
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
