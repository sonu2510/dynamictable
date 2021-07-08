@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Flashing </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/flashing">Flashing </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Flashing Add</li>                                    
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
                                <h4 class="card-title">Flashing From</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/flashing/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('flashing_id', isset($flashing_details) ? $flashing_details->flashing_id : '',['id'=>'flashing_id']) }}
                                   
                                <div class="card-body">                                    
                                   
                                   
                                    <div class="row">
                                          <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Ball Diameter</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12 ball_diameter " name="ball_diameter" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Ball Diameter</option>
                                                        @foreach($ball_diameter as $ball_data)                                    
                                                       <option value="{{$ball_data->id}}" @if(isset($flashing_details) && $flashing_details->ball_diameter==$ball_data->id)  selected  @endif>{{$ball_data->ball_size}}</option>
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
                                            <div class="form-group row">                                               
                                                                      
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">flashing Date </label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="dateopen" name="flashing_date" value="{{isset($flashing_details) ? $flashing_details->flashing_date : date('Y-m-d')}}"> 
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
                                     <div class="col-sm-12 col-lg-6">    
                                         <h5>Select Heading Batch</h5>                                     
                                            <table class="table table-dark m-b-0 text-center" id="flashing_batch_no_data">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Select Heading Batch</th>  
                                                    <th scope="col">Master No</th>  
                                                      
                                                    <th scope="col">Action
                                                         @if(isset($flashing_details))
                                                        <button type="button" id="add_batch_no" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif</th>                                                    
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($flashing_details))
                                            <tbody id="new_batch_no">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="flashing_batch_no_data_{{$i}}" class="new" data-id="{{$i}}">
                                                     <input type="hidden" name="batch_id[]">
                                                     <input type="hidden" name="flashing_batch_id[]">
                                                      <input type="hidden" name="flashing_batch_no[]">
                                                    <td scope="">
                                                          <select class="custom-select col-12 heading_id" name="heading_batch_id[]" id="{{$i}}" required> 
                                                        <option value="">Select Batch Number </option>
                                                        @foreach($heading_data as $heading)                                    
                                                       <option value="{{$heading->heading_id}}">{{$heading->heading_batch_no}}</option>
                                                         @endforeach  
                                                            
                                                        </select>  
                                                    </td>
                                                    <td scope="">
                                                         <input type="hidden" class="form-control" name="batchinit[]" id="batchinit_{{$i}}" readonly="" placeholder="" >

                                                         <input type="text" class="form-control float-right" name="master_batch_no[]" id="master_batch_no_{{$i}}" value="{{isset($flashing_details) ? $flashing_details->master_batch_no : '' }} " @if(isset($flashing_details) &&  isset($flashing_details->master_batch_no)) readonly @endif style="width:69%;">
                                                      @if(Auth()->user()->id == 1)   
                                                        <input type="text" class="form-control number" data-id="{{$i}}" style="width:30%;" id="number_{{$i}}" name="number[]" placeholder=""  >
                                                      @endif   

                                                         
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
                                    </div>
                                        <div class="col-sm-12 col-lg-6">        
                                    <div class="row text-center">
                                            <h5 >Product Specification For Flashing</h5>
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
                                                        <td><input type="text" id="fs_unloading_gauge" class="form-control"  placeholder="Unloading Gauge" name="fs_unloading_gauge"  value="{{isset($flashing_details) ? $flashing_details->fs_unloading_gauge : ''}}"></td>                                                    
                                                        <td><input type="text" id="fs_tolerance" class="form-control" placeholder="Tolarance (µm)"   name="fs_tolerance" value="{{isset($flashing_details) ? $flashing_details->fs_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" id="fs_ovality" class="form-control" placeholder="OVALITY / O.D. VERY. MAX. (µm)"  name="fs_ovality"   value="{{isset($flashing_details) ? $flashing_details->fs_ovality : ''}}" ></td>                                                   
                                                                                                            
                                                        <td><input type="text" id="fs_lot_variation" class="form-control" placeholder="LOT Variation (µm)" name="fs_lot_variation"  value="{{isset($flashing_details) ? $flashing_details->fs_lot_variation : ''}}" ></td>   
                                                        
                                                                                                           
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                 </div>

                                    <br>
                                    <hr>


                                     

                                         <div class="row table-responsive">
                                            <h5>flashing Observation</h5>
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
                                                        @if(isset($flashing_details))
                                                        <button type="button" id="add_observation" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif
                                                    </th>
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($flashing_details))
                                            <tbody id="new">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="obs_data_{{$i}}" class="new" data-id="{{$i}}">
                                                    <td scope="row"><input type="hidden" name="" id="obs_no" value="{{$i}}"><input type="hidden" name="flashing_observation_id[]" id="flashing_observation_id ">
                                                   
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
                                                        @foreach($flashing_machine as $machine)                                    
                                                       <option value="{{$machine->machine_type_id }}">{{$machine->machine_name}}</option>
                                                         @endforeach 
                                                            
                                                        </select>
                                                    </td>

                                                    <td>
                                                       <select class="custom-select col-12" name="operator_id[]" id="operator_id_{{$i}}"  required> 
                                                        <option value="">Select Operator</option>
                                                        @foreach($flashing_operator as $operator)                                    
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
                                                    <option value="1" @if(isset($flashing_details) && $flashing_details->status==1)  selected  @endif>Active</option>
                                                    <option value="0" @if(isset($flashing_details) && $flashing_details->status==0)  selected  @endif>Inactive</option>
                                                    
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
                console.log(res);
                if(res){
                    $("#fs_unloading_gauge").val(res.fs_unloading_gauge);
                    $("#fs_tolerance").val(res.fs_tolerance);
                    $("#fs_ovality").val(res.fs_ovality);
                    $("#fs_lot_variation").val(res.fs_lot_variation);
                }  
              }

          })
     }
});

