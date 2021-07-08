<?php

namespace App\Http\Controllers\Admin\Production;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Vendor\Vendor;
use App\Models\RawMaterial\Inward;
use App\Models\RawMaterial\CoilInward;
use App\Models\RawMaterial\coil_detail;
use App\Models\RawMaterial\Processed_coil;
use App\Models\RawMaterial\Processed_coil_detail;
use App\Models\RawMaterial\Inward_underprocess;
use App\Models\RawMaterial\Under_process_coil;
use App\Models\RawMaterial\Ball_Diameter;
use App\Models\Production\Heading;
use App\Models\Production\HTProcessM;
use App\Models\Production\MachineTypeMaster;
use App\Models\Production\MachineMaster;
use App\Models\Production\MasterBatchNo;
use App\Models\Production\FlashingBatch;
use App\Models\Production\HeadingWire;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;
Use App\User;
use Carbon\Carbon;


class HTProcessMonitoringController extends Controller
{
     use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Production.HTProcessM.index');
	}

	public function indexDatatable() {
		
		$heat_treatment_data = HTProcessM::with('flashingbatchno_data','headingBall')
									->orderBy('heat_treatment_id','desc')->get();
							
		//dd($heat_treatment_data->headingbatchno_data);
	//	dd($heat_treatment_data);
		return Datatables::of($heat_treatment_data)

			->addColumn('id', function ($heat_treatment_data) {
				//pass Unique Id And Status
				return $this->checkboxDom($heat_treatment_data->heat_treatment_id);

			})
			->addColumn('heat_treatment_date', function ($heat_treatment_data) {
				//pass Unique Id And Status
				return date(' d F Y', strtotime($heat_treatment_data->heat_treatment_date	));

			})
			->addColumn('fc_no', function ($heat_treatment_data) {
				//pass Unique Id And Status
				return $heat_treatment_data->fc_no;

			})
			->addColumn('ball_size', function ($heat_treatment_data) {
				//pass Unique Id And Status
				return $heat_treatment_data->headingBall->ball_size; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('batch_no', function ($heat_treatment_data) {
				//pass Unique Id And Status
				
				return $heat_treatment_data->flashingbatchno_data->flashing_batch_no; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})

			
		 ->addColumn('action', function ($heat_treatment_data) {

                return $this->EditDom("/ht_process/edit",$heat_treatment_data->heat_treatment_id,'ht_process').$this->DeleteDom("/ht_process/delete",$heat_treatment_data->heat_treatment_id,'ht_process');
                
        })	

		->rawColumns(['id','heat_treatment_date','fc_no','ball_size','batch_no','action'])
        ->make(true);

	}

	public function create(){
		
		
		$masterno=MasterBatchNo::get();
			//	dd($Heading_batch_no);
		$ball_diameter=Ball_Diameter::where('status','1')->get();
		
		
		return view('Admin.Production.HTProcessM.add',compact('masterno','ball_diameter'));
	}

	public function Save(Request $request) {
	//	dd($request->all());
		//dd(Inward::latest()->first());
		$heat_treatment_details = Auth::user();
		$validator = HTProcessM::validator($request->all(), $request->get("heat_treatment_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}
 
		if ($request->get("heat_treatment_id") == '') {
			$heat_treatment_details = new HTProcessM();
		
		} else {
			$heat_treatment_details = HTProcessM::findOrFail($request->get("heat_treatment_id"));
		}
	
        
			
		$heat_treatment_details->heat_treatment_date =$request->get("heat_treatment_date");
		$heat_treatment_details->fc_no = $request->get("fc_no");
		$heat_treatment_details->ball_size = $request->get("ball_size");
		$heat_treatment_details->batch_weight = $request->get("batch_weight");
		$heat_treatment_details->master_batch_id = $request->get("master_batch_id");
		$heat_treatment_details->set_temp = $request->get("set_temp");		
		$heat_treatment_details->load_time = $request->get("load_time");
		$heat_treatment_details->flow_rate = $request->get("flow_rate");
		$heat_treatment_details->at_start_time = $request->get("at_start_time");
		$heat_treatment_details->at_start_temp = $request->get("at_start_temp");
		$heat_treatment_details->equalize_time = $request->get("equalize_time");		
		$heat_treatment_details->set_soak_time = $request->get("set_soak_time");
		$heat_treatment_details->at_unload_time = $request->get("at_unload_time");
		$heat_treatment_details->oil_temp = $request->get("oil_temp");
		$heat_treatment_details->quench_start_time = $request->get("quench_start_time");
		$heat_treatment_details->quench_end_time = $request->get("quench_end_time");
		$heat_treatment_details->quench_total_time = $request->get("quench_total_time");
		$heat_treatment_details->quench_hardnes = $request->get("quench_hardnes");
		$heat_treatment_details->sub_zero = $request->get("sub_zero");
		$heat_treatment_details->tempering_set_temp = $request->get("tempering_set_temp");
		$heat_treatment_details->tempering_start_time = $request->get("tempering_start_time");
		$heat_treatment_details->tempering_load_time = $request->get("tempering_load_time");
		$heat_treatment_details->tempering_unload_time = $request->get("tempering_unload_time");
		$heat_treatment_details->tempering_hardnes = $request->get("tempering_hardnes");
		$heat_treatment_details->status = $request->get("status");
		
		
		$heat_treatment_details->save();

		$last_heat_treatment_id=HTProcessM::latest()->first();
		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/ht_process')->with($notification);

	}


	public function Edit($heading_id , Request $request) {
	
		$masterno=MasterBatchNo::get();
		$ball_diameter=Ball_Diameter::where('status','1')->get();	
		$heat_treatment_details=HTProcessM::findOrFail($heading_id);	
	
	
		return view('Admin.Production.HTProcessM.add', compact('ball_diameter','heat_treatment_details','masterno'));
	}

	



	public function getDelete($heat_treatment_id) {
		try
		{
			$heat_treatment = HTProcessM::find($heat_treatment_id);
			//dd(Carbon::now()->toDateTimeString());
			$heat_treatment->delete();
			
		

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/ht_process')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/ht_process')->with($notification);
		}

	}

	

	
	
}
