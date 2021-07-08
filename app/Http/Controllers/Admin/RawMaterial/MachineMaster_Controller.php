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

class MachineMaster_Controller extends Controller
{
   use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Rawmaterial.machine_master.index');
	}

	public function indexDatatable() {
	//	$machinedata = MachineMaster::get();
		$machinedata = MachineMaster::with('machine_type')->orderBy('machine_master_id','desc')->get();
		//dd($machinedata);
		return Datatables::of($machinedata)

			->addColumn('machine_master_id', function ($machinedata) {
				//pass Unique Id And Status
				return $this->checkboxDom($machinedata->machine_master_id);

			})
			->addColumn('machine_name', function ($machinedata) {
				//pass Unique Id And Status
				return $machinedata->machine_name;

			})->addColumn('machine_slug', function ($machinedata) {
				//pass Unique Id And Status
				return $machinedata->machine_slug;				
				

			})->addColumn('machine_type', function ($machinedata) {
				//pass Unique Id And Status
				return $machinedata->machine_type->machine_type;
				
			})
			->addColumn('status', function ($machinedata) {
				//pass Unique Id And Status
				return $this->SwitchDom($machinedata->id, $machinedata->status);

			})
		 ->addColumn('action', function ($machinedata) {

                return $this->EditDom("/machine_master/edit",$machinedata->machine_master_id,'machine_master').$this->DeleteDom("/machine_master/delete",$machinedata->machine_master_id,'machine_master');
                
        })	

		->rawColumns(['machine_master_id','machine_name','machine_type','action','status'])
        ->make(true);

	}

	public function create(){
		$machine_type = MachineTypeMaster::All();
		return view('Admin.Rawmaterial.machine_master.add', compact('machine_type'));
	}

	public function Save(Request $request) {
		//dd($request->all());
		$machine_master_details = Auth::user();
		$validator = MachineMaster::validator($request->all(), $request->get("machine_master_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("machine_master_id") == '') {
			$machine_master_details = new MachineMaster();

		} else {

			$machine_master_details = MachineMaster::findOrFail($request->get("machine_master_id"));
		}
		$machine_master_details->machine_type_id = $request->get("machine_type_id");
		$machine_master_details->machine_name = $request->get("machine_name");
		$machine_master_details->machine_slug = $request->get("machine_slug");
		$machine_master_details->status = $request->get("status");

		$machine_master_details->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
				//dd($machine_master_details);
			//	dd($request->all());
		return Redirect::to('/machine_master')->with($notification);

	}

	public function Edit($machine_master_id, Request $request) {
		//dd($machine_master_id);
		$machinedetails = MachineMaster::findOrFail($machine_master_id);
		$machine_type = MachineTypeMaster::All();
		return view('Admin.Rawmaterial.machine_master.add', compact('machinedetails','machine_type'));
	}

	public function getDelete($machine_master_id) {
		try
		{
			$MachineMaster = MachineMaster::find($machine_master_id);

			$MachineMaster->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/machine_master')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/machine_master')->with($notification);
		}

	}
}
