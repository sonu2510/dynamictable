@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Lapping </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/lapping">Lapping </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Lapping Add</li>                                    
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
                                <h4 class="card-title">Lapping From</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/lapping/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('lapping_id', isset($lapping_details) ? $lapping_details->lapping_id : '',['id'=>'lapping_id']) }}
                                   
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
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">lapping Date </label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="dateopen" name="lapping_date" value="{{isset($lapping_details) ? $lapping_details->lapping_date : date('Y-m-d')}}"> 
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

                                 
                                   <input type="hidden" id="batchvalues" value="{{isset($lapping_details) ? $lapping_details->batch_id : ''}}"> 
                                    <div class="row">
                                        
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group row">                                                
                                                <div class="col-sm-12 text-center">                                                                                     
                                               <button type="button"name="lapping_count" id="lapping_count" class=" col-sm-5 btn btn-info btn-rounded waves-effect waves-light">Add Lapping</button>
                                               <input type="hidden" name="lapping_number" id="lapping_number" value="{{isset($lapping_details) ? $lapping_details->lapping_count : ''}}" >
                                                 </div>
                                            </div>
                                        </div>
                                    </div>   
                                   
                                    <br><hr>                                  
                                    
                                    <div class="row text-center">
                                            <h5>Product Specification For lapping</h5>
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
                                                        <td><input type="text" id="ls_unloading_gauge" class="form-control"  placeholder="Unloading Gauge" name="ls_unloading_gauge"  value="{{isset($lapping_details) ? $lapping_details->ls_unloading_gauge : ''}}"></td>                                                    
                                                        <td><input type="text" id="ls_tolerance" class="form-control" placeholder="Tolarance (µm)"   name="ls_tolerance" value="{{isset($lapping_details) ? $lapping_details->ls_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" id="ls_ovality" class="form-control" placeholder="OVALITY / O.D. VERY. MAX. (µm)"  name="ls_ovality"   value="{{isset($lapping_details) ? $lapping_details->ls_ovality : ''}}" ></td>                                                   
                                                                                                            
                                                        <td><input type="text" id="ls_lot_variation" class="form-control" placeholder="LOT Variation (µm)" name="ls_lot_variation"  value="{{isset($lapping_details) ? $lapping_details->ls_lot_variation : ''}}" ></td>   
                                                        
                                                                                                           
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div><br><hr>
                                    <!--- DIV COUNT Start -->
                                    <div id="lappingcounter">
                                    </div>
                                    <!-- Lapping Count Div -->  

                                    <div class="row col-sm-12">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                                    <option value="1" @if(isset($lapping_details) && $lapping_details->status==1)  selected  @endif>Active</option>
                                                    <option value="0" @if(isset($lapping_details) && $lapping_details->status==0)  selected  @endif>Inactive</option>
                                                    
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
   
   var obs_val=$(this).val();   
   var obs_n_val=$('#observation_data_'+obs_val+' tbody tr.new_'+obs_val+'').length;
   var obs_no_val=parseInt($('#observation_data_'+obs_val+' tbody tr:last').attr("data-id"));
   //alert($('#coil_data tbody tr.new').length);
   //alert(obs_no);
   
   //alert(obs_n_val);
   var obs_no=obs_no_val+1;
   var html='<tr id="obs_data_'+obs_val+''+obs_no+'" class="new" data-id="'+obs_no+'">'
             +'<td scope="row">'
             +'<input type="hidden" name="lapping_observation_id_'+obs_val+'[]" id="lapping_observation_id_'+obs_no+' ">'
            
             +'<input type="date" class="form-control" value="{{date('Y-m-d')}}" required="" id="loading_date_'+obs_no+'" name="loading_date_'+obs_val+'[]" ><br>'
             +'<input type="time" class="form-control" required="" id="loading_time_'+obs_no+'" name="loading_time_'+obs_val+'[]" ></td>'

             +'<td>'
             +'<input type="date" class="form-control" value="{{date('Y-m-d')}}" required="" id="unloading_date_'+obs_no+'" name="unloading_date_'+obs_val+'[]" ><br>'
             +'<input type="time" class="form-control" required="" id="unloading_time_'+obs_no+'" name="unloading_time_'+obs_val+'[]" >'
             +'</td>'
             +'<td>'
               +'<select class="custom-select col-12" name="machine_id_'+obs_val+'[]" id="machine_id_'+obs_no+'"  required>' 
                +'<option value="">Select Machine</option>'
                @foreach($lapping_machine as $machine)                                    
               +'<option value="{{$machine->machine_type_id }}">{{$machine->machine_name}}</option>'
                 @endforeach 
                +'</select>'
            +'</td>'

            +'<td>'
               +'<select class="custom-select col-12" name="operator_id_'+obs_val+'[]" id="operator_id_'+obs_no+'"  required>' 
                +'<option value="">Select Operator</option>'
                @foreach($lapping_operator as $operator)                                    
               +'<option value="{{$operator->id}}">{{$operator->name}}</option>'
                 @endforeach 
                +'</select>'
            +'</td>'

            +'<td> <input type="text" class="form-control" id="unloading_gauge_'+obs_no+'" name="unloading_gauge_'+obs_val+'[]" required="" placeholder="unloading gauge">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="ball_dia_variation_'+obs_no+'" name="ball_dia_variation_'+obs_val+'[]" required="" placeholder="ball dia variation">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="load_dia_variation_'+obs_no+'" name="load_dia_variation_'+obs_val+'[]" required="" placeholder="load dia variation">'
            +'</td>'
            +'<td> <input type="text" class="form-control" id="surface_'+obs_no+'" name="surface_'+obs_val+'[]" required="" placeholder="Surface">'
            +'</td>'

               +'<td><button type="button" id="remove_obs" value="'+obs_no+'" data-id="'+obs_val+'" class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
              // alert(html);
    
        $("#observation_data_"+obs_val+" tbody#new_"+obs_val+" ").append(html);         
    
 })   

 $(document).on('click','#remove_obs',function(){
   var tr_id=($(this).val());
   var tr_attr=($(this).attr('data-id'));
   //alert(tr_id);
   //alert(tr_attr);
   $('table#observation_data_'+tr_attr+' tr#obs_data_'+tr_attr+''+tr_id+'').remove();   
 })  


