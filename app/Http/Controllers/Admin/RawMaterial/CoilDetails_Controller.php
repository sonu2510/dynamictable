<?php

namespace App\Http\Controllers\Admin\RawMaterial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\RawMaterial\coil_detail;
use App\Http\Traits\datatabledom;
use DataTables;

class CoilDetails_Controller extends Controller
{
   use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Rawmaterial.Coildata.index');
	}

	public function indexDatatable() {
		$Coildata = coil_detail::All();
		//dd($user_type);
		return Datatables::of($Coildata)

			->addColumn('coil_id', function ($Coildata) {
				//pass Unique Id And Status
				return $this->checkboxDom($Coildata->id);

			})
			->addColumn('size', function ($Coildata) {
				//pass Unique Id And Status
				return $Coildata->coil_size;

			})
			->addColumn('status', function ($Coildata) {
				//pass Unique Id And Status
				return $this->SwitchDom($Coildata->id, $Coildata->status);

			})
		 ->addColumn('action', function ($Coildata) {

                return $this->EditDom("/coildetail/edit",$Coildata->id,'coildetail').$this->DeleteDom("/coildetail/delete",$Coildata->id,'coildetail');
                
        })	

		->rawColumns(['coil_id','action','status'])
        ->make(true);

	}

	public function create(){
		
		return view('Admin.Rawmaterial.Coildata.add');
	}

	public function Save(Request $request) {

		$coildetails = Auth::user();
		$validator = coil_detail::validator($request->all(), $request->get("matcoil_iderial_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("coil_id") == '') {
			$coildetails = new coil_detail();

		} else {
			$coildetails = coil_detail::findOrFail($request->get("coil_id"));
		}
		$coildetails->coil_size = $request->get("coil_size");
		$coildetails->coil_number = $request->get("coil_number");
		$coildetails->status = $request->get("status");

		$coildetails->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
		
		return Redirect::to('/coildetail')->with($notification);

	}

	public function Edit($coil_id, Request $request) {
		//dd($request);
		$coildetails = coil_detail::findOrFail($coil_id);

		return view('Admin.Rawmaterial.Coildata.add', compact('coildetails'));
	}

	public function getDelete($coil_id) {
		try
		{
			$coil_id = coil_detail::find($coil_id);

			$coil_id->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/coildetail')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/coildetail')->with($notification);
		}

	}
}
