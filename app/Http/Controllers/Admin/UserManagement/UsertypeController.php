<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\UserManagement\Usertype;
use App\Http\Traits\datatabledom;
use DataTables;

class UsertypeController extends Controller
{
    use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Usermanagement.Usertype.index');
	}

	public function indexDatatable() {
		$user_type = UserType::All();
		//dd($user_type);
		return Datatables::of($user_type)

			->addColumn('user_type_id', function ($user_type) {
				//pass Unique Id And Status
				return $this->checkboxDom($user_type->user_type_id);

			})
			->addColumn('status', function ($user_type) {
				//pass Unique Id And Status
				return $this->SwitchDom($user_type->user_type_id, $user_type->status);

			})
		 ->addColumn('action', function ($user_type) {

                return $this->EditDom("/usertype/edit",$user_type->user_type_id,'usertype').$this->DeleteDom("/usertype/delete",$user_type->user_type_id,'usertype');
                
        })	

		->rawColumns(['user_type_id','action','status'])
        ->make(true);

	}

	public function create(){
		
		return view('Admin.Usermanagement.Usertype.add');
	}

	public function Save(Request $request) {

		$usertypedetails = Auth::user();
		$validator = Usertype::validator($request->all(), $request->get("user_type_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("user_type_id") == '') {
			$usertypedetails = new Usertype();

		} else {
			$usertypedetails = Usertype::findOrFail($request->get("user_type_id"));
		}
		$usertypedetails->name = $request->get("name");
		$usertypedetails->status = $request->get("status");

		$usertypedetails->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
		
		return Redirect::to('/usertype')->with($notification);

	}

	public function Edit($user_type_id , Request $request) {
		//dd($request);
		$usertypedetails = Usertype::findOrFail($user_type_id);

		return view('Admin.Usermanagement.Usertype.add', compact('usertypedetails'));
	}

	public function getDelete($user_type_id) {
		try
		{
			$user_type_id = Usertype::find($user_type_id);

			$user_type_id->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/usertype')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/usertype')->with($notification);
		}

	}
}
