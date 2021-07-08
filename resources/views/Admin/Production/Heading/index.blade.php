@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Heading</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Heading Index</li>                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                {!! (new \App\Helpers\Helper)->Combo_Button_add('/heading/new',"heading") !!}
                            </div>
                           
                        </div>
                    </div>                   
          
        
@endsection  
@section('content')  

                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Heading Index</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="heading">
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>                                              
                                                <th class="no-sort hidden-sm-down">Heading Details</th>
                                                <th class="no-sort hidden-sm-down">Batch No</th>
                                                <th class="no-sort hidden-sm-down">Ball Details</th>
                                                <th class="no-sort hidden-sm-down">Coil Details</th>
                                              
                                               <!--  <th class="no-sort hidden-sm-down">Status</th> -->
                                                <th class="no-sort hidden-sm-down">Action</th>
                                            </tr>
                                        </thead>
                                            
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

@endsection 
@section('footer_scripts')
<script>

$(document).ready(function(){
    //alert("index");
})

$(function() {
    $dataTable = $('#heading').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/heading/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'id', name: 'id',orderable: false, searchable: false },           
            { data: 'heading_data', name: 'heading_data' },
            { data: 'heading_batch', name: 'heading_batch' },
            { data: 'ball_details', name: 'ball_details' },
            { data: 'coil_details', name: 'coil_details' },         
            { data: 'action', name: 'action' }
            ],

        
    });
});
</script>
@endsection 