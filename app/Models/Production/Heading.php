<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class Heading extends Model
{
    use SoftDeletes;
	
	protected $table = 'heading';
    protected $primaryKey = 'heading_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $heading_id = '')
    {
        return Validator::make($data, [            
            'processed_coil_id' => 'required',
            //'invoice_no' => 'required',
            //'coilsize_id' => 'required',            
            //'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }
    public function heading_obsdata()
    {   
        return $this->hasMany('App\Models\Production\HeadingObservation','heading_id','heading_id');
    }

    public function headingwire_data()
    {   
        return $this->hasMany('App\Models\Production\HeadingWire','heading_id','heading_id');
    }

    public function headingBall(){

        return $this->hasOne('App\Models\RawMaterial\Ball_Diameter','id','ball_diameter');
    }

    public function processed_coil(){

        return $this->hasOne('App\Models\RawMaterial\Processed_coil','id','processed_coil_id');
    }
      
}
