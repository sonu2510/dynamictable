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
use App\user;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		
		return view('Admin.Usermanagement.User.index');
	}

	public function indexDatatable() {
		$user_data= User::with('usertype')->get();
		//dd($user_data);
		return Datatables::of($user_data)
			
			->addColumn('name', function ($user_data) {
				//pass Unique Id And Status
				return ucfirst($user_data->name).'<br><small>'.$user_data->email.'<small>';

			})			
			->addColumn('usertype', function ($user_data) {
				//pass Unique Id And Status
				return '<label class="btn btn-secondary btn-rounded">'.$user_data->usertype->name.'</label>';

			})
			->addColumn('status', function ($user_type) {
				//pass Unique Id And Status
				return $this->SwitchDom($user_type->user_type_id, $user_type->status);

			})
		 ->addColumn('action', function ($user_data) {

                return ' <div class="button-group"><a href="/EditUser/'.$user_data->id.'"><button class="waves-effect waves-light  btn-primary" type="button"><i class="mdi mdi-lead-pencil"> Edit</i></button></a>
               
                <a href="/permission/'.$user_data->id.'"><button class="waves-effect waves-light  btn-danger" type="button"><i class="mdi mdi-key"> Permission </i></button></a></div>';
               
    
                
        })	

		->rawColumns(['name','action','status','usertype'])
        ->make(true);

	}
	public function create(){
		$usertypes=Usertype::get();
		return view('Admin.Usermanagement.User.add',compact('usertypes'));
	}

	  protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_type_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

	public function SaveUserdata(Request $request){
			//dd($request->all());
		$userdetails = Auth::user();
		
	

		if ($request->get("userid") == '') {

			$validator = $this->validator($request->all());

			if ($validator->fails()) {
				return redirect()->back()
					->withErrors($validator->getMessageBag())
					->withInput($request->all());				
			}	

				$userdetails = new User();			
				$userdetails->name = $request->get("name");
				$message="Registration Successfully";



		} else {
		$userdetails = User::findOrFail($request->get("userid"));

		$message="Record updated Successfully";
		}
		$userdetails->name = $request->get("name");
		$userdetails->password = Hash::make($request->get("password"));	
		$userdetails->textpass = $request->get("password");
		$userdetails->user_type_id = $request->get("user_type_id");
		$userdetails->email = $request->get("email");		
		$userdetails->status = $request->get("status");

		$userdetails->save();

		$notification = array(
			'message' => $message,
			'alert-type' => 'success',
		);
		
		return Redirect::to('/userslist')->with($notification);
	}

	public function Edit($userid,Request $request){
		if(isset($userid)){

		$usertypes=Usertype::get();
		$userdetails = user::findOrFail($userid);
		return view('Admin.Usermanagement.User.add',compact('usertypes','userdetails'));

		}
	}

	public function ChangePasswrodFrom($userid,Request $request){

		if(isset($userid)){

		$usertypes=Usertype::get();
		$userdetails = user::findOrFail($userid);
		return view('Admin.Usermanagement.User.changepassword',compact('usertypes','userdetails'));

		}
	}

}
