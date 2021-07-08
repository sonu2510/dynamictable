<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class Inward extends Model
{
    use SoftDeletes;
	
	protected $table = 'inward_detail';
    protected $primaryKey = 'id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $inward_id = '')
    {
        return Validator::make($data, [            
            'supplier_id' => 'required',
            'invoice_no' => 'required',
            'coilsize_id' => 'required',            
            'total_weight' => 'required',          
           
           // 'name' => 'required' ,
        ]);
    }
    public function qc_data()
    {   
        return $this->hasOne('App\Models\RawMaterial\Qcinward','inward_id','id');
    }

    public function coil_data()
    {   
        return $this->hasMany('App\Models\RawMaterial\CoilInward','inward_id','id');
    }

     public function vendor()
    {   
        return $this->hasOne('App\Models\Vendor\Vendor','id','supplier_id');
    }

     public function coil_size()
    {   
        return $this->hasOne('App\Models\RawMaterial\coil_detail','id','coilsize_id');
    }

    public function inward_processed_coil(){

        return $this->hasOne('App\Models\RawMaterial\Inward_processed_coil','inward_id','id');
    }
    
}
