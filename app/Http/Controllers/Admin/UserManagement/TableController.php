<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\UserManagement\Usertype;
use App\Http\Traits\datatabledom;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use DataTables;





use Doctrine\DBAL\Platforms\AbstractPlatform as DoctrineAbstractPlatform;
use Doctrine\DBAL\Types\Type as DoctrineType;

class TableController extends Controller
{
    use datatabledom;
 	protected static $customTypesRegistered = false;
    protected static $platformTypeMapping = [];
    protected static $allTypes = [];
    protected static $platformTypes = [];
    protected static $customTypeOptions = [];
    protected static $typeCategories = [];
    public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		return view('Admin.Usermanagement.DynamicTable.index');
	}

	public function indexDatatable() {
		$tables = DB::select('SHOW TABLES');
//		$user_type = UserType::All();
		//dd($tables);
		return Datatables::of($tables)

			
			->addColumn('name', function ($tables) {
			
				return ucfirst($tables->Tables_in_metal_skill_balls);

			})	
			 ->addColumn('action', function ($tables) {

	                return $this->EditDom("/dynamictable/edit",$tables->Tables_in_metal_skill_balls,'dynamictable').$this->DeleteDom("/dynamictable/delete",$tables->Tables_in_metal_skill_balls,'dynamictable');
	                
	        })	

		->rawColumns(['name','action'])
        ->make(true);

	}

	public function create(){
		$types = static::getTypeCategories();	
		
		return view('Admin.Usermanagement.DynamicTable.add', compact('types'));
	}

	public function Save(Request $request) {

		$usertypedetails = Auth::user();
		//dd($request->all());
	/*	$validator = Usertype::validator($request->all(), $request->get("user_type_id", ''));

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator->getMessageBag())
				->withInput($request->all());
		}

		if ($request->get("user_type_id") == '') {
			$usertypedetails = new Usertype();

		} else {
			$usertypedetails = Usertype::findOrFail($request->get("user_type_id"));
		}
		$usertypedetails->name = $request->get("name");
		$usertypedetails->status = $request->get("status");

		$usertypedetails->save();

		*/
		$table_name = $request->table_name;

       	 // set your dynamic fields (you can fetch this data from database this is just an example)
     /*   $fields = [
            ['name' => 'field_1', 'type' => 'string'],
            ['name' => 'field_2', 'type' => 'text'],
            ['name' => 'field_3', 'type' => 'integer'],
            ['name' => 'field_4', 'type' => 'longText']
        ];*/
        if($request->current_name != '' && $request->current_name != $request->table_name ){
          Schema::rename($request->current_name, $request->table_name);
          $table_name=$request->table_name;
      
        }
     //   dd($table_name);
		
	        if (!Schema::hasTable($table_name)) {
	        	$t_schema='create';
	        		$notification = array(
							'message' => 'Given table has been successfully created!',
							'alert-type' => 'success',
						);

	        }else{
	        	$t_schema='table';
				$notification = array(
						'message' => 'Given table is Updated .',
						'alert-type' => 'error',
					);    

	        }
	            Schema::{$t_schema}($table_name, function (Blueprint $table) use ($request,$table_name,$t_schema) {
	            
	               //$table->increments('id');

	             // dd(($request->get("length")));
					$column_count=count($request->get("column_name"));

					for($row=0;$row<$column_count;$row++){

		                if ($column_count > 0) {
		                		if($request->index[$row]=='PRIMARY'){
		                			
		                				if($request->old_column_name[$row] != '' && (!Schema::hasColumn($table_name,$request->column_name[$row])) ){		
		                			
		                				//update  && $request->column_type[$row]=='increments'
		                					 Schema::{$t_schema}($table_name, function (Blueprint $table) use ($request,$table_name,$t_schema,$row) {   	
		                			    		 $table->renameColumn($request->old_column_name[$row],$request->column_name[$row]);

		                					 });

		                				/*	 Schema::{$t_schema}($table_name, function (Blueprint $table) use ($request,$table_name,$t_schema,$row) {
		                			    			 $table->increments($request->column_name[$row])->change();
		                			    		});*/

		                				}else if(Schema::hasColumn($table_name,$request->column_name[$row])){

													  //  $table->increments($request->column_name[$row])->unsigned()->change();											 
		                				}else{
		                					
		                					$table->increments($request->column_name[$row]);
		                				}
		                			

		                		}else{
		                		
		                			

		                			if($request->old_column_name[$row] != ''&& ((!Schema::hasColumn($table_name,$request->column_name[$row]))  || $request->old_length[$row] != $request->length[$row])){
		                					//update 
						
		                					if((!Schema::hasColumn($table_name,$request->column_name[$row]) && $request->old_length[$row] == $request->length[$row])){
		                						 Schema::{$t_schema}($table_name, function (Blueprint $table) use ($request,$table_name,$t_schema,$row) {
		                							$table->renameColumn($request->old_column_name[$row],$request->column_name[$row]);
		                					 	});	
		                					}else if(Schema::hasColumn($table_name,$request->column_name[$row]) && $request->old_length[$row] != $request->length[$row]){
		                						
		                						$table->{$request->column_type[$row]}($request->column_name[$row],$request->length[$row])->change();
		                					
		                					}else if(!Schema::hasColumn($table_name,$request->column_name[$row]) && $request->old_length[$row] != $request->length[$row]){

		                							 Schema::{$t_schema}($table_name, function (Blueprint $table) use ($request,$table_name,$t_schema,$row) {
		                							 		$table->renameColumn($request->old_column_name[$row],$request->column_name[$row]);
		                							 });	
		                							 Schema::{$t_schema}($table_name, function (Blueprint $table) use ($request,$table_name,$t_schema,$row) {
		                							 		$table->{$request->column_type[$row]}($request->column_name[$row],$request->length[$row])->change();
		                							 });
		                							
		                							
		                							
		                					} 

		                			}else if(Schema::hasColumn($table_name,$request->column_name[$row]) && $request->old_length[$row] == $request->length[$row] ){									
 										
				                			

		                			}
		                			else{
		                				//new
		                				 //  $table->{$request->column_type[$row]}($request->column_name[$row],$request->length[$row]);

		                				   if($request->default[$row]=='Yes'){
	            								
			            							if($request->column_type[$row]=='integer' || $request->column_type[$row]=='datetime' ){

					            						$table->{$request->column_type[$row]}($request->column_name[$row])->nullable();
					            					}else{

					            							$table->{$request->column_type[$row]}($request->column_name[$row], $request->length[$row])->nullable();

					            					}
			            					}else{

				            						if($request->column_type[$row]=='integer' || $request->column_type[$row]=='datetime' ){
				            							$table->{$request->column_type[$row]}($request->column_name[$row]);
				            						}else{
				            							$table->{$request->column_type[$row]}($request->column_name[$row], $request->length[$row]);
				            						}
			            					}
		                			}                		


	            			
		                  			
		                  		}	

		             		
		                  		if( $request->old_column_type[$row] != $request->column_type[$row]  && $request->index[$row]!='PRIMARY'  && $t_schema=='table' && $request->old_column_name[$row]!=''){
	
		                  		//	print_r($request->old_column_type[$row]);
		                  			//print_r( $request->column_type[$row] );
		                  			
 											Schema::{$t_schema}($table_name, function (Blueprint $table) use ($request,$table_name,$t_schema,$row) {
		                							if($request->column_type[$row]=='datetime'){
		                								 $table->{$request->column_type[$row]}($request->column_name[$row])->charset(null)->collation(null)->change();
		                							}else{

		                							 $table->{$request->column_type[$row]}($request->column_name[$row])->change();
		                							}
		                						 });
		                						
		                  		}
				               
		                     
		                   
		                }
		            }
	             // $table->timestamps();
	            });
				$notification = array(
							'message' => 'Given table has been successfully created!',
							'alert-type' => 'success',
						);
	           
	       /* }*/
        	
        	

		//	dd($request->all());
		return Redirect::to('/dynamictable')->with($notification);

	}

	public function Edit($table_name , Request $request) {
	
		$types = static::getTypeCategories();	
	 	$table_column=	Schema::getColumnListing($table_name);
		//$columnType = DB::getSchemaBuilder()->getColumnType($table_name,'field_2');	
		//dd($columnType);
		return view('Admin.Usermanagement.DynamicTable.add', compact('table_column','table_name','types'));
	}



	public function GetaddedColumnData(Request $request){		
		//$types = static::getTypeCategories();	
			
		$table_column=	Schema::getColumnListing($request->table_name);

	//	$res=array('table_column'=>$table_column,'types'=>$types);
		return response()->json($table_column);
	}




	public function delete_ColumnData(Request $request){		
	
			
		$demo='';
			Schema::table($request->table_name, function (Blueprint $table) use($request,$demo){
			    $table->dropColumn($request->column_name);
			    $demo='success ';
			});

		return response()->json($demo);
	}


	public function GetColumnType(Request $request){
		//dd($request->column_name);
		$columnType = DB::getSchemaBuilder()->getColumnType($request->table_name,$request->column_name);
		 $columns2 = DB::connection()->getDoctrineColumn($request->table_name,$request->column_name)->getautoincrement();	  
		 $columns1 = DB::connection()->getDoctrineColumn($request->table_name,$request->column_name)->getName();	  
	  
	     $columns3 = DB::connection()->getDoctrineColumn($request->table_name,$request->column_name)->getDefault();
	     $columns4 = DB::connection()->getDoctrineColumn($request->table_name,$request->column_name)->getLength();
	  //  dd( $columns2 );
	     $all_data = array(
				'columnType' => $columnType,
				'Length' => $columns4,
				'Default' => $columns3,
				'autoincrement'=>$columns2
			);
//dd($all_data);
		
		return response()->json($all_data);	
	}
		
	public function getDelete($table_name) {
		try
		{
			Schema::dropIfExists($table_name);			
			$notification = array(
				'message' => 'Record Delete Successfully ',
				'alert-type' => 'success',
			);
            
			return Redirect::to('/dynamictable')->with($notification);

		} catch (\Exception $ex) {
		$notification = array(
				'message' => 'Something Went Wrong',
				'alert-type' => 'error',
			);
            return Redirect::to('/dynamictable')->with($notification);
		}

	}


	 public static function getTypeCategories()
    {
        if (static::$typeCategories) {
            return static::$typeCategories;
        }

      /*  $typeCategories = [
            'boolean',
            'tinyint',
            'smallint',
            'mediumint',
            'integer',
            'int',
            'bigint',
            'decimal',
            'numeric',
            'money',
            'float',
            'real',
            'double',
            'double precision',       
            'char',
            'character',
            'varchar',
            'character varying',
            'string',
            'guid',
            'uuid',
            'tinytext',
            'text',
            'mediumtext',
            'longtext',
            'tsquery',
            'tsvector',
            'xml',     
            'date',
            'datetime',
            'year',
            'time',
            'timetz',
            'timestamp',
            'timestamptz',
            'datetimetz',
            'dateinterval',
            'interval',        
            'enum',
            'set',
            'simple_array',
            'array',
            'json',
            'jsonb',
            'json_array',       
            'bit',
            'bit varying',
            'binary',
            'varbinary',
            'tinyblob',
            'blob',
            'mediumblob',
            'longblob',
            'bytea',      
            'cidr',
            'inet',
            'macaddr',
            'txid_snapshot',        
            'geometry',
            'point',
            'linestring',
            'polygon',
            'multipoint',
            'multilinestring',
            'multipolygon',
            'geometrycollection'];
        
*/

      $typeCategories = [
            'integer',
            'string',
            'text',         
            'date',
            'datetime',           
            'decimal',
            'double',          
            'float',
            'increments',          
            'json',
            'longText',                
            'time',  
          
          
        ];

        return $typeCategories;
    }



}
