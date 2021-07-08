<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 

class MasterBatchNo extends Model
{
    use SoftDeletes;
	
	protected $table = 'masterbatchno';
    protected $primaryKey = 'batch_id';
    
    protected $dates = ['deleted_at'];
	 
    public static function validator(array $data, $batch_id = '')
    {
        
    }
    
    public function flashingbatch(){
    	 return $this->hasOne('App\Models\Production\FlashingBatch','master_batch_id','batch_id');
    }
      
}
