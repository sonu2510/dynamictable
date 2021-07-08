@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dynamic Table</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dynamictable">Dynamic Table</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dynamic Table New </li>                                    
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
                                <h4 class="card-title">Create Table </h4>                               
                               
                                  <form class="m-t-30" role="form" method="POST" action="/dynamictable/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                     <div class="row">
                                          <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Table Name</label>
                                                <div class="col-sm-9"> 
                                               <input type="text"  class="form-control" placeholder="Table Name"  name="table_name"   value="{{isset($table_name) ? $table_name: ''}}" ></div>
                                     </div>
                                    {{ Form::hidden('current_name', isset($table_name) ? $table_name : '',['id'=>'table_name']) }}
                                   
                                
                                         <div class="row table-responsive">
                                            <h5>Table Column</h5>
                                            <table class="table table-dark m-b-0" id="dynamic_data">
                                            <thead>
                                                <tr class="text-center">
                                                    <th >Column Name</th>                                                 
                                                    <th >Column Type</th>                                                 
                                                    <th >Column Length</th>                                                 
                                                    <th >Default [ Null ]</th>                                                 
                                                    <th >Index</th>                                                 
                                                          <th >Action 
                                                        @if(isset($table_column))
                                                        <button type="button" id="add_column" class="btn btn-info float-right"><i class="mdi mdi-plus"></i> ADD</button>
                                                        @endif
                                                  
                                                    </th>
                                                </tr>
                                            </thead>                                          
                                           @if(!isset($table_column))
                                            <tbody id="new">
                                                
                                                @php 
                                                 $i=1;
                                                @endphp
                                                <tr id="obs_data_{{$i}}" class="new" data-id="{{$i}}">
                                                    <td >                                                  
                                                
                                                    <input type="Text" class="form-control" required id="column_name_{{$i}}" name="column_name[]" placeholder="Column name" >
                                                    <input type="hidden" class="form-control"  name="old_column_name[]" >
                                                    </td> 
                                                     <td >                                                  
                                                
                                                       <select class="custom-select col-12" name="column_type[]" id="column_type_{{$i}}"  required placeholder="Column Tpe">
                                                            <option value="">Select Type</option>
                                                            @foreach($types as $key=>$value)                                    
                                                                   <option value="{{$value}}">{{$value}}</option>
                                                             @endforeach 
                                                        </select>
                                                        <input type="hidden" class="form-control"  name="old_column_type[]" >
                                                    </td>    
                                                    <td >                                                  
                                                
                                                    <input type="Text" class="form-control"  id="length_{{$i}}" name="length[]" placeholder="Length">
                                                    <input type="hidden" class="form-control"  name="old_length[]" >

                                                    </td>    
                                                    <td >                                                  
                                                      <input type="hidden" class="form-control"  name="old_default[]" >  
                                                  <select class="custom-select col-12" name="default[]" id="default_{{$i}}"  > 
                                                    
                                                         <option value="No">No</option>  
                                                        <option value="Yes">Yes</option>  
                                                       </select>
                                                  
                                                    </td>   
                                                     <td >                                                  
                                                    <input type="hidden" class="form-control"  name="old_index[]" > 
                                                     <select class="custom-select col-12" name="index[]" id="index_{{$i}}"  > 
                                                        <option value="">No </option>  
                                                         <option value="PRIMARY">PRIMARY</option>  
                                                        <option value="UNIQUE">UNIQUE</option>  
                                                       </select>
                                                    </td> 
                                                    <td><button type="button" id="add_column" class="btn btn-info"><i class="mdi mdi-plus"></i> ADD</button>
                                                    </td>
                                                </tr>

                                                                                                                                      
                                            </tbody>

                                            @else                                            
                                            <tbody id="save">

                                            </tbody>


                                             @endif  
                                        </table>
                                    </div>
<br><br>
                                            <div class="row">
                                          <label for="fname2" class="col-sm-3 text-right control-label col-form-label"></label>
                                                <div class="col-sm-9"> 

                                            <button type="submit" class="btn btn-primary">Submit</button>
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

$(document).ready(function(){
    //alert("index");
    var table_name=$('#table_name').val();
   if(table_name != ''){      


     $.ajax({
              url: '/GetaddedColumnData/ajax/',
              type: "get",
              data:{table_name:table_name},
              dataType:"json",
              success:function(res) {
               
                    if(res != ''){
                    var html='';
                    var incr=1;
                    $.each(res, function(key, value) 
                        {
                         
                            var column_type=getcolumn_type(table_name,value,incr);
                              
                        html+='<tr id="obs_data_'+incr+'" class="new" data-id="'+incr+'">' 

                                +'<td> <input type="text" class="form-control" value="'+value+'"  id="column_name_'+incr+'" name="column_name[]" required="" placeholder="Column name">'
                                +'</td>'
                                 +'<td> '
                                  +'<select class="custom-select col-12" name="column_type[]" id="column_type_'+incr+'"  required>' 
                                        +'<option value="">Select Type</option>'
                                        @foreach($types as $key=>$value)                                    
                                               +'<option value="{{$value}}">{{$value}}</option>'
                                         @endforeach 
                                        +'</select>'
                                +'</td>'
                                  +'<td >'           
                                    +' <input type="hidden" class="form-control" value="'+value+'" id="old_column_name_'+incr+'"  name="old_column_name[]" >'
                                    +' <input type="hidden" class="form-control"  id="old_column_type_'+incr+'"  name="old_column_type[]" >'
                                    +' <input type="hidden" class="form-control"  id="old_length_'+incr+'"  name="old_length[]" >'
                                    +' <input type="text" class="form-control" id="length_'+incr+'" name="length[]"  placeholder="Length">'
                                    +'</td>' 
                                     +'<td >'           
                                    +'    <input type="hidden" class="form-control"  id="old_default_'+incr+'"  name="old_default[]" >'
                                    +'    <select class="custom-select col-12" name="default[]" id="default_'+incr+'"  >  <option value="No">No</option><option value="Yes">Yes</option></select>'
                                    +'</td>'
                                     +'<td >'           
                                    +'   <input type="hidden" class="form-control"    id="old_index_'+incr+'"   name="old_index[]" >'
                                    +'   <select class="custom-select col-12" name="index[]" id="index_'+incr+'"  >   <option value="">No</option> <option value="PRIMARY">PRIMARY</option>  <option value="UNIQUE">UNIQUE</option>  </select>'
                                    +'</td>'

                                   +'<td><button type="button" id="delete_obs" value="'+incr+'" data-id="'+value+'" class="btn btn-danger"><i class="mdi mdi-delete-empty"></i> Delete</button></td></tr>';
                                    incr++;

                        });
                       // alert(html);
                      $("#dynamic_data tbody#save").append(html);  
                    }

                    }
            })   












       
}

});


