<?php

namespace App\Http\Traits;

use App\Models\admin_menu;
use App\Models\role_permission_model;
use Auth;

trait datatabledom {

	public function checkboxDom($id) {
		$html = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="sub_chk custom-control-input" id="customCheck' . $id . '" value="' . $id . '"  data-id="' . $id . '" >
                    <label class="sub_chk custom-control-label" for="customCheck' . $id . '"  data-id="' . $id . '" ></label>
                </div>';
		//$html='<input type="checkbox" id="sub_chk" class=""  data-id="' . $id . '"  value="' .$id. '">';
		return $html;
	}

	public function SwitchDom($id, $status) {

		$html = '';
		if ($status == 1) {
			$html .= '<span class="label label-rounded label-success">Active</span>';
		} else {
			$html .= '<span class="label label-rounded label-danger">Inactive</span>';
		}
		return $html;
	}

	public function EditDom($url, $id, $route) {
		$permissiondata = $this->permission($route);
		$menu_id = $permissiondata[0];
		$EditPermission = $permissiondata[1];

		$html = '<a href="' . $url . '/' . $id . '" ><button type="button" class="btn btn-info waves-effect waves-light btn-sm"><i class="far fa-edit"> Edit</i></button></a>&nbsp;';

		return (in_array($menu_id, $EditPermission)) ? $html : '';
	}

	public function DeleteDom($url, $id, $route) {
		$permissiondata = $this->permission($route);
		$menu_id = $permissiondata[0];
		$DeletePermission = $permissiondata[2];

		$html = '<a href="' . $url . '/' . $id . '" ><button type="button" href="" class="btn waves-effect waves-light btn-square btn-danger btn-sm"><i class="far fa-trash-alt"></i></button></a>&nbsp;';
		return (in_array($menu_id, $DeletePermission)) ? $html : '';
	}

	public function permission($route) {
		$getPermission = role_permission_model::join('users', 'users.id', '=', 'role_permission.user_id')
			->where('users.id', '=', Auth::user()->id)
			->first();
		$menuid = admin_menu::select('*')->Where('route', '=', $route)->first();
		$menuid = $menuid['admin_id'];
		$EditPermission = unserialize($getPermission['edit_permission']);
		$DeletePermission = unserialize($getPermission['delete_permission']);

		return array($menuid, $EditPermission, $DeletePermission);
	}

	public function MultipleEditDom($url, $id, $type_air, $type_sea, $type_pick, $label_air, $label_sea, $label_pick, $class_air, $class_sea, $class_pick) {
		$html = '<a href="' . $url . '/' . $id . '/' . $type_air . '" ><button type="button" class="btn btn-sm waves-effect waves-light btn-rounded ' . $class_air . '"><i class="fa fa-edit">' . $label_air . '</i></button></a>&nbsp;&nbsp;&nbsp;<a href="' . $url . '/' . $id . '/' . $type_sea . '" ><button type="button" class="btn btn-sm waves-effect waves-light btn-rounded ' . $class_sea . '"><i class="fa fa-edit">' . $label_sea . '</i></button></a>&nbsp;&nbsp;&nbsp;<a href="' . $url . '/' . $id . '/' . $type_pick . '" ><button type="button" class="btn btn-sm waves-effect waves-light btn-rounded ' . $class_pick . '"><i class="fa fa-edit">' . $label_pick . '</i></button></a>&nbsp;';
		return $html;
	}
}
