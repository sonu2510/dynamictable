@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Grinding </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/grinding">Grinding </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Grinding Add</li>                                    
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
                                <h4 class="card-title">Grinding From</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/grinding/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('grinding_id', isset($grinding_details) ? $grinding_details->grinding_id : '',['id'=>'grinding_id']) }}
                                   
                                <div class="card-body">                                    
                                   
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Ball Diameter</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12 ball_diameter" name="ball_diameter" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Ball Diameter</option>
                                                        @foreach($ball_diameter as $ball_data)                                    
                                                       <option value="{{$ball_data->id}}" @if(isset($grinding_details) && $grinding_details->ball_diameter==$ball_data->id)  selected  @endif>{{$ball_data->ball_size}}</option>
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
                                        <div class="col-sm-12 col-lg-6">
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">                                               
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Master Batch </label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12 batch_id" name="batch_id[]" id="inlineFormCustomSelect" multiple="multiple" required> 
                                                        <option value="">Select Master Batch Number</option>
                                                        @foreach($masterbatchdata as $batch_data)                                    
                                                       <option value="{{$batch_data->batch_id}}" @if(isset($grinding_details) && $grinding_details->batch_id==$batch_data->batch_id)  selected  @endif>{{$batch_data->master_batch_no}}</option>
                                                         @endforeach  
                                                            
                                                     </select>                                                   
                                                     @if ($errors->has('batch_id'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('batch_id') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>                                           
                                            </div>
                                        </div>
                                       <!--  <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">                                               
                                               <label for="fname2" class="col-sm-6 text-right control-label col-form-label">grinding Batch Number </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="fname2" name="grinding_batch_no" placeholder="grinding Batch Number" required="" value="{{isset($grinding_details) ? $grinding_details->grinding_batch_no : ''}}">
                                                     @if ($errors->has('grinding_batch_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('grinding_batch_no') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>                                           
                                            </div>
                                        </div> -->
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">grinding Date </label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="dateopen" name="grinding_date" value="{{isset($grinding_details) ? $grinding_details->grinding_date : date('Y-m-d')}}"> 
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

                                
                                    <input type="hidden" id="batchvalues" value="{{isset($grinding_details) ? $grinding_details->batch_id : ''}}">
                                                                                              
                                     
                         
                                    <br>
                                    <hr>

                                    <div class="row text-center">
                                            <h5 >Product Specification For grinding</h5>
                                            <table class="table table-dark m-b-0" id="coil_data">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Unloading Gauge</th>
                                                    <th scope="col">Ball Dia Variation</th>
                                                    <th scope="col">Load Dia Variation</th> 
                                                    <th scope="col">Surface</th>        
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                 <tr>
                                                        <td><input type="text" id="gs_unloading_gauge" class="form-control"  placeholder="Unloading Gauge" name="gs_unloading_gauge"  value="{{isset($grinding_details) ? $grinding_details->gs_unloading_gauge : ''}}"></td>                                                    
                                                        <td><input type="text" id="gs_tolerance" class="form-control" placeholder="Tolarance (µm)"   name="gs_tolerance" value="{{isset($grinding_details) ? $grinding_details->gs_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" id="gs_ovality" class="form-control" placeholder="OVALITY / O.D. VERY. MAX. (µm)"  name="gs_ovality"   value="{{isset($grinding_details) ? $grinding_details->gs_ovality : ''}}" ></td>                                                   
                                                                                                            
                                                        <td><input type="text" id="gs_lot_variation" class="form-control" placeholder="LOT Variation (µm)" name="gs_lot_variation"  value="{{isset($grinding_details) ? $grinding_details->gs_lot_variation : ''}}" ></td>   
                                                        
                                                                                                           
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <hr>


                                     

                                         <div class="row table-responsive">
                                            <h5>grinding Observation</h5>
                                            <table class="table table-dark m-b-0" id="observation_data">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Loading Date/Time</th>
                                                    <th scope="col">Unloading Date/Time</th>             
                                                    <th scope="col">Machine</th>
                                                    <th scope="col">Operator</th>
                                                    <th scope="col">Unloading Gauge</th>
                                                    <th scope="col">Ball Dia Varation</th>
                                                    <th scope="col">Load Dia Variation</th>
                                                    <th scope="col">Surface</th>                                                    
                                                    <th scope="col">Action 
                                                        @if(isset($grinding_details))
                                                        <button type="button" id="add_observation" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif
                                                    </th>
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($grinding_details))
                                            <tbody id="new">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="obs_data_{{$i}}" class="new" data-id="{{$i}}">
                                                    <td scope="row"><input type="hidden" name="" id="obs_no" value="{{$i}}"><input type="hidden" name="grinding_observation_id[]" id="grinding_observation_id ">
                                                   
                                                    <input type="date" class="form-control" required="" id="loading_date_{{$i}}" name="loading_date[]" value="{{date('Y-m-d')}}" ><br>
                                                    <input type="time" class="form-control" required="" id="loading_time_{{$i}}" name="loading_time[]" >
                                                    </td>

                                                    <td>
                                                    <input type="date" class="form-control" required="" id="unloading_date_{{$i}}" name="unloading_date[]" value="{{date('Y-m-d')}}" ><br>
                                                    <input type="time" class="form-control" required="" id="unloading_time_{{$i}}" name="unloading_time[]" >
                                                    </td>

                                                    <td>
                                                       <select class="custom-select col-12" name="machine_id[]" id="machine_id_{{$i}}"  required> 
                                                        <option value="">Select Machine</option>
                                                        @foreach($grinding_machine as $machine)                                    
                                                       <option value="{{$machine->machine_type_id }}">{{$machine->machine_name}}</option>
                                                         @endforeach 
                                                            
                                                        </select>
                                                    </td>

                                                    <td>
                                                       <select class="custom-select col-12" name="operator_id[]" id="operator_id_{{$i}}"  required> 
                                                        <option value="">Select Operator</option>
                                                        @foreach($grinding_operator as $operator)                                    
                                                       <option value="{{$operator->id}}">{{$operator->name}}</option>
                                                         @endforeach 
                                                            
                                                        </select>
                                                    </td>

                                                    <td> <input type="text" class="form-control" id="unloading_gauge_{{$i}}" name="unloading_gauge[]" required="" placeholder="Unloading Gauge">
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="ball_dia_variation_{{$i}}" name="ball_dia_variation[]" required="" placeholder="ball dia variation">
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="load_dia_variation_{{$i}}" name="load_dia_variation[]" required="" placeholder="load dia variation">
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="surface_{{$i}}" name="surface[]" required="" placeholder="Surface">
                                                    </td>
                                                    
                                                    <td><button type="button" id="add_observation" class="btn btn-info"><i class="mdi mdi-plus"></i> ADD</button>
                                                    </td>
                                                </tr>

                                                                                                                                      
                                            </tbody>

                                            @else                                            
                                            <tbody id="save">

                                            </tbody>


                                             @endif  
                                        </table>
                                    </div>
                                    <br>
                                    <hr>                                  
                                  


                                    <div class="row col-sm-12">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                                    <option value="1" @if(isset($grinding_details) && $grinding_details->status==1)  selected  @endif>Active</option>
                                                    <option value="0" @if(isset($grinding_details) && $grinding_details->status==0)  selected  @endif>Inactive</option>
                                                    
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

 $(document).on('click','#add_observation',function(){
   var obs_n_val=$('#observation_data tbody tr.new').length;
   var obs_no_val=parseInt($('#observation_data tbody tr:last').attr("data-id"));
   //alert($('#coil_data tbody tr.new').length);
   //alert(coil_nval);
   var obs_no=obs_no_val+1;
   var html='<tr id="obs_data_'+obs_no+'" class="new" data-id="'+obs_no+'">'
             +'<td scope="row">'
             +'<input type="hidden" name="grinding_observation_id[]" id="grinding_observation_id_'+obs_no+' ">'
            
             +'<input type="date" class="form-control" value="{{date('Y-m-d')}}" required="" id="loading_date_'+obs_no+'" name="loading_date[]" ><br>'
             +'<input type="time" class="form-control" required="" id="loading_time_'+obs_no+'" name="loading_time[]" ></td>'

             +'<td>'
             +'<input type="date" class="form-control" value="{{date('Y-m-d')}}" required="" id="unloading_date_'+obs_no+'" name="unloading_date[]" ><br>'
             +'<input type="time" class="form-control" required="" id="unloading_time_'+obs_no+'" name="unloading_time[]" >'
             +'</td>'
             +'<td>'
               +'<select class="custom-select col-12" name="machine_id[]" id="machine_id_'+obs_no+'"  required>' 
                +'<option value="">Select Machine</option>'
                @foreach($grinding_machine as $machine)                                    
               +'<option value="{{$machine->machine_type_id }}">{{$machine->machine_name}}</option>'
                 @endforeach 
                +'</select>'
            +'</td>'

            +'<td>'
               +'<select class="custom-select col-12" name="operator_id[]" id="operator_id_'+obs_no+'"  required>' 
                +'<option value="">Select Operator</option>'
                @foreach($grinding_operator as $operator)                                    
               +'<option value="{{$operator->id}}">{{$operator->name}}</option>'
                 @endforeach 
                +'</select>'
            +'</td>'

            +'<td> <input type="text" class="form-control" id="unloading_gauge_'+obs_no+'" name="unloading_gauge[]" required="" placeholder="unloading gauge">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="ball_dia_variation_'+obs_no+'" name="ball_dia_variation[]" required="" placeholder="ball dia variation">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="load_dia_variation_'+obs_no+'" name="load_dia_variation[]" required="" placeholder="load dia variation">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="surface_'+obs_no+'" name="surface[]" required="" placeholder="Surface">'
            +'</td>'

               +'<td><button type="button" id="remove_obs" value="'+obs_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
               //alert(html);
     if($('#grinding_id').val() == ''){
        $("#observation_data tbody#new").append(html);
     }else{
        $("#observation_data tbody#save").append(html);
     }          
    
 })   

 $(document).on('click','#remove_obs',function(){
   var tr_id=($(this).val());
   $('table#observation_data tr#obs_data_'+tr_id+'').remove();   
 })  

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
                    $("#gs_unloading_gauge").val(res.gs_unloading_gauge);
                    $("#gs_tolerance").val(res.gs_tolerance);
                    $("#gs_ovality").val(res.gs_ovality);
                    $("#gs_lot_variation").val(res.gs_lot_variation);
                }  
              }

          })
     }
});

