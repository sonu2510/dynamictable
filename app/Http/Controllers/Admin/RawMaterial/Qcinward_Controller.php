<?php

namespace App\Http\Controllers\Admin\RawMaterial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Vendor\Vendor;
use App\Models\RawMaterial\Inward;
use App\Models\RawMaterial\CoilInward;
use App\Models\RawMaterial\Qcinward;
use App\Models\RawMaterial\Processed_coil_detail;
use App\Models\RawMaterial\Inward_processed_coil;
use App\Models\RawMaterial\coil_detail;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;

class Qcinward_Controller extends Controller
{
        use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Rawmaterial.Qcinwards.index');
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
			->addColumn('vendor', function ($inward_details) {
				//pass Unique Id And Status
				return $inward_details->vendor->company_name; 
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})

			
		 ->addColumn('action', function ($inward_details) {

                return $this->EditDom("/qcinward/edit",$inward_details->id,'qcinward_report').$this->DeleteDom("/qcinward/delete",$inward_details->id,'qcinward_report');
                
        })	

		->rawColumns(['id','invoice_data','vendor','action'])
        ->make(true);

	}

	public function Edit($inward_id, Request $request) {
		
		$vendors=Vendor::all();
		$coil_data=coil_detail::where('status','1')->get();
		$inward_details = Inward::findOrFail($inward_id);	
		$coil_details=CoilInward::where('inward_id',$inward_id)->get();
		$qc_details=Qcinward::where('inward_id',$inward_id)->first();
		return view('Admin.Rawmaterial.Qcinwards.add', compact('inward_details','vendors','coil_details','coil_data','qc_details'));		
	}

	public function Save(Request $request) {
		
		
		$qcinward_details = Auth::user();
		$validator = Qcinward::validator($request->all(), $request->get("qc_id", ''));
		//dd($request->all());
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if($request->qc_id == ''){
			$qcinward_details = new Qcinward();	
		}else{
			$qcinward_details = Qcinward::findOrFail($request->get("qc_id"));
		}

		

		//dd($request->all());
		$qcinward_details->inward_id=$request->inward_id;
		$qcinward_details->qc_report_date=$request->qc_date;

		$qcinward_details->chem_c=$request->chem_c;
		$qcinward_details->chem_si=$request->chem_si;
		$qcinward_details->chem_mn=$request->chem_mn;
		$qcinward_details->chem_cr=$request->chem_cr;
		$qcinward_details->chem_s=$request->chem_s;
		$qcinward_details->chem_p=$request->chem_p;
		$qcinward_details->chem_ni=$request->chem_ni;
		$qcinward_details->chem_mo=$request->chem_mo;

		$qcinward_details->uts=$request->uts;
		$qcinward_details->carbide_network=$request->carbide_network;
		$qcinward_details->carbide_segrn=$request->carbide_segrn;

		$qcinward_details->sulphide_thin=$request->sulphide_thin;
		$qcinward_details->sulphide_thick=$request->sulphide_thick;
		$qcinward_details->alumina_thin=$request->alumina_thin;
		$qcinward_details->alumina_thick=$request->alumina_thick;
		$qcinward_details->silicate_thin=$request->silicate_thin;
		$qcinward_details->silicate_thick=$request->silicate_thick;
		$qcinward_details->globular_thin=$request->globular_thin;
		$qcinward_details->globular_thick=$request->globular_thick;

		$qcinward_details->decarb=$request->decarb;

		$qcinward_details->qc_remark=$request->qc_remark;
		
		$qcinward_details->eatching=$request->eatching;
		//dd($qcinward_details);
		$qcinward_details->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
		
		return Redirect::to('/qcinward_report')->with($notification);
	}
}