function getcolumn_type(table_name,column_name,incr){

      $.ajax({
              url: '/GetColumnType/ajax/',
              type: "get",
              data:{table_name:table_name,column_name:column_name},
              dataType:"json",
              success:function(res) {
                 
                //   alert(res.Default);

                   $('#column_type_'+incr).val(res.columnType);
                   $('#old_column_type_'+incr).val(res.columnType);
                   $('#old_length_'+incr).val(res.Length);                  
                   $('#length_'+incr).val(res.Length);                  
                    
                   if(res.Default == null && res.autoincrement==false){ 
                      $('#default_'+incr+' option[value="Yes"]').attr("selected", "selected");
                      $('#old_default_'+incr).val("Yes");
                   }else{                
                      $('#default_'+incr+' option[value="No"]').attr("selected", "selected");
                        $('#old_default_'+incr).val("No");
                   }
               
                    if(res.autoincrement==true){
                     $('#index_'+incr+' option[value="PRIMARY"]').attr("selected", "selected");
                     $('#index_'+incr).attr("readonly", "readonly");
                       $('#old_index_'+incr).val("PRIMARY");

                    }else{
                         $('#index_'+incr+' option[value=""]').attr("selected", "selected");
                           $('#old_index_'+incr).val("");
                    }

                }
            })   
}


    
   

   $(document).on('click','#add_column',function(){
      
   var obs_n_val=$('#dynamic_data tbody tr.new').length;
   var obs_no_val=parseInt($('#dynamic_data tbody tr:last').attr("data-id"));
   //alert($('#coil_data tbody tr.new').length);
   //alert(coil_nval);
   var obs_no=obs_no_val+1;
   var html='<tr id="obs_data_'+obs_no+'" class="new" data-id="'+obs_no+'">'
             +'<td >'           
            +' <input type="text" class="form-control" id="column_name_'+obs_no+'" name="column_name[]" required="" placeholder="Column name">'
            +' <input type="hidden" class="form-control"  name="old_column_name[]" >'
            +'</td>'
            +'<td >'           
                +'<input type="hidden" class="form-control"  name="old_column_type[]" >' 
                +'<select class="custom-select col-12" name="column_type[]" id="column_type_'+obs_no+'"  required>' 
                    +'<option value="">Select Type</option>'
                    @foreach($types as $key=>$value)                                    
                           +'<option value="{{$value}}">{{$value}}</option>'
                     @endforeach 
                    +'</select>'
            +'</td>' 
             +'<td >'           
            +' <input type="hidden" class="form-control"  name="old_length[]" >'
            +' <input type="text" class="form-control" id="length_'+obs_no+'" name="length[]"  placeholder="Length">'
            +'</td>' 
             +'<td >'           
            +'    <input type="hidden" class="form-control"  name="old_default[]" >'
            +'    <select class="custom-select col-12" name="default[]" id="default_'+obs_no+'"  >  <option value="No">No</option><option value="Yes">Yes</option></select>'
            +'</td>'
             +'<td >'           
            +'   <input type="hidden" class="form-control"  name="old_index[]" >'
            +'   <select class="custom-select col-12" name="index[]" id="index_'+obs_no+'"  >   <option value="">NO</option> <option value="PRIMARY">PRIMARY</option>  <option value="UNIQUE">UNIQUE</option>  </select>'
            +'</td>'

               +'<td><button type="button" id="remove_obs" value="'+obs_no+'"  class="btn btn-danger"><i class="mdi mdi-minus"></i> Remove</button></td></tr>';
     // alert($('#table_name').val());   
     if($('#table_name').val() == ''){
        $("#dynamic_data tbody#new").append(html);
     }else{
        $("#dynamic_data tbody#save").append(html);
     }          
    
 })   

 $(document).on('click','#remove_obs',function(){
   var tr_id=($(this).val());
   $('table#dynamic_data tr#obs_data_'+tr_id+'').remove();   
 })  

$(document).on('click','#delete_obs',function(){
    var tr_id=($(this).val());  
    var column_name=$('#column_name_'+tr_id).val();
    var table_name=$('#table_name').val();
    if(column_name != ''){
        if (confirm('Are you sure ?')) {
             $.ajax({
                  url: '/delete_ColumnData/ajax/',
                  type: "get",
                  data:{table_name:table_name,column_name:column_name},
                  dataType:"json",
                  success:function(res) {
                 
                   // alert('Success');
                    $('table#dynamic_data tr#obs_data_'+tr_id+'').remove();  
                  
                  }

              })
      }
 }
});




</script>
@endsection   