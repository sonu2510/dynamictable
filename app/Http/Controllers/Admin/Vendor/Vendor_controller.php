<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Vendor\Vendor;
use App\Http\Traits\datatabledom;
use DataTables;

class Vendor_controller extends Controller
{
        use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Vendor.index');
	}

	public function indexDatatable() {
		//dd(Vendor::first());
		$Vendor_details = Vendor::All();
		//dd($Vendor_details);
		return Datatables::of($Vendor_details)

			->addColumn('id', function ($Vendor_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($Vendor_details->id);

			})
			->addColumn('name', function ($Vendor_details) {
				//pass Unique Id And Status
				return $Vendor_details->company_name;

			})
			->addColumn('status', function ($Vendor_details) {
				//pass Unique Id And Status
				return $this->SwitchDom($Vendor_details->id, $Vendor_details->status);

			})
		 ->addColumn('action', function ($Vendor_details) {

                return $this->EditDom("/supplier/edit",$Vendor_details->id,'supplier').$this->DeleteDom("/supplier/delete",$Vendor_details->id,'supplier');
                
        })	

		->rawColumns(['id','name','action','status'])
        ->make(true);

	}

	public function create(){
		
		return view('Admin.Vendor.add');
	}

	public function Save(Request $request) {
		//dd($request->all());
		$Vendor_details = Auth::user();
		$validator = Vendor::validator($request->all(), $request->get("vendor_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("vendor_id") == '') {
			$Vendor_details = new Vendor();

		} else {
			$Vendor_details = Vendor::findOrFail($request->get("vendor_id"));
		}
		$Vendor_details->company_name = $request->get("company_name");
		$Vendor_details->email_1 = $request->get("email_1");
		$Vendor_details->email_2 = $request->get("email_2");
		$Vendor_details->contact_no = $request->get("contact_no");
		$Vendor_details->address = $request->get("address");
		$Vendor_details->postal_code = $request->get("postal_code");
		$Vendor_details->gst_no = $request->get("gst_no");
		$Vendor_details->website = $request->get("website");
		$Vendor_details->state = $request->get("state");
		$Vendor_details->city = $request->get("city");
		$Vendor_details->remark = $request->get("remark");
		$Vendor_details->status = $request->get("status");

		$Vendor_details->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
		
		return Redirect::to('/supplier')->with($notification);

	}

	public function Edit($vendor_id , Request $request) {
		//dd($request);
		$vendor_details = Vendor::findOrFail($vendor_id);

		return view('Admin.Vendor.add', compact('vendor_details'));
	}

	public function getDelete($vendor_id) {
		try
		{
			$vendor_id = Vendor::find($vendor_id);

			$vendor_id->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/supplier')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/supplier')->with($notification);
		}

	}
}
