@if(isset($role_permission) && $role_permission != '')
@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    
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

                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                 @if(in_array(17,unserialize($role_permission->view_permission)) || (in_array(147,unserialize($role_permission->view_permission))) )
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">SAPP Stock</h4>
                                        <h5 class="card-subtitle"></h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle text-center" id="sapp">
                                        <thead class="bg-info text-white">
                                            <tr class="border-0">
                                                <th class="border-0">Coil Size</th>
                                                <th class="border-0">Available Stock</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            
                                            @php 
                                                $coildata=App\Models\RawMaterial\coil_detail::get();
                                                 //dd($data);
                                            @endphp
                                            @if(!empty($coildata) && count($coildata) > 0)
                                            @foreach($coildata  as $coil)
                                            <tr>
                                                <td>
                                                    {{$coil->coil_size}}
                                                </td>
                                                <td>
                                                    @php
                                                        $sappstock=App\Models\RawMaterial\CoilInward::select(DB::raw("SUM(per_coil_weight) as total_weight"))
                                                        ->where('coil_status',1)
                                                        ->where('coilsize_id',$coil->id)
                                                        ->first();
                                                        //print_r($sappstock);

                                                    @endphp
                                                    @if($sappstock->total_weight != '') {{$sappstock->total_weight}} KG @else --- @endif
                                                </td>                                                
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr><td colspan="2">
                                                --------------NO Record--------------
                                            </tr></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(in_array(15,unserialize($role_permission->view_permission)) || (in_array(147,unserialize($role_permission->view_permission))) )
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center ">
                                    <div>
                                        <h4 class="card-title">Finished Stock</h4>
                                        <h5 class="card-subtitle"></h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle text-center" id="finished">
                                        <thead class="bg-info text-white">
                                            <tr class="border-0">
                                                <th class="border-0">Coil Size</th>
                                                <th class="border-0">Available Stock</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @if(!empty($coildata) && count($coildata) > 0)
                                            @foreach($coildata  as $coil)
                                            <tr>
                                                <td>
                                                    {{$coil->coil_size}}
                                                </td>
                                                <td>
                                                     @php
                                                        $FinishedStockWeight=App\Http\Controllers\Admin\RawMaterial\InwardsController::getFinishedStock($coil->id);
                                                        //dd($FinishedStockWeight);
                                                       
                                                    @endphp
                                                    @if($FinishedStockWeight != '') {{$FinishedStockWeight->total_weight}} KG @else --- @endif
                                                </td>                                                
                                            </tr>
                                            @endforeach                                            
                                             @else
                                             <tr><td colspan="2">
                                                --------------NO Record--------------
                                            </tr></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                 @if(in_array(10,unserialize($role_permission->view_permission)) || (in_array(147,unserialize($role_permission->view_permission))) )
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Latest Inwards</h4>
                                        <h5 class="card-subtitle">Records</h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle">
                                        <thead class="bg-info text-white text-center">
                                            <tr class="border-0">
                                                <th class="border-0">Inward Number</th>                                                
                                                <th class="border-0">Coil Size</th>
                                                <th class="border-0">Supplier Name</th>
                                                                                              
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @php 
                                                $inward_details=App\Http\Controllers\Admin\RawMaterial\InwardsController::DashboardData();
                                                 //dd($inward_details);
                                            @endphp
                                            @if(!empty($inward_details) && count($inward_details) > 0)
                                            @foreach($inward_details  as $data)
                                            <tr>
                                                <td>
                                                    {{$data->inward_no}}<br>{{date(' d F Y', strtotime($data->invoice_date))}}
                                                </td>
                                                <td>
                                                    {{$data->coil_size->coil_size}}
                                                </td>
                                                <td>
                                                    {{$data->vendor->company_name}}
                                                </td>                                                
                                            </tr>
                                            @endforeach
                                            @else
                                             <tr><td colspan="3">
                                                --------------NO Record--------------
                                            </tr></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(in_array(20,unserialize($role_permission->view_permission)) || (in_array(147,unserialize($role_permission->view_permission))) )
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Latest Heading</h4>
                                        <h5 class="card-subtitle">Records</h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle text-center">
                                        <thead class="bg-info text-white">
                                            <tr class="border-0">
                                                <th class="border-0">Heading Details</th>
                                                <th class="border-0">Batch No</th>                                                
                                                <th class="border-0">Ball Dia</th>                                                
                                                <th class="border-0">Coil Size</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                           @php 
                                           $heading_details=App\Http\Controllers\Admin\Production\HeadingController::DashboardData();
                                                 //dd($data);
                                            @endphp
                                            @if(!empty($heading_details) && count($heading_details) > 0)
                                            @foreach($heading_details  as $data)
                                            <tr>
                                                <td>
                                                    {{$data->heading_no}}<br>{{date(' d F Y', strtotime($data->heading_date))}}
                                                </td>
                                                <td>
                                                    {{$data->heading_batch_no}}
                                                </td>
                                                <td>
                                                    {{$data->headingBall->ball_size}}
                                                </td>
                                                <td>
                                                    {{$data->processed_coil->coil_size}}
                                                </td>                                                
                                            </tr>
                                            @endforeach
                                            @else
                                             <tr><td colspan="4">
                                                --------------NO Record--------------
                                            </tr></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                @if(in_array(21,unserialize($role_permission->view_permission)) || (in_array(147,unserialize($role_permission->view_permission))) ) 
                 <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Latest Flashing</h4>
                                        <h5 class="card-subtitle">Records</h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle text-center">
                                        <thead class="bg-info text-white">
                                            <tr class="border-0">
                                                <th class="border-0">Flashing Details</th>
                                                <th class="border-0">Master No</th>                                                
                                                <th class="border-0">Ball Dia</th>        
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                           @php 
                                           $flashing_details=App\Http\Controllers\Admin\Production\FlashingController::DashboardData();
                                                 //dd($flashing_details);
                                            @endphp
                                            @if(!empty($flashing_details) && count($flashing_details) > 0)
                                            @foreach($flashing_details  as $data)
                                            <tr>
                                                <td>                                                    
                                                    {{$data->flashing_no}}<br>{{date(' d F Y', strtotime($data->flashing_date))}}
                                                </td>
                                                <td>
                                                    {{$data->master_batch_no}}
                                                </td>
                                                <td>
                                                    {{$data->Ball_data->ball_size}}
                                                </td>                                                                                            
                                            </tr>
                                            @endforeach
                                            @else
                                             <tr><td colspan="4">
                                                --------------NO Record--------------
                                            </tr></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endif
                      @if(in_array(22,unserialize($role_permission->view_permission)) || (in_array(147,unserialize($role_permission->view_permission))) ) 
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Latest Grinding</h4>
                                        <h5 class="card-subtitle">Records</h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle text-center">
                                        <thead class="bg-info text-white">
                                            <tr class="border-0">
                                                <th class="border-0">Grinding Details</th>
                                                <th class="border-0">Master No</th>                                                
                                                <th class="border-0">Ball Dia</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                           @php 
                                           $grinding_details=App\Http\Controllers\Admin\Production\GrindingController::DashboardData();
                                                 //dd($data);
                                            @endphp
                                            @if(!empty($grinding_details) && count($grinding_details) > 0)
                                            @foreach($grinding_details  as $data)
                                            <tr>
                                                <td>
                                                    {{$data->grinding_no}}<br>{{date(' d F Y', strtotime($data->grinding_date))}}
                                                </td>
                                                <td>
                                                    {{$data->masterbatch_data->master_batch_no}}
                                                </td>
                                                <td>
                                                    {{$data->balldia_data->ball_size}}
                                                </td>                                                                                              
                                            </tr>
                                            @endforeach
                                            @else
                                             <tr><td colspan="4">
                                                --------------NO Record--------------
                                            </tr></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                 <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                  @if(in_array(23,unserialize($role_permission->view_permission)) || (in_array(147,unserialize($role_permission->view_permission))) )
                 <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Latest Lapping</h4>
                                        <h5 class="card-subtitle">Records</h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle text-center">
                                        <thead class="bg-info text-white">
                                            <tr class="border-0">
                                                <th class="border-0">Lapping Details</th>
                                                <th class="border-0">Master No</th>                                                
                                                <th class="border-0">Ball Dia</th>       
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                           @php 
                                           $lapping_details=App\Http\Controllers\Admin\Production\LappingController::DashboardData();
                                                 //dd($data);
                                            @endphp
                                            @if(!empty($lapping_details) && count($lapping_details) > 0)
                                            @foreach($lapping_details  as $data)
                                            <tr>
                                                <td>
                                                    {{$data->lapping_no}}<br>{{date(' d F Y', strtotime($data->lapping_date))}}
                                                </td>
                                                <td>
                                                    {{$data->masterbatch_data->master_batch_no}}
                                                </td>
                                                <td>
                                                    {{$data->balldia_data->ball_size}}
                                                </td>                                                                                          
                                            </tr>
                                            @endforeach
                                            @else
                                             <tr><td colspan="4">
                                                --------------NO Record--------------
                                            </tr></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                   <!--  <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Latest Grinding</h4>
                                        <h5 class="card-subtitle">Records</h5>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle text-center">
                                        <thead class="bg-info text-white">
                                            <tr class="border-0">
                                                <th class="border-0">Heading Details</th>
                                                <th class="border-0">Batch No</th>                                                
                                                <th class="border-0">Ball Dia</th>                                                
                                                <th class="border-0">Coil Size</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                           @php 
                                           $heading_details=App\Http\Controllers\Admin\Production\HeadingController::DashboardData();
                                                 //dd($data);
                                            @endphp
                                            @if(!empty($heading_details))
                                            @foreach($heading_details  as $data)
                                            <tr>
                                                <td>
                                                    {{$data->heading_no}}<br>{{date(' d F Y', strtotime($data->heading_date))}}
                                                </td>
                                                <td>
                                                    {{$data->heading_batch_no}}
                                                </td>
                                                <td>
                                                    {{$data->headingBall->ball_size}}
                                                </td>
                                                <td>
                                                    {{$data->processed_coil->coil_size}}
                                                </td>                                                
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                --------------NO Record--------------
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            
@endsection
@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function() {
    $('#sapp').DataTable( {
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    } );
    $('#finished').DataTable( {
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    } );
} );
</script>
@endsection
@else
<script>window.location = "/404";</script>  
@endif      
          