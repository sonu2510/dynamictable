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
use App\Models\Production\FlashingObservation;
use App\Models\Production\HeadingObservation;
use App\Models\Production\MachineTypeMaster;
use App\Models\Production\MachineMaster;
use App\Models\Production\HeadingWire;
use App\Models\Production\MasterBatchNo;
use App\Models\Production\HeadingBatch;
use App\Models\Production\FlashingBatch;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;
Use App\User;
use Carbon\Carbon;


class FlashingController extends Controller
{
     use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Production.flashing.index');
	}

	public function indexDatatable() {
		//dd(Vendor::first());
		$flashing_details = Flashing::with('flashing_obsdata','Ball_data')
									->orderBy('flashing_id','desc')->get();
							 /*->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })*/
							//->orderBy('id','desc')->get();
		//dd($flashing_details[0]->Ball_data->ball_size);
		return Datatables::of($flashing_details)

			->addColumn('id', function ($flashing_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($flashing_details->flashing_id);

			})
			->addColumn('flashing_data', function ($flashing_details) {
				//pass Unique Id And Status
				return $flashing_details->flashing_no.'<br>'.date(' d F Y', strtotime($flashing_details->flashing_date));

			})
			->addColumn('master_batch', function ($flashing_details) {
				//pass Unique Id And Status
				return $flashing_details->master_batch_no;

			})
			->addColumn('ball_details', function ($flashing_details) {
				//pass Unique Id And Status
				return $flashing_details->Ball_data->ball_size; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('heading', function ($flashing_details) {
				
				return $flashing_details->Ball_data->ball_size; 
				//return $flashing_details->heading_id;
				

			})

			
		 ->addColumn('action', function ($flashing_details) {

                return $this->EditDom("/flashing/edit",$flashing_details->flashing_id,'flashing').$this->DeleteDom("/flashing/delete",$flashing_details->flashing_id,'flashing');
                
        })	

		->rawColumns(['id','flashing_data','master_batch','ball_details','heading','action'])
        ->make(true);

	}

	public function create(){
		
		
		$heading_data=Heading::where('status','1')->get();		
		$heading_batch_data=HeadingBatch::get();	
		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$flashing_machine=MachineMaster::where('status','1')->where('machine_type_id','2')->get();
		$flashing_operator=User::where('user_type_id','4')->where('status','1')->get();
		
		return view('Admin.Production.flashing.add',compact('ball_diameter','heading_data','flashing_operator','flashing_machine'));
	}

	public function Save(Request $request) {
		//dd(implode(',',$request->get("heading_id")));
	
		//dd($request->all());
	
		$flashing_details = Auth::user();
		$validator = Flashing::validator($request->all(), $request->get("flashing_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}
        $flashing_number='';
		if ($request->get("flashing_id") == '') {
			$flashing_details = new Flashing();
			$flashing_data=Flashing::latest()->first();
			if($flashing_data == '' ){
				$flashing_number=1;
				$flashing_details->flashing_no = "FLS".str_pad($flashing_number,6,'0',STR_PAD_LEFT);	
				
				
			}else{
				$flashing_number=$flashing_data->flashing_id + 1;
				$flashing_details->flashing_no = "FLS".str_pad($flashing_number,6,'0',STR_PAD_LEFT);	
				
			}
        
		} else {
			$flashing_details = Flashing::findOrFail($request->get("flashing_id"));
		}
	   //dd("INWD".str_pad($inward_number,6,'0',STR_PAD_LEFT));

		$flashing_details->ball_diameter = $request->get("ball_diameter");		
		$flashing_details->shift_type = $request->get("shift_type");
		$flashing_details->flashing_date = $request->get("flashing_date");
		$flashing_details->fs_unloading_gauge = $request->get("fs_unloading_gauge");
		$flashing_details->fs_tolerance = $request->get("fs_tolerance");		
		$flashing_details->fs_ovality = $request->get("fs_ovality");
		$flashing_details->fs_lot_variation = $request->get("fs_lot_variation");
		
		$flashing_details->status = $request->get("status");
		//dd($flashing_details);
		$flashing_details->save();

		$last_flashing_id=Flashing::orderBy('flashing_id','desc')->first();
		//dd('ss');
  
  		if(count($request->get("heading_batch_id")) != 0){  		
			$batch_data_count=count($request->get("heading_batch_id"));
				for($row=0;$row<$batch_data_count;$row++){
					
							
				// ------------------------MAster Batch Table Start--------------------------	
		            if($request->batch_id[$row] == ''){		                	
		        		$MasterBatchNumber = new MasterBatchNo();
		        		$MasterBatchNumber->flashing_id=$last_flashing_id->flashing_id;		        		        		
		        	}else{	
		        		$MasterBatchNumber =MasterBatchNo::findOrFail($request->batch_id[$row]);
		        		$MasterBatchNumber->flashing_id=$request->flashing_id;		        		
		        	}

		        	$MasterBatchNumber->heading_batch_id=$request->heading_batch_id[$row];
		        	$MasterBatchNumber->master_batch_no=$request->master_batch_no[$row];
	        		$MasterBatchNumber->ball_size_id=$request->ball_diameter;
	        		$MasterBatchNumber->batchinit=$request->batchinit[$row];
	        		$MasterBatchNumber->number=$request->number[$row];

	        		$MasterBatchNumber->save();
	        		
		        	$last_masterbatch_id=MasterBatchNo::orderBy('batch_id','desc')->first();
		        // ------------------------MAster Batch Table End--------------------------	
		        // ------------------------Flashing Batch Table Start--------------------------	
	        	$flashing_batch_data=FlashingBatch::orderBy('flashing_batch_id','desc')->first();
	        	//dd($flashing_batch_data);
	        	$fbnumber=1;
	        	if($flashing_batch_data){
	        	$fbnumber=($flashing_batch_data->flashing_batch_id+1);	
	        	} 	        	
		        if($request->flashing_batch_id[$row] == ''){				    	   
					$flashingbatch_details = new FlashingBatch();
					$flashingbatch_details->flashing_id=$last_flashing_id->flashing_id;
					$flashingbatch_details->master_batch_id=$last_masterbatch_id->batch_id;
					$flashingbatch_details->flashing_batch_no = "FBT".str_pad($fbnumber,6,'0',STR_PAD_LEFT);
				}else{
					$flashingbatch_details = FlashingBatch::findOrFail($request->flashing_batch_id[$row]);
				    $flashingbatch_details->flashing_id=$request->flashing_id;
				}				
				$flashingbatch_details->ball_size_id=$request->get("ball_diameter");
				$flashingbatch_details->save();

				// ------------------------Flashing Batch Table END--------------------------	
		    }
		}
		
		
		
		if(count($request->get("flashing_observation_id")) != 0){
			$issue_data_count=count($request->get("flashing_observation_id"));

			for($row=0;$row<$issue_data_count;$row++){

				if($request->flashing_observation_id[$row] == ''){
				        
					$flashingobservation_details = new FlashingObservation();
				    	if ($request->get("flashing_id") == '') {
				    	    $flashingobservation_details->flashing_id=$last_flashing_id->flashing_id;
				    	}else{
				    	    $flashingobservation_details->flashing_id=$request->flashing_id; 
				    	}
				}else{

					$flashingobservation_details = FlashingObservation::findOrFail($request->flashing_observation_id[$row]);
				    $flashingobservation_details->flashing_id=$request->flashing_id;
				}


				
				$flashingobservation_details->loading_date=$request->loading_date[$row];
				$flashingobservation_details->loading_time=$request->loading_time[$row];
				$flashingobservation_details->unloading_date=$request->unloading_date[$row];
				$flashingobservation_details->unloading_time=$request->unloading_time[$row];
				$flashingobservation_details->machine_id=$request->machine_id[$row];
				$flashingobservation_details->operator_id=$request->operator_id[$row];
				$flashingobservation_details->unloading_gauge=$request->unloading_gauge[$row];
				$flashingobservation_details->ball_dia_variation=$request->ball_dia_variation[$row];
				$flashingobservation_details->load_dia_variation=$request->load_dia_variation[$row];
				$flashingobservation_details->surface=$request->surface[$row];
			
				$flashingobservation_details->save();
			}

		}
		


		

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/flashing')->with($notification);

	}
	public function getFlashingBatchData(Request $request){
		if($request->flashing_id){			
			$flashingbatch_details=MasterBatchNo::with('flashingbatch')->where('flashing_id',$request->flashing_id)->get();
		
			return response()->json($flashingbatch_details);
		}
	}

	public function Edit($flashing_id, Request $request) {
		//dd($request);

		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$flashing_machine=MachineMaster::where('status','1')->where('machine_type_id','2')->get();		
		$flashing_operator=User::where('user_type_id','4')->where('status','1')->get();
		$heading_data=Heading::where('status','1')->get();
		$heading_batch_data=HeadingBatch::get();	
		$flashing_details=Flashing::findOrFail($request->flashing_id);
		
		//dd($splitcoils_data);
		return view('Admin.Production.flashing.add', compact('heading_data','ball_diameter','flashing_machine','flashing_operator','flashing_details'));
	}

	public function getFlashingObservationData(Request $request){
		if($request->flashing_id){			
			$flashingobs_details=FlashingObservation::where('flashing_id',$request->flashing_id)
									->get();		
			
			return response()->json($flashingobs_details);
		}
	}
	

	public function getDelete($flashing_id) {
		try
		{
			$flashingrecord_id = Flashing::find($flashing_id);
			//dd(Carbon::now()->toDateTimeString());
			 $flashingrecord_id->delete();

			 $FlashingObservation=FlashingObservation::where('flashing_id',$flashing_id)->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/flashing')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/flashing')->with($notification);
		}

	}

	public function getFlashingObservationDelete(Request $request){
		try
		{
			$flashing_observation_id = FlashingObservation::find($request->flashing_observation_id);
			//dd(Carbon::now()->toDateTimeString());
			$flashing_observation_id->delete();
		
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
	public function getMasterBatchData(Request $request){
		$getBallData=Ball_Diameter::findOrFail($request->ball_size);
		$currentyear=date("y");
		$mastbatchstring=$getBallData->ball_batch_no.''.$currentyear;
		//dd($getBallData->ball_batch_no.''.$currentyear);
		if($getBallData){
			$getMasterBatchData=MasterBatchNo::where('ball_size_id',$request->ball_size)->max('number');	
			//dd($getMasterBatchData+1);		
			$series=1;
			if(isset($getMasterBatchData) && $getMasterBatchData != ''){
				$series=$getMasterBatchData+1;
				$mastno=str_pad($series,2,"0",STR_PAD_LEFT);
				$batchinitial=$getBallData->ball_batch_no.''.$currentyear;				
			}else{
				$mastno=str_pad($series,2,"0",STR_PAD_LEFT);
				$batchinitial=$getBallData->ball_batch_no.''.$currentyear;				
			}	
			$response = array(
				'batchinitial' =>$batchinitial,
				'mastno' => $mastno,
			);		
		return response()->json($response);	
		}
		
	}
	
	

	public static function DashboardData(){
		$flashing_details = Flashing::with('Ball_data')->orderBy('flashing_id','desc')->take(5)->get();
		return $flashing_details;					
	}
	
}
