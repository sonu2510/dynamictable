<?php

namespace App\Http\Controllers\Admin\RawMaterial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
use App\Models\Vendor\Vendor;
use App\Models\RawMaterial\Inward;
use App\Models\RawMaterial\CoilInward;
use App\Models\RawMaterial\coil_detail;
use App\Models\RawMaterial\Processed_coil;
use App\Models\RawMaterial\Processed_coil_detail;
use App\Models\RawMaterial\Inward_underprocess;
use App\Models\RawMaterial\Under_process_coil;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;
use Carbon\Carbon;


class InwardsController extends Controller
{
     use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Rawmaterial.Inwards.index');
	}

	public function indexDatatable() {
		//dd(Vendor::first());
		$inward_details = Inward::with('vendor','coil_size')
							 /*->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })*/
							->orderBy('id','desc')->get();
		//dd($inward_details);
		return Datatables::of($inward_details)

			->addColumn('id', function ($inward_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($inward_details->id);

			})
			->addColumn('invoice_data', function ($inward_details) {
				//pass Unique Id And Status
				return $inward_details->inward_no.'<br>'.date(' d F Y', strtotime($inward_details->invoice_date));

			})
			->addColumn('coil', function ($inward_details) {
				//pass Unique Id And Status
				return $inward_details->coil_size->coil_size;

			})
			->addColumn('mill', function ($inward_details) {
				//pass Unique Id And Status
				return $inward_details->mill;

			})
			->addColumn('vendor', function ($inward_details) {
				//pass Unique Id And Status
				return $inward_details->vendor->company_name; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})

			
		 ->addColumn('action', function ($inward_details) {

                return $this->EditDom("/inward/edit",$inward_details->id,'inward').$this->DeleteDom("/inward/delete",$inward_details->id,'inward');
                
        })

        ->addColumn('posted_by', function ($inward_details) {
				//pass Unique Id And Status

				return '<span class="label label-success label-rounded">'.$this->getUser($inward_details->user_id).'</span>'; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})	

		->rawColumns(['id','invoice_data','vendor','action','posted_by'])
        ->make(true);

	}

	public function getUser($user_id){
		if($user_id){
			$getUsername=User::findOrFail($user_id);
			return $getUsername->name;
		}
	}

	public function create(){
		
		$vendors=Vendor::where('status','1')->get();
		$coil_data=coil_detail::where('status','1')->get();
		return view('Admin.Rawmaterial.Inwards.add',compact('vendors','coil_data'));
	}

	public function Save(Request $request) {
		//dd($request->all());
		//dd(Inward::latest()->first());
		$inward_details = Auth::user();

		$coil_size_no = coil_detail::findOrFail($request->get("coilsize_id"));

		//dd($coil_size_no);

		$validator = Inward::validator($request->all(), $request->get("inward_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}
        $inward_number='';
		if ($request->get("inward_id") == '') {
			$inward_details = new Inward();
			$inward_data=Inward::latest()->first();
			if($inward_data == '' ){
				$inward_number=1;
				$inward_details->inward_no = "INWD".str_pad($inward_number,6,'0',STR_PAD_LEFT);	
				
			}else{
				$inward_number=$inward_data->id + 1;
				$inward_details->inward_no = "INWD".str_pad($inward_number,6,'0',STR_PAD_LEFT);	
			}
        
		} else {
			$inward_details = Inward::findOrFail($request->get("inward_id"));
		}
	   //dd("INWD".str_pad($inward_number,6,'0',STR_PAD_LEFT));
        
			
		$inward_details->supplier_id = $request->get("supplier_id");
		$inward_details->inward_date = $request->get("inward_date");
		$inward_details->invoice_no = $request->get("invoice_no");
		$inward_details->invoice_date = $request->get("invoice_date");
		
		$inward_details->heat_point = $request->get("heat_point");
		$inward_details->mill = $request->get("mill");
		$inward_details->coilsize_id = $request->get("coilsize_id");

		$inward_details->total_weight = $request->get("total_weight");		
		$inward_details->remark = $request->get("remark");
		$inward_details->status = $request->get("status");
		$inward_details->user_id = Auth()->user()->id;
		
		$inward_details->save();

		$last_inward_id=Inward::latest()->first();
		//dd('ss');
		
		if(count($request->get("inward_coil_id")) != 0){
			$issue_data_count=count($request->get("inward_coil_id"));

			for($row=0;$row<$issue_data_count;$row++){

				if($request->inward_coil_id[$row] == ''){
				        
					$Coilinward_details = new CoilInward();
				    	if ($request->get("inward_id") == '') {
				    	    $Coilinward_details->inward_id=$last_inward_id->id;
				    	}else{
				    	    $Coilinward_details->inward_id=$request->inward_id; 
				    	}
				}else{

					$Coilinward_details = CoilInward::findOrFail($request->inward_coil_id[$row]);
				    $Coilinward_details->inward_id=$request->inward_id;
				}
			
				$spbpl_number=$coil_size_no->coil_number.''.date("y").''.str_pad($request->spbpl_no[$row],3,"0",STR_PAD_LEFT);
				//Coilinward_details->inward_id=$last_inward_id->id;
				$Coilinward_details->coilsize_id=$request->get("coilsize_id");
				$Coilinward_details->coil_entry_year=date("Y");
				$Coilinward_details->per_coil_weight=$request->per_coil_weight[$row];
				$Coilinward_details->spbpl_no=$request->spbpl_no[$row];
				$Coilinward_details->spbpl_number=$spbpl_number;
				$Coilinward_details->coil_status=1;

				$Coilinward_details->save();
			}

		}

		

		
		//--------------------Inward Issue Details----------------------------------
/*		if ($request->get("inward_id") != '') {
			$issue_data_count=count($request->get("inward_coil_id"));

			for($row=0;$row<$issue_data_count;$row++){				
			
				$Coilinward_details = CoilInward::findOrFail($request->inward_coil_id[$row]);
				

				$Coilinward_details->issue_date=$request->issue_date[$row];
				//$Coilinward_details->inward_coil_no=$last_inward_id;
				$Coilinward_details->challan_no=$request->challan_no[$row];
				$Coilinward_details->jobword_supplier=$request->jobword_supplier[$row];
				
				//dd($Coilinward_details);
				$Coilinward_details->save();
			}
		}
		
*/		//--------------------End Inward Issue Details----------------------------------


		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/inward')->with($notification);

	}


	public function Edit($inward_id, Request $request) {

		//dd($request);
		$vendors=Vendor::all();
		$coil_data=coil_detail::where('status','1')->get();
		$inward_details = Inward::findOrFail($inward_id);
		$coil_details=CoilInward::where('inward_id',$inward_id)->get();

		return view('Admin.Rawmaterial.Inwards.add', compact('inward_details','vendors','coil_details','coil_data'));
	}

	public function getDelete($inward_id) {
		try
		{
			$inward_id = Inward::find($inward_id);
			//dd(Carbon::now()->toDateTimeString());
			 $inward_id->delete();

			$timestamp = Carbon::now();
			//DB::enableQueryLog();
			$coil_details=CoilInward::where('inward_id',$inward_id->id)->delete();
			//dd(DB::getQueryLog());

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/inward')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/inward')->with($notification);
		}

	}

	public function getCoilinwardDetails(Request $request){
		if($request->inward_id != ''){
			
			$Coilinward_details=CoilInward::where('inward_id',$request->inward_id)->get();
			//dd($Coilinward_details);

			return response()->json($Coilinward_details);
		}

	}

	public function getCoildetailsDelete(Request $request){
		if($request->coil_inward_id != ''){			
			
			$coil_inward_id = CoilInward::find($request->coil_inward_id);

			$coil_inward_id->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);

			return response()->json($notification);
		}
	}

	public function getCoilSpblpnumber(Request $request){
		
		try
		{
			if($request->coilsize_id != ''){
			//dd($request->coilsize_id);
				//DB::enableQueryLog(); 
				$Coil_details=CoilInward::where('coilsize_id',$request->coilsize_id)->where('coil_entry_year',date("Y"))->orderBy('inward_coil_id','desc')->max('spbpl_no');

				
			
				//dd(DB::getQueryLog());
			return response()->json($Coil_details);
			}

		} catch (\Exception $ex) {
			$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
           return response()->json($notification);
		}

	}


	//-------------------------Under Processing Inwards----------------------------------//

	public function indexUnderProcess(){

		return view('Admin.Rawmaterial.Inward_underprocessing.index');
	}

	public function indexUnderProcessDatatable(){

		
        $inward_inprocess_details=Inward_underprocess::with('underprocess_coil')
        				 /*->whereHas('Inward_underprocess', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })*/
        				 ->orderBy('inward_underprocess_id','desc')->get();

        //dd(DB::getQueryLog());
		//dd($inward_inprocess_details);
		
		return Datatables::of($inward_inprocess_details)

			->addColumn('id', function ($inward_inprocess_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($inward_inprocess_details->id);

			})
			->addColumn('invoice_data', function ($inward_inprocess_details) {
				//pass Unique Id And Status
				return $inward_inprocess_details->under_processing_no.'<br>'.date(' d F Y', strtotime($inward_inprocess_details->created_at));

			})
			->addColumn('coils', function ($inward_details) {
				//pass Unique Id And Status
				$data=array();
				foreach($inward_details->underprocess_coil as $coildata){
				$data[]=$coildata->coil_data->coil_size.'<br>';
				}
				$unique = array_unique($data); 
				//$data[]=array_unique($data);
				return implode(',',$unique); 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('mill', function ($inward_details) {
				//pass Unique Id And Status
				$data=array();
				foreach($inward_details->underprocess_coil as $coildata){
				$data[]=$coildata->mill;
				}
				$mills = implode(',',$data); 
				//$data[]=array_unique($data);
				return $mills; 

			})

			
		 ->addColumn('action', function ($inward_inprocess_details) {

                return $this->EditDom("/inward_underprocess/edit",$inward_inprocess_details->inward_underprocess_id,'inward_underprocess');
                
        })
        ->addColumn('posted_by', function ($inward_inprocess_details) {
				//pass Unique Id And Status

				return '<span class="label label-success label-rounded">'.$this->getUser($inward_inprocess_details->user_id).'</span>'; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})		

		->rawColumns(['id','invoice_data','coils','action','posted_by'])
        ->make(true);
	}
	public function finishedProcessDatatable(){

		$user = new Inward_underprocess();
		$coil_id=$user->coilstatus_check();
		//dd($coil_id);
        $inward_inprocess_details=Inward_underprocess::with('underprocess_coil')
        				->whereHas('underprocess_coil', function($query) use($coil_id){
						        $query->whereIn('under_process_coil_id',explode(',',$coil_id));
						    })
        				 ->orderBy('inward_underprocess_id','desc')->get();

        //dd(DB::getQueryLog());
		//dd($inward_inprocess_details);
		
		return Datatables::of($inward_inprocess_details)

			->addColumn('id', function ($inward_inprocess_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($inward_inprocess_details->id);

			})
			->addColumn('invoice_data', function ($inward_inprocess_details) {
				//pass Unique Id And Status
				return $inward_inprocess_details->under_processing_no.'<br>'.date(' d F Y', strtotime($inward_inprocess_details->created_at));

			})
			->addColumn('coils', function ($inward_details) {
				//pass Unique Id And Status
				$data=array();
				foreach($inward_details->underprocess_coil as $coildata){
				$data[]=$coildata->coil_data->coil_size.'<br>';
				}
				$unique = array_unique($data); 
				//$data[]=array_unique($data);
				return implode(',',$unique); 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('mill', function ($inward_details) {
				$data=array();
				foreach($inward_details->underprocess_coil as $coildata){
				$data[]=$coildata->mill;
				}
				$mills = implode(',',$data); 
				//$data[]=array_unique($data);
				return $mills; 
				
			})

			
		 ->addColumn('action', function ($inward_inprocess_details) {

                return $this->EditDom("/inward_underprocess/edit",$inward_inprocess_details->inward_underprocess_id,'inward_underprocess');
                
        })
        ->addColumn('posted_by', function ($inward_inprocess_details) {
				//pass Unique Id And Status

				return '<span class="label label-success label-rounded">'.$this->getUser($inward_inprocess_details->user_id).'</span>'; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})	

		->rawColumns(['id','invoice_data','coils','action','posted_by'])
        ->make(true);
	}

	public function createUnderProcessing(){
		
		//$vendors=Vendor::where('status','1')->get();
		$coil_data=coil_detail::where('status','1')->get();
		$processed_coil=Processed_coil::where('status','1')->get();
		$suppliers=Vendor::Where('status',1)->get();
		return view('Admin.Rawmaterial.Inward_underprocessing.add',compact('coil_data','suppliers','processed_coil'));
	}

	public function getCoilSpbplNo(Request $request){
		//dd($request->edit);
		if($request->coilsize != ''){	
			$spbpl_no=CoilInward::query();
			
			$query = $spbpl_no->where('coilsize_id',$request->coilsize);
			if(!$request->edit){
			$query=$spbpl_no->where('coil_status',1);			
			}			
			$spbpl_no->get();
			//dd($spbpl_no->get());
			return response()->json($spbpl_no->get());
		}
	}

	public function EditUnderprocessing($inward_underprocess_id, Request $request) {
		//dd($request);
		$inward_inprocess_details=Inward_underprocess::with('underprocess_coil')->where('inward_underprocess_id',$inward_underprocess_id)->first();
		

		$coil_data=coil_detail::where('status','1')->get();
		$processed_coil=Processed_coil::where('status','1')->get();
		$suppliers=Vendor::Where('status',1)->get();
		//$processedcoil_details=Processed_coil_detail::with('inward_underprocess_data','underprocess_coil_data')->where('inward_underprocess_id',$inward_underprocess_id)->get();

		$processedcoil_details=Under_process_coil::with('underprocess_coil_data','coil_data')->where('inward_underprocess_id',$inward_underprocess_id)->get();
	//dd($processedcoil_details);

		return view('Admin.Rawmaterial.Inward_underprocessing.add', compact('inward_inprocess_details','coil_data','processedcoil_details','suppliers','processed_coil'));
	}

	public function Save_ProcessedCoil(Request $request){

		//dd($request->all());			
		$inward_underprocess_details = Auth::user();
		
        $under_processing_no='';
		if ($request->get("inward_underprocess_id") == '') {
			$inward_underprocess_details = new Inward_underprocess();
			$inwardprocessing_data=Inward_underprocess::latest()->first();
			if($inwardprocessing_data == '' ){
				$under_processing_no=1;
				$inward_underprocess_details->under_processing_no = "UPR".str_pad($under_processing_no,6,'0',STR_PAD_LEFT);	
				
			}else{
				$under_processing_no=$inwardprocessing_data->inward_underprocess_id  + 1;
				$inward_underprocess_details->under_processing_no = "UPR".str_pad($under_processing_no,6,'0',STR_PAD_LEFT);	
			}
        
		} else {
			//dd('ss');
			$inward_underprocess_details = Inward_underprocess::findOrFail($request->get("inward_underprocess_id"));
		}
		$inward_underprocess_details->status=$request->status;
		$inward_underprocess_details->user_id = Auth()->user()->id;
		$inward_underprocess_details->save();

		$last_underprocess_id=Inward_underprocess::latest()->first();

		if(count($request->get("issue_date")) != 0){
			$issue_data_count=count($request->get("issue_date"));
			$all_coil_count=0;
			for($row=0;$row<$issue_data_count;$row++){

				if($request->under_process_coil_id[$row] == ''){				        
					$Under_process_coil = new Under_process_coil();	
					//coil status update to under processing
					$Coilinward_details = CoilInward::findOrFail($request->spbpl[$row]);
					$Coilinward_details->coil_status=2;
					$Coilinward_details->save();
					//
				}else{
					$Under_process_coil = Under_process_coil::findOrFail($request->under_process_coil_id[$row]);				    
				}
				if(isset($request->inward_underprocess_id) && $request->inward_underprocess_id != ''){
					$Under_process_coil->inward_underprocess_id=$request->inward_underprocess_id;
				}else{
					$Under_process_coil->inward_underprocess_id=$last_underprocess_id->inward_underprocess_id;
				}
				
				$Under_process_coil->inward_coil_id=$request->spbpl[$row];
				$Under_process_coil->coil_size_id=$request->coils[$row];

				$getSpbplno=CoilInward::findOrFail($request->spbpl[$row]);
				//dd();
				$Under_process_coil->coil_spbpl_no=$getSpbplno->spbpl_number;


				$Under_process_coil->issue_date=$request->issue_date[$row];
				$Under_process_coil->challan_no=$request->challan_no[$row];
				$Under_process_coil->mill=$request->mill[$row];
				$Under_process_coil->jobwork_supplier=$request->job_work[$row];
				$Under_process_coil->splitcoil_size=$request->coil_size[$row];

				if(isset($request->inward_coil_id[$row]) && $request->status == 0){					
					$Under_process_coil->splitcoil_inwarddate=$request->splitcoil_inwarddate[$row];
				}
				$Under_process_coil->save();
				//dd(isset($request->inward_coil_id[1]));
				if(isset($request->inward_coil_id[$row]) && $request->status == 0 && ($request->get('splitcoils_weight_'.$request->inward_coil_id[$row]) != null ) ){
					//dd('s');
					$splitcoil_count=count($request->get('splitcoils_weight_'.$request->inward_coil_id[$row]));
					//print_r($splitcoil_count);
					//print_r('<br>');
					 	$stringabcd='A';
						for($total_coil=0;$total_coil<$splitcoil_count;$total_coil++){
								print_r($all_coil_count);
						if ($request->get("processed_coil_id")[$all_coil_count] == ''){											
							$processedcoil_details = new Processed_coil_detail();	
							//coil status update to under processing
							$Coilinward_details = CoilInward::findOrFail($request->spbpl[$row]);
							$Coilinward_details->coil_status=3;
							$Coilinward_details->save();
													
						} else {								
								$processedcoil_details = Processed_coil_detail::findOrFail($request->get("processed_coil_id")[$all_coil_count]);							
							
						}						
							$number=$request->get('spbpl_no_'.$request->get('inward_coil_id')[$row])[$total_coil].''.$stringabcd;
							$processedcoil_details->under_process_coil_id=$request->under_process_coil_id[$row];
							$processedcoil_details->inward_underprocess_id=$request->inward_underprocess_id;

							$processedcoil_details->coil_weight=$request->get('splitcoils_weight_'.$request->get('inward_coil_id')[$row])[$total_coil];	
							$processedcoil_details->coil_name=$number;
							
						
						$processedcoil_details->save();
											
						$all_coil_count++;
				$stringabcd++;	}

				} 
					
			}

		}
		//dd('ss');
		
		$notification = array(
			'message' => 'Record Updated Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/inward_underprocess')->with($notification);
	}


	public function getsplitCoilDelete(Request $request){
		if($request->splitcoil_id != ''){			
			
			$splitcoil_id = Processed_coil_detail::find($request->splitcoil_id);

			$splitcoil_id->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);

			return response()->json($notification);
		}
	}

	public function getSpbplCoilWeight(Request $request){
		if($request->inward_coilid != ''){			
			
			$coil_weight = CoilInward::findOrFail($request->inward_coilid);

			return response()->json($coil_weight);
		}

	}
	//--------------------------------End------------------------------------------------//


	//--------------------------------Finished Wired Stock--------------------------------//

	public function indexFinishedstock(){

		return view('Admin.Rawmaterial.finished_stock.index');
	}

	public function indexFinishedstockDatatable(){
		
        $processedcoil_details=Processed_coil_detail::with('underprocess_coil_data','inward_underprocess_data')->get();				
		
		return Datatables::of($processedcoil_details)

			->addColumn('id', function ($processedcoil_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($processedcoil_details->id);

			})
			->addColumn('coil_data', function ($processedcoil_details) {
				//pass Unique Id And Status
				return $processedcoil_details->underprocess_coil_data[0]->coil_data->coil_size;

			})
			->addColumn('mill', function ($processedcoil_details) {
				//pass Unique Id And Status
				return $processedcoil_details->mill;

			})
			->addColumn('coil_spbpl_no', function ($processedcoil_details) {
				//pass Unique Id And Status
				return $processedcoil_details->coil_name;

			})
			->addColumn('coil_size', function ($processedcoil_details) {
				//pass Unique Id And Status
				return $processedcoil_details->coil_weight;

			})
			->addColumn('inward_date', function ($processedcoil_details) {
				//pass Unique Id And Status
				return date(' d F Y', strtotime($processedcoil_details->created_at));
			})	
        	

		->rawColumns(['id','coil_data','coil_spbpl_no','inward_date','coil_size'])
        ->make(true);
	}

	public static function getFinishedStock($coil_id){

		 $SearchCoil_InProcess=Under_process_coil::with('coil_data')
		 					  ->whereHas('coil_data', function($query) use($coil_id){
						        $query->where('id', $coil_id);						        
						       })
		 		               ->first();
		$finishedStockWeight=''; 		               
		 if(!empty($SearchCoil_InProcess)){		               
		 $finishedStockWeight=Processed_coil_detail::select(DB::raw("SUM(coil_weight) as total_weight"))
		 											->where('inward_underprocess_id',$SearchCoil_InProcess->inward_underprocess_id)
		 											->first();
		 }
		return $finishedStockWeight;

	}

	/*public function ViewFinishedStock($inward_id = '', Request $request) {
		//dd($request);
		$vendors=Vendor::all();
		$coil_data=coil_detail::where('status','1')->get();
		$inward_details = Inward::findOrFail($inward_id);
		$processedcoil_details=Inward_processed_coil::with('inward_coil_data','inward_data','processed_coils')->where('inward_id',$inward_id)->get();
		//dd($processedcoil_details[0]);
		$coil_details=CoilInward::where('inward_id',$inward_id)->get();

		return view('Admin.Rawmaterial.finished_stock.add', compact('inward_details','vendors','coil_details','coil_data','processedcoil_details'));
	}*/

	///-------------------------------------End-------------------------------------------//

	public function indexSappstock(){

		return view('Admin.Rawmaterial.sapp_stock.index');
	}

	public function indexSappstockDatatable(){
		
        $coil_details=CoilInward::with('issue_inwards_data','coil_data')->where('coil_status',1)->orderBy('inward_coil_id','desc')->get();				
		//dd($coil_details);
		return Datatables::of($coil_details)

			->addColumn('id', function ($coil_details) {
				//pass Unique Id And Status
				return $this->checkboxDom($coil_details->inward_coil_id);

			})
			->addColumn('coil_data', function ($coil_details) {
				//pass Unique Id And Status
				return $coil_details->coil_data->coil_size;

			})
			->addColumn('coil_spbpl_no', function ($coil_details) {
				//pass Unique Id And Status
				return $coil_details->spbpl_number;

			})
			->addColumn('mill', function ($coil_details) {
				//pass Unique Id And Status
				return $coil_details->mill;

			})
			->addColumn('coil_size', function ($coil_details) {
				//pass Unique Id And Status
				return $coil_details->per_coil_weight;

			})
			->addColumn('inward_date', function ($coil_details) {
				//pass Unique Id And Status
				return date(' d F Y', strtotime($coil_details->created_at));
			})	
        	

		->rawColumns(['id','coil_data','coil_spbpl_no','inward_date','coil_size'])
        ->make(true);
	}

	public static function DashboardData(){
		$inward_details = Inward::with('vendor','coil_size')
							 /*->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })*/
							->orderBy('id','desc')->take(5)->get();
		return $inward_details;					
	}
}