$(document).on('change','.ball_diameter',function(){
    var ball_size=$(this).val();
    //alert('ASD');
    if(ball_size != ''){
      
         $.ajax({
              url: '/getBallMasterData/ajax/',
              type: "get",
              data:{ball_size:ball_size},
              dataType:"json",
              success:function(res) {
                if(res){
                 $('.batch_id').empty().trigger("change"); 
                 $('.batch_id').append('<option value="">Master No.</option>');         
                 $.each(res, function(key, value) 
                        {
                            $('.batch_id').append('<option value="'+value.batch_id +'">'+value.master_batch_no+'</option>');
                        });
                }  
              }

          })
     }
});

$(document).ready(function(){
    //alert("index");
    var grinding_id=$('#grinding_id').val();
    if(grinding_id != ''){       
        $.ajax({
              url: '/grindingObservationData/ajax/',
              type: "get",
              data:{grinding_id:grinding_id},
              dataType:"json",
              success:function(res) {

                    if(res != ''){
                    var html='';
                    var incr=1;
                    $.each(res, function(key, value) 
                        {
                            //alert(res.length);
                                  var sel1,sel2=''; 
                        html+='<tr id="obs_data_'+incr+'" class="new" data-id="'+incr+'">'
                                 +'<td scope="row">'
                                 +'<input type="hidden" name="grinding_observation_id[]" value="'+value.grinding_observation_id+'"  id="grinding_observation_id_'+incr+' ">'

                                 +'<input type="date" class="form-control" required="" value="'+value.loading_date+'"  id="loading_date_'+incr+'" name="loading_date[]" ><br>'
                                
                                 +'<input type="time" class="form-control" required="" value="'+value.loading_time+'"  id="loading_time_'+incr+'" name="loading_time[]" ></td>'

                                 +'<td>'

                                 +'<input type="date" class="form-control" required="" value="'+value.unloading_date+'"  id="unloading_date_'+incr+'" name="unloading_date[]" ><br>'
                                
                                 +'<input type="time" class="form-control" required="" value="'+value.unloading_time+'"  id="unloading_time_'+incr+'" name="unloading_time[]" ></td>'

                                 +'<td>'
                                   +'<select class="custom-select col-12" name="machine_id[]"  id="machine_id_'+incr+'"  required>' 
                                    +'<option value="">Select Machine</option>';
                                    @foreach($grinding_machine as $machine) 
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
                                    @foreach($grinding_operator as $operator)
                                     if(value.operator_id == {{$operator->id}}){
                                        var sel2='selected';
                                    }                                
                             html+='<option value="{{$operator->id}}"  '+sel2+' >{{$operator->name}}</option>'
                                     @endforeach 
                                    +'</select>'
                                +'</td>'

                                +'<td> <input type="text" class="form-control" value="'+value.unloading_gauge+'"  id="unloading_gauge_'+incr+'" name="unloading_gauge[]" required="" placeholder="unloading gauge">'
                                +'</td>'
                                +'<td> <input type="text" class="form-control" value="'+value.ball_dia_variation+'"  id="ball_dia_variation_'+incr+'" name="ball_dia_variation[]" required="" placeholder="ball dia variation">'
                                +'</td>'
                                +'<td> <input type="text" class="form-control" value="'+value.load_dia_variation+'"  id="load_dia_variation_'+incr+'" name="load_dia_variation[]" required="" placeholder="load dia variation">'
                                +'</td>'
                                +'<td> <input type="text" class="form-control" value="'+value.surface+'"  id="surface_'+incr+'" name="surface[]" required="" placeholder="Surface">'
                                +'</td>'

                                   +'<td><button type="button" id="delete_obs" value="'+incr+'" data-id="'+value.grinding_observation_id+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';
                                    incr++;

                        });
                       // alert(html);
                      $("#observation_data tbody#save").append(html);  
                    }

                    }
            })          

    }
    
}) 


$(document).on('click','#delete_obs',function(){
    var tr_id=($(this).val());
    var grinding_observation_id=$(this).attr('data-id');
    var grinding_id=$('#grinding_id').val();
    if(grinding_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_grindingobservation/ajax/',
              type: "get",
              data:{grinding_observation_id:grinding_observation_id},
              dataType:"json",
              success:function(res) {
                $('table#observation_data tr#obs_data_'+tr_id+'').remove();  
              }

          })
     }
 }
});


$(document).ready(function(){   
var grinding_id=$('#grinding_id').val();     
                if(grinding_id != ''){
                 //var headingvalues = [];
                 var batchvalues=$("#batchvalues").val();
                 $('.batch_id').val(batchvalues.split(','));
                 $('.batch_id').change(); 
                 }  
              /*  }else{
                  $(".flashing_id").select2();
                }*/
}); 

$(".batch_id").select2();

</script>
@endsection         