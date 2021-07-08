<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class coil_detail extends Model
{
    use SoftDeletes;
	
	protected $table = 'coil_detail';
    protected $primaryKey = 'id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $material_type_id = '')
    {
        return Validator::make($data, [
            'coil_size' => 'required|string',
           // 'name' => 'required' ,
        ]);
    }
}
