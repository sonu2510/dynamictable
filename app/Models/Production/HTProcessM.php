<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;
use App\Models\Production\heading;

class HTProcessM extends Model
{
    use SoftDeletes;
	
	protected $table = 'heat_treatment_procces';
    protected $primaryKey = 'heat_treatment_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $heat_treatment_id = '')
    {
        return Validator::make($data, [            
            'ball_size' => 'required',
            'fc_no' => 'required',
           
        ]);
    }
  
    public function flashingbatchno_data()
    {   
        return $this->hasOne('App\Models\Production\FlashingBatch','flashing_batch_id','flashing_batch_id');
    }

    public function headingBall(){

        return $this->hasOne('App\Models\RawMaterial\Ball_Diameter','id','ball_size');
    }

  
      
}
