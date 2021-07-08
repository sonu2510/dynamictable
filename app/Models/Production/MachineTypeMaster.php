<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class MachineTypeMaster extends Model
{
    use SoftDeletes;
	
	protected $table = 'machinetype_master';
    protected $primaryKey = 'machine_type_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $machine_type_id = '')
    {
        return Validator::make($data, [            
            'machine_type' => 'required',           
        ]);
    }
    
      
}
