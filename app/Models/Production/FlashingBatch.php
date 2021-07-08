<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class FlashingBatch extends Model
{
    use SoftDeletes;
	
	protected $table = 'flashing_batch';
    protected $primaryKey = 'flashing_batch_id';
    
    protected $dates = ['deleted_at'];
	    
      
}
