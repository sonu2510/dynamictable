@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Inward (Under Processing) </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/inward_underprocess">Inward (Under Processing) </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Inward Edit (Under Processing)</li>                                    
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
                                <h4 class="card-title">Inward (Under Processing) Details</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/inward_underprocess/save" enctype="multipart/form-data">
                                 
                                    {!! csrf_field() !!}
                                 
                                      
                                   {{ Form::hidden('inward_underprocess_id',isset($inward_inprocess_details) ? $inward_inprocess_details->inward_underprocess_id : '',['id'=>'inward_underprocess_id']) }}
                                  
                                      <hr>
                                       <h4>Under Processing Form</h4>
                                      <br>                                 
   
                                  @php $disable=""; @endphp
                                       @if(isset($inward_inprocess_details))
                                             @if(count($processedcoil_details[0]->underprocess_coil_data) < 1)
                                              
                                             @else
                                             @php $disable="disabled"; @endphp
                                            @endif
                                        @endif                   
                                   <div class="row" {{$disable}}>
                                            <h5></h5>
                                            <table class="table table-dark m-b-0" id="coil_data" >
                                            <thead>
                                                <tr>
                                                    <th scope="col">Coil Size</th>
                                                     <th scope="col">Processed Coil Size </th>
                                                    <th scope="col">SPBPL No.</th>
                                                    <th scope="col">Coil Weight</th>
                                                    <th scope="col">Issue Date</th>
                                                    <th scope="col">Challan No</th>
                                                    <th scope="col">Mill</th>
                                                    <th scope="col">Job Work Supplier</th>
                                                    <th scope="col">Action &nbsp;&nbsp;&nbsp;
                                                        @if(isset($inward_inprocess_details))
                                                            @if(count($processedcoil_details[0]->underprocess_coil_data) < 1)
                                                        <button type="button" id="add_coil" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                            @endif
                                                        @endif
                                                    </th>
                                                </tr>
                                            </thead>      
                                             @php 
                                                 $i=1;
                                                @endphp                                    
                                           @if(!isset($inward_inprocess_details))
                                            <tbody id="new">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="coil_{{$i}}" class="new" data-id="{{$i}}">

                                                    <td scope="row">
                                                    <input type="hidden" name="under_process_coil_id[]">
                                                    <select class="custom-select col-12 coil_size" name="coils[]" id="coil_size_{{$i}}" required="" data-id="{{$i}}"> 
                                                        <option value="">Select Coil Size</option>
                                                        @foreach($coil_data as $coils)                                    
                                                       <option value="{{$coils->id}}">{{$coils->coil_size}}</option>
                                                    
                                                       @endforeach
                                                    </select>
                                                    </td>

                                                    <td>
                                                      <select class="custom-select col-12" name="coil_size[]" id="splitcoil_size_{{$i}}" required="" data-id="{{$i}}"> 
                                                        <option value="">Select Processed Coil</option>
                                                        @foreach($processed_coil as $coil)                                    
                                                       <option value="{{$coil->id}}">{{$coil->coil_size}}</option>
                                                    
                                                       @endforeach
                                                    </select>
                                                    </td>
                                                    
                                                    <td> 
                                                    <select class="select2_{{$i}} form-control custom-select spbpl" name="spbpl[]" required="" data-id="{{$i}}" id="spbpl_{{$i}}">
                                                    <option value="">Select SPBPL No</option>
                                                    </select>
                                                    </td> 

                                                    <td> <input type="text" class="form-control " id="coil_weight_{{$i}}"  readonly="" ></td>

                                                    <td> <input type="date" class="form-control " id="issue_date_{{$i}}" name="issue_date[]" required="" placeholder="Issue Date"></td>

                                                     <td> <input type="text" class="form-control " id="challan_no_{{$i}}" name="challan_no[]" required="" placeholder="Challan Number"></td>

                                                      <td> <input type="text" class="form-control " id="mill{{$i}}" name="mill[]" required="" placeholder="Mill"></td>

                                                    <td>
                                                      <select class="custom-select col-12 " name="job_work[]" id="job_work_{{$i}}" required=""> 
                                                        <option value="">Select Supplier</option>
                                                        @foreach($suppliers as $supplier)                                    
                                                       <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                                                    
                                                       @endforeach
                                                    </select>                                                     
                                                    </td>

                                                    <td><button type="button" id="add_coil" class="btn btn-info"><i class="mdi mdi-plus"></i> ADD</button></td>
                                                </tr>

                                                                                                                                      
                                            </tbody>

                                            @else
                                            <tbody id="save">
                                           @foreach($inward_inprocess_details->underprocess_coil as $up_coils)
                                               <tr id="coil_{{$i}}" class="new" data-id="{{$i}}">

                                                    <td scope="row">
                                                   <input type="hidden" name="under_process_coil_id[]" value="{{$up_coils->under_process_coil_id}}" id="under_process_coil_id_{{$i}}">
                                                    <select class="custom-select col-12 coil_size" name="coils[]" id="coil_size_{{$i}}" required="" data-id="{{$i}}"> 
                                                        <option value="">Select Coil Size</option>
                                                        @foreach($coil_data as $coils)                                    
                                                       <option value="{{$coils->id}}" @if($up_coils->coil_size_id == $coils->id) selected @endif >{{$coils->coil_size}}</option>
                                                    
                                                       @endforeach
                                                    </select>
                                                    </td>

                                                     <td>
                                                      <select class="custom-select col-12" name="coil_size[]" id="splitcoil_size_{{$i}}" required="" data-id="{{$i}}"> 
                                                        <option value="">Select Processed Coil</option>
                                                        @foreach($processed_coil as $coil)                                    
                                                       <option value="{{$coil->id}}" @if($up_coils->splitcoil_size == $coil->id) selected @endif>{{$coil->coil_size}}</option>
                                                    
                                                       @endforeach
                                                    </select>
                                                    </td>                                                    

                                                    <td> 
                                                    <input type="hidden" id="inward_coil_id_{{$i}}" value="{{$up_coils->inward_coil_id}}">
                                                    <select class="select2_{{$i}} form-control custom-select spbpl" name="spbpl[]" required="" data-id="{{$i}}" id="spbpl_{{$i}}">
                                                    <option value="">Select SPBPL No</option>
                                                    </select>
                                                    </td> 

                                                      <td> <input type="text" class="form-control " id="coil_weight_{{$i}}"  readonly="" ></td>

                                                    <td> <input type="date" class="form-control " id="issue_date_{{$i}}" name="issue_date[]" value="{{$up_coils->issue_date}}" required="" placeholder="Issue Date"></td>

                                                     <td> <input type="text" class="form-control " id="challan_no_{{$i}}" name="challan_no[]" value="{{$up_coils->challan_no}}" required="" placeholder="Challan Number"></td>

                                                     <td> <input type="text" class="form-control " id="mill{{$i}}" name="mill[]" value="{{$up_coils->mill}}" required="" placeholder="Mill"></td>

                                                    <td>
                                                       <select class="custom-select col-12 " name="job_work[]" id="job_work_{{$i}}" required="" > 
                                                        <option value="">Select Supplier</option>
                                                        @foreach($suppliers as $supplier)                                    
                                                       <option value="{{$supplier->id}}" @if($up_coils->jobwork_supplier == $supplier->id) selected @endif >{{$supplier->company_name}}</option>
                                                    
                                                       @endforeach
                                                    </select>                                                      
                                                    </td>

                                                    <!-- <td><button type="button" id="remove_data" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button> --></td>
                                                </tr>
                                               @php 
                                                 $i++;
                                                @endphp
                                                @endforeach
                                            </tbody>
                                               

                                             @endif  
                                        </table>
                                    </div>  

                                    <br> 

                                  @if(isset($inward_inprocess_details) && $inward_inprocess_details->status == 0)
                                 <hr>

                                     <h4>Split Coil Details</h4><br>                                 
                                        
                                                <div class="row">                                                    
                                                        <table class="table table-bordered table-dark m-b-0 text-center" >
                                                        <thead>
                                                            <tr>
                                                               <b>
                                                                <th scope="col">Coil Size </th>                                
                                                                <th scope="col">Coil SPBPL NO.</th> 
                                                                <th scope="col">Coil Weight</th>   
                                                                <th scope="col">Inward Date</th> 
                                                                 <th scope="col">Action</th>
                                                                  <th scope="col">Proessed Coil Details </th> 
                                                                
                                                                </b>
                                                            </tr>
                                                        </thead>

                                                        @if(empty($processedcoil_details[0]))
                                                      
                                                         @else                                                      
                                                         <tbody>
                                                            @foreach($processedcoil_details as $processedcoil_data)
                                                            <tr>
                                                                
                                                                <td >
                                                                  <input type="hidden" value="{{$processedcoil_data->inward_coil_id}}" name="inward_coil_id[]" id="{{$processedcoil_data->inward_coil_id}}">
                                                                  {{$processedcoil_data->coil_data->coil_size}}
                                                                  <input type="hidden" class="form-control" name="spbpl_no_{{$processedcoil_data->inward_coil_id}}[]"  id="spbpl_no_{{$processedcoil_data->inward_coil_id}}" value="{{$processedcoil_data->coil_spbpl_no}}" >
                                                                </td>  
                                                                <td >{{$processedcoil_data->coil_spbpl_no}}</td>
                                                                <td >{{$processedcoil_data->inward_coil_data->per_coil_weight}}</td>

                                                                <td ><input type="date" class="form-control" name="splitcoil_inwarddate[]" value="{{isset($processedcoil_data) ? $processedcoil_data->splitcoil_inwarddate : '' }}" ></td>                             
                                                                <td> <button type="button" id="add_splitcoil" class="btn btn-info" value="{{$processedcoil_data->inward_coil_id}}"><i class="mdi mdi-plus"></i>Add Coil</button></td> 
                                                                 <td id="split_coils_{{$processedcoil_data->inward_coil_id}}" >
                                                                 

                                                                  @foreach($processedcoil_data->underprocess_coil_data as $splitcoils)
                                                                    <div class="row m-b-0 m-t-10 split_coil_{{$splitcoils->id}}" id="row">
                                                                        <div class="col-sm-12 col-lg-5">
                                                                            <input type="hidden" name="processed_coil_id[]" value="{{$splitcoils->id}}">
                                                                            <input type="text" class="form-control" name="splitcoils_weight_{{$processedcoil_data->inward_coil_id}}[]" id="" value="{{$splitcoils->coil_weight}}" >
                                                                        </div>
                                                                        <div> 
                                                                         <input type="hidden"   name="spbpl_no_{{$splitcoils->id}}[]" value="{{$processedcoil_data->coil_spbpl_no}}">                   
                                                                           
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-3">
                                                                        <button type="button" id="del_split_coil" data-value="" value="{{$splitcoils->id}}" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i></button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach


                                                                 </td> 
                                                                                                                               
                                                            </tr>
                                                            @endforeach 
                                                       
                                                        </tbody>

                                                        @endif
                                                    </table>
                                                </div>                                          
                                   
                                  <br><hr>
                                  @endif  

                                  <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                                    <option value="1" @if(isset($inward_inprocess_details) && $inward_inprocess_details->status==1)  selected  @endif>In Process</option>
                                                    <option value="0" @if(isset($inward_inprocess_details) && $inward_inprocess_details->status==0)  selected  @endif>Complete</option>
                                                    
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               
                                            </div>
                                        </div>
                                    </div><br>

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
<style type="text/css">
  div[disabled]
{
  pointer-events: none;
  opacity: 0.7;
}
</style>
<script type="text/javascript">
 

 $(document).on('click','#add_coil',function(){

   //var coil_no_val=$('#coil tbody tr.new').length;
   var coil_no_val=parseInt($('#coil_data tbody tr:last').attr("data-id"));
   //alert($('#coil_data tbody tr.new').length);
   //alert(coil_no_val);
   var coil_no=coil_no_val+1;
   var underprocess_coil_html='';
   //if($('#inward_underprocess_id').val() != ''){
    var underprocess_coil_html='<input type="hidden" name="under_process_coil_id[]" >';
   //}

   var html='<tr id="coil_'+coil_no+'" class="new" data-id="'+coil_no+'">'
                +'<td scope="row"><input type="hidden" name="under_process_coil_id[]" >'
                +'<select class="custom-select col-12 coil_size" name="coils[]" id="coil_size_'+coil_no+'" required="" data-id="'+coil_no+'">' 
                +'<option value="">Select Coil Size</option>'
                @foreach($coil_data as $coils)                                    
               +'<option value="{{$coils->id}}">{{$coils->coil_size}}</option>'            
               @endforeach
            +'</select></td>'
            +'<td>'
            +'<select class="custom-select col-12" name="coil_size[]" id="splitcoil_size_'+coil_no+'" required="" data-id="'+coil_no+'">' 
                +'<option value="">Select Processed Coil</option>'
                @foreach($processed_coil as $coil)                                    
               +'<option value="{{$coil->id}}">{{$coil->coil_size}}</option>'            
               @endforeach
            +'</select>'
            +'</td>'
           
            +'<td>' 
            +'<select class="select2_'+coil_no+' form-control custom-select spbpl" required="" name="spbpl[]" data-id="'+coil_no+'" id="spbpl_'+coil_no+'">'
            +'<option value="">Select SPBPL No</option>'
            +'</select>'
            +'</td>'           
            +'<td> <input type="text" class="form-control " id="coil_weight_'+coil_no+'"  readonly="" ></td>'
            +'<td> <input type="date" class="form-control " id="issue_date_'+coil_no+'" name="issue_date[]" required="" placeholder="Issue Date"></td>'
             +'<td> <input type="text" class="form-control " id="challan_no_'+coil_no+'" name="challan_no[]" required="" placeholder="Challan Number"></td>'
             +'<td> <input type="text" class="form-control " id="mill'+coil_no+'" name="mill[]" required="" placeholder="MIll"></td>'
            +'<td>'
             +'<select class="custom-select col-12" name="job_work[]" id="job_work_'+coil_no+'" required="" data-id="'+coil_no+'">' 
                +'<option value="">Select Coil Size</option>'
                @foreach($suppliers as $supplier)                                    
               +'<option value="{{$supplier->id}}">{{$supplier->company_name}}</option>'            
               @endforeach
            +'</select>'        
            +'</td>'
            +'<td><button type="button" id="remove_coil" value="'+coil_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td>'
            +'</tr>';
               //alert(html);
               
     if($('#inward_underprocess_id').val() == ''){
        $("#coil_data tbody#new").append(html);
     }else{
        $("#coil_data tbody#save").append(html);
     } 
     //$("#coil_data tbody#new").append(html);  
     $(".select2_"+coil_no).select2();      
    
 })   

 $(document).on('click','#del_split_coil',function(){

if (confirm('Are you sure ?')) {
       var splitcoil_id=($(this).val());
     $.ajax({
              url: '/delete_split_coilinwarddata/ajax/',
              type: "get",
              data:{splitcoil_id:splitcoil_id},
              dataType:"json",
              success:function(res) {
                $('.split_coil_'+splitcoil_id).remove();
              }

          })
    
    }


});

  $(document).on('click','#remove_coil',function(){

   var row_id=($(this).val());
   $('#coil_'+row_id).remove();  
 })   

