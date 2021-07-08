<?php

namespace App\Http\Controllers\Admin\RawMaterial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Production\MachineMaster;
use App\Models\Production\MachineTypeMaster;
use App\Http\Traits\datatabledom;
use DataTables;

class MachineType_Controller extends Controller
{
   use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Rawmaterial.machine_type.index');
	}

	public function indexDatatable() {
		$machine_type_data = MachineTypeMaster::get();
	
	//	dd($machine_type_data);

		return Datatables::of($machine_type_data)

			->addColumn('machine_type_id', function ($machine_type_data) {
				//pass Unique Id And Status
				return $this->checkboxDom($machine_type_data->machine_type_id);

			})
			->addColumn('machine_type', function ($machine_type_data) {
				//pass Unique Id And Status
				return $machine_type_data->machine_type;

			})
			->addColumn('status', function ($machine_type_data) {
				//pass Unique Id And Status
				return $this->SwitchDom($machine_type_data->machine_type_id, $machine_type_data->status);

			})
		 ->addColumn('action', function ($machine_type_data) {

                return $this->EditDom("/machine_type/edit",$machine_type_data->machine_type_id,'machine_type').$this->DeleteDom("/machine_type/delete",$machine_type_data->machine_type_id,'machine_type');
                
        })	

		->rawColumns(['machine_type_id','machine_type','action','status'])
        ->make(true);

	}

	public function create(){
	
		return view('Admin.Rawmaterial.machine_type.add');
	}

	public function Save(Request $request) {
		//dd($request->all());
		$machine_type_details = Auth::user();
		$validator = MachineTypeMaster::validator($request->all(), $request->get("machine_type_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("machine_type_id") == '') {
			$machine_type_details = new MachineTypeMaster();

		} else {

			$machine_type_details = MachineTypeMaster::findOrFail($request->get("machine_type_id"));
		}
				//dd($machine_type_details);
				
		$machine_type_details->machine_type = $request->get("machine_type");
		$machine_type_details->status = $request->get("status");

		$machine_type_details->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
				//dd($machine_type_details);
		
		return Redirect::to('/machine_type')->with($notification);

	}

	public function Edit($machine_type_id, Request $request) {
		//dd($machine_type_id);
		$machinetypeData = MachineTypeMaster::findOrFail($machine_type_id);
	
		return view('Admin.Rawmaterial.machine_type.add', compact('machinetypeData'));
	}

	public function getDelete($machine_type_id) {
		try
		{
			$MachineTypeMaster = MachineTypeMaster::find($machine_type_id);

			$MachineTypeMaster->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/machine_type')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/machine_type')->with($notification);
		}

	}
}
