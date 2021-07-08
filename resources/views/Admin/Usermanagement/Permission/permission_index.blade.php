@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">User Permission Management</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">                                   
                                    <li class="breadcrumb-item active" aria-current="page">User Permission Management</li>                                    
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
                                <h4 class="card-title">User List</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle" id="userdata">
                                         <thead class="thead-light">
                                            <tr>                                                 
                                                <th class="no-sort hidden-sm-down">Username</th>
                                                 <th class="no-sort hidden-sm-down">Email</th>                                             
                                                <th class="no-sort hidden-sm-down">Department</th>                                                
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
    $dataTable = $('#userdata').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '/usersdata/datatable/ajax',
            type:'GET',
        },
        aoColumns: [           
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'usertype', name: 'usertype' },
            { data: 'action', name: 'action' }
            ],

        
    });
});
</script>
@endsection 