$(document).on('change','.coil_size',function(){
    //alert('asd');
    var coilsize_row=$(this).attr("data-id");
    var coilsize=$('#coil_size_'+coilsize_row).val();
    var edit=$('#under_process_coil_id_'+coilsize_row).val();
    //alert(edit);
    if(coilsize != ''){
    $.ajax({
              url: '/getSpbpl/ajax/',
              type: "get",
              data:{coilsize:coilsize,edit:edit},
              dataType:"json",
              success:function(res) {
                 $('#spbpl_'+coilsize_row).empty().trigger("change"); 
                 $('#spbpl_'+coilsize_row).append('<option value="">SPBPL NO.</option>');         
                 $.each(res, function(key, value) 
                        {
                            $('#spbpl_'+coilsize_row).append('<option value="'+value.inward_coil_id+'">'+value.spbpl_number+'</option>');
                        });
                //$('.split_coil_'+splitcoil_id).remove();
                if($('#inward_underprocess_id').val() != ''){
                  var len = $('select.coil_size'). length;
                      for(var i=1;i<=len;i++){                       
                        var getValue=$('#inward_coil_id_'+i).val();
                        console.log(getValue);
                      $(".select2_"+i).val(getValue); // Select the option with a value of '1'
                       $(".select2_"+i).trigger('change');
                       
                     }
                }
              }

          })
    }

})

