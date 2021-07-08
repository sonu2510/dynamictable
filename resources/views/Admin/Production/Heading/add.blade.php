@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Heading </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/heading">Heading </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Heading Add</li>                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                <div class="lastmonth"></div>
                            </div>
                           
                        </div>
                    </div>                   
          
        
@endsection  
@section('content')     

<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">heading From</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/heading/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('heading_id', isset($heading_details) ? $heading_details->heading_id : '',['id'=>'heading_id']) }}
                                   
                                <div class="card-body">                                    
                                   

                                     <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Ball Diameter</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12 ball_diameter" name="ball_diameter" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Ball Diameter</option>
                                                        @foreach($ball_diameter as $ball_data)                                    
                                                       <option value="{{$ball_data->id}}" @if(isset($heading_details) && $heading_details->ball_diameter==$ball_data->id)  selected  @endif>{{$ball_data->ball_size}}</option>
                                                         @endforeach  
                                                            
                                                        </select>
                                                        @if ($errors->has('ball_diameter'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('ball_diameter') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                               
                                    </div>
                                    <input type="hidden" name="heading_batch_no" value="{{isset($heading_details) ? $heading_details->$heading_batch_no : ''}}">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Coil</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12 processed_coil" name="processed_coil_id" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Coil</option>
                                                        @foreach($processed_coil as $coil)                                    
                                                       <option value="{{$coil->id}}" @if(isset($heading_details) && $heading_details->processed_coil_id==$coil->id)  selected  @endif>{{$coil->coil_size}}</option>
                                                         @endforeach  
                                                            
                                                        </select>
                                                        @if ($errors->has('processed_coil_id'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('processed_coil_id') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Heading Date :</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="dateopen" name="heading_date" value="{{isset($heading_details) ? $heading_details->heading_date : date('Y-m-d')}}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Shift :</label>
                                                <div class="col-sm-4">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="shift_type" checked="" value='1' class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">Day</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="shift_type" value='2' class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2">Night</label>
                                        </div>
                                    </div>
                                            </div>
                                        </div>
                                    </div>                                  

                                      
                            

                                               
                                     <div class="row">  
                                     <!-- <div class="col-sm-12 col-lg-6">
                                        <h5 >Heading Batch</h5>                                         
                                            <table class="table table-dark m-b-0" id="heading_batch_no_data">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Heading Batch Number</th>  
                                                    <th scope="col">Action
                                                         @if(isset($heading_details))
                                                        <button type="button" id="add_batch_no" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif</th>                                                    
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($heading_details))
                                            <tbody id="new_batch_no">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="heading_batch_no_data{{$i}}" class="new" data-id="{{$i}}">
                                                    <td scope="row">
                                                     <input type="hidden" name="heading_batch_id[]" id="heading_batch_id ">
                                                      <input type="text" class="form-control" id="heading_batch_no_{{$i}}" name="heading_batch_no[]" required="" placeholder="Batch no ">
                                                    </td>

                                                                                                    
                                                    
                                                    <td><button type="button" id="add_batch_no" class="btn btn-info"><i class="mdi mdi-plus"></i> Add Batch No</button>
                                                    </td>
                                                </tr>

                                                                                                                                      
                                            </tbody>

                                            @else
                                            <input type="hidden" id="batch_no_td"  >
                                            <tbody id="save_batch_no">

                                            </tbody>


                                             @endif  
                                        </table>
                                    </div> -->
                                    <div class="col-sm-12 col-lg-6">

                                    <input type="hidden" id="edit_splitcoils" value="{{isset($heading_details) ? json_encode($splitcoils_data) : ''}}">
                               

                                       <div class="row"> 
                                            <h5 >Wire Dia</h5>                                          
                                            <table class="table table-dark m-b-0" id="wire_data">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Wire Dia</th>
                                                    <th scope="col">Weight</th>
                                                    <th scope="col">Action
                                                         @if(isset($heading_details))
                                                        <button type="button" id="add_wire" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif</th>                                                    
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($heading_details))
                                            <tbody id="new">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="wire_data_{{$i}}" class="new" data-id="{{$i}}">
                                                    <td scope="row"><input type="hidden" name="heading_wire_id[]" id="heading_wire_id">
                                                   
                                                    <select class="wire custom-select col-12" name="processed_coilsize_id[]" id="processed_coilsize_id_{{$i}}"  required>                                                        
                                                        </select>
                                                    </td>

                                                    <td>
                                                       <input type="text" class="form-control" id="processed_coil_weight_{{$i}}" name="processed_coil_weight[]" required="" placeholder="Coil Weight">
                                                    </td>                                                   
                                                    
                                                    <td><button type="button" id="add_wire" class="btn btn-info"><i class="mdi mdi-plus"></i> Add Wire</button>
                                                    </td>
                                                </tr>

                                                                                                                                      
                                            </tbody>

                                            @else
                                            <input type="hidden" id="coilsize"  >
                                            <tbody id="save">

                                            </tbody>


                                             @endif  
                                        </table>
                                    </div>
                                    </div>

                                 
                                    <hr>

                                    <div class="row ">
                                            <h5 >Detail Of Product Specification</h5>
                                            <table class="table table-dark m-b-0 text-center" border="1" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" colspan="2" >Equator Dia (mm)</th>    
                                                        <th scope="col" colspan="2">Pole Dia (mm)</th>                  
                                                        <th scope="col">Offset Max.  in (Micron)</th>        
                                                        <th scope="col" colspan="2">Weight of 100 Balls In gram</th>  
                                                        <th scope="col" colspan="2" >Number of balls / KG</th>                                                        
                                                      
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td>Equator Dia (mm)</td>
                                                        <td>Equator Tolerance are in (Micron)</td>
                                                        <td>Pole Dia (mm)</td>
                                                        <td>Pole Tolerance are in (Micron)</td>
                                                        <td></td>
                                                        <td>Minimum</td>
                                                        <td>Maximum</td>
                                                        <td>Minimum</td>
                                                        <td>Maximum</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="hs_equator_dia"   placeholder="Equator Dia" name="hs_equator_dia"  value="{{isset($heading_details) ? $heading_details->hs_equator_dia : ''}}"></td>

                                                        <td><input type="text" class="form-control" id="hs_equator_tolerance"  placeholder="Equator Tolerance are in (Micron)" name="hs_equator_tolerance"  value="{{isset($heading_details) ? $heading_details->hs_equator_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" id="hs_pole_dimension"  placeholder="Pole Dimension"   name="hs_pole_dimension" value="{{isset($heading_details) ? $heading_details->hs_pole_dimension : ''}}"></td>

                                                          <td><input type="text" class="form-control" id="hs_pole_tolerance"  placeholder="Pole Tolerance are in (Micron)"   name="hs_pole_tolerance" value="{{isset($heading_details) ? $heading_details->hs_pole_tolerance : ''}}"></td>

                                                        <td><input type="text" class="form-control" id="hs_offset" placeholder="Offset Max.  in (Micron)"  name="hs_offset"   value="{{isset($heading_details) ? $heading_details->hs_offset : ''}}" ></td>                                                    
                                                        <td><input type="text" class="form-control" id="hs_weight_min" placeholder="Weight of 100 Balls In gram (MIN)" name="hs_weight_min"   value="{{isset($heading_details) ? $heading_details->hs_weight_min : ''}}" ></td>

                                                         <td><input type="text" class="form-control" id="hs_weight_max"  placeholder="Weight of 100 Balls In gram (MAX)" name="hs_weight_max"   value="{{isset($heading_details) ? $heading_details->hs_weight_max : ''}}" ></td>                                                    
                                                        <td><input type="text" class="form-control" id="hs_total_balls_min" placeholder="Number of balls / KG (MIN)" name="hs_total_balls_min"  value="{{isset($heading_details) ? $heading_details->hs_total_balls_min : ''}}" ></td>

                                                        <td><input type="text" class="form-control" id="hs_total_balls_max" placeholder="Number of balls / KG (MAX)" name="hs_total_balls_max"  value="{{isset($heading_details) ? $heading_details->hs_total_balls_max : ''}}" ></td>
                                                    </tr>
                                                </tbody>
                                            </table>      
                                    </div>
                                    <br>
                                 

                                    <br>
                                     

                                         <div class="row">
                                            <h5>Heading Observation</h5>
                                            <table class="table table-dark m-b-0" id="observation_data">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Machine</th>
                                                    <th scope="col">Operator</th>
                                                    <th scope="col">Eqautor</th>
                                                    <th scope="col">Pole dimension</th>
                                                    <th scope="col">Off Set</th>
                                                    <th scope="col">Surface</th>                                                    
                                                    <th scope="col">Action 
                                                        @if(isset($heading_details))
                                                        <button type="button" id="add_observation" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif
                                                    </th>
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($heading_details))
                                            <tbody id="new">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="obs_data_{{$i}}" class="new" data-id="{{$i}}">
                                                    <td scope="row"><input type="hidden" name="" id="obs_no" value="{{$i}}"><input type="hidden" name="heading_observation_id[]" id="heading_observation_id ">
                                                   
                                                    <input type="time" class="form-control" required="" id="observation_time_{{$i}}" name="observation_time[]" >
                                                    </td>

                                                    <td>
                                                       <select class="custom-select col-12" name="machine_id[]" id="machine_id_{{$i}}"  required> 
                                                        <option value="">Select Machine</option>
                                                        @foreach($heading_machine as $machine)                                    
                                                       <option value="{{$machine->machine_type_id}}">{{$machine->machine_name}}</option>
                                                         @endforeach 
                                                            
                                                        </select>
                                                    </td>

                                                    <td>
                                                       <select class="custom-select col-12" name="operator_id[]" id="operator_id_{{$i}}"  required> 
                                                        <option value="">Select Operator</option>
                                                        @foreach($heading_operator as $operator)                                    
                                                       <option value="{{$operator->id}}">{{$operator->name}}</option>
                                                         @endforeach 
                                                            
                                                        </select>
                                                    </td>

                                                    <td> <input type="text" class="form-control" id="eqautor_{{$i}}" name="eqautor[]" required="" placeholder="eqautor">
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="pole_dimension_{{$i}}" name="pole_dimension[]" required="" placeholder="Pole Dimension">
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="offset_{{$i}}" name="offset[]" required="" placeholder="Off Set">
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="surface_{{$i}}" name="surface[]" required="" placeholder="Surface">
                                                    </td>
                                                    
                                                    <td><button type="button" id="add_observation" class="btn btn-info"><i class="mdi mdi-plus"></i> ADD</button>
                                                    </td>
                                                </tr>

                                                                                                                                      
                                            </tbody>

                                            @else
                                             <input type="hidden" id="machine"  >
                                              <input type="hidden" id="operator"  >
                                            <tbody id="save">

                                            </tbody>


                                             @endif  
                                        </table>
                                    </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Total Balls </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="total_balls" placeholder="Total Balls" required="" value="{{isset($heading_details) ? $heading_details->total_balls : ''}}">
                                                     @if ($errors->has('total_balls'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('total_balls') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                           
                                        </div>
                                    </div>
                                
                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Weight Per 100 Balls </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="weight_per_100" placeholder="Weight Per 100 Balls" required="" value="{{isset($heading_details) ? $heading_details->weight_per_100 : ''}}">
                                                     @if ($errors->has('weight_per_100'))
                                                            <span class="weight_per_100-block" style="color: red;">
                                                                    <strong>{{ $errors->first('weight_per_100') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">HCL Etching </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="hcl_etching" placeholder="HCL Etching" required="" value="{{isset($heading_details) ? $heading_details->hcl_etching : ''}}">
                                                     @if ($errors->has('hcl_etching'))
                                                            <span class="help-hcl_etching" style="color: red;">
                                                                    <strong>{{ $errors->first('hcl_etching') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>                                                           
                                   

                                    <div class="row col-sm-12">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                                    <option value="1" @if(isset($heading_details) && $heading_details->status==1)  selected  @endif>Active</option>
                                                    <option value="0" @if(isset($heading_details) && $heading_details->status==0)  selected  @endif>Inactive</option>
                                                    
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               
                                            </div>
                                        </div>
                                    </div>


                                </div>    


                                <div class="card-body">
                                    <div class="form-group m-b-0 text-center">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                        <a type="" href="{{ URL::previous() }}" class="btn btn-dark waves-effect waves-light">Cancel</a>
                                    </div>
                                </div>
                            </form>
                                 
                            </div>
                        </div>
                    </div>
                </div>
@endsection        
@section('footer_scripts')
<script type="text/javascript">
    $(function() {    
      //$('#dateopen').datepicker('setDate', '23/04/2014');
    });

$(document).on('change','.ball_diameter',function(){
    var ball_size=$(this).val();
    //alert('ASD');
    if(ball_size != ''){
      
         $.ajax({
              url: '/getBallSpecification/ajax/',
              type: "get",
              data:{ball_size:ball_size},
              dataType:"json",
              success:function(res) {
                if(res){
                    $("#hs_equator_dia").val(res.hs_equator_dia);
                    $("#hs_equator_tolerance").val(res.hs_equator_tolerance);
                    $("#hs_pole_dimension").val(res.hs_pole_dimension);
                    $("#hs_pole_tolerance").val(res.hs_pole_tolerance);
                    $("#hs_offset").val(res.hs_offset);
                    $("#hs_weight_min").val(res.hs_weight_min);
                    $("#hs_weight_max").val(res.hs_weight_max);
                    $("#hs_total_balls_min").val(res.hs_total_balls_min);
                    $("#hs_total_balls_max").val(res.hs_total_balls_max);
                }  
              }

          })
     }
});


 $(document).on('click','#add_observation',function(){
   var obs_n_val=$('#observation_data tbody tr.new').length;
   var obs_no_val=parseInt($('#observation_data tbody tr:last').attr("data-id"));
   //alert($('#coil_data tbody tr.new').length);
   //alert(coil_nval);
   var obs_no=obs_no_val+1;
   var html='<tr id="obs_data_'+obs_no+'" class="new" data-id="'+obs_no+'">'
             +'<td scope="row">'
             +'<input type="hidden" name="heading_observation_id[]" id="heading_observation_id_'+obs_no+' ">'
            
             +'<input type="time" class="form-control" required="" id="observation_time_'+obs_no+'" name="observation_time[]" ></td>'

             +'<td>'
               +'<select class="custom-select col-12" name="machine_id[]" id="machine_id_'+obs_no+'"  required>' 
                +'<option value="">Select Machine</option>'
                @foreach($heading_machine as $machine)                                    
               +'<option value="{{$machine->machine_type_id }}">{{$machine->machine_name}}</option>'
                 @endforeach 
                +'</select>'
            +'</td>'

            +'<td>'
               +'<select class="custom-select col-12" name="operator_id[]" id="operator_id_'+obs_no+'"  required>' 
                +'<option value="">Select Operator</option>'
                @foreach($heading_operator as $operator)                                    
               +'<option value="{{$operator->id}}">{{$operator->name}}</option>'
                 @endforeach 
                +'</select>'
            +'</td>'

            +'<td> <input type="text" class="form-control" id="eqautor_'+obs_no+'" name="eqautor[]" required="" placeholder="eqautor">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="pole_dimension_'+obs_no+'" name="pole_dimension[]" required="" placeholder="Pole Dimension">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="offset_'+obs_no+'" name="offset[]" required="" placeholder="Off Set">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="surface_'+obs_no+'" name="surface[]" required="" placeholder="Surface">'
            +'</td>'

               +'<td><button type="button" id="remove_obs" value="'+obs_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
               //alert(html);
     if($('#heading_id').val() == ''){
        $("#observation_data tbody#new").append(html);
     }else{
        $("#observation_data tbody#save").append(html);
     }          
    
 })   

 $(document).on('click','#remove_obs',function(){
   var tr_id=($(this).val());
   $('table#observation_data tr#obs_data_'+tr_id+'').remove();   
 })  

  $(document).on('click','#remove_wire',function(){
   var tr_id=($(this).val());
   $('table#wire_data tr#wire_data_'+tr_id+'').remove();   
 })  
 
 $(document).on('click','#remove_batch',function(){
   var tr_id=($(this).val());
   $('table#heading_batch_no_data tr#heading_batch_no_data_'+tr_id+'').remove();   
 })  





$(document).ready(function(){
    //alert("index");
    var heading_id=$('#heading_id').val();
    if(heading_id != ''){       
        $.ajax({
              url: '/HeadingObservationData/ajax/',
              type: "get",
              data:{heading_id:heading_id},
              dataType:"json",
              success:function(res) {

                    if(res != ''){
                    var html='';
                    var incr=1;
                    $('#machine').val(res.machinedata);
                    $('#operator').val(res.operatordata);
                        $.each(res.headingobs_details, function(key, value) 
                        {
                            //alert(res.length);
                                  var sel1,sel2=''; 
                        html+='<tr id="obs_data_'+incr+'" class="new" data-id="'+incr+'">'
                                 +'<td scope="row">'
                                 +'<input type="hidden" name="heading_observation_id[]" value="'+value.heading_observation_id+'"  id="heading_observation_id_'+incr+' ">'
                                
                                 +'<input type="time" class="form-control" required="" value="'+value.observation_time+'"  id="observation_time_'+incr+'" name="observation_time[]" ></td>'

                                 +'<td>'
                                   +'<select class="custom-select col-12" name="machine_id[]"  id="machine_id_'+incr+'"  required>' 
                                    +'<option value="">Select Machine</option>';
                                    @foreach($heading_machine as $machine) 
                                    if(value.machine_id == {{$machine->machine_type_id}}){
                                        var sel1='selected';
                                    }                                     
                            html+='<option value="{{$machine->machine_type_id }}" '+sel1+' >{{$machine->machine_name}}</option>'
                                     @endforeach 
                                    +'</select>'
                                +'</td>'

                                +'<td>'
                                   +'<select class="custom-select col-12" name="operator_id[]" id="operator_id_'+incr+'"  required>' 
                                    +'<option value="">Select Operator</option>';
                                    @foreach($heading_operator as $operator)
                                     if(value.operator_id == {{$operator->id}}){
                                        var sel2='selected';
                                    }                                
                             html+='<option value="{{$operator->id}}"  '+sel2+' >{{$operator->name}}</option>'
                                     @endforeach 
                                    +'</select>'
                                +'</td>'

                                +'<td> <input type="text" class="form-control" value="'+value.eqautor+'"  id="eqautor_'+incr+'" name="eqautor[]" required="" placeholder="eqautor">'
                                +'</td>'
                                +'<td> <input type="text" class="form-control" value="'+value.pole_dimension+'"  id="pole_dimension_'+incr+'" name="pole_dimension[]" required="" placeholder="Pole Dimension">'
                                +'</td>'
                                +'<td> <input type="text" class="form-control" value="'+value.offset+'"  id="offset_'+incr+'" name="offset[]" required="" placeholder="Off Set">'
                                +'</td>'
                                +'<td> <input type="text" class="form-control" value="'+value.surface+'"  id="surface_'+incr+'" name="surface[]" required="" placeholder="Surface">'
                                +'</td>'

                                   +'<td><button type="button" id="delete_obs" value="'+incr+'" data-id="'+value.heading_observation_id+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';
                                    incr++;

                        });
                       // alert(html);
                      $("#observation_data tbody#save").append(html);  
                    }

                    }
            })

            $.ajax({
                  url: '/HeadingWireData/ajax/',
                  type: "get",
                  data:{heading_id:heading_id},
                  dataType:"json",
                  success:function(res) {
                       console.log(res);
                        if(res != ''){
                        var html='';
                        var incr1=1;
                        $('#coilsize').val(res.coildata);
                            $.each(res.headingwire_details, function(key, value) 
                            {
                                //alert(res.length);
                        
                            html+='<tr id="wire_data_'+incr1+'" class="new" data-id="'+incr1+'">'
                                 +'<td scope="row">'
                                 +'<input type="hidden" name="heading_wire_id[]" id="heading_wire_id_'+incr1+' " value="'+value.heading_wire_id+'">'
                                +'<input type="hidden"  id="processed_coilsize_'+incr1+' " value="'+value.processed_coilsize_id+'">'
                                
                                +'<select class="wire custom-select col-12"  name="processed_coilsize_id[]" id="processed_coilsize_id_'+incr1+'"  required>' 
                                    
                                    +'</select>'
                                +'</td>'

                                +'<td>'
                                   +'<input type="text" class="form-control" id="processed_coil_weight_'+incr1+'" name="processed_coil_weight[]" required="" value="'+value.processed_coil_weight+'" placeholder="Coil Weight">'
                                +'</td>'    
                               
                                   +'<td><button type="button" id="delete_wire" value="'+incr1+'" data-id="'+value.heading_wire_id+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';                                       
                                      

                                        incr1++;

                                 
                                 
                                 
                                $('.processed_coil').change(); 
                               // getSelectedCoils();
                            });                            

                            //alert(html);
                          $("#wire_data tbody#save").append(html); 
                           
                          
                          //$('#processed_coilsize_id_'+incr1).val($('#coilsize_'+incr1).val()).change()
                        }

                        }
                })     

                 $.ajax({
                  url: '/HeadingBatchData/ajax/',
                  type: "get",
                  data:{heading_id:heading_id},
                  dataType:"json",
                  success:function(res) {
                       console.log(res);
                        if(res != ''){
                        var html='';
                        var incr1=1;                     
                            $.each(res, function(key, value) 
                            {
                                //alert(res.length);
                        
                            html+='<tr id="heading_batch_no_data_'+incr1+'" class="new" data-id="'+incr1+'">'
                                 +'<td scope="row">'
                                 +'<input type="hidden" name="heading_batch_id[]" id="heading_batch_id'+incr1+' " value="'+value.heading_batch_id+'">'                                
                                 +'<input type="text" class="form-control" id="processed_coil_weight_'+incr1+'" name="heading_batch_no[]" required="" value="'+value.heading_batch_no+'" placeholder="Coil Weight">'
                                +'</td>'

                           
                               
                                   +'<td><button type="button" id="delete_batch" value="'+incr1+'" data-id="'+value.heading_batch_id+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';                                       
                                      

                                        incr1++;

                                 
                                 
                                 
                            
                            });                            

                            //alert(html);
                          $("#heading_batch_no_data tbody#save_batch_no").append(html); 
                           //getSelectedCoils();
                          
                          //$('#processed_coilsize_id_'+incr1).val($('#coilsize_'+incr1).val()).change()
                        }

                        }
                })

    }
    
}) 

$(document).on('click','#delete_wire',function(){
    var tr_id=($(this).val());
    var heading_wire_id=$(this).attr('data-id');
    var heading_id=$('#heading_id').val();
    //alert(heading_wire_id);
    if(heading_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_headingwire/ajax/',
              type: "get",
              data:{heading_wire_id:heading_wire_id},
              dataType:"json",
              success:function(res) {
                $('table#wire_data tr#wire_data_'+tr_id+'').remove();   
              }

          })
        }
    }
});
$(document).on('click','#delete_batch',function(){
    var tr_id=($(this).val());
    var heading_batch_id=$(this).attr('data-id');
    var heading_id=$('#heading_id').val();
    //alert(heading_wire_id);
    if(heading_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_headingbatch/ajax/',
              type: "get",
              data:{heading_batch_id:heading_batch_id},
              dataType:"json",
              success:function(res) {
                $('table#heading_batch_no_data tr#heading_batch_no_data_'+tr_id+'').remove();   
              }

          })
        }
    }
});
$(document).on('click','#delete_obs',function(){
    var tr_id=($(this).val());
    var heading_observation_id=$(this).attr('data-id');
    var heading_id=$('#heading_id').val();
    if(heading_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_headingobservation/ajax/',
              type: "get",
              data:{heading_observation_id:heading_observation_id},
              dataType:"json",
              success:function(res) {
                $('table#observation_data tr#obs_data_'+tr_id+'').remove();  
              }

          })
     }
 }
});


