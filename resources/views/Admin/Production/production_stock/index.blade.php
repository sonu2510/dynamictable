@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Stock</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Stock Index</li>                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                              
                            </div>
                           
                        </div>
                    </div>                   
          
        
@endsection  
@section('content')  

                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Stock Index</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="stock">
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>                                              
                                                <th class="no-sort hidden-sm-down">Ball Size Details</th>
                                                <th class="no-sort hidden-sm-down">Heading Batches</th>
                                                <th class="no-sort hidden-sm-down">Flashing Batches</th>
                                                <th class="no-sort hidden-sm-down">Grinding Batches</th>
                                                <th class="no-sort hidden-sm-down">Lapping Batches</th>
                                            
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
    $dataTable = $('#stock').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/production_stock/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'id', name: 'id',orderable: false, searchable: false },           
            { data: 'ball_size', name: 'ball_size' },
            { data: 'Heading_Batches', name: 'Heading_Batches' },
            { data: 'Flashing_Batches', name: 'Flashing_Batches' },
            { data: 'Grinding_Batches', name: 'Grinding_Batches' },         
            { data: 'Lapping_Batches', name: 'Lapping_Batches' },         
            
            ],

        
    });
});
</script>
@endsection 