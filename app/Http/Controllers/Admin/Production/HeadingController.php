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
use App\Models\Production\HeadingObservation;
use App\Models\Production\MachineTypeMaster;
use App\Models\Production\MachineMaster;
use App\Models\Production\HeadingWire;
use App\Models\Production\HeadingBatch;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;
Use App\User;
use Carbon\Carbon;


class HeadingController extends Controller
{
     use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Production.Heading.index');
	}

	public function indexDatatable() {
		//dd(Vendor::first());
		$heading_details = Heading::with('heading_obsdata','headingwire_data','headingBall','processed_coil')
									->orderBy('heading_id','desc')->get();
							 /*->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })*/
							//->orderBy('id','desc')->get();
		//dd($heading_details);
		return Datatables::of($heading_details)

			->addColumn('id', function ($heading_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($heading_details->heading_id);

			})
			->addColumn('heading_data', function ($heading_details) {
				//pass Unique Id And Status
				return $heading_details->heading_no.'<br>'.date(' d F Y', strtotime($heading_details->heading_date));

			})
			->addColumn('heading_batch', function ($heading_details) {
				//pass Unique Id And Status
				return $heading_details->heading_batch_no;

			})
			->addColumn('ball_details', function ($heading_details) {
				//pass Unique Id And Status
				return $heading_details->headingBall->ball_size; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('coil_details', function ($heading_details) {
				//pass Unique Id And Status
				
				return $heading_details->processed_coil->coil_size; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})

			
		 ->addColumn('action', function ($heading_details) {

                return $this->EditDom("/heading/edit",$heading_details->heading_id,'heading').$this->DeleteDom("/heading/delete",$heading_details->heading_id,'heading');
                
        })	

		->rawColumns(['id','heading_data','heading_batch','ball_details','coil_details','action'])
        ->make(true);

	}

	public function create(){
		
		
		$processed_coil=Processed_coil::where('status','1')->get();
		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$heading_machine=MachineMaster::where('status','1')->where('machine_type_id','1')->get();
		$heading_operator=User::where('user_type_id','3')->where('status','1')->get();
		
		return view('Admin.Production.Heading.add',compact('processed_coil','ball_diameter','heading_machine','heading_operator'));
	}

	public function Save(Request $request) {
		//dd($request->all());
		//dd(Inward::latest()->first());
		$heading_details = Auth::user();
		$validator = Heading::validator($request->all(), $request->get("heading_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}
        $heading_number='';
		if ($request->get("heading_id") == '') {
			$heading_details = new Heading();
			$heading_data=Heading::latest()->first();
			if($heading_data == '' ){
				$heading_number=1;
				$heading_details->heading_no = "HEAD".str_pad($heading_number,6,'0',STR_PAD_LEFT);	
				$heading_details->heading_batch_no = "HBT".str_pad($heading_number,6,'0',STR_PAD_LEFT);	
				
			}else{
				$heading_number=$heading_data->heading_id + 1;
				$heading_details->heading_no = "HEAD".str_pad($heading_number,6,'0',STR_PAD_LEFT);	
				$heading_details->heading_batch_no = "HBT".str_pad($heading_number,6,'0',STR_PAD_LEFT);	
			}
        
		} else {
			$heading_details = Heading::findOrFail($request->get("heading_id"));
		}
	   //dd("INWD".str_pad($inward_number,6,'0',STR_PAD_LEFT));
        
			
		//$heading_details->heading_batch_no =$request->get("heading_batch_no");
		$heading_details->ball_diameter = $request->get("ball_diameter");
		$heading_details->processed_coil_id = $request->get("processed_coil_id");
		$heading_details->shift_type = $request->get("shift_type");
		$heading_details->heading_date = $request->get("heading_date");		
		$heading_details->total_balls = $request->get("total_balls");
		$heading_details->weight_per_100 = $request->get("weight_per_100");
		$heading_details->hcl_etching = $request->get("hcl_etching");

		$heading_details->hs_equator_dia = $request->get("hs_equator_dia");
		$heading_details->hs_equator_tolerance = $request->get("hs_equator_tolerance");		
		$heading_details->hs_pole_dimension = $request->get("hs_pole_dimension");
		$heading_details->hs_pole_tolerance = $request->get("hs_pole_tolerance");
		$heading_details->hs_offset = $request->get("hs_offset");
		$heading_details->hs_weight_min = $request->get("hs_weight_min");
		$heading_details->hs_weight_max = $request->get("hs_weight_max");
		$heading_details->hs_total_balls_min = $request->get("hs_total_balls_min");
		$heading_details->hs_total_balls_max = $request->get("hs_total_balls_max");
		

		$heading_details->status = $request->get("status");
		
		$heading_details->save();

		$last_heading_id=Heading::latest()->first();
		//dd('ss');


		/*add for batch*/

		/*if(count($request->get("heading_batch_id")) != 0){
			$issue_data_count=count($request->get("heading_batch_id"));
			for($row=0;$row<$issue_data_count;$row++){

				if($request->heading_batch_id[$row] == ''){
				        
					$headingbatch_details = new HeadingBatch();
				    	if ($request->get("heading_id") == '') {
				    	    $headingbatch_details->heading_id=$last_heading_id->heading_id;
				    	}else{
				    	    $headingbatch_details->heading_id=$request->heading_id; 
				    	}
				}else{

					$headingbatch_details = HeadingBatch::findOrFail($request->heading_batch_id[$row]);
				    $headingbatch_details->heading_id=$request->heading_id;
				}

				$headingbatch_details->heading_batch_no=$request->heading_batch_no[$row];
				$headingbatch_details->ball_size_id=$request->get("ball_diameter");
			
			
				$headingbatch_details->save();
			}

		}*/
		


		/*end */
		if(count($request->get("heading_wire_id")) != 0){
			$issue_data_count=count($request->get("heading_wire_id"));
			for($row=0;$row<$issue_data_count;$row++){

				if($request->heading_wire_id[$row] == ''){
				        
					$headingwire_details = new HeadingWire();
				    	if ($request->get("heading_id") == '') {
				    	    $headingwire_details->heading_id=$last_heading_id->heading_id;
				    	}else{
				    	    $headingwire_details->heading_id=$request->heading_id; 
				    	}
				}else{

					$headingwire_details = HeadingWire::findOrFail($request->heading_wire_id[$row]);
				    $headingwire_details->heading_id=$request->heading_id;
				}

				$headingwire_details->processed_coilsize_id=$request->processed_coilsize_id[$row];
				$headingwire_details->processed_coil_weight=$request->processed_coil_weight[$row];			
			
				$headingwire_details->save();
			}

		}
		
		if(count($request->get("heading_observation_id")) != 0){
			$issue_data_count=count($request->get("heading_observation_id"));

			for($row=0;$row<$issue_data_count;$row++){

				if($request->heading_observation_id[$row] == ''){
				        
					$headingobservation_details = new HeadingObservation();
				    	if ($request->get("heading_id") == '') {
				    	    $headingobservation_details->heading_id=$last_heading_id->heading_id;
				    	}else{
				    	    $headingobservation_details->heading_id=$request->heading_id; 
				    	}
				}else{

					$headingobservation_details = HeadingObservation::findOrFail($request->heading_observation_id[$row]);
				    $headingobservation_details->heading_id=$request->heading_id;
				}

				
				$headingobservation_details->observation_time=$request->observation_time[$row];
				$headingobservation_details->machine_id=$request->machine_id[$row];
				$headingobservation_details->operator_id=$request->operator_id[$row];
				$headingobservation_details->eqautor=$request->eqautor[$row];
				$headingobservation_details->pole_dimension=$request->pole_dimension[$row];
				$headingobservation_details->offset=$request->offset[$row];
				$headingobservation_details->surface=$request->surface[$row];
			
				$headingobservation_details->save();
			}

		}
		
	

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/heading')->with($notification);

	}


	public function Edit($heading_id , Request $request) {


		//dd($request);
		$processed_coil=Processed_coil::where('status','1')->get();
		$ball_diameter=Ball_Diameter::where('status','1')->get();
		$heading_machine=MachineMaster::where('status','1')->where('machine_type_id','1')->get();
		$heading_operator=User::where('user_type_id','3')->where('status','1')->get();
		$heading_details=Heading::findOrFail($heading_id);

		$coil_id=$heading_details->processed_coil_id;
		$splitcoils_data=Processed_coil_detail::with('underprocess_coil_data','underprocess_coil_data')
									 ->whereHas('underprocess_coil_data', function($query) use($coil_id){
						       		$query->where('splitcoil_size',$coil_id);
						    		})
									->get();
		//dd($splitcoils_data);
		return view('Admin.Production.Heading.add', compact('processed_coil','ball_diameter','heading_machine','heading_operator','heading_details','splitcoils_data'));
	}

	public function getHeadingObservationData(Request $request){
		if($request->heading_id){			
			$headingobs_details=HeadingObservation::where('heading_id',$request->heading_id)
									->get();
			$machine=array();				
			$operator=array();				
			foreach($headingobs_details as $heading){
				$machine[]=$heading->machine_id;
				$operator[]=$heading->operator_id;
			}
			$machinedata=implode(',',$machine);					
			$operatordata=implode(',',$operator);					
			$obsdata = array(
			'machinedata' => $machinedata,
			'operatordata' => $operatordata,
			'headingobs_details' => $headingobs_details,
		);		
			
			return response()->json($obsdata);
		}
	}

	public function getHeadingWireData(Request $request){
		if($request->heading_id){			
			$headingwire_details=HeadingWire::where('heading_id',$request->heading_id)
									->get();
			$coils=array();				
			foreach($headingwire_details as $wire){
				$coils[]=$wire->processed_coilsize_id;
			}
			$coildata=implode(',',$coils);					
			$data = array(
			'coildata' => $coildata,
			'headingwire_details' => $headingwire_details,
		);						
			
			return response()->json($data);
		}
	}
	public function getHeadingBatchData(Request $request){
		if($request->heading_id){			
			$headingbatch_details=HeadingBatch::where('heading_id',$request->heading_id)->get();		
			
						
			
			//dd($headingbatch_details);
			return response()->json($headingbatch_details);
		}
	}

	public function getDelete($heading_id) {
		try
		{
			$heading = Heading::find($heading_id);
			//dd(Carbon::now()->toDateTimeString());
			$heading->delete();
			
			$HeadingObservation=HeadingObservation::where('heading_id',$heading_id)->delete();
			$HeadingBatch=HeadingBatch::where('heading_id',$heading_id)->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/heading')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/heading')->with($notification);
		}

	}

	public function getHeadingWireDelete(Request $request){
		try
		{
			$heading_wire_id = HeadingWire::find($request->heading_wire_id);
			//dd(Carbon::now()->toDateTimeString());
			$heading_wire_id->delete();
		
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
	public function getHeadingbatchDelete(Request $request){
		try
		{
			$heading_batch_id = HeadingBatch::find($request->heading_batch_id);
			//dd(Carbon::now()->toDateTimeString());
			$heading_batch_id->delete();
		
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

	public function getHeadingObservationDelete(Request $request){
		try
		{
			$heading_observation_id = HeadingObservation::find($request->heading_observation_id);
			//dd(Carbon::now()->toDateTimeString());
			$heading_observation_id->delete();
		
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

	public function getSplitcoils(Request $request){
		if($request->processed_coil_id){

			$processedcoil_output=array();
			$splitcoilid=array();
			$splitcoilname=array();
			$da=array();

			$splitcoil_size=$request->processed_coil_id;
			$processedcoil_details=Processed_coil_detail::with('underprocess_coil_data')
									 ->whereHas('underprocess_coil_data', function($query) use($splitcoil_size) {
						       		$query->where('splitcoil_size',$splitcoil_size);
						    		})
									->get();
						//dd($processedcoil_details);			
			foreach($processedcoil_details as $coilsdata){
				$CheckUsedWeight=HeadingWire::select(DB::raw("SUM(processed_coil_weight) as weightsum"))
											->where('processed_coilsize_id',$coilsdata->id)->first();

				if(!empty($CheckUsedWeight) && $CheckUsedWeight != ''){
					//print_r($CheckUsedWeight->weightsum.'= > =='.$coilsdata->coil_weight);
					$usedweight=$CheckUsedWeight->weightsum;
					$coilweight=$coilsdata->coil_weight;
										
						if($coilweight > $usedweight){
							$splitcoilid[]=$coilsdata->id;
							$splitcoilname[]=$coilsdata->coil_name;	

							$processedcoil_output[] = array(
												'id'=>$coilsdata->id, 
												'coil_name'=>$coilsdata->coil_name
											);			

						}
						
				}else{

						   $processedcoil_output[] = array(
												'id'=>$coilsdata->id, 
												'coil_name'=>$coilsdata->coil_name
											);	
						
				}	
								
					
			}						
			//dd($processedcoil_output);
			if($request->edit == 0 || $request->edit == 2){
				return response()->json($processedcoil_output);
			}else if($request->edit == 1){
				return response()->json($processedcoil_details);
			}
			
		}
	}
	

	public static function DashboardData(){
		$heading_details = Heading::with('heading_obsdata','headingwire_data','headingBall','processed_coil')
									->orderBy('heading_id','desc')->take(5)->get();
		return $heading_details;					
	}
	
}