$(document).on('change','.processed_coil',function(){


// var wire_no_val=parseInt($('#wire_data tbody tr:last').attr("data-id");

var processed_coil_id=$(this).val();
//alert(processed_coil_id);
var heading_id=$('#heading_id').val();
var edit=0;
        if(heading_id != ''){
            var edit=1;
        }
                           
         $.ajax({
                  url: '/getSplitcoils/ajax/',
                  type: "get",
                  data:{processed_coil_id:processed_coil_id,edit:edit},
                  dataType:"json",
                  success:function(res) {
                   // alert(res);
                   //console.log();
                    $('#edit_splitcoils').val(JSON.stringify(res));
                    $('.wire').empty();                
                    if(res.length > 0){                       
                        $('.wire').append('<option value="">Select Wire</option>');
                        $.each((res), function(key, value) 
                        {                 
                            $('.wire').append('<option value="'+value.id+'"  >'+value.coil_name+'</option>');
                        });
                    }
                    getSelectedCoils();
                  }

              })
       
     

});

$(document).on('click','#add_wire',function(){   
   var wire_no_val=parseInt($('#wire_data tbody tr:last').attr("data-id"));
   //alert($('#coil_data tbody tr.new').length);
   //alert(coil_nval);
   var wire_no=wire_no_val+1;
   var html='<tr id="wire_data_'+wire_no+'" class="new" data-id="'+wire_no+'">'
             +'<td scope="row">'
             +'<input type="hidden" name="heading_wire_id[]" id="heading_wire_id_'+wire_no+' ">'
            
            +'<select class="wire custom-select col-12" name="processed_coilsize_id[]" id="processed_coilsize_id_'+wire_no+'"  required>' 
                
                +'</select>'
            +'</td>'

            +'<td>'
               +'<input type="text" class="form-control" id="processed_coil_weight_'+wire_no+'" name="processed_coil_weight[]" required="" placeholder="Coil Weight">'
            +'</td>'    
           
               +'<td><button type="button" id="remove_wire" value="'+wire_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
               //alert(html);
     if($('#heading_id').val() == ''){
        $("#wire_data tbody#new").append(html);
     }else{
        $("#wire_data tbody#save").append(html);
     }  
     coilchange(wire_no);   
     //$('.processed_coil').change();     
    
 }) 
