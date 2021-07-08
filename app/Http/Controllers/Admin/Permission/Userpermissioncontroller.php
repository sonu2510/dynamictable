<?php

namespace App\Http\Controllers\admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\UserManagement\UserType;
use App\Http\Traits\datatabledom;
use DataTables;
use App\Models\role_permission_model;
use App\Models\admin_menu;
use App\User;
use DB;

class Userpermissioncontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

		return view('Admin.Usermanagement.Permission.permission_index');
	}

	public function indexDatatable() {
		$user_data= User::with('usertype')->get();
		//dd($user_data);
		return Datatables::of($user_data)
			
			->addColumn('name', function ($user_data) {
				//pass Unique Id And Status
				return $user_data->name;

			})
			->addColumn('email', function ($user_data) {
				//pass Unique Id And Status
				return $user_data->email;

			})
			->addColumn('usertype', function ($user_data) {
				//pass Unique Id And Status
				return '<span class="label label-rounded label-danger">'.$user_data->usertype->name.'</span>';

			})
		 ->addColumn('action', function ($user_data) {

                return '<a href="/permission/'.$user_data->id.'"><button class="waves-effect waves-light  btn-primary" type="button"><i class="ti-settings"> Permission</i></button></a>';
                
        })	

		->rawColumns(['name','action','email','usertype'])
        ->make(true);

	}

	public function Edit($userid , Request $request) {
		//dd($useid);
		if($userid!=""){
        $userid=User::where('id','=',$userid)->first();
		}
        $menulist=\App\Models\admin_menu::all();
		//$role_permission = role_permission_model::where('')($role_permission);
		$role_perm=\App\Models\role_permission_model::join('users','users.id','=','role_permission.user_id')
					->where('users.id','=',$userid->id)
					->first();
       
			//dd($role_permission);
		return view('Admin.Usermanagement.Permission.permission_add',compact('role_perm','menulist','userid'));
	}

	public function SavePermission(Request $request) {

		$role_permission = Auth::user();
		             
        if($request->get("role_permission_id") == '') {
            $role_permission = new role_permission_model();
                   
        } else {
            $role_permission = role_permission_model::findOrFail($request->get("role_permission_id"));
                       
        }

        $role_permission->user_id = $request->get("user_id");
        $role_permission->user_type_id = $request->get("user_type_id");
		//$role_permission->user_type_id=1;
        $role_permission->add_permission=serialize($request->get("add_permission")); 
        $role_permission->edit_permission=serialize($request->get('edit_permission'));
        $role_permission->delete_permission=serialize($request->get('delete_permission'));
        $role_permission->view_permission=serialize($request->get('view_permission'));
        //dd($role_permission);
		
		$role_permission->save();
		$notification = array(
				'message' => 'Record Added Successfully', 
				'alert-type' => 'success'
			);
	 
	   return redirect()->route('permission')->with($notification);

	}
}
