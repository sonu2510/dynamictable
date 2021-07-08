<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\MessageBag;
use Validator; 
use App\Models\RawMaterial\CoilInward;

class HeadingWire extends Model
{
    use SoftDeletes;
	
	protected $table = 'heading_wire';
    protected $primaryKey = 'heading_wire_id';
    
    protected $dates = ['deleted_at'];
	    
      
}
