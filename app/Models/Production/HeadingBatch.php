<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class HeadingBatch extends Model
{
    use SoftDeletes;
	
	protected $table = 'heading_batch';
    protected $primaryKey = 'heading_batch_id';
    
    protected $dates = ['deleted_at'];
	    
      
}
