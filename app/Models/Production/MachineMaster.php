<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\Production\MachineTypeMaster;

class MachineMaster extends Model
{
    use SoftDeletes;
	
	protected $table = 'machine_master';
    protected $primaryKey = 'machine_master_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $machine_master_id  = '')
    {
        return Validator::make($data, [            
            'machine_type_id' => 'required',
            'machine_name' => 'required',
           
        ]);
    }
     public function machine_type(){

        return $this->hasOne('App\Models\Production\MachineTypeMaster','machine_type_id','machine_type_id');
    }
    
      
}
