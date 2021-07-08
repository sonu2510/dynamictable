@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Finished Wire Stock</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Finished Wire Stock Index</li>                                    
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
                                <h4 class="card-title">Finished Wire Stock Index</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="finished_stock">
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>           
                                                <th class="no-sort hidden-sm-down">Coil InwardDate</th>                                   
                                                <th class="no-sort hidden-sm-down">Coil Size</th>
                                                <th class="no-sort hidden-sm-down">Spbpl No</th>
                                                <th class="no-sort hidden-sm-down">Mill</th>
                                                <th class="no-sort hidden-sm-down">Coil Weight</th>
                                                
                                               
                                              
                                               <!--  <th class="no-sort hidden-sm-down">Status</th> -->
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Inward Date</th>
                                                <th>Coil Size</th>
                                                <th>SPBPL No</th>
                                                <th>Mill</th>
                                                <th>Coil Weight</th>                                                                                         
                                            </tr>
                                        </tfoot>    
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

    $('#finished_stock tfoot th').each( function (i) {
     if(i>=1 && i<=5){
        var title = $('#finished_stock thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
        }
    } );

    var table = $('#finished_stock').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/finished_stock/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'id', name: 'id',orderable: false, searchable: false },  
            { data: 'inward_date', name: 'inward_date' },           
            { data: 'coil_data', name: 'coil_data' },
            { data: 'coil_spbpl_no', name: 'coil_spbpl_no' },
            { data: 'mill', name: 'mill' },
            { data: 'coil_size', name: 'coil_size' },
                     
         
            ],

        
    });

    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
});
</script>
@endsection 