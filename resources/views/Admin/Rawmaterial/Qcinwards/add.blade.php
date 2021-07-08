@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">(Inwards) Quality Check</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/inward">Inward</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">(Inwards) Quality Check Form</li>                                    
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

<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Finished Wire Stock Details</h4>                               
                               
                              
                                   
                                   
                                   
                                  <form class="form-horizontal"  role="form" method="POST" action="/qcinward/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('qc_id', isset($qc_details) ? $qc_details->id : '',['id'=>'qc_id']) }} 
                                    {{ Form::hidden('inward_id', isset($inward_details) ? $inward_details->id : '',['id'=>'inward_id']) }}

                                <div class="card-body">                                  
                                   
                                       <h4 class="text-center">Inwards Details</h4><br> 
                                        <div class="row col-sm-12">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group row">

                                                  <div class="table-responsive">
                                                    <table class="table table-bordered table-dark m-b-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th scope="col"><b>Inward No </b></th>
                                                            <th scope="col"><b>Inward Date(Material Receive)</b></th>
                                                            <th scope="col"><b>Invoice/Challan No.</b></th> 
                                                            <th scope="col"><b>Invoice/Challan Date :</b></th>                        
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                            <th scope="col"><b>{{$inward_details->inward_no}}</b></th>
                                                            <th scope="col"><b>  {{date('j F, Y', strtotime($inward_details->inward_date))}} </b></th>
                                                            <th scope="col"><b>{{$inward_details->invoice_no}}</b></th> 
                                                            <th scope="col"><b> {{date('j F, Y', strtotime($inward_details->invoice_date))}}       </b></th>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      <hr>
                                     <br>

                                       <div class="row">
                                         <div class="col-sm-6">
                                            <h4>Material Details</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-dark m-b-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th scope="col"><b>Vendor Name</b></th>
                                                            <th scope="col"><b>Coil Diameter</b></th>
                                                            <th scope="col"><b>Heat No.</b></th> 
                                                            <th scope="col"><b>Total Coil Weight</b></th>                        
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>         

                                                        <tr>      
                                                            <td>{{$inward_details->vendor->company_name}}</td>        
                                                            <td>{{$inward_details->coil_size->coil_size}}</td>
                                                            <td>{{$inward_details->heat_point}}</td>                                   
                                                            <td>{{$inward_details->total_weight}}</td>                                   
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>    
                                        </div>
                                         <div class="col-sm-6">
                                            <h4>Coil Details</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-dark m-b-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th scope="col"><b>Coil Weight</b></th>
                                                            <th scope="col"><b>SPBPL No.</b></th>
                                                                       
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>         
                                                          @foreach($coil_details  as $coil_data)
                                                        
                                                        <tr>      
                                                            <td>{{$coil_data->per_coil_weight}}</td>        
                                                            <td>{{$coil_data->spbpl_no}} - {{$coil_data->coil_entry_year}}</td>
                                                                                              
                                                        </tr>
                                                          @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><br>                                 

                                        
                                   
                                  

                           
                                <h4 class="text-center">RAW Material Testing Report</h4><br> 
                                <div class="row col-sm-12">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group row">
                                              <h5>(A) Chemical Composition</h5>
                                               
                                                    <table class="table col-sm-12 table-responsive form-group table-bordered table-dark m-b-0 text-center" >
                                                        <thead>
                                                            <tr > 
                                                                <th  scope="col">Specified</th> 
                                                                 <th scope="col">C %</th> 
                                                                 <th scope="col">SI %</th>
                                                                 <th scope="col">Mn %</th>                                
                                                                  <th scope="col">Cr %</th> 
                                                                  <th scope="col">S %</th> 
                                                                  <th scope="col">P %</th> 
                                                                  <th scope="col">Ni %</th> 
                                                                  <th scope="col">Mo %</th>
                                                                </b>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr> 
                                                                <th scope="col">MIN</th> 
                                                                 <th scope="col">0.93</th> 
                                                                 <th scope="col">0.15</th>
                                                                 <th scope="col">0.25</th>                                
                                                                  <th scope="col">1.35</th> 
                                                                  <th scope="col">-</th> 
                                                                  <th scope="col">-</th> 
                                                                  <th scope="col">-</th> 
                                                                  <th scope="col">-</th>
                                                                </b>
                                                            </tr>
                                                            <tr> 
                                                                <th scope="col">MAX</th> 
                                                                 <th scope="col">1.05</th> 
                                                                 <th scope="col">0.35</th>
                                                                 <th scope="col">0.45</th>                                
                                                                  <th scope="col">1.50</th> 
                                                                  <th scope="col">0.015</th> 
                                                                  <th scope="col">0.025</th> 
                                                                  <th scope="col">0.25</th> 
                                                                  <th scope="col">0.10</th>
                                                                </b>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Actual</th> 
                                                                <td ><input type="text" name="chem_c" value="{{isset($qc_details) ? $qc_details->chem_c : ''}}" style="width:90px"></td>
                                                                <td ><input type="text" name="chem_si" value="{{isset($qc_details) ? $qc_details->chem_si : ''}}" style="width:90px"></td>
                                                                <td ><input type="text" name="chem_mn" value="{{isset($qc_details) ? $qc_details->chem_mn : ''}}" style="width:90px"></td>
                                                                <td ><input type="text" name="chem_cr" value="{{isset($qc_details) ? $qc_details->chem_cr : ''}}" style="width:90px"></td>
                                                                <td ><input type="text" name="chem_s" value="{{isset($qc_details) ? $qc_details->chem_s : ''}}" style="width:90px"></td>
                                                                <td ><input type="text" name="chem_p" value="{{isset($qc_details) ? $qc_details->chem_p : ''}}" style="width:90px"></td>
                                                                <td ><input type="text" name="chem_ni" value="{{isset($qc_details) ? $qc_details->chem_ni : ''}}" style="width:90px"></td>
                                                                <td ><input type="text" name="chem_mo" value="{{isset($qc_details) ? $qc_details->chem_mo : ''}}" style="width:90px"></td>
                                                               
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                   
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                     <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <h5>(B) UTS</h5>
                                            <div class="form-group row">                                          
                                              
                                              <h5 class="text-center col-sm-3">Specification  : 68.8 - 79.03 kgf/mm2</h5>
                                              <br>
                                          </div>
                                      </div>
                                       <div class="col-sm-12 col-lg-12 ">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-2 text-right control-label col-form-label">Actual.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="uts" placeholder="Actual UTS"  value="{{isset($qc_details) ? $qc_details->uts : ''}}">
                                                     @if ($errors->has('uts'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('uts') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                      </div>

                                    <hr>
                                      <div class="row col-sm-12">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group row">
                                              <h5>(C) Micro Composition</h5>
                                               
                                                    <table class="table col-sm-12 table-responsive form-group table-bordered table-dark m-b-0 text-center" >
                                                        <thead>
                                                            <tr > 
                                                                <th  scope="col"></th> 
                                                                 <th scope="col">Specification</th> 
                                                                 <th scope="col">Actual</th>
                                                                </b>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr> 
                                                                <th scope="col">Carbide Network</th> 
                                                                 <th scope="col">CN 5.0 to 5.2</th> 
                                                                 <th scope="col"><input type="text" name="carbide_network" value="{{isset($qc_details) ? $qc_details->carbide_network : ''}}"></th>
                                                                </b>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Carbide Segrn & Banding</th> 
                                                                <td >CZ 6.0 to 6.1 & CZ 7.0 to 7.2</td>
                                                                <td ><input type="text" name="carbide_segrn" value="{{isset($qc_details) ? $qc_details->carbide_segrn : ''}}"></td>
                                                               
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                   
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                     <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <h5>(D) Marco Eatch test</h5>
                                      </div>
                                       <div class="col-sm-12 col-lg-12 ">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-2 text-right control-label col-form-label">Observation.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="eatching" placeholder="Marco Eatch observation"  value="{{isset($qc_details) ? $qc_details->eatching : ''}}">
                                                     @if ($errors->has('eatching'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('eatching') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                      </div>

                                      <hr>
                                      <div class="row col-sm-12">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group row">
                                              <h5>(E) Inclusion</h5>
                                               
                                                    <table class="table col-sm-12 table-responsive form-group table-bordered table-dark m-b-0 text-center" >
                                                        <thead>
                                                            <tr > 
                                                                <th ></th> 
                                                                 <th colspan="2">Specification</th> 
                                                                 <th colspan="2">Actual</th>
                                                                </b>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr> 
                                                                <th >Inclusion Type</th> 
                                                                 <th scope="col">Thin Series</th> 
                                                                 <th scope="col">Thick Series</th> 
                                                                 <th scope="col">Thin Series</th> 
                                                                 <th scope="col">Thick Series</th> 
                                                                </b>
                                                            </tr>
                                                             <tr> 
                                                                <th >A (Sulphides)</th> 
                                                                 <th scope="col">2.0</th> 
                                                                 <th scope="col">1.5</th>  
                                                                 <th scope="col"><input type="text" name="sulphide_thin" value="{{isset($qc_details) ? $qc_details->sulphide_thin : ''}}"></th> 
                                                                 <th scope="col"><input type="text" name="sulphide_thick" value="{{isset($qc_details) ? $qc_details->sulphide_thick : ''}}"></th> 
                                                                </b>
                                                            </tr>
                                                            <tr> 
                                                                <th >B (Alumina)</th> 
                                                                <th scope="col">2.0</th> 
                                                                 <th scope="col">1.0</th>  
                                                                 <th scope="col"><input type="text" name="alumina_thin" value="{{isset($qc_details) ? $qc_details->alumina_thin : ''}}"></th> 
                                                                 <th scope="col"><input type="text" name="alumina_thick" value="{{isset($qc_details) ? $qc_details->alumina_thick : ''}}"></th> 
                                                                </b>
                                                            </tr>
                                                            <tr> 
                                                                <th >C (silicates)</th> 
                                                                 <th scope="col">0.5</th>  
                                                                 <th scope="col">0.5</th> 
                                                                 <th scope="col"><input type="text" name="silicate_thin" value="{{isset($qc_details) ? $qc_details->silicate_thin : ''}}"></th> 
                                                                 <th scope="col"><input type="text" name="silicate_thick" value="{{isset($qc_details) ? $qc_details->silicate_thick : ''}}"></th> 
                                                                </b>
                                                            </tr>
                                                            <tr> 
                                                                <th >D (Globular)</th> 
                                                                 <th scope="col">1.0</th>  
                                                                 <th scope="col">1.0</th>  
                                                                 <th scope="col"><input type="text" name="globular_thin" value="{{isset($qc_details) ? $qc_details->globular_thin : ''}}"></th> 
                                                                 <th scope="col"><input type="text" name="globular_thick" value="{{isset($qc_details) ? $qc_details->globular_thick : ''}}"></th> 
                                                                </b>
                                                            </tr>
                                                            

                                                        </tbody>
                                                    </table>
                                                   
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                     <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <h5>(F) Decarb</h5>
                                      </div>
                                       <div class="col-sm-12 col-lg-12 ">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-2 text-right control-label col-form-label">Observation.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="decarb" placeholder="Decarb observation"  value="{{isset($qc_details) ? $qc_details->decarb : ''}}">
                                                     @if ($errors->has('decarb'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('decarb') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <hr>
                                       <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <h5>Remark</h5>
                                      </div>
                                       <div class="col-sm-12 col-lg-6 ">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-2 text-right control-label col-form-label">Testing Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="fname2" name="qc_date" placeholder="Remark"  value="{{isset($qc_details) ? $qc_details->qc_report_date : date('Y-m-d')}}">
                                                     @if ($errors->has('qc_date'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('qc_date') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6 ">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-2 text-right control-label col-form-label">Remark</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="qc_remark" placeholder="Remark"  value="{{isset($qc_details) ? $qc_details->qc_remark : ''}}">
                                                     @if ($errors->has('qc_remark'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('qc_remark') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                      </div>


                                   


                                </div>    

                                <div class="card-body">
                                    <div class="form-group m-b-0 text-center">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                        <a type="" href="{{ URL::previous() }}" class="btn btn-dark waves-effect waves-light">Cancel</a>
                                    </div>
                                </div>
                            </form>
                            
                                 
                            </div>
                        </div>
                    </div>
                </div>
@endsection        
@section('footer_scripts')
<script type="text/javascript">
    $(function() {    
      //$('#dateopen').datepicker('setDate', '23/04/2014');
    });


</script>
@endsection         