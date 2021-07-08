<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Processed_coil extends Model
{
    use SoftDeletes;
	
	protected $table = 'processedcoil';
    protected $primaryKey = 'id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $processedcoil_id = '')
    {
        return Validator::make($data, [
            'coil_size' => 'required|string',
           // 'name' => 'required' ,
        ]);
    }
}
