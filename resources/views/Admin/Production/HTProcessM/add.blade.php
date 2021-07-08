@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Heat Treatment Process </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/ht_process">Heat Treatment Process Monitoring  </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Heat Treatment Process  Add</li>                                    
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
                                <h4 class="card-title">Heat Treatment  Process Monitoring From</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/ht_process/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('heat_treatment_id', isset($heat_treatment_details) ? $heat_treatment_details->heat_treatment_id : '',['id'=>'heat_treatment_id']) }}
                                   
                                <div class="card-body">                                    
                                   
                                        <div class="row p-t-20">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                     <input type="date" class="form-control" id="dateopen" name="heat_treatment_date" value="{{isset($heat_treatment_details) ? $heat_treatment_details->heat_treatment_date : date('Y-m-d')}}"> 
                                                   </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-2">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">F/C No</label>
                                                     <input type="text" class="form-control" id="fc_no" name="fc_no" placeholder="F/C No" required="" value="{{isset($heat_treatment_details) ? $heat_treatment_details->fc_no : ''}}">
                                                     @if ($errors->has('fc_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('fc_no') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                              <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Ball Size</label>
                                                     <select class="custom-select col-12" name="ball_size" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Ball Size</option>
                                                        @foreach($ball_diameter as $ball_data)                                    
                                                       <option value="{{$ball_data->id}}" @if(isset($heat_treatment_details) && $heat_treatment_details->ball_size==$ball_data->id)  selected  @endif>{{$ball_data->ball_size}}</option>
                                                         @endforeach  
                                                            
                                                        </select>
                                                        @if ($errors->has('ball_size'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('ball_size') }}</strong>
                                                                </span>
                                                     @endif 
                                                 </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Master No </label>
                                                     <select class="custom-select col-12" name="master_batch_id" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Master no</option>
                                                        @foreach($masterno as $batch_no)                                    
                                                       <option value="{{$batch_no->batch_id }}" @if(isset($heat_treatment_details) && $heat_treatment_details->master_batch_id==$batch_no->batch_id )  selected  @endif>{{$batch_no->master_batch_no}}</option>
                                                         @endforeach  
                                                            
                                                        </select>
                                                        @if ($errors->has('flashing_batch_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('flashing_batch_no') }}</strong>
                                                                </span>
                                                     @endif 
                                                 </div>

                                            </div>
                                              <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Batch Weight (KGS)</label>
                                                           <input type="text" class="form-control" id="batch_weight" name="batch_weight" placeholder="Batch Weight (KGS)" required="" value="{{isset($heat_treatment_details) ? $heat_treatment_details->batch_weight : ''}}">
                                                     @if ($errors->has('heading_batch_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('batch_weight') }}</strong>
                                                                </span>
                                                     @endif 
                                                       </div>
                                                </div>
                                            <!--/span-->
                                        </div>
                                            <div class="row p-t-20">
                                               
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Set Temp (C)</label>
                                                           <input type="text" class="form-control" id="set_temp" name="set_temp" placeholder="Set Temp (C)" required="" value="{{isset($heat_treatment_details) ? $heat_treatment_details->set_temp : ''}}">
                                                     @if ($errors->has('heading_batch_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('set_temp') }}</strong>
                                                                </span>
                                                     @endif 
                                                       </div>
                                                </div> 
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Load Time</label>
                                                           <input type="text" class="form-control" id="load_time" name="load_time" placeholder="Load Time" required="" value="{{isset($heat_treatment_details) ? $heat_treatment_details->load_time : ''}}">
                                                             @if ($errors->has('heading_batch_no'))
                                                                    <span class="help-block" style="color: red;">
                                                                            <strong>{{ $errors->first('load_time') }}</strong>
                                                                        </span>
                                                             @endif 
                                                       </div>
                                                </div>
                                            </div>
                                          
                                            <hr>
                                          
                                        
                                         <div class="row p-t-20">                                               
                                                <h4 >ATMOSPHERE</h4>
                                                <table class="table table-dark m-b-0" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" rowspan="2">Set Temp (C)</th>
                                                        <th scope="col" rowspan="2">Load Time</th>
                                                        <th scope="col" colspan="3"><center>ATMOSPHERE</center></th>             
                                                            
                                                        <th scope="col" rowspan="2">Equalize Time</th>        
                                                        <th scope="col" rowspan="2">Set SOAK Time(Minit)</th>        
                                                        <th scope="col" rowspan="2">Unload Time</th>        
                                                    </tr>  
                                                       <tr>
                                                       
                                                        <th scope="col">Flow rate</th>             
                                                        <th scope="col">Start Time</th>        
                                                        <th scope="col">Start Temp (C)</th>        
                                                       
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" class="form-control"  placeholder="Set Temp " name="set_temp"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->set_temp : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control"  placeholder="Load Time" name="load_time" value="{{isset($heat_treatment_details) ? $heat_treatment_details->load_time : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Flow rate"  name="flow_rate"   value="{{isset($heat_treatment_details) ? $heat_treatment_details->flow_rate : ''}}" ></td>                                                    
                                                        <td><input type="time" class="form-control" placeholder="Start Time"  name="at_start_time"   value="{{isset($heat_treatment_details) ? $heat_treatment_details->at_start_time : ''}}" ></td>                                                    
                                                        <td><input type="text" class="form-control"  placeholder="Start Temp" name="at_start_temp"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->at_start_temp : ''}}" ></td> 
                                                        <td><input type="time" class="form-control" placeholder="Equalize Time"  name="equalize_time"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->equalize_time : ''}}" ></td>
                                                        <td><input type="time" class="form-control"  placeholder="Set SOAK Time"  name="set_soak_time"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->set_soak_time : ''}}" ></td> 
                                                        <td><input type="time" class="form-control" placeholder="Unload Time" name="at_unload_time"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->at_unload_time : ''}}" ></td>                                                    
                                                    </tr>
                                                </tbody>
                                            </table>                                            
                                         
                                     </div>
                                                <div class="row p-t-20">                                               
                                                <h4 >QUENCH</h4>
                                                <table class="table table-dark m-b-0" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Oil Temp</th>
                                                        <th scope="col">Start Time</th>        
                                                        <th scope="col">End Time </th>        
                                                        <th scope="col">Total Quench Time (Minit)</th>  
                                                        <th scope="col">Quench Hardnes in HRC</th>        
                                                        <th scope="col">Sub Zero Done</th>        
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" class="form-control"  placeholder="Oil Temp"  name="oil_temp"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->oil_temp : ''}}"></td>                                                    
                                                        <td><input type="time" class="form-control" placeholder="Start Time"  name="quench_start_time" value="{{isset($heat_treatment_details) ? $heat_treatment_details->quench_start_time : ''}}"></td>                                                    
                                                        <td><input type="time" class="form-control" placeholder="End Time"  name="quench_end_time"   value="{{isset($heat_treatment_details) ? $heat_treatment_details->quench_end_time : ''}}" ></td>                                                    
                                                        <td><input type="time" class="form-control" placeholder="Total Quench Time" name="quench_total_time"   value="{{isset($heat_treatment_details) ? $heat_treatment_details->quench_total_time : ''}}" ></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Hardnes in HRC"  name="quench_hardnes"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->quench_hardnes : ''}}" ></td>   
                                                         <td><input type="text" class="form-control" placeholder="Sub Zero"  name="sub_zero"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->sub_zero : ''}}" ></td> 
                                                                                                           
                                                    </tr>
                                                </tbody>
                                            </table>                                            
                                         
                                     </div>
                                            <div class="row p-t-20">                                               
                                                <h4 >TEMPERING</h4>
                                                <table class="table table-dark m-b-0" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Set Temp</th>
                                                        <th scope="col">Start Time</th>        
                                                        <th scope="col">Load Time </th>                                                                
                                                        <th scope="col">Tempering Hardnes in HRC</th>        
                                                      
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" class="form-control"  placeholder="Set Temp" name="tempering_set_temp"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->tempering_set_temp : ''}}"></td>                                                    
                                                        <td><input type="time" class="form-control" placeholder="Start Time"   name="tempering_start_time" value="{{isset($heat_treatment_details) ? $heat_treatment_details->tempering_start_time : ''}}"></td>                                                    
                                                        <td><input type="time" class="form-control" placeholder="Load Time"  name="tempering_load_time"   value="{{isset($heat_treatment_details) ? $heat_treatment_details->tempering_load_time : ''}}" ></td>                                         
                                                        <td><input type="text" class="form-control" placeholder="Hardnes in HRC" name="tempering_hardnes"  value="{{isset($heat_treatment_details) ? $heat_treatment_details->tempering_hardnes : ''}}" ></td>   
                                                        
                                                                                                           
                                                    </tr>
                                                </tbody>
                                            </table>                                            
                                         
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

 







$(document).on('change','.processed_coil',function(){
var processed_coil_id=$(this).val();
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
                    //alert(res);
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

function getSelectedCoils() {
    var total=0;
    var coil=1;
    var heading_id=$('#heading_id').val();
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

 var intrval=setInterval(function () {
        getSelectedCoils();
        clearInterval(intrval);
    },2000);

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