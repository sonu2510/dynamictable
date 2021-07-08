<?php

namespace App\Http\Controllers\Admin\RawMaterial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\RawMaterial\Processed_coil;
use App\Http\Traits\datatabledom;
use DataTables;

class ProcessedCoil_Controller extends Controller
{
   use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Rawmaterial.processed_coil.index');
	}

	public function indexDatatable() {
		$ProcessedCoil_data = Processed_coil::All();
		//dd($user_type);
		return Datatables::of($ProcessedCoil_data)

			->addColumn('coil_id', function ($ProcessedCoil_data) {
				//pass Unique Id And Status
				return $this->checkboxDom($ProcessedCoil_data->id);

			})
			->addColumn('size', function ($ProcessedCoil_data) {
				//pass Unique Id And Status
				return $ProcessedCoil_data->coil_size;

			})
			->addColumn('status', function ($ProcessedCoil_data) {
				//pass Unique Id And Status
				return $this->SwitchDom($ProcessedCoil_data->id, $ProcessedCoil_data->status);

			})
		 ->addColumn('action', function ($ProcessedCoil_data) {

                return $this->EditDom("/processed_coil/edit",$ProcessedCoil_data->id,'processed_coil').$this->DeleteDom("/processed_coil/delete",$ProcessedCoil_data->id,'processed_coil');
                
        })	

		->rawColumns(['coil_id','action','status'])
        ->make(true);

	}

	public function create(){
		
		return view('Admin.Rawmaterial.processed_coil.add');
	}

	public function Save(Request $request) {

		$ProcessedCoil_data = Auth::user();
		$validator = Processed_coil::validator($request->all(), $request->get("matcoil_iderial_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("coil_id") == '') {
			$ProcessedCoil_data = new Processed_coil();

		} else {
			$ProcessedCoil_data = Processed_coil::findOrFail($request->get("coil_id"));
		}
		$ProcessedCoil_data->coil_size = $request->get("coil_size");
		$ProcessedCoil_data->status = $request->get("status");

		$ProcessedCoil_data->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
		
		return Redirect::to('/processed_coil')->with($notification);

	}

	public function Edit($coil_id , Request $request) {
		//dd($request);
		$processedcoil_data = Processed_coil::findOrFail($coil_id);

		return view('Admin.Rawmaterial.processed_coil.add', compact('processedcoil_data'));
	}

	public function getDelete($coil_id) {
		try
		{
			$coil_id = Processed_coil::find($coil_id);

			$coil_id->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/processed_coil')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/processed_coil')->with($notification);
		}

	}
}
