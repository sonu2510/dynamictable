<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class admin_menu extends Model
{
    protected $table = 'admin_menu';
    protected $fillable = ['parent_id', 'title','route','icon','sort','status'];

	protected $primaryKey = 'admin_id';

    public function parent()
    {
        return $this->belongsTo('App\Models\admin_menu', 'parent_id')->orderBy('sort');
    }

    public function children()
    {
        return $this->hasMany('App\Models\admin_menu', 'parent_id')->where('status',1)->orderBy('sort');
    }
    public static function tree() {

        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=','0')->where('status',1)->orderBy('sort')->get();

    }
    public static function validator(array $data, $admin_id = '')
    {
        return Validator::make($data, []);
    }
   
}
