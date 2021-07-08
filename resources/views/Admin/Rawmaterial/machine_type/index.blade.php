@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Machine Details</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Machine Index</li>                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                {!! (new \App\Helpers\Helper)->Combo_Button_add('/machine_type/new',"Machine") !!}
                            </div>
                           
                        </div>
                    </div>                   
          
        
@endsection  
@section('content')  

                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Machine Type Index</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="machine_type">
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>
                                                <th class="no-sort hidden-sm-down">Machine Type</th>
                                                <th class="no-sort hidden-sm-down">Status</th>
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
    $dataTable = $('#machine_type').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/machine_type/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'machine_type_id', name: 'machine_type_id',orderable: false, searchable: false },        
            { data: 'machine_type', name: 'machine_type' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' }
            ],

        
    });
});
</script>
@endsection 