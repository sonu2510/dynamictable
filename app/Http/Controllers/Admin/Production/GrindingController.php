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
use App\Models\Production\Flashing;
use App\Models\Production\Grinding;
use App\Models\Production\GrindingObservation;
use App\Models\Production\HeadingObservation;
use App\Models\Production\MachineTypeMaster;
use App\Models\Production\MachineMaster;
use App\Models\Production\HeadingWire;
use App\Models\Production\MasterBatchNo;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;
Use App\User;
use Carbon\Carbon;


class GrindingController extends Controller
{
     use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Production.grinding.index');
	}

	public function indexDatatable() {
		//dd(Vendor::first());
		$grinding_details = grinding::with('grinding_obsdata','balldia_data','masterbatch_data')
									->orderBy('grinding_id','desc')->get();
							 /*->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })*/
							//->orderBy('id','desc')->get();
		//dd($grinding_details);
		return Datatables::of($grinding_details)

			->addColumn('id', function ($grinding_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($grinding_details->grinding_id);

			})
			->addColumn('grinding_data', function ($grinding_details) {
				//pass Unique Id And Status
				return $grinding_details->grinding_no.'<br>'.date(' d F Y', strtotime($grinding_details->grinding_date));

			})
			->addColumn('master_batch', function ($grinding_details) {
				//pass Unique Id And Status
				return $grinding_details->masterbatch_data->master_batch_no;

			})
			->addColumn('ball_details', function ($grinding_details) {
				//pass Unique Id And Status
				return $grinding_details->balldia_data->ball_size; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('flashing', function ($grinding_details) {				
				return $grinding_details->balldia_data->ball_size;
				

			})

			
		 ->addColumn('action', function ($grinding_details) {

                return $this->EditDom("/grinding/edit",$grinding_details->grinding_id,'grinding').$this->DeleteDom("/grinding/delete",$grinding_details->grinding_id,'grinding');
                
        })	

		->rawColumns(['id','grinding_data','master_batch','ball_details','flashing','action'])
        ->make(true);

	}

	public function create(){
		
		
		$flashing_data=Flashing::where('status','1')->get();
		$masterbatchdata=MasterBatchNo::get();
		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$grinding_machine=MachineMaster::where('status','1')->where('machine_type_id','3')->get();
		$grinding_operator=User::where('user_type_id','5')->where('status','1')->get();
		
		return view('Admin.Production.grinding.add',compact('ball_diameter','flashing_data','grinding_operator','grinding_machine','masterbatchdata'));
	}

	public function Save(Request $request) {
		//dd(implode(',',$request->get("heading_id")));
		//dd($request->all());
		//dd(Inward::latest()->first());
		$grinding_details = Auth::user();
		$validator = grinding::validator($request->all(), $request->get("grinding_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}
        $grinding_number='';
		if ($request->get("grinding_id") == '') {
			$grinding_details = new grinding();
			$grinding_data=grinding::latest()->first();
			if($grinding_data == '' ){
				$grinding_number=1;
				$grinding_details->grinding_no = "GRD".str_pad($grinding_number,6,'0',STR_PAD_LEFT);	
				
				
			}else{
				$grinding_number=$grinding_data->grinding_id + 1;
				$grinding_details->grinding_no = "GRD".str_pad($grinding_number,6,'0',STR_PAD_LEFT);	
				
			}
        
		} else {
			$grinding_details = grinding::findOrFail($request->get("grinding_id"));
		}
	   //dd("INWD".str_pad($inward_number,6,'0',STR_PAD_LEFT));
        
			
		$grinding_details->grinding_batch_no =$request->get("grinding_batch_no");
		$grinding_details->batch_id =implode(',',$request->get("batch_id"));
		$grinding_details->ball_diameter = $request->get("ball_diameter");		
		$grinding_details->shift_type = $request->get("shift_type");
		$grinding_details->grinding_date = $request->get("grinding_date");		

		$grinding_details->gs_unloading_gauge = $request->get("gs_unloading_gauge");
		$grinding_details->gs_tolerance = $request->get("gs_tolerance");		
		$grinding_details->gs_ovality = $request->get("gs_ovality");
		$grinding_details->gs_lot_variation = $request->get("gs_lot_variation");
		
		$grinding_details->status = $request->get("status");
		
		$grinding_details->save();

		$last_grinding_id=grinding::latest()->first();
		//dd('ss');

		
		
		if(count($request->get("grinding_observation_id")) != 0){
			$issue_data_count=count($request->get("grinding_observation_id"));

			for($row=0;$row<$issue_data_count;$row++){

				if($request->grinding_observation_id[$row] == ''){
				        
					$grindingobservation_details = new GrindingObservation();
				    	if ($request->get("grinding_id") == '') {
				    	    $grindingobservation_details->grinding_id=$last_grinding_id->grinding_id;
				    	}else{
				    	    $grindingobservation_details->grinding_id=$request->grinding_id; 
				    	}
				}else{

					$grindingobservation_details = GrindingObservation::findOrFail($request->grinding_observation_id[$row]);
				    $grindingobservation_details->grinding_id=$request->grinding_id;
				}

				
				$grindingobservation_details->loading_date=$request->loading_date[$row];
				$grindingobservation_details->loading_time=$request->loading_time[$row];
				$grindingobservation_details->unloading_date=$request->unloading_date[$row];
				$grindingobservation_details->unloading_time=$request->unloading_time[$row];
				$grindingobservation_details->machine_id=$request->machine_id[$row];
				$grindingobservation_details->operator_id=$request->operator_id[$row];
				$grindingobservation_details->unloading_gauge=$request->unloading_gauge[$row];
				$grindingobservation_details->ball_dia_variation=$request->ball_dia_variation[$row];
				$grindingobservation_details->load_dia_variation=$request->load_dia_variation[$row];
				$grindingobservation_details->surface=$request->surface[$row];
			
				$grindingobservation_details->save();
			}

		}
		
	

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/grinding')->with($notification);

	}

	public function Edit($grinding_id, Request $request) {
		//dd($request);

		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$masterbatchdata=MasterBatchNo::get();
		$grinding_machine=MachineMaster::where('status','1')->where('machine_type_id','3')->get();
		$grinding_operator=User::where('user_type_id','5')->where('status','1')->get();
		$flashing_data=Flashing::where('status','1')->get();
		$grinding_details=grinding::findOrFail($request->grinding_id);
		
		//dd($splitcoils_data);
		return view('Admin.Production.grinding.add', compact('flashing_data','ball_diameter','grinding_machine','grinding_operator','grinding_details','masterbatchdata'));
	}

	public function getgrindingObservationData(Request $request){
		if($request->grinding_id){			
			$grindingobs_details=GrindingObservation::where('grinding_id',$request->grinding_id)
									->get();		
			
			return response()->json($grindingobs_details);
		}
	}
	

	public function getDelete($grinding_id) {
		try
		{
			$grindingrecord_id = grinding::find($grinding_id);
			//dd(Carbon::now()->toDateTimeString());
			 $grindingrecord_id->delete();
			 $grinding_observation = GrindingObservation::where('grinding_id',$grinding_id)->delete();
			 
			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/grinding')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/grinding')->with($notification);
		}

	}
	public function getBallMasterData(Request $request){
		try
		{
			if($request->ball_size != ''){
			$MasterBatchData = MasterBatchNo::Where('ball_size_id',$request->ball_size)->get();		
			 
			return response()->json($MasterBatchData);
		  }	
		} catch (\Exception $ex) {
		   
		}
	}

	public function getgrindingObservationDelete(Request $request){
		try
		{
			$grinding_observation_id = GrindingObservation::find($request->grinding_observation_id);
			//dd(Carbon::now()->toDateTimeString());
			$grinding_observation_id->delete();
		
			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return response()->json($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return response()->json($notification);
		}
	}

	public static function DashboardData(){		
		$grinding_details = grinding::with('grinding_obsdata','balldia_data','masterbatch_data')
									->orderBy('grinding_id','desc')->take(5)->get();
		return $grinding_details;					
	}
	
}
