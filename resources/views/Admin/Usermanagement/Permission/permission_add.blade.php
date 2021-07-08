@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Permission</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">                                   
                                    <li class="breadcrumb-item active" aria-current="page">Permission Management</li>                                    
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
   
      <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
					
                    <div class="ibox">
                        <div class="ibox-title">
                            <h4>{{ucfirst(Auth()->user()->name)}}</h4>
                            <h5>Permission</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                               
                            </div>
						 <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Permission\Userpermissioncontroller@SavePermission') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}

                             {{Form::hidden('user_id', isset($userid) ? $userid->id : '')}}
							 {{Form::hidden('user_type_id', isset($userid) ? $userid->user_type_id : '')}}
							 {{Form::hidden('role_permission_id', isset($role_perm) ? $role_perm->role_permission_id : '')}}
                            <div class="project-list" id="addscroll">

									<table class="table table-hover" id="permission" >
									<thead>
                                    <th>Menu Name </th>
									<th>Create  </th>
									<th>Edit </th>
									<th>View </th>
									<th>Delete </th>
									<th>Check All </th>
									</thead>
                                    <tbody >
									@php $n=1; @endphp
									@foreach($menulist as $menuitems)
                                    <tr>
									
                                        
                                        <td class="project-title">
                                            <a href="project_detail.html">{{$menuitems->title}}</a>
                                            <br>
                                            <small>{{$menuitems->created_at}}</small>
                                        </td>
                                                                                
                                                                                      
										<td>
                                        <span class="project-title">
										<label> <input type="checkbox" class="check_{{$n}}" name="add_permission[]" value="{{$menuitems->admin_id}}" id="{{$menuitems->admin_id}}"
                                            @php if($role_perm){if(in_array($menuitems->admin_id,unserialize($role_perm->add_permission))){echo "checked";}else{echo "";}} @endphp>
                                            Create
                                        </span>
                                       
										
                                    </td>
									<td>
                                        <span class="project-title">
										<label> <input type="checkbox" class="check_{{$n}}" name="edit_permission[]" value="{{$menuitems->admin_id}}" id="{{$menuitems->admin_id}}"
                                             @php if($role_perm){if(in_array($menuitems->admin_id,unserialize($role_perm->edit_permission))){echo "checked";}else{echo "";}} @endphp>
                                           
                                            Edit
                                        </span>
                                             </td>
									<td>
                                        <span class="project-title">
										<label> <input type="checkbox" class="check_{{$n}}" name="view_permission[]" value="{{$menuitems->admin_id}}" id="{{$menuitems->admin_id}}"
                                             @php if($role_perm){if(in_array($menuitems->admin_id,unserialize($role_perm->view_permission))){echo "checked";}else{echo "";}} @endphp>
                                                                                      
										   View
										
                                        </span>
                                     </td>
									<td>
                                        <span class="project-title	">
										<label> <input type="checkbox" class="check_{{$n}}" name="delete_permission[]" value="{{$menuitems->admin_id}}" id="{{$menuitems->admin_id}}"
                                             @php if($role_perm){if(in_array($menuitems->admin_id,unserialize($role_perm->delete_permission))){echo "checked";}else{echo "";}} @endphp>
                                           
                                            Delete
                                        </span>
                                     </td>
									 <td >
                                        <span class="project-title"  >
										<label> <input type="checkbox" class="all_{{$n}}"  onChange="selectall({{$n}});" id="checkAll_{{$n}}" value="{{$menuitems->admin_id}}"
                                            @php if($role_perm){if(in_array($menuitems->admin_id,unserialize($role_perm->view_permission)) && in_array($menuitems->admin_id,unserialize($role_perm->edit_permission)) && in_array($menuitems->admin_id,unserialize($role_perm->add_permission)) && in_array($menuitems->admin_id,unserialize($role_perm->delete_permission))){echo "checked";}else{echo "";}} @endphp >
                                           All
                                        </span>
                                     </td>
                                      
                                   
                                    </tr>
									@php $n++; @endphp
									@endforeach
                                   
                                    </tbody>
                                </table>
								
                        </div>  
                        <br><br><br>
                         <div class="form-group">
                                <div class="col-lg-8">

                          
                                  
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                              
                                    
                                </div>          
				
                   </form>		
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('footer_scripts')
<script type="text/javascript">


function selectall(value){
	//alert(value);
	//$('.check_'value':checkbox:checked');
	if($("#checkAll_"+value).prop('checked') == true){
			
					$(".check_"+value).prop('checked', true);
					//alert("check all");
   		
	  	   
	}else if($("#checkAll_"+value).prop('checked') == false){
		//alert("not checked");
			//alert("XXXXXXXXXXXXXXXXXX");
					$(".check_"+value).prop('checked', false);
		
		
	}
	
}


  $(function() {
    $('#permission').DataTable();
});

</script> 

<!--
<script type="text/javascript">

       
$('#checkAll').click(function(){
var i=$('#checkAll').val();
//alert(i);
     if ($('#checkAll').prop('checked') == true) {
        
            alert('hiiii');
              //$('.icheckbox_square-green').addClass('checked');
              $('.check_'+i).prop('checked', true);
                $(this).val('UnselectAll');
            } else {
                alert('sdsf');
                //$('.icheckbox_square-green').removeClass("checked");
                $('.check_'+i).prop('checked', false);
                //$(this).val('SelectAll');
            }
    });

    </script>-->
@endsection