<?php

namespace App\Http\Controllers\Admin\RawMaterial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Vendor\Vendor;
use App\Models\RawMaterial\Inward;
use App\Models\RawMaterial\CoilInward;
use App\Models\RawMaterial\coil_detail;
use App\Models\RawMaterial\Processed_coil_detail;
use App\Models\RawMaterial\Inward_processed_coil;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;
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
		$inward_details = Inward::with('vendor','inward_processed_coil','coil_size')
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
			->addColumn('vendor', function ($inward_details) {
				//pass Unique Id And Status
				return $inward_details->vendor->company_name; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})

			
		 ->addColumn('action', function ($inward_details) {

                return $this->EditDom("/inward/edit",$inward_details->id,'inward').$this->DeleteDom("/inward/delete",$inward_details->id,'inward');
                
        })	

		->rawColumns(['id','invoice_data','vendor','action'])
        ->make(true);

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
		$inward_details->coilsize_id = $request->get("coilsize_id");

		$inward_details->total_weight = $request->get("total_weight");		
		$inward_details->status = $request->get("status");
		
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

				//Coilinward_details->inward_id=$last_inward_id->id;
				$Coilinward_details->coilsize_id=$request->get("coilsize_id");
				$Coilinward_details->coil_entry_year=date("Y");
				$Coilinward_details->per_coil_weight=$request->per_coil_weight[$row];
				$Coilinward_details->spbpl_no=$request->spbpl_no[$row];
				$Coilinward_details->save();
			}

		}

		

		
		//--------------------Inward Issue Details----------------------------------
		if ($request->get("inward_id") != '') {
			$issue_data_count=count($request->get("coil_id"));

			for($row=0;$row<$issue_data_count;$row++){				
			
				$Coilinward_details = CoilInward::findOrFail($request->coil_id[$row]);
				

				$Coilinward_details->issue_date=$request->issue_date[$row];
				//$Coilinward_details->inward_coil_no=$last_inward_id;
				$Coilinward_details->challan_no=$request->challan_no[$row];
				$Coilinward_details->jobword_supplier=$request->jobword_supplier[$row];
				
				//dd($Coilinward_details);
				$Coilinward_details->save();
			}
		}
		
		//--------------------End Inward Issue Details----------------------------------


		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);


		
		return Redirect::to('/inward')->with($notification);

	}

	public function Edit($inward_id = '', Request $request) {
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

			$inward_id->delete();

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
			$Coil_details=CoilInward::where('coilsize_id',$request->coilsize_id)->where('coil_entry_year',date("Y"))->orderBy('inward_coil_id','desc')->first();
			//dd($Coil_details);

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

		
        $inward_details=inward::with('inward_processed_coil')
        				 ->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 1);
						    })
        				 ->orderBy('id','desc')->get();

        //dd(DB::getQueryLog());
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
			->addColumn('vendor', function ($inward_details) {
				//pass Unique Id And Status
				return $inward_details->vendor->company_name; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})

			
		 ->addColumn('action', function ($inward_details) {

                return $this->EditDom("/inward_underprocess/edit",$inward_details->id,'inward');
                
        })	

		->rawColumns(['id','invoice_data','vendor','action'])
        ->make(true);
	}

	public function createUnderProcessing(){
		
		//$vendors=Vendor::where('status','1')->get();
		$coil_data=coil_detail::where('status','1')->get();
		return view('Admin.Rawmaterial.Inward_underprocessing.add',compact('coil_data'));
	}

	public function getCoilSpbplNo(Request $request){
		if($request->coilsize != ''){			
			
			$spbpl_no = CoilInward::where('coilsize_id',$request->coilsize)->get();

			return response()->json($spbpl_no);
		}
	}

	public function EditUnderprocessing($inward_id = '', Request $request) {
		//dd($request);
		$vendors=Vendor::all();
		$coil_data=coil_detail::where('status','1')->get();
		$inward_details = Inward::findOrFail($inward_id);
		$processedcoil_details=Inward_processed_coil::with('inward_coil_data','inward_data','processed_coils')->where('inward_id',$inward_id)->get();
		//dd($processedcoil_details[0]);
		$coil_details=CoilInward::where('inward_id',$inward_id)->get();

		return view('Admin.Rawmaterial.Inward_underprocessing.add', compact('inward_details','vendors','coil_details','coil_data','processedcoil_details'));
	}

	public function Save_ProcessedCoil(Request $request){

		$inward_processedcoil_details = Auth::user();	
		//dd($request->all());
		if(isset($request->inward_coil_id)){			//Add 
			$inward_coil_count=count($request->inward_coil_id);
		}else if(isset($request->processed_coil_id)){
			//Update
			$inward_coil_count=count($request->inward_processed_coil_id);
		}
		
		//dd($inward_coil_count);

		if($inward_coil_count > 0 ){
			$all_coil_count=0;
			for($i=0;$i<$inward_coil_count;$i++){

					

					if ($request->get("inward_processed_coil_id") == '') {
						$inward_processedcoil_details = new Inward_processed_coil();
							
					} else {
						$inward_processedcoil_details = Inward_processed_coil::findOrFail($request->get("inward_processed_coil_id")[$i]);
						//dd($inward_processedcoil_details);
					}


					$inward_processedcoil_details->inward_id=$request->inward_id;

					if($request->inward_coil_id != ''){
						$inward_processedcoil_details->inward_coil_id=$request->inward_coil_id[$i];

						$splitcoil_count=count($request->get('splitcoils_weight_'.$request->inward_coil_id[$i]));
					}else if($request->inward_processed_coil_id != ''){
						$inward_processedcoil_details->inward_coil_id=$request->inward_processed_coil_id[$i];	

						$splitcoil_count=count($request->get('splitcoils_weight_'.$request->inward_processed_coil_id[$i]));						
					}
					
					$inward_processedcoil_details->inward_date=$request->splitcoil_inwarddate[$i];

					$inward_processedcoil_details->coil_process_status=$request->coil_process_status;
					
					//print_r($inward_processedcoil_details);
					$inward_processedcoil_details->save();
					
					$last_inward_processedcoil_id=Inward_processed_coil::orderBy('inward_processed_coil_id','desc')->first();
					$last_insertedid=$last_inward_processedcoil_id->inward_processed_coil_id;
					
					//print_r('========');
					for($total_coil=0;$total_coil<$splitcoil_count;$total_coil++){
						//print_r($processedcoil_details->inward_processed_coil_id);
						//print_r('<br>');
						

						if (!empty($request->get("inward_coil_id")[$total_coil]) ) {												
							$processedcoil_details = new Processed_coil_detail();
							
						} else {
							if($request->get("processed_coil_id")[$all_coil_count] == ''){
								$processedcoil_details = new Processed_coil_detail();
								$processedcoil_details->inward_processed_coil_id=$request->inward_processed_coil_id[$i];
								
							}else{
								$processedcoil_details = Processed_coil_detail::findOrFail($request->get("processed_coil_id")[$all_coil_count]);
							}
							
							
						}

						//dd();
						
						//dd($request->get('splitcoils_weight_'.$request->get('processed_coil_id')[$i])[3]);
						if($request->inward_coil_id != ''){		
							$processedcoil_details->inward_processed_coil_id=$last_insertedid;
							

							$processedcoil_details->coil_weight=$request->get('splitcoils_weight_'.$request->get('inward_coil_id')[$i])[$total_coil];	
							
							}
						 if($request->inward_processed_coil_id != ''){
							//

							$processedcoil_details->coil_weight=$request->get('splitcoils_weight_'.$request->get('inward_processed_coil_id')[$i])[$total_coil];		
							
							
									
						}

						print_r($processedcoil_details->inward_processed_coil_id);
						print_r('<br>');

						//print_r($processedcoil_details->inward_processed_coil_id);
						//dd($request->get('splitcoils_weight_'.$inward_coil_id)[$total_coil]);
						//print_r($all_coil_count);								
						//print_r('<br>');								
						
						$processedcoil_details->save();

						$all_coil_count++;
					}
					
			}
		}
		//var_dump($processedcoil_details);
			//dd('sdsad');
		
		
		$notification = array(
			'message' => 'Record Added Successfully',
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
	//--------------------------------End------------------------------------------------//


	//--------------------------------Finished Wired Stock--------------------------------//

	public function indexFinishedstock(){

		return view('Admin.Rawmaterial.finished_stock.index');
	}

	public function indexFinishedstockDatatable(){

		
        $inward_details=inward::with('inward_processed_coil')
        				 ->whereHas('inward_processed_coil', function($query) {
						        $query->where('coil_process_status', '=', 0);
						    })
        				->get();

        //dd(DB::getQueryLog());
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
			
		 ->addColumn('action', function ($inward_details) {

                //return $this->EditDom("/finished_stock/edit",$inward_details->id,'inward');
                return '<a href="/finished_stock/edit/1"><button type="button" class="btn btn-info waves-effect waves-light btn-sm"><i class="far fa-edit">View Stock</i></button></a>';
                
        })	

		->rawColumns(['id','invoice_data','vendor','action'])
        ->make(true);
	}

	public function ViewFinishedStock($inward_id = '', Request $request) {
		//dd($request);
		$vendors=Vendor::all();
		$coil_data=coil_detail::where('status','1')->get();
		$inward_details = Inward::findOrFail($inward_id);
		$processedcoil_details=Inward_processed_coil::with('inward_coil_data','inward_data','processed_coils')->where('inward_id',$inward_id)->get();
		//dd($processedcoil_details[0]);
		$coil_details=CoilInward::where('inward_id',$inward_id)->get();

		return view('Admin.Rawmaterial.finished_stock.add', compact('inward_details','vendors','coil_details','coil_data','processedcoil_details'));
	}

	///-------------------------------------End-------------------------------------------//
}
