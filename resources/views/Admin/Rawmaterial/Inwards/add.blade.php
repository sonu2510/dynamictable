@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Inward </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/inward">Inward </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Inward Add</li>                                    
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
                                <h4 class="card-title">Inward Details</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/inward/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('inward_id', isset($inward_details) ? $inward_details->id : '',['id'=>'inward_id']) }}
                                   
                                <div class="card-body">                                    
                                   

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Supplier Name</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="supplier_id" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Supplier</option>
                                                        @foreach($vendors as $vendor)                                    
                                                       <option value="{{$vendor->id}}" @if(isset($inward_details) && $inward_details->supplier_id==$vendor->id)  selected  @endif>{{$vendor->company_name}}</option>
                                                         @endforeach  
                                                            
                                                        </select>
                                                        @if ($errors->has('supplier_id'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('supplier_id') }}</strong>
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
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Inward Date(Material Receive) :</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="dateopen" name="inward_date" value="{{isset($inward_details) ? $inward_details->inward_date : date('Y-m-d')}}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            
                                        </div>
                                    </div>                                  

                                      <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Invoice/Challan No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="invoice_no" placeholder="Invoice/Challan No" required="" value="{{isset($inward_details) ? $inward_details->invoice_no : ''}}">
                                                     @if ($errors->has('invoice_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('invoice_no') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Invoice/Challan Date :</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="dateopen" name="invoice_date" value="{{isset($inward_details) ? $inward_details->invoice_date : date('Y-m-d')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            

                                      <hr>
                                       <h4>Material Details</h4><br>

                                        <div class="row">

                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Wire Coil Dia</label>
                                            <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="coilsize_id" id="coilsize_id" required @if(isset($inward_details)) readonly @endif> 
                                                        <option value="">Select Coil Size</option>
                                                        @foreach($coil_data as $coil)                                    
                                                       <option value="{{$coil->id}}" @if(isset($inward_details) && $inward_details->coilsize_id==$coil->id)  selected  @endif>{{$coil->coil_size}}</option>
                                                         @endforeach  
                                                            
                                                        </select>
                                                        @if ($errors->has('coilsize_id'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('coilsize_id') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-3">
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">Heat No.</label>
                                               <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fname2" name="heat_point" placeholder="heat Number" required=""  value="{{isset($inward_details) ? $inward_details->heat_point : ''}}" step=".01">
                                                     @if ($errors->has('heat_point'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('heat_point') }}</strong>
                                                                </span>
                                                     @endif
                                             </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-3">
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">Mill</label>
                                               <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fname2" name="mill" placeholder="Mill" required=""  value="{{isset($inward_details) ? $inward_details->mill : ''}}" step=".01">
                                                     @if ($errors->has('mill'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('mill') }}</strong>
                                                                </span>
                                                     @endif
                                             </div>
                                            </div>
                                        </div>
                                    </div>

                                     

                                         <div class="row">
                                            <h5>Coil Details</h5>
                                            <table class="table table-dark m-b-0" id="coil_data">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Coil Weight </th>
                                                    <th scope="col">SPBPL No.</th>
                                                    <th scope="col">Action 
                                                        @if(isset($inward_details) && $inward_details->id != '')
                                                        <button type="button" id="add_material" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif
                                                    </th>
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($inward_details))
                                            <tbody id="new">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="coil_data_1" class="new" data-id="{{$i}}">
                                                    <td scope="row"><input type="hidden" name="" id="coil_no" value="{{$i}}"><input type="hidden" name="inward_coil_id[]" id="inward_coil_id "></td>
                                                    <td> <input type="number" class="form-control coil_weight" id="coil_weight_{{$i}}" name="per_coil_weight[]" required="" placeholder="coil weight" step=".01"></td>
                                                    <td><input type="number" class="form-control" id="spbpl_no_{{$i}}" name="spbpl_no[]" placeholder="SPBPL Number" required="" ></td>
                                                    <td><button type="button" id="add_material" class="btn btn-info"><i class="mdi mdi-plus"></i> ADD</button></td>
                                                </tr>

                                                                                                                                      
                                            </tbody>

                                            @else

                                            <tbody id="save">

                                            </tbody>


                                             @endif  
                                        </table>
                                    </div>
                                    <br>
                                                                     
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">                                           
                                           <div class="form-group row">
                                               <label class="col-sm-3 text-right control-label col-form-label">Total Weight (In Kgs)</label>
                                               <div class="col-sm-9">
                                                 <input type="number" class="form-control" id="fname2" name="total_weight" placeholder="Total Weight (In Kgs)" required="" value="{{isset($inward_details) ? $inward_details->total_weight : ''}}" step=".01">
                                                     @if ($errors->has('total_weight'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('total_weight') }}</strong>
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
                                               <label class="col-sm-3 text-right control-label col-form-label">Inward Remark</label>
                                               <div class="col-sm-9">
                                                 <textarea class="form-control" name="remark" aria-label="With textarea" placeholder="remark Here">{{isset($inward_details) ? $inward_details->remark : ''}}</textarea>
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
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                                    <option value="1" @if(isset($inward_details) && $inward_details->status==1)  selected  @endif>Active</option>
                                                    <option value="0" @if(isset($inward_details) && $inward_details->status==0)  selected  @endif>Inactive</option>
                                                    
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

 $(document).on('click','#add_material',function(){
   var coil_n_val=$('#coil_data tbody tr.new').length;
   var coil_no_val=parseInt($('#coil_data tbody tr:last').attr("data-id"));
   //alert($('#coil_data tbody tr.new').length);
   //alert(coil_nval);
   var coil_no=coil_no_val+1;
   var html='<tr id="coil_data_'+coil_no+'" class="new" data-id="'+coil_no+'">'
             +'<td scope="row"><input type="hidden" name="inward_coil_id[]" id="inward_coil_id_'+coil_no+' "><input type="hidden" name="coil_no[]" id="coil_no" value="'+coil_no+'"></td>'
             +'<td> <input type="number " class="form-control coil_weight " id="coil_weight_'+coil_no+'" required="" name="per_coil_weight[]" placeholder="coil weight" step=".01"></td>'
               +'<td><input type="number" class="form-control" id="spbpl_no_'+coil_no+'" required="" name="spbpl_no[]" placeholder="SPBPL Number" ></td>'
               +'<td><button type="button" id="remove_material" value="'+coil_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
               //alert(html);
     if($('#inward_id').val() == ''){
        $("#coil_data tbody#new").append(html);
     }else{
        $("#coil_data tbody#save").append(html);
     }          
    
 })   

 $(document).on('click','#remove_material',function(){
   var tr_id=($(this).val());
   $('table#coil_data tr#coil_data_'+tr_id+'').remove();
   $('.coil_weight').change();
 })   


$(document).on('change','.coil_weight',function(){
    //var table_length=$('#coil_data tbody tr.new').length;
    var coil_no_val=parseInt($('#coil_data tbody tr:last').attr("data-id"));
    //alert(coil_no_val);
    //var total_row=parseInt(table_length-1);
    var total_weight=0;
    //alert($('#coil_weight_1').val());
    for(var i=1;i<=coil_no_val;i++){
       // alert($('#coil_weight_'+i+'').val() != '');
        //parseFloat(total_weight)+=$('#coil_weight_'+total_row+'').val();
        //alert(parseFloat($('#coil_weight_3').val()),2);
        if($('#coil_weight_'+i+'').val() != '' && $('#coil_weight_'+i+'').val() != undefined){
          total_weight += parseFloat($('#coil_weight_'+i+'').val());
         //alert($('#coil_weight_'+i+'').val());
        }
    }
    //alert(total_weight);
    $('input[name="total_weight"]').val(total_weight.toFixed(2));
});


$(document).ready(function(){
    //alert("index");
    var inward_id=$('#inward_id').val();
    if(inward_id != ''){       
        $.ajax({
              url: '/coilinwarddata/ajax/',
              type: "get",
              data:{inward_id:inward_id},
              dataType:"json",
              success:function(res) {

                    if(res != ''){
                    var html='';
                    var incr=1;
                        $.each(res, function(key, value) 
                        {
                            //alert(res.length);
                     html+='<tr id="coil_data_'+value.inward_coil_id+'" class="new" data-id="'+value.inward_coil_id+'">'
                             +'<td scope="row"><input type="hidden" name="inward_coil_id[]" value="'+value.inward_coil_id+'" id="inward_coil_id_'+value.inward_coil_id+' "><input type="hidden" name="coil_no[]" id="coil_no" value="'+incr+'"></td>'
                             +'<td> <input type="number " class="form-control coil_weight " id="coil_weight_'+incr+'" required="" name="per_coil_weight[]" placeholder="coil weight" step=".01" value="'+value.per_coil_weight+'"></td>'
                               +'<td><input type="number" class="form-control" id="spbpl_no_'+incr+'" required="" name="spbpl_no[]" placeholder="SPBPL Number" value="'+value.spbpl_no+'"></td>'
                               +'<td><button type="button" id="delete_material" value="'+value.inward_coil_id+'"  class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';
                               incr++

                        });
                       // alert(html);
                      $("#coil_data tbody#save").append(html);  
                    }

                    }
            })
    }
}) 

$(document).on('click','#delete_material',function(){
    var coil_inward_id=($(this).val());
    var inward_id=$('#inward_id').val();
    if(inward_id != ''){
        if (confirm('Are you sure ?')) {
         $.ajax({
              url: '/delete_coilinwarddata/ajax/',
              type: "get",
              data:{coil_inward_id:coil_inward_id},
              dataType:"json",
              success:function(res) {

              }

          })
     }
 }
});

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}


$(document).on('change','#coilsize_id',function(){
var inward_id=$('#inward_id').val();
    if(inward_id == ''){       
        var coilsize_id=($(this).val());
         $.ajax({
                  url: '/coilspbplno/ajax/',
                  type: "get",
                  data:{coilsize_id:coilsize_id},
                  dataType:"json",
                  success:function(res) {
                    console.log(res);
                   if(res){  
                         if(res>0) {                     
                               var spbplno=parseInt(res)+1;
                             }else{
                              var spbplno=1;  
                             }    

                        $('#spbpl_no_1').val(spbplno);                      
                    
                    }else{
                             toastr.warning("Something Went Wrong");
                    }

                  }

              })
     }

});



</script>
@endsection         