$(document).on('change','.heading_id',function(){
    var ball_size=$('.ball_diameter').val();
    var headid=$(this).attr('id');
    //alert(ball_size);
    if(ball_size != ''){    
       
                 $.ajax({
                      url: '/getMasterBatch/ajax/',
                      type: "get",
                      data:{ball_size:ball_size},
                      dataType:"json",
                      success:function(res) {
                        //console.log(res);
                        $('#master_batch_no_'+headid).val(res.batchinitial+''+res.mastno);
                        $('#batchinit_'+headid).val(res.batchinitial);
                        $('#number_'+headid).val(res.mastno);
                        //$('#number').change();
                        if(headid>1){
                            var id=headid-1;                           
                            var getPreviousNumber=$('#number_'+id).val();
                            var getPreviousBatchinit=$('#batchinit_'+id).val();    
                            var NewBatchInit=parseInt(getPreviousBatchinit)+1;
                            var NewNumber=parseInt(getPreviousNumber)+1;
                            $('#master_batch_no_'+headid).val(NewBatchInit+''+NewNumber);
                            $('#batchinit_'+headid).val(NewBatchInit);
                            $('#number_'+headid).val(NewNumber);
                        }
                      }


                  })

                }
        
});



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
             +'<input type="hidden" name="flashing_observation_id[]" id="flashing_observation_id_'+obs_no+' ">'
            
             +'<input type="date" class="form-control" value="{{date('Y-m-d')}}" required="" id="loading_date_'+obs_no+'" name="loading_date[]" ><br>'
             +'<input type="time" class="form-control" required="" id="loading_time_'+obs_no+'" name="loading_time[]" ></td>'

             +'<td>'
             +'<input type="date" class="form-control" value="{{date('Y-m-d')}}" required="" id="unloading_date_'+obs_no+'" name="unloading_date[]" ><br>'
             +'<input type="time" class="form-control" required="" id="unloading_time_'+obs_no+'" name="unloading_time[]" >'
             +'</td>'
             +'<td>'
               +'<select class="custom-select col-12" name="machine_id[]" id="machine_id_'+obs_no+'"  required>' 
                +'<option value="">Select Machine</option>'
                @foreach($flashing_machine as $machine)                                    
               +'<option value="{{$machine->machine_type_id }}">{{$machine->machine_name}}</option>'
                 @endforeach 
                +'</select>'
            +'</td>'

            +'<td>'
               +'<select class="custom-select col-12" name="operator_id[]" id="operator_id_'+obs_no+'"  required>' 
                +'<option value="">Select Operator</option>'
                @foreach($flashing_operator as $operator)                                    
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
     if($('#flashing_id').val() == ''){
        $("#observation_data tbody#new").append(html);
     }else{
        $("#observation_data tbody#save").append(html);
     }          
    
 })   

 $(document).on('click','#remove_obs',function(){
   var tr_id=($(this).val());
   $('table#observation_data tr#obs_data_'+tr_id+'').remove();   
 })  