$(document).ready(function(){
    //alert("index");
    var lapping_id=$('#lapping_id').val();
    var lapping_count=$('#lapping_number').val();
    if(lapping_id != ''){       
        $.ajax({
              url: '/lappingData/ajax/',
              type: "get",
              data:{lapping_id:lapping_id},
              dataType:"json",
              success:function(res) {
                    //console.log(res);                    
                            
                    if(res != ''){
                    var html='';
                    
                    $.each(res, function(key, value){
                             console.log();
                             var lapping_number=value.lapping_number;
                            html+='<input type="hidden" name="lapping_obs_count[]" value="'+value.lapping_obs_count_id+'" ><div class="lappingtr" id="lapping_'+lapping_number+'"><a id="delete_lapping" data-id="" class="col-1 waves-effect float-right waves-light btn btn-secondary d-block" href="javascript: void(0)"><i class="mdi mdi-delete-empty"></i>Delete</a><a id="compose_mail" class="waves-effect waves-light btn btn-danger d-block" href="javascript: void(0)">Lapping '+lapping_number+'</a>'                                
                                    +'<br>'                                    
                                    +'<hr>'                                         
                                         +'<div class="row table-responsive">'
                                            +'<h5>Lapping '+lapping_number+' Observation</h5>'
                                            +'<table class="table table-dark m-b-0" id="observation_data_'+lapping_number+'">'
                                            +'<thead>'
                                                +'<tr class="text-center">'
                                                    +'<th scope="col">Loading Date/Time</th>'
                                                    +'<th scope="col">Unloading Date/Time</th>'             
                                                    +'<th scope="col">Machine</th>'
                                                    +'<th scope="col">Operator</th>'
                                                    +'<th scope="col">Unloading Gauge</th>'
                                                    +'<th scope="col">Ball Dia Varation</th>'
                                                    +'<th scope="col">Load Dia Variation</th>'
                                                    +'<th scope="col">Surface</th>'                                                    
                                                    +'<th scope="col">Action' 
                                                        @if(isset($lapping_details))
                                                        +'<button type="button" id="add_observation"  value="'+lapping_number+'" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>'
                                                        @endif
                                                    +'</th>'
                                                +'</tr>'
                                            +'</thead>'                                          
                                          
                                            +'<tbody id="new_'+lapping_number+'" >';                                               
                                          
                                            var lap_obs=1;
                                                $.each(res[key].lappingobs, function(key, value) 
                                                        {                                                            
                                                            console.log();
                                                         var sel1,sel2=''; 
                                                        html+='<tr id="obs_data_'+lapping_number+''+lap_obs+'" class="new" data-id="'+lap_obs+'">'
                                                                 +'<td scope="row">'
                                                                 +'<input type="hidden" name="lapping_observation_id_'+lapping_number+'[]" value="'+value.lapping_observation_id+'"  ">'

                                                                 +'<input type="date" class="form-control" required="" value="'+value.loading_date+'"  name="loading_date_'+lapping_number+'[]" ><br>'
                                                                
                                                                 +'<input type="time" class="form-control" required="" value="'+value.loading_time+'" name="loading_time_'+lapping_number+'[]" ></td>'

                                                                 +'<td>'

                                                                 +'<input type="date" class="form-control" required="" value="'+value.unloading_date+'" name="unloading_date_'+lapping_number+'[]" ><br>'
                                                                
                                                                 +'<input type="time" class="form-control" required="" value="'+value.unloading_time+'"  name="unloading_time_'+lapping_number+'[]" ></td>'

                                                                 +'<td>'
                                                                   +'<select class="custom-select col-12" name="machine_id_'+lapping_number+'[]"  required>' 
                                                                    +'<option value="">Select Machine</option>';
                                                                    @foreach($lapping_machine as $machine) 
                                                                    if(value.machine_id == {{$machine->machine_type_id}}){
                                                                        var sel1='selected';
                                                                    }                                     
                                                            html+='<option value="{{$machine->machine_type_id }}" '+sel1+' >{{$machine->machine_name}}</option>'
                                                                     @endforeach 
                                                                    +'</select>'
                                                                +'</td>'

                                                                +'<td>'
                                                                   +'<select class="custom-select col-12" name="operator_id_'+lapping_number+'[]" required>' 
                                                                    +'<option value="">Select Operator</option>';
                                                                    @foreach($lapping_operator as $operator)
                                                                     if(value.operator_id == {{$operator->id}}){
                                                                        var sel2='selected';
                                                                    }                                
                                                             html+='<option value="{{$operator->id}}"  '+sel2+' >{{$operator->name}}</option>'
                                                                     @endforeach 
                                                                    +'</select>'
                                                                +'</td>'

                                                                +'<td> <input type="text" class="form-control" value="'+value.unloading_gauge+'"  name="unloading_gauge_'+lapping_number+'[]" required="" placeholder="unloading gauge">'
                                                                +'</td>'
                                                                +'<td> <input type="text" class="form-control" value="'+value.ball_dia_variation+'" name="ball_dia_variation_'+lapping_number+'[]" required="" placeholder="ball dia variation">'
                                                                +'</td>'
                                                                +'<td> <input type="text" class="form-control" value="'+value.load_dia_variation+'"  name="load_dia_variation_'+lapping_number+'[]" required="" placeholder="load dia variation">'
                                                                +'</td>'
                                                                +'<td> <input type="text" class="form-control" value="'+value.surface+'"  name="surface_'+lapping_number+'[]" required="" placeholder="Surface">'
                                                                +'</td>'

                                                                   +'<td><button type="button" id="delete_obs" value="'+lap_obs+'" data-id="'+value.lapping_observation_id+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';
                                                                    lap_obs++;

                                                        });
                                         html+='</tbody>'

                                        +'</table>'
                                    +'</div>'
                                    +'<br>'
                                    +'<hr></div>';
                       
                        });
                        //alert(html);
                      $("#lappingcounter").append(html);  
                    }

                    }
            })          

    }
    
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
                    $("#ls_unloading_gauge").val(res.ls_unloading_gauge);
                    $("#ls_tolerance").val(res.ls_tolerance);
                    $("#ls_ovality").val(res.ls_ovality);
                    $("#ls_lot_variation").val(res.ls_lot_variation);
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
$(document).on('click','#delete_obs',function(){
    var tr_id=($(this).val());
    var lapping_observation_id=$(this).attr('data-id');
    var lapping_id=$('#lapping_id').val();
    if(lapping_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_lappingobservation/ajax/',
              type: "get",
              data:{lapping_observation_id:lapping_observation_id},
              dataType:"json",
              success:function(res) {
                $('table#observation_data tr#obs_data_'+tr_id+'').remove();  
              }

          })
     }
 }
});
$(document).on('click','#delete_lapping',function(){
    var lapping_observation=($(this).attr('data-id'));
    //alert(lapping_specification);
    
    if(lapping_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_lappingdata/ajax/',
              type: "get",
              data:{lapping_observation_id:lapping_observation_id},
              dataType:"json",
              success:function(res) {
                $('#lapping_'+lapping_observation).remove();  
              }

          })
     }
 }
 //}
});
$(document).on('click','#remove_lapping',function(){
    var tr=($(this).attr('data-id'));
    //alert(lapping_specification);
        
     if (confirm('Are you sure ?')) {
                $('#lapping_'+tr).remove();  
     }
 //}
});


