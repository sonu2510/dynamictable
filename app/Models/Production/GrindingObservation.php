<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class GrindingObservation extends Model
{
    use SoftDeletes;
	
	protected $table = 'grinding_observation';
    protected $primaryKey = 'grinding_observation_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $grinding_observation_id = '')
    {
        return Validator::make($data, [            
           
        ]);
    }    

}
