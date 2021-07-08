<?php

namespace App\Http\Controllers\Admin\RawMaterial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\RawMaterial\Ball_Diameter;
use App\Http\Traits\datatabledom;
use DataTables;

class BallDiameter_Controller extends Controller
{
   use datatabledom;

    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Rawmaterial.Ballsize.index');
	}

	public function indexDatatable() {
		$ball_data = Ball_Diameter::All();
		//dd($user_type);
		return Datatables::of($ball_data)

			->addColumn('ball_id', function ($ball_data) {
				//pass Unique Id And Status
				return $this->checkboxDom($ball_data->id);

			})
			->addColumn('size', function ($ball_data) {
				//pass Unique Id And Status
				return $ball_data->ball_size;

			})
			->addColumn('status', function ($ball_data) {
				//pass Unique Id And Status
				return $this->SwitchDom($ball_data->id, $ball_data->status);

			})
		 ->addColumn('action', function ($ball_data) {

                return $this->EditDom("/ballsize/edit",$ball_data->id,'ballsize').$this->DeleteDom("/ballsize/delete",$ball_data->id,'ballsize');
                
        })	

		->rawColumns(['ball_id','action','status'])
        ->make(true);

	}

	public function create(){
		
		return view('Admin.Rawmaterial.Ballsize.add');
	}

	public function Save(Request $request) {

		//dd($request->all());
		$ball_data = Auth::user();
		$validator = Ball_Diameter::validator($request->all(), $request->get("id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("id") == '') {
			$ball_data = new Ball_Diameter();

		} else {
			$ball_data = Ball_Diameter::findOrFail($request->get("id"));
		}
		


		$ball_data->ball_size = $request->get("ball_size");
		$ball_data->ball_batch_no = $request->get("ball_batch_no");

		$ball_data->hs_equator_dia = $request->get("hs_equator_dia");
		$ball_data->hs_equator_tolerance = $request->get("hs_equator_tolerance");
		$ball_data->hs_pole_dimension = $request->get("hs_pole_dimension");
		$ball_data->hs_pole_tolerance = $request->get("hs_pole_tolerance");
		$ball_data->hs_offset = $request->get("hs_offset");
		$ball_data->hs_weight_min = $request->get("hs_weight_min");
		$ball_data->hs_weight_max = $request->get("hs_weight_max");
		$ball_data->hs_total_balls_min = $request->get("hs_total_balls_min");
		$ball_data->hs_total_balls_max = $request->get("hs_total_balls_max");

		$ball_data->fs_unloading_gauge = $request->get("fs_unloading_gauge");
		$ball_data->fs_tolerance = $request->get("fs_tolerance");
		$ball_data->fs_ovality = $request->get("fs_ovality");
		$ball_data->fs_lot_variation = $request->get("fs_lot_variation");

		$ball_data->gs_unloading_gauge = $request->get("gs_unloading_gauge");
		$ball_data->gs_tolerance = $request->get("gs_tolerance");
		$ball_data->gs_ovality = $request->get("gs_ovality");
		$ball_data->gs_lot_variation = $request->get("gs_lot_variation");
		
		$ball_data->ls_unloading_gauge = $request->get("ls_unloading_gauge");
		$ball_data->ls_tolerance = $request->get("ls_tolerance");
		$ball_data->ls_ovality = $request->get("ls_ovality");
		$ball_data->ls_lot_variation = $request->get("ls_lot_variation");

		$ball_data->status = $request->get("status");

		$ball_data->save();

		$notification = array(
			'message' => 'Record Added Successfully',
			'alert-type' => 'success',
		);
		
		return Redirect::to('/ballsize')->with($notification);

	}

	public function Edit($ballsize_id , Request $request) {
		//dd($request);
		$ball_data = Ball_Diameter::findOrFail($ballsize_id);

		return view('Admin.Rawmaterial.Ballsize.add', compact('ball_data'));
	}

	public function getDelete($ballsize_id) {
		try
		{
			$ballsize = Ball_Diameter::find($ballsize_id);

			$ballsize->delete();

			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/ballsize')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/ballsize')->with($notification);
		}

	}
}
