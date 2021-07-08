@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Finished Wire Stock </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/inward_underprocess">Inward (Finished Wire Stock) </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Finished Wire Stock View</li>                                    
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
                                <h4 class="card-title">Finished Wire Stock Details</h4>                               
                               
                              
                                   
                                   
                                   {{ Form::hidden('inward_id', isset($inward_details) ? $inward_details->id : '') }}
                                  

                                <div class="card-body">                                    
                                   
                                    <h4 class="text-center">Inward No : {{$inward_details->inward_no}} </h4><hr>                 

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Inward Date(Material Receive) :</label>
                                                <div class="col-sm-4 form-control">
                                                    {{date('d-m-Y', strtotime($inward_details->inward_date))}} 
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
                                                <div class="col-sm-9 form-control">
                                                    {{$inward_details->invoice_no}}                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Invoice/Challan Date :</label>
                                                <div class="col-sm-4 form-control">
                                                {{date('d-m-Y', strtotime($inward_details->invoice_date))}}                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            

                                      <hr>
                                       <h4>Material Details</h4><br>

                                       <div class="row">
                                         <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-dark m-b-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th scope="col"><b>Vendor Name</b></th>
                                                            <th scope="col"><b>Coil Diameter</b></th>
                                                            <th scope="col"><b>Heat No.</b></th> 
                                                            <th scope="col"><b>Total Coil Weight</b></th>                        
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>         

                                                        <tr>      
                                                            <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">{{$inward_details->vendor->company_name}}</button></td>        
                                                            <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">{{$inward_details->coil_size->coil_size}}</button></td>
                                                            <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">{{$inward_details->heat_point}}</button></td>                                   
                                                            <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">{{$inward_details->total_weight}}</button></td>                                   
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><br>                                 

                                        
                                   
                                  

                                    <hr>

                                     <h4>Split Coil Details</h4><br>                                 
                                        
                                                <div class="row">                                                    
                                                        <table class="table table-bordered table-dark m-b-0 text-center" >
                                                        <thead>
                                                            <tr>
                                                               <b>
                                                                  <th scope="col">Inward Date</th>  
                                                                <th scope="col">Coil weight </th> 
                                                                 <th scope="col">Coil SPBPL NO.</th>                                
                                                                 <th scope="col">Processed Coil NO.</th>                                
                                                                  <th scope="col">Proessed Coil weight </th> 
                                                                
                                                                </b>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($processedcoil_details as $processedcoil_data)
                                                            <tr>
                                                                <td >
                                                                  {{date('j F, Y', strtotime($processedcoil_data->inward_date))}}  
                                                                </td>

                                                                <td >{{$processedcoil_data->inward_coil_data->per_coil_weight}}</td> 
                                                               
                                                                 <td >
                                                                  {{$processedcoil_data->inward_coil_data->coil_entry_year}}-{{$processedcoil_data->inward_coil_data->spbpl_no}}
                                                                </td> 

                                                                <td >
                                                                    @php $i=1; @endphp
                                                                     @foreach($processedcoil_data->processed_coils as $splitcoils)
                                                                     <button type="button" class="btn btn-block btn-outline-light">
                                                                         {{$processedcoil_data->inward_coil_data->coil_entry_year}}-{{$processedcoil_data->inward_coil_data->spbpl_no}}-[{{$i}}]   </button>  
                                                                      @php $i++; @endphp
                                                                    @endforeach
                                                                </td>      

                                                                 <td id="split_coils_{{$processedcoil_data->inward_coil_data->inward_coil_id}}" >
                                                                 
                                                                     
                                                                  @foreach($processedcoil_data->processed_coils as $splitcoils)
                                                                     <button type="button" class="btn btn-block btn-outline-light">
                                                                        {{$splitcoils->coil_weight}}
                                                                     </button>
                                                                    
                                                                  
                                                                @endforeach


                                                                 </td> 
                                                                                                                               
                                                            </tr>
                                                            @endforeach
                                                        </tbody>

                                                      
                                                    </table>
                                                </div>                                          
                                   
                                  <br><hr>
 

                                   


                                </div>    


                            
                                 
                            </div>
                        </div>
                    </div>
                </div>
@endsection        
@section('footer_scripts')
<script type="text/javascript">
 

 $(document).on('click','#add_coil',function(){
   var inward_coilid=$(this).val();

   var input_count=$('input[name*="splitcoils_weight_'+inward_coilid+'"]').length;
   var count=0;

   if(input_count==0){
    count=1;
   }else{
    count=input_count+1;
   }
  
   var inward_processed_coil_id='';
   if($('#inward_processed_coil_id').val() != undefined){
       inward_processed_coil_id='<input type="hidden" name="processed_coil_id[]">';
     }

   //alert(inward_processed_coil_id);

    var html='<div class="row m-b-0 m-t-10" id="row_'+inward_coilid+'_'+count+'">'
                +'<div class="col-sm-12 col-lg-9">'+inward_processed_coil_id
                      
                    +'<input type="text" class="form-control" name="splitcoils_weight_'+inward_coilid+'[]" placeholder="Processed Coil Weight" id="split_coil_'+count+'">'
                    
                +'</div>'
                +'<div class="col-sm-12 col-lg-3">'
                +'<button type="button" id="remove_coil" data-value="'+inward_coilid+'" value="'+count+'"class="btn btn-danger"><i class="mdi mdi-minus"></i></button>'
                +'</div>'
            +'</div>';

       //alert(html);
    $("#split_coils_"+inward_coilid).append(html);
    

  /*

   var coil_no_val=$('#coil_data tbody tr.new').length;
   //alert($('#coil_data tbody tr.new').length);
   //alert(coil_no_val);
   var coil_no=coil_no_val+1;
   var html='<tr id="coil_data_'+coil_no+'" class="new">'
             +'<td scope="row"><input type="hidden" name="inward_coil_id[]" id="inward_coil_id_'+coil_no+' "><input type="hidden" name="coil_no[]" id="coil_no" value="'+coil_no+'"></td>'
             +'<td> <input type="number " class="form-control coil_weight " id="coil_weight_'+coil_no+'" required="" name="per_coil_weight[]" placeholder="coil weight" step=".01"></td>'
               +'<td><input type="number" class="form-control" id="spbpl_no_'+coil_no+'" required="" name="spbpl_no[]" placeholder="SPBPL Number" ></td>'
               +'<td><button type="button" id="remove_material" value="'+coil_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
               //alert(html);
     if($('#inward_id').val() == ''){
        $("#coil_data tbody#new").append(html);
     }else{
        $("#coil_data tbody#save").append(html);
     }          */
    
 })   

 $(document).on('click','#split_coil',function(){

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
   var row_val=$(this).data('value');
  //alert(row_id);
    $('#row_'+row_val+'_'+row_id+'').remove();  
 })   


    $(function() {   
      //alert($('#inward_processed_coil_id').val());
      if($('#inward_processed_coil_id').val() != undefined){
       
      }else{
        
      }
      
    });
</script>
@endsection         