$(function() {    
      //$('#dateopen').datepicker('setDate', '23/04/2014');
      if($('#inward_underprocess_id').val() != ''){
        $('.coil_size').change();
        //var count=$(':select').length;
        var len = $('select.coil_size'). length;
        for(var i=1;i<=len;i++){
          //alert(i);
          $(".select2_"+i).select2();
          var getValue=$('#inward_coil_id_'+i).val();
         
          //$(".select2_"+i).trigger('change');
          //$(".select2_"+i).select2("val", getValue);
        
        }
        
      }
    });

/*setInterval(function(){ 
   $(".select2_1").val(4); // Select the option with a value of '1'
   $(".select2_1").trigger('change');
   }, 1000);*/

$(document).on('click','#add_splitcoil',function(){
   var inward_coilid=$(this).val();

   var input_count=$('input[name*="splitcoils_weight_'+inward_coilid+'"]').length;
    var spbpl_no=$('#spbpl_no_'+inward_coilid).val();
   //alert();
   var count=0;

   if(input_count==0){
    count=1;
   }else{
    count=input_count+1;
   }

    var html='<div class="row m-b-0 m-t-10" id="row_'+inward_coilid+'_'+count+'">'
                +'<div class="col-sm-12 col-lg-5"><input type="hidden" name="processed_coil_id[]">'
                      
                    +'<input type="text" class="form-control" required name="splitcoils_weight_'+inward_coilid+'[]" placeholder="Processed Coil Weight" id="split_coil_'+count+'">'
                    
                +'</div>'            
                      
                    +'<input type="hidden"   name="spbpl_no_'+inward_coilid+'[]" value="'+spbpl_no+'" id="split_coil_'+count+'">'
                    
            
                +'<div class="col-sm-12 col-lg-3">'
                +'<button type="button" id="remove_splitcoil" data-value="'+inward_coilid+'" value="'+count+'"class="btn btn-danger"><i class="mdi mdi-minus"></i></button>'
                +'</div>'
            +'</div>';

       //alert(html);
    $("#split_coils_"+inward_coilid).append(html);

});

  $(document).on('click','#remove_splitcoil',function(){

   var row_id=($(this).val());
   var row_val=$(this).data('value');
  //alert(row_id);
    $('#row_'+row_val+'_'+row_id+'').remove();  
 })   


$(document).on('change','.spbpl',function(){
  var select_id=$(this).attr("data-id");
  var inward_coilid=$(".select2_"+select_id).val();
  //alert(select_id);
  if(inward_coilid != ''){
    $.ajax({
              url: '/getSpbplCoilWeight/ajax/',
              type: "get",
              data:{inward_coilid:inward_coilid},
              dataType:"json",
              success:function(res) {

                $('#coil_weight_'+select_id).val(res.per_coil_weight);
              }
          })
  }

})
$(".select2_1").select2();
</script>
@endsection         