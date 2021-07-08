<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Qcinward extends Model
{
    use SoftDeletes;
	
	protected $table = 'inward_qc_detail';
    protected $primaryKey = 'id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $id = '')
    {
        return Validator::make($data, [            
            'inward_id' => 'required',
            'eatching' => 'required',
           /* 'hardness' => 'required',   */        
           
           // 'name' => 'required' ,
        ]);
    }
}