$(document).on('click','#add_batch_no',function(){   
   var b_no_val=parseInt($('#heading_batch_no_data tbody tr:last').attr("data-id"));

   var b_no=b_no_val+1;
   var html='<tr id="heading_batch_no_data_'+b_no+'" class="new" data-id="'+b_no+'">'
             +'<td scope="row">'
             +'<input type="hidden" name="heading_batch_id[]" id="heading_batch_id'+b_no+' ">'            
             +'<input type="text" class="form-control" id="heading_batch_no_'+b_no+'" name="heading_batch_no[]" required="" placeholder="Batch No">'
            +'</td>'

           
               +'<td><button type="button" id="remove_batch" value="'+b_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
               //alert(html);
     if($('#heading_id').val() == ''){
        $("#heading_batch_no_data tbody#new_batch_no").append(html);
     }else{
        $("#heading_batch_no_data tbody#save_batch_no").append(html);
     }  
   
     //$('.processed_coil').change();     
    
 }) 

function getSelectedCoils() {
    var total=0;
    var coil=1;
    var heading_id=$('#heading_id').val();
 //   alert('wegyqher');
        if(heading_id != ''){
         var coils=$('#coilsize').val();
         var coilvals=coils.split(',');
         for(var i=0;i<coilvals.length;i++){
                $('#processed_coilsize_id_'+coil).val(coilvals[total]);               
                total++;
                coil++;
            }
        }
        
}

 /*var intrval=setInterval(function () {
        getSelectedCoils();
        clearInterval(intrval);
    },5000);*/

 function coilchange(num){
        var processed_coil_id=$('.processed_coil').val();
        var heading_id=$('#heading_id').val();
        var edit=0;
                if(heading_id != ''){
                    var edit=2;
                }
       //alert(arr); 
       $.ajax({
                  url: '/getSplitcoils/ajax/',
                  type: "get",
                  data:{processed_coil_id:processed_coil_id,edit:edit},
                  dataType:"json",
                  success:function(res) {
                    //alert(res);
                   //console.log();
                    $('#edit_splitcoils').val(JSON.stringify(res));
                    $('#processed_coilsize_id_'+num+' ').empty();                
                    if(res.length > 0){
                        $('#processed_coilsize_id_'+num+' ').append('<option value="">Select Wire</option>');
                        $.each((res), function(key, value) 
                        {                 
                            $('#processed_coilsize_id_'+num+' ').append('<option value="'+value.id+'"  >'+value.coil_name+'</option>');
                        });
                    }
                  }

              })          
                    
         }            


 
$(".select2").select2();

</script>
@endsection         