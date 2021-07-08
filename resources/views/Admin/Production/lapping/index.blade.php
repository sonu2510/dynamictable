@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Lapping</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Lapping Index</li>                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                {!! (new \App\Helpers\Helper)->Combo_Button_add('/lapping/new',"lapping") !!}
                            </div>
                           
                        </div>
                    </div>                   
          
        
@endsection  
@section('content')  

                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Lapping Index</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="lapping">
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>                                              
                                                <th class="no-sort hidden-sm-down">Lapping Details</th>
                                                <th class="no-sort hidden-sm-down">Master Batch No</th>
                                                <th class="no-sort hidden-sm-down">Ball Details</th>
                                                <th class="no-sort hidden-sm-down">Flashing Details</th>
                                              
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
    $dataTable = $('#lapping').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/lapping/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'id', name: 'id',orderable: false, searchable: false },           
            { data: 'lapping_data', name: 'lapping_data' },
            { data: 'master_batch', name: 'master_batch' },
            { data: 'ball_details', name: 'ball_details' },
            { data: 'grinding', name: 'grinding' },         
            { data: 'action', name: 'action' }
            ],

        
    });
});


    $(document).ready(function (e) {
        if (e.keyCode === 27) {
            $('#"' + table_id + '" tbody input[type="checkbox"]').prop('checked',
                false);
            $('.select_all').prop('checked', false);
        }
        $(document).on('click', '.select_all', function () {
            alert('asd');
            if ($(this).is(':checked', true)) {
                $('#' + table_id + ' tbody input[type="checkbox"]').prop('checked', this.checked);
            } else {
                $('#' + table_id + ' tbody input[type="checkbox"]').prop('checked', this.checked);
            }
        });
    });
    // esc

</script>
@endsection 