$(document).ready(function(){
    //alert("index");
    var flashing_id=$('#flashing_id').val();
    if(flashing_id != ''){       
        $.ajax({
              url: '/flashingObservationData/ajax/',
              type: "get",
              data:{flashing_id:flashing_id},
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
                                 +'<input type="hidden" name="flashing_observation_id[]" value="'+value.flashing_observation_id+'"  id="flashing_observation_id_'+incr+' ">'

                                 +'<input type="date" class="form-control" required="" value="'+value.loading_date+'"  id="loading_date_'+incr+'" name="loading_date[]" ><br>'
                                
                                 +'<input type="time" class="form-control" required="" value="'+value.loading_time+'"  id="loading_time_'+incr+'" name="loading_time[]" ></td>'

                                 +'<td>'

                                 +'<input type="date" class="form-control" required="" value="'+value.unloading_date+'"  id="unloading_date_'+incr+'" name="unloading_date[]" ><br>'
                                
                                 +'<input type="time" class="form-control" required="" value="'+value.unloading_time+'"  id="unloading_time_'+incr+'" name="unloading_time[]" ></td>'

                                 +'<td>'
                                   +'<select class="custom-select col-12" name="machine_id[]"  id="machine_id_'+incr+'"  required>' 
                                    +'<option value="">Select Machine</option>';
                                    @foreach($flashing_machine as $machine)
                                     var sel1=''; 
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
                                    @foreach($flashing_operator as $operator)
                                     var sel2='';
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

                                   +'<td><button type="button" id="delete_obs" value="'+incr+'" data-id="'+value.flashing_observation_id+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';
                                    incr++;

                        });
                       // alert(html);
                      $("#observation_data tbody#save").append(html);  
                    }

                    }
            })   

                $.ajax({
                  url: '/flashingBatchData/ajax/', 
                  type: "get",
                  data:{flashing_id:flashing_id},
                  dataType:"json",
                  success:function(res) {
                       console.log(res);
                        if(res != ''){
                        var html='';
                        var incr1=1;                     
                            $.each(res, function(key, value) 
                            {
                                //alert(res.length);
                                  
                          html+='<tr id="flashing_batch_no_data_'+incr1+'" class="new" data-id="'+incr1+'">'                         
                                    +'<input type="hidden" name="batch_id[]" value="'+value.batch_id+'">'
                                     +'<input type="hidden" name="flashing_batch_id[]" value="'+value.flashingbatch.flashing_batch_id+'">'
                                     +'<input type="hidden" name="flashing_batch_no[]" value="'+value.flashingbatch.flashing_batch_no+'">'
                                     +'<td scope="">'
                                      +'<select class="custom-select col-12" name="heading_batch_id[]" id="inlineFormCustomSelect" required>' 
                                    +'<option value="">Select Batch Number </option>';
                                    @foreach($heading_data as $heading) 
                                    var selbatch='';   
                                    if(value.heading_batch_id === {{$heading->heading_id}}){
                                        var selbatch='selected';                                        
                                    }                                          
                            html+='<option value="{{$heading->heading_id}}" '+selbatch+'>{{$heading->heading_batch_no}}</option>';
                                     @endforeach  
                                        
                            html+='</select>' 
                            +'</td>'
                            +'<td scope="">'
                                   +'<input type="hidden" class="form-control" name="batchinit[]" id="batchinit_'+incr1+'" value="'+value.batchinit+'" readonly="" placeholder="" >'

                                     +'<input type="text" class="form-control float-right" name="master_batch_no[]" id="master_batch_no_'+incr1+'" value="'+value.master_batch_no+'" @if(isset($flashing_details) &&  isset($flashing_details->master_batch_no)) readonly @endif style="width:69%;">'
                                  @if(Auth()->user()->id == 1)   
                                    +'<input type="text" class="form-control number" style="width:30%;" id="number_'+incr1+'" data-id="'+incr1+'" name="number[]" placeholder="" value="'+value.number+'" >'
                                  @endif   
                            +'</td>';
                       html+='<td><button type="button" id="delete_batch" value="'+incr1+'" data-id="'+value.flashing_batch_id+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';

                           
                               
                                 
                                        incr1++; 
                            
                            });                            

                            //alert(html);
                          $("#flashing_batch_no_data tbody#save_batch_no").append(html); 
                        
                        }

                        }
                })      

    }
    
}) 


