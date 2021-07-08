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
use App\Models\Production\Grinding;
use App\Models\Production\Lapping;
use App\Models\Production\LappingObservation;
use App\Models\Production\LappingObsCount;
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


class LappingController extends Controller
{
     use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Production.lapping.index');
	}

	public function indexDatatable() {
		//dd(Vendor::first());
		$lapping_details = lapping::with('lapping_obsdata','balldia_data','masterbatch_data')
									->orderBy('lapping_id','desc')->get();
							 /*->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })*/
							//->orderBy('id','desc')->get();
		//dd($lapping_details);
		return Datatables::of($lapping_details)

			->addColumn('id', function ($lapping_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($lapping_details->lapping_id);

			})
			->addColumn('lapping_data', function ($lapping_details) {
				//pass Unique Id And Status
				return $lapping_details->lapping_no.'<br>'.date(' d F Y', strtotime($lapping_details->lapping_date));

			})
			->addColumn('master_batch', function ($lapping_details) {
				//pass Unique Id And Status
				return $lapping_details->masterbatch_data->master_batch_no;

			})
			->addColumn('ball_details', function ($lapping_details) {
				//pass Unique Id And Status
				return $lapping_details->balldia_data->ball_size; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('grinding', function ($lapping_details) {				
				return $lapping_details->balldia_data->ball_size;
				

			})

			
		 ->addColumn('action', function ($lapping_details) {

                return $this->EditDom("/lapping/edit",$lapping_details->lapping_id,'lapping').$this->DeleteDom("/lapping/delete",$lapping_details->lapping_id,'lapping');
                
        })	

		->rawColumns(['id','lapping_data','master_batch','ball_details','grinding','action'])
        ->make(true);

	}

	public function create(){
		
		
		$grinding_data=Grinding::where('status','1')->get();
		$masterbatchdata=MasterBatchNo::get();
		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$lapping_machine=MachineMaster::where('status','1')->where('machine_type_id','4')->get();
		$lapping_operator=User::where('user_type_id','6')->where('status','1')->get();
		
		return view('Admin.Production.lapping.add',compact('ball_diameter','grinding_data','lapping_operator','lapping_machine','masterbatchdata'));
	}

	public function Save(Request $request) {
		//dd(implode(',',$request->get("heading_id")));
		//dd($request->all());

	   
		//dd(Inward::latest()->first());
		$lapping_details = Auth::user();
		$validator = lapping::validator($request->all(), $request->get("lapping_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}
        $lapping_number='';
		if ($request->get("lapping_id") == '') {
			$lapping_details = new lapping();
			$lapping_data=lapping::latest()->first();
			if($lapping_data == '' ){
				$lapping_number=1;
				$lapping_details->lapping_no = "LAP".str_pad($lapping_number,6,'0',STR_PAD_LEFT);	
				
				
			}else{
				$lapping_number=$lapping_data->lapping_id + 1;
				$lapping_details->lapping_no = "LAP".str_pad($lapping_number,6,'0',STR_PAD_LEFT);	
				
			}
        
		} else {
			$lapping_details = lapping::findOrFail($request->get("lapping_id"));
		}
	   //dd("INWD".str_pad($inward_number,6,'0',STR_PAD_LEFT));
        
			
		$lapping_details->lapping_batch_no =$request->get("lapping_batch_no");
		$lapping_details->batch_id =implode(',',$request->get("batch_id"));
		$lapping_details->lapping_count =$request->get("lapping_number");
		$lapping_details->ball_diameter = $request->get("ball_diameter");		
		$lapping_details->shift_type = $request->get("shift_type");
		$lapping_details->lapping_date = $request->get("lapping_date");

		$lapping_details->ls_unloading_gauge=$request->ls_unloading_gauge;
		$lapping_details->ls_tolerance=$request->ls_tolerance;
		$lapping_details->ls_ovality=$request->ls_ovality;
		$lapping_details->ls_lot_variation=$request->ls_lot_variation;	

		$lapping_details->status = $request->get("status");
		
		$lapping_details->save();

		$last_lapping_id=lapping::latest()->first();		//dd('ss');
		
		if(count($request->get("lapping_obs_count")) != 0){
				$lapping_obs_count=count($request->get("lapping_obs_count"));		
		   for($observation_count=0;$observation_count<$lapping_obs_count;$observation_count++){


				if($request->lapping_obs_count[$observation_count] == ''){
					$lappingobscount_details = new LappingObsCount();
					if ($request->get("lapping_id") == '') {
						$lappingobscount_details->lapping_id=$last_lapping_id->lapping_id;
					}else{
						$lappingobscount_details->lapping_id=$request->lapping_id; 
					}
				}else
				{
					$lappingobscount_details = LappingObsCount::findOrFail($request->lapping_obs_count[$observation_count]);
					$lappingobscount_details->lapping_id=$request->lapping_id;
				}

				$lappingobscount_details->lapping_number=$observation_count+1;
				$lappingobscount_details->save();

				$last_lappingobscount_id=LappingObsCount::orderBy('lapping_obs_count_id','desc')->first();
				
				$obs_counter=$observation_count+1;				
				if(count($request->get("lapping_observation_id_".$obs_counter."")) != 0){
						$obs_data_count=count($request->get("lapping_observation_id_".$obs_counter.""));
						//dd(count($request->get("lapping_observation_id_".$obs_counter."")));
						for($row=0;$row<$obs_data_count;$row++){

							if($request->get("lapping_observation_id_".$obs_counter."")[$row] == ''){
							   $lappingobservation_details = new lappingObservation();   
							   		if ($request->get("lapping_id") == '') {
							    	    $lappingobservation_details->lapping_id=$last_lapping_id->lapping_id;
							    	}else{
							    	    $lappingobservation_details->lapping_id=$request->lapping_id; 
							    	}							    	
									if ($request->lapping_obs_count[$observation_count] == ''){
										$lappingobservation_details->lapping_obs_count_id =$last_lappingobscount_id->lapping_obs_count_id;
									}else{
										$lappingobservation_details->lapping_obs_count_id =$request->lapping_obs_count_id[$observation_count];
									}
								   
							}else{
								$lappingobservation_details = lappingObservation::findOrFail($request->get("lapping_observation_id_".$obs_counter."")[$row]);
								 $lappingobservation_details->lapping_id=$request->lapping_id;
							}

							
							$lappingobservation_details->loading_date=$request->get("loading_date_".$obs_counter."")[$row];
							$lappingobservation_details->loading_time=$request->get("loading_time_".$obs_counter."")[$row];
							$lappingobservation_details->unloading_date=$request->get("unloading_date_".$obs_counter."")[$row];
							$lappingobservation_details->unloading_time=$request->get("unloading_time_".$obs_counter."")[$row];
							$lappingobservation_details->machine_id=$request->get("machine_id_".$obs_counter."")[$row];
							$lappingobservation_details->operator_id=$request->get("operator_id_".$obs_counter."")[$row];
							$lappingobservation_details->unloading_gauge=$request->get("unloading_gauge_".$obs_counter."")[$row];
							$lappingobservation_details->ball_dia_variation=$request->get("ball_dia_variation_".$obs_counter."")[$row];
							$lappingobservation_details->load_dia_variation=$request->get("load_dia_variation_".$obs_counter."")[$row];
							$lappingobservation_details->surface=$request->get("surface_".$obs_counter."")[$row];
						
							$lappingobservation_details->save();
							
						}

					}
				}
			}	
				 	
				//Lapping Observation End			

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/lapping')->with($notification);

	}

	public function Edit($lapping_id, Request $request) {
		//dd($request);

		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$lapping_machine=MachineMaster::where('status','1')->where('machine_type_id','4')->get();
		$lapping_operator=User::where('user_type_id','6')->where('status','1')->get();
		$grinding_data=Grinding::where('status','1')->get();
		$lapping_details=lapping::findOrFail($request->lapping_id);
		$masterbatchdata=MasterBatchNo::get();
		
		//dd($splitcoils_data);
		return view('Admin.Production.lapping.add', compact('grinding_data','ball_diameter','lapping_machine','lapping_operator','lapping_details','masterbatchdata'));
	}

	public function getlappingData(Request $request){
		if($request->lapping_id){			
			$lapping_details=LappingObsCount::with('lappingobs')->where('lapping_id',$request->lapping_id)
									->get();
			//dd($lapping_details);								
			
			return response()->json($lapping_details);
		}
	}
	

	public function getDelete($lapping_id) {
		try
		{
			$lappingrecord_id = lapping::find($lapping_id);
			//dd(Carbon::now()->toDateTimeString());
			 $lappingrecord_id->delete();

			 $lapping_observation_id = LappingObservation::where('lapping_id',$lapping_id)->delete();
			

			$lapping_observation_id = LappingObsCount::where('lapping_id',$lapping_id)->delete();
			//dd(Carbon::now()->toDateTimeString());
		

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/lapping')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/lapping')->with($notification);
		}

	}

	public function getlappingObsCountDelete(Request $request){
		try
		{
			$lapping_obscount_id = LappingObsCount::find($request->lapping_observation_id);
			//dd(Carbon::now()->toDateTimeString());
			$lapping_obscount_id->delete();
			$lapping_observation_id = LappingObservation::where('lapping_observation_id',$request->lapping_observation_id)->delete();
		
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
	public function getlappingDataDelete(Request $request){
		try
		{
			$lapping_observation_id = LappingObservation::find($request->lapping_observation_id);
			//dd($lapping_observation_id);
			$lapping_observation_id->delete();			
						//dd(Carbon::now()->toDateTimeString());
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

	public function getBallSpecificationData(Request $request){
		//dd(Ball_Diameter::findorFail($request->ball_size));
		if($request->ball_size){			
			$balldia_spec_details=Ball_Diameter::findorFail($request->ball_size);									
			//dd($balldia_spec_details);
			return response()->json($balldia_spec_details);
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
	
	

	public static function DashboardData(){
		$lapping_details = lapping::with('lapping_obsdata','balldia_data','masterbatch_data')
									->orderBy('lapping_id','desc')->take(5)->get();
		return $lapping_details;					
	}
	
}
