<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Vendor extends Model
{
    use SoftDeletes;
	
	protected $table = 'vendor_detail';
    protected $primaryKey = 'id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $vendor_id = '')
    {
        return Validator::make($data, [
            'company_name' => 'required|string',
           // 'name' => 'required' ,
        ]);
    }
}
