@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Inward(Under Process)</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Inward (Under Process) Index</li>                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                {!! (new \App\Helpers\Helper)->Combo_Button_add('/inward_underprocess/new'," ") !!}
                            </div>
                           
                        </div>
                    </div>                   
          
        
@endsection  
@section('content')  

                <div class="row">
                      <div class="m-r-10 float-right">
                                <button type="button" class="btn waves-effect inp waves-light btn-primary">Index</button>
                                <button type="button" class="btn waves-effect fi waves-light btn-secondary">Peding Inward List</button>
                                         </div>
                    <div class="col-sm-12 col-lg-12" id="table1">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Inward Index (Under Process) List</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="inward" >
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox" >
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>                                              
                                                <th class="no-sort hidden-sm-down">Index Number</th>
                                                <th class="no-sort hidden-sm-down">Coils</th>
                                                <th class="no-sort hidden-sm-down">Mill</th>
                                              
                                               <!--  <th class="no-sort hidden-sm-down">Status</th> -->
                                                <th class="no-sort hidden-sm-down">Action</th>
                                                <th class="no-sort hidden-sm-down">Post By</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Under Processing No</th>
                                                <th>Coil Size</th>
                                                <th>Mill</th>
                                                <th></th>                                             
                                                <th></th>                                             
                                            </tr>
                                        </tfoot>
                                            
                                    </table>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12" id="table2" style="display:none">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pending (In Process) List</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="finished" >
                                         <thead class="thead-light">
                                            <tr>
                                                 <th><div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="select_all custom-control-input" id="customCheck" value="">
                                                            <label class="select_all custom-control-label" for="customCheck"></label>
                                                        </div>
                                                </th>                                              
                                                <th class="no-sort hidden-sm-down">Index Number</th>
                                                <th class="no-sort hidden-sm-down">Coils</th>
                                                <th class="no-sort hidden-sm-down">Mill</th>
                                              
                                               <!--  <th class="no-sort hidden-sm-down">Status</th> -->
                                                <th class="no-sort hidden-sm-down">Action</th>
                                                <th class="no-sort hidden-sm-down">Post By</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Under Processing No</th>
                                                <th>Coil Size</th>
                                                <th>Mill</th>
                                                <th></th>                                              
                                                <th></th>                                              
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


     $('#inward tfoot th').each( function (i) {
     if(i>=1 && i<=3){
        var title = $('#inward thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
        }
    } );
  


    var table = $('#inward').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/inward_underprocess/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'id', name: 'id',orderable: false, searchable: false },           
            { data: 'invoice_data', name: 'invoice_data' },
           { data: 'coils', name: 'coils' },
           { data: 'mill', name: 'mill' },
         
            { data: 'action', name: 'action' },
            { data: 'posted_by', name: 'posted_by' }
            ],

        
    });

    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
  
});
$('.inp').click(function(){
$('#inward').DataTable().ajax.reload();
$("#table1").css("display", "inline");
$("#inward").css("width", "100%");
$("#table2").css("display", "none");

})

$('.fi').click(function(){
$('#finished').DataTable().ajax.reload();
$("#table2").css("display", "inline");
$("#finished").css("width", "100%");
$("#table1").css("display", "none");
})

$(function() {    


     $('#finished tfoot th').each( function (i) {
     if(i>=1 && i<=3){
        var title = $('#finished thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
        }
    } );
  

    var table = $('#finished').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
              url : '/finished/datatable/ajax',
            type:'GET',
        },
        aoColumns: [
            { data: 'id', name: 'id',orderable: false, searchable: false },           
            { data: 'invoice_data', name: 'invoice_data' },
           { data: 'coils', name: 'coils' },
              { data: 'mill', name: 'mill' },
            { data: 'action', name: 'action' },
            { data: 'posted_by', name: 'posted_by'}
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