$(document).ready(function(){   
var lapping_id=$('#lapping_id').val();     
                if(lapping_id != ''){
                 //var headingvalues = [];
                 var batchvalues=$("#batchvalues").val();
                 $('.batch_id').val(batchvalues.split(','));
                 $('.batch_id').change(); 
                 }  
              /*  }else{
                  $(".grinding_id").select2();
                }*/
}); 

$(document).ready(function(){
     var tr_counter=$('.lappingtr').length;
     $('#lapping_number').val(tr_counter);
})
$(document).on('click','#lapping_count',function(){
    var html='';
    
    var tr_counter=$('.lappingtr').length;
    
    if(tr_counter<=2){
    if(tr_counter != '' & tr_counter != undefined ){
        tr_counter=tr_counter+1;
    }else{
        tr_counter=1;   
    }
    $('#lapping_number').val(tr_counter);
    //alert(tr_counter);   
        //alert('asd');
         html+='<input type="hidden" name="lapping_obs_count[]" ><div class="lappingtr" id="lapping_'+tr_counter+'"><a id="remove_lapping" data-id="'+tr_counter+'" class="col-1 waves-effect float-right waves-light btn btn-secondary d-block" href="javascript: void(0)"><i class="mdi mdi-delete-empty"></i>Remove</a><a id="compose_mail" class="waves-effect waves-light btn btn-danger d-block" href="javascript: void(0)">Lapping '+tr_counter+'</a>'   
                                    +'<br>'                                    
                                    +'<hr>'
                                         +'<div class="row table-responsive">'
                                            +'<h5>Lapping '+tr_counter+' Observation</h5>'
                                            +'<table class="table table-dark m-b-0" id="observation_data_'+tr_counter+'">'
                                            +'<thead>'
                                                +'<tr class="text-center">'
                                                    +'<th scope="col">Loading Date/Time</th>'
                                                    +'<th scope="col">Unloading Date/Time</th>'             
                                                    +'<th scope="col">Machine</th>'
                                                    +'<th scope="col">Operator</th>'
                                                    +'<th scope="col">Unloading Gauge</th>'
                                                    +'<th scope="col">Ball Dia Varation</th>'
                                                    +'<th scope="col">Load Dia Variation</th>'
                                                    +'<th scope="col">Surface</th>'                                                    
                                                    +'<th scope="col">Action</th>'
                                                +'</tr>'
                                            +'</thead>'                                          
                                          
                                            +'<tbody id="new_'+tr_counter+'" >'
                                                +'<tr id="obs_data_'+tr_counter+''+tr_counter+'" class="new" data-id="'+tr_counter+'">'
                                                    +'<td scope="row"><input type="hidden" name="" id="obs_no" value="'+tr_counter+'"><input type="hidden" name="lapping_observation_id_'+tr_counter+'[]" id="lapping_observation_id ">'
                                                   
                                                    +'<input type="date" class="form-control" required="" id="loading_date_'+tr_counter+'" name="loading_date_'+tr_counter+'[]" value="{{date('Y-m-d')}}" ><br>'
                                                    +'<input type="time" class="form-control" required="" id="loading_time_'+tr_counter+'" name="loading_time_'+tr_counter+'[]" >'
                                                    +'</td>'

                                                    +'<td>'
                                                    +'<input type="date" class="form-control" required="" id="unloading_date_'+tr_counter+'" name="unloading_date_'+tr_counter+'[]" value="{{date('Y-m-d')}}" ><br>'
                                                    +'<input type="time" class="form-control" required="" id="unloading_time_'+tr_counter+'" name="unloading_time_'+tr_counter+'[]" >'
                                                    +'</td>'

                                                    +'<td>'
                                                       +'<select class="custom-select col-12" name="machine_id_'+tr_counter+'[]" id="machine_id_'+tr_counter+'"  required>' 
                                                        +'<option value="">Select Machine</option>'
                                                        @foreach($lapping_machine as $machine)                                    
                                                       +'<option value="{{$machine->machine_type_id }}">{{$machine->machine_name}}</option>'
                                                         @endforeach 
                                                            
                                                        +'</select>'
                                                    +'</td>'

                                                    +'<td>'
                                                       +'<select class="custom-select col-12" name="operator_id_'+tr_counter+'[]" id="operator_id_'+tr_counter+'"  required>' 
                                                        +'<option value="">Select Operator</option>'
                                                        @foreach($lapping_operator as $operator)                                    
                                                       +'<option value="{{$operator->id}}">{{$operator->name}}</option>'
                                                         @endforeach 
                                                            
                                                        +'</select>'
                                                    +'</td>'

                                                    +'<td> <input type="text" class="form-control" id="unloading_gauge_'+tr_counter+'" name="unloading_gauge_'+tr_counter+'[]" required="" placeholder="Unloading Gauge">'
                                                    +'</td>'
                                                    +'<td> <input type="text" class="form-control" id="ball_dia_variation_'+tr_counter+'" name="ball_dia_variation_'+tr_counter+'[]" required="" placeholder="ball dia variation">'
                                                    +'</td>'
                                                    +'<td> <input type="text" class="form-control" id="load_dia_variation_'+tr_counter+'" name="load_dia_variation_'+tr_counter+'[]" required="" placeholder="load dia variation">'
                                                    +'</td>'
                                                    +'<td> <input type="text" class="form-control" id="surface_'+tr_counter+'" name="surface_'+tr_counter+'[]" required="" placeholder="Surface">'
                                                    +'</td>'
                                                    
                                                    +'<td><button type="button" value="'+tr_counter+'" data-id="'+tr_counter+'" id="add_observation" class="btn btn-info"><i class="mdi mdi-plus"></i> ADD</button>'
                                                    +'</td>'
                                                +'</tr>'

                                                                                                                                      
                                            +'</tbody>'                                             
                                        +'</table>'
                                    +'</div>'
                                    +'<br>'
                                    +'<hr></div>';
                $("#lappingcounter").append(html);
         }          
                      
})

$(document).ready(function(){   
var lapping_id=$('#lapping_id').val();     
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