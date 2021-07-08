<?php

namespace App\Models\RawMaterial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Ball_Diameter extends Model
{
    use SoftDeletes;
	
	protected $table = 'ball_size';
    protected $primaryKey = 'id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $bakksize_id = '')
    {
        return Validator::make($data, [
            'ball_size' => 'required|string',
           // 'name' => 'required' ,
        ]);
    }
}
