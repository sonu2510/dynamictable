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
use App\Models\Production\HeadingBatch;
use App\Models\Production\FlashingBatch;
use App\Http\Traits\datatabledom;
use DataTables;
use DB;
Use App\User;
use Carbon\Carbon;


class StockController extends Controller
{
     use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Production.production_stock.index');
	}

	public function indexDatatable() {
		//dd(Vendor::first());
		$lapping_details = Ball_Diameter::get();
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
			->addColumn('ball_size', function ($lapping_details) {
				//pass Unique Id And Status
				return $lapping_details->ball_size;

			})
			->addColumn('Heading_Batches', function ($lapping_details) {
				//pass Unique Id And Status
				return 'Batche Count - '.$this->getHeadingBatchCount($lapping_details->id);

			})
			->addColumn('Flashing_Batches', function ($lapping_details) {
				//pass Unique Id And Status
				return 'Batche Count - '.$this->getFlashingBatchCount($lapping_details->id);
				//date('l, F d Y', strtotime($inward_details->material_receive_date));

			})
			->addColumn('Grinding_Batches', function ($lapping_details) {				
				return $lapping_details->ball_size;
				

			})
			->addColumn('Lapping_Batches', function ($lapping_details) {
			   return $lapping_details->ball_size;

			})

			
		

		->rawColumns(['id'])
        ->make(true);

	}	

	public function getHeadingBatchCount($ball_size_id){

		if($ball_size_id){
			$headingbatch=HeadingBatch::where('ball_size_id',$ball_size_id)->get();
			if(count($headingbatch) > 0){
				return(count($headingbatch));
			}else{
				return '0';
			}
		}

	}

	public function getFlashingBatchCount($ball_size_id){

		if($ball_size_id){
			$flashingbatch=FlashingBatch::where('ball_size_id',$ball_size_id)->get();
			if(count($flashingbatch) > 0){
				return(count($flashingbatch));
			}else{
				return '0';
			}
		}

	}

	public function getGrindingBatchCount($ball_size_id){

		if($ball_size_id){
			$flashingbatch=FlashingBatch::where('ball_size_id',$ball_size_id)->get();
			if(count($flashingbatch) > 0){
				return(count($flashingbatch));
			}else{
				return '0';
			}
		}

	}
	
}