$(document).on('click','#delete_obs',function(){
    var tr_id=($(this).val());
    var flashing_observation_id=$(this).attr('data-id');
    var flashing_id=$('#flashing_id').val();
    if(flashing_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_flashingobservation/ajax/',
              type: "get",
              data:{flashing_observation_id:flashing_observation_id},
              dataType:"json",
              success:function(res) {
                $('table#observation_data tr#obs_data_'+tr_id+'').remove();  
              }

          })
     }
 }
});





$(document).on('click','#add_batch_no',function(){   
   var b_no_val=parseInt($('#flashing_batch_no_data tbody tr:last').attr("data-id"));

   var b_no=b_no_val+1;
   var html='<tr id="flashing_batch_no_data_'+b_no+'" class="new" data-id="'+b_no+'">'
             +'<input type="hidden" name="batch_id[]">'
             +'<input type="hidden" name="flashing_batch_id[]">'
             +'<input type="hidden" name="flashing_batch_no[]">'
            +'<td scope="">'
              +'<select class="custom-select col-12 heading_id" name="heading_batch_id[]" id="'+b_no+'" required>' 
            +'<option value="">Select Batch Number </option>';
            @foreach($heading_data as $heading)                                    
    html+='<option value="{{$heading->heading_id}}">{{$heading->heading_batch_no}}</option>';
             @endforeach  
                
    html+='</select>' 
        +'</td>'
        +'<td scope="">'
               +'<input type="hidden" class="form-control" name="batchinit[]" id="batchinit_'+b_no+'" readonly="" placeholder="" >'

                 +'<input type="text" class="form-control float-right" name="master_batch_no[]" id="master_batch_no_'+b_no+'" value="{{isset($flashing_details) ? $flashing_details->master_batch_no : '' }} " @if(isset($flashing_details) &&  isset($flashing_details->master_batch_no)) readonly @endif style="width:69%;">'
              @if(Auth()->user()->id == 1)   
                +'<input type="text" class="form-control number" style="width:30%;" id="number_'+b_no+'" data-id="'+b_no+'" name="number[]" placeholder=""  >'
              @endif   
        +'</td>';
   html+='<td><button type="button" id="remove_batch" value="'+b_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
            
     if($('#flashing_id').val() == ''){
        $("#flashing_batch_no_data tbody#new_batch_no").append(html);
     }else{
        $("#flashing_batch_no_data tbody#save_batch_no").append(html);
     }  
   
   
    
 })
 $(document).on('click','#remove_batch',function(){
    var tr_id=($(this).val());    
        if (confirm('Are you sure ?')) {         
                $('table#flashing_batch_no_data tr#flashing_batch_no_data_'+tr_id+'').remove();
         }
}); 

$(document).on('keyup','.number',function(){
    var dataid=$(this).attr('data-id');
    var masternumber=$('#number_'+dataid).val();
    if(masternumber != ''){
        var batchno=$('#batchinit_'+dataid).val();
        $('#master_batch_no_'+dataid).val(batchno+''+masternumber);       
        //$('#number').val(res.mastno);
    }
})


</script>
@endsection         