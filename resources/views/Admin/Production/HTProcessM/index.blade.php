@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Heat Treatment Process</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Heat Treatment Process Monitoring Index</li>                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                {!! (new \App\Helpers\Helper)->Combo_Button_add('/ht_process/new',"Heat Treatment Process ") !!}
                            </div>
                           
                        </div>
                    </div>                   
          
        
@endsection  
@section('content')  

                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Heat Treatment Process Monitoring Index</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="ht_process">
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>                                              
                                                <th class="no-sort hidden-sm-down">Heat Treatment Date</th>
                                                <th class="no-sort hidden-sm-down">F/c No</th>
                                                <th class="no-sort hidden-sm-down">Ball size</th>
                                                <th class="no-sort hidden-sm-down">Batch no</th>
                                              
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
    $dataTable = $('#ht_process').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/ht_process/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'id', name: 'id',orderable: false, searchable: false },           
            { data: 'heat_treatment_date', name: 'heat_treatment_date' },
            { data: 'fc_no', name: 'fc_no' },
            { data: 'ball_size', name: 'ball_size' },
            { data: 'batch_no', name: 'batch_no' },         
            { data: 'action', name: 'action' }
            ],

        
    });
});
</script>
@endsection 