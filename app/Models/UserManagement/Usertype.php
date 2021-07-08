<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class Usertype extends Model
{
    use SoftDeletes;
	
	protected $table = 'usertype';
    protected $primaryKey = 'user_type_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $user_type_id = '')
    {
        return Validator::make($data, [
            'name' => 'required|string',
           // 'name' => 'required' ,
        ]);
    }

     public function User()
    {   
        return $this->hasMany('App\User','user_type_id','user_type_id');
    }
}
