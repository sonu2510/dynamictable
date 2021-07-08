<?php
namespace App\Helpers;
use App\Http\Traits\datatabledom;
use App\Models\admin_menu;
use App\Models\role_permission_model;
use Auth;
use Illuminate\Support\Facades\Route;

class Helper {
	use datatabledom;
	public static function Combo_Button2() {

		$html = '<button type="button" id="active_all" class="btn btn-sm btn-success "><i class="fa fa-check"></i> Active</button>
			   <button type="button" id="inactive_all" class="btn btn-sm btn-warning "><i class="fa fa-times"></i> Inactive</button>';
		return $html;
	}
	public static function Combo_Button3() {

		$permissiondata = self::permission(Route::getFacadeRoot()->current()->uri());
		$menu_id = $permissiondata[0];
		$DeletePermission = $permissiondata[2];

		$html = '<button type="button" id="active_all" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Active</button>
			   <button type="button" id="inactive_all" class="btn btn-sm btn-warning "><i class="fa fa-times"></i> Inactive</button>&nbsp;';

		if (in_array($menu_id, $DeletePermission)) {
			$html .= '<button type="button" id="delete_all" class="btn btn-sm btn-danger "><i class="far fa-trash-alt"></i> Delete</button>';
		}

		return $html;
	}
	public static function Combo_Button4($url) {
		$permissiondata = self::permission(Route::getFacadeRoot()->current()->uri());
		$menu_id = $permissiondata[0];
		$AddPermission = $permissiondata[3];
		$DeletePermission = $permissiondata[2];
		$html = '';

		if (in_array($menu_id, $AddPermission)) {
			$html .= '<a href="' . $url . '"><button type="button" id="addnew" class="btn btn-sm btn-success btn-rounded"><i class="fa fa-plus"></i> New&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;</a>';
		}
		$html .= '<button type="button" id="active_all" class="btn btn-sm btn-success btn-rounded"><i class="fa fa-check"></i> Active</button>
			   <button type="button" id="inactive_all" class="btn btn-sm btn-warning btn-rounded"><i class="fa fa-times"></i> Inactive</button>&nbsp;';
		if (in_array($menu_id, $DeletePermission)) {
			$html .= '<button type="button" id="delete_all" class="btn btn-sm btn-danger btn-rounded"><i class="far fa-trash-alt"></i> Delete</button>';
		}
		return $html;
	}

	public static function permission() {
		$getPermission = role_permission_model::join('users', 'users.id', '=', 'role_permission.user_id')
			->where('users.id', '=', Auth::user()->id)
			->first();
	
		$menuid = admin_menu::select('*')->Where('route', '=', Route::getFacadeRoot()->current()->uri())->first();
		$menuid = $menuid['admin_id'];
		$EditPermission = unserialize($getPermission['edit_permission']);
		$DeletePermission = unserialize($getPermission['delete_permission']);
		$AddPermission = unserialize($getPermission['add_permission']);

		return array($menuid, $EditPermission, $DeletePermission, $AddPermission);

	}

	public static function Combo_Button_add($url,$addform_name) {
		$permissiondata = self::permission(Route::getFacadeRoot()->current()->uri());
		$menu_id = $permissiondata[0];
		$AddPermission = $permissiondata[3];
		$DeletePermission = $permissiondata[2];
		$html = '';

		if (in_array($menu_id, $AddPermission)) {
			$html .= '<a href="' . $url . '"><button type="button" id="addnew" class="btn btn-sm btn-success btn-rounded"><i class="fa fa-plus"></i> &nbsp;New&nbsp;'.ucfirst($addform_name).'</button>&nbsp;</a>';
		}
		
		return $html;
	}

	public static function ViewPermission() {
		$getPermission = role_permission_model::join('users', 'users.id', '=', 'role_permission.user_id')
			->where('users.id', '=', Auth::user()->id)
			->first();
		$menuid = admin_menu::select('*')->Where('route', '=', Route::getFacadeRoot()->current()->uri())->first();
		$menuid = $menuid['admin_id'];
		$ViewPermission = unserialize($getPermission['view_permission']);
		if (in_array($menuid, $ViewPermission)) {
			return '1';
		} else {
			return '';
		}

	}

}