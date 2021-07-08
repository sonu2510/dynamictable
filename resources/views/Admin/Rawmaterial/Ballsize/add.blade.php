@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Ball Diameter</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/ballsize">Ball Diameter</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Ball Diameter Add</li>                                    
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
                                <h4 class="card-title">Form</h4>                               
                               
                                  <form class="m-t-30" role="form" method="POST" action="/ballsize/save" enctype="multipart/form-data">

                                    {!! csrf_field() !!}
                                    {{ Form::hidden('id', isset($ball_data) ? $ball_data->id : '') }}
                                   
                                <div class="card-body">                                    
                                   
                                 <div class="row p-t-20">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ball Size</label>
                                                <input type="text" class="form-control" name="ball_size" id="exampleInputEmail1" aria-describedby="Usertype" placeholder="Enter Ball Size" required="" value="{{isset($ball_data) ? $ball_data->ball_size : ''}}">

                                                @if ($errors->has('ball_size'))
                                                        <span class="help-block" style="color: red;">
                                                                <strong>{{ $errors->first('ball_size') }}</strong>
                                                            </span>
                                                 @endif                                        
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ball Batch Number</label>
                                                <input type="text" class="form-control" name="ball_batch_no" id="exampleInputEmail1" aria-describedby="Usertype" placeholder="Enter Ball Batch No" required="" value="{{isset($ball_data) ? $ball_data->ball_batch_no : ''}}">

                                                @if ($errors->has('ball_batch_no'))
                                                        <span class="help-block" style="color: red;">
                                                                <strong>{{ $errors->first('ball_batch_no') }}</strong>
                                                            </span>
                                                 @endif                                        
                                            </div>
                                        </div>

                                          <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                                            <option value="1" @if(isset($ball_data) && $ball_data->status==1)  selected  @endif>Active</option>
                                                            <option value="0" @if(isset($ball_data) && $ball_data->status==0)  selected  @endif>Inactive</option>
                                                            
                                                        </select>
                                                     </div>  
                                             </div>  
                                    </div>  




                                          <div class="row p-t-20">                                               
                                                <h4 > HEADING SPECIFICATION</h4>
                                                <table class="table table-dark m-b-0 text-center" border="1" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" colspan="2" >Equator Dia (mm)</th>    
                                                        <th scope="col" colspan="2">Pole Dia (mm)</th>                  
                                                        <th scope="col">Offset Max.  in (Micron)</th>        
                                                        <th scope="col" colspan="2">Weight of 100 Balls In gram</th>  
                                                        <th scope="col" colspan="2" >Number of balls / KG</th>                                                        
                                                      
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td>Equator Dia (mm)</td>
                                                        <td>Equator Tolerance are in (Micron)</td>
                                                        <td>Pole Dia (mm)</td>
                                                        <td>Pole Tolerance are in (Micron)</td>
                                                        <td></td>
                                                        <td>Minimum</td>
                                                        <td>Maximum</td>
                                                        <td>Minimum</td>
                                                        <td>Maximum</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control"  placeholder="Equator Dia" name="hs_equator_dia"  value="{{isset($ball_data) ? $ball_data->hs_equator_dia : ''}}"></td>

                                                        <td><input type="text" class="form-control"  placeholder="Equator Tolerance are in (Micron)" name="hs_equator_tolerance"  value="{{isset($ball_data) ? $ball_data->hs_equator_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Pole Dimension"   name="hs_pole_dimension" value="{{isset($ball_data) ? $ball_data->hs_pole_dimension : ''}}"></td>

                                                          <td><input type="text" class="form-control" placeholder="Pole Tolerance are in (Micron)"   name="hs_pole_tolerance" value="{{isset($ball_data) ? $ball_data->hs_pole_tolerance : ''}}"></td>

                                                        <td><input type="text" class="form-control" placeholder="Offset Max.  in (Micron)"  name="hs_offset"   value="{{isset($ball_data) ? $ball_data->hs_offset : ''}}" ></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Weight of 100 Balls In gram (MIN)" name="hs_weight_min"   value="{{isset($ball_data) ? $ball_data->hs_weight_min : ''}}" ></td>

                                                         <td><input type="text" class="form-control" placeholder="Weight of 100 Balls In gram (MAX)" name="hs_weight_max"   value="{{isset($ball_data) ? $ball_data->hs_weight_max : ''}}" ></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Number of balls / KG (MIN)" name="hs_total_balls_min"  value="{{isset($ball_data) ? $ball_data->hs_total_balls_min : ''}}" ></td>

                                                        <td><input type="text" class="form-control" placeholder="Number of balls / KG (MAX)" name="hs_total_balls_max"  value="{{isset($ball_data) ? $ball_data->hs_total_balls_max : ''}}" ></td>
                                                    </tr>
                                                </tbody>
                                            </table>                                            
                                         
                                       </div>
                                          <div class="row p-t-20">                                               
                                                <h4 > FLASHING SPECIFICATION</h4>
                                                <table class="table table-dark m-b-0 text-center" border="1" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">UNLOAD SIZE IN (µm)</th>
                                                        <th scope="col">Tolarance (µm)</th>        
                                                        <th scope="col">OVALITY / O.D. VERY. MAX. (µm)</th>      
                                                        <th scope="col">LOT Variation (µm)</th>        
                                                      
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" class="form-control"  placeholder="Unloading Gauge" name="fs_unloading_gauge"  value="{{isset($ball_data) ? $ball_data->fs_unloading_gauge : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Tolarance (µm)"   name="fs_tolerance" value="{{isset($ball_data) ? $ball_data->fs_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="OVALITY / O.D. VERY. MAX. (µm)"  name="fs_ovality"   value="{{isset($ball_data) ? $ball_data->fs_ovality : ''}}" ></td>                                                   
                                                                                                            
                                                        <td><input type="text" class="form-control" placeholder="LOT Variation (µm)" name="fs_lot_variation"  value="{{isset($ball_data) ? $ball_data->fs_lot_variation : ''}}" ></td>   
                                                        
                                                                                                           
                                                    </tr>
                                                </tbody>
                                            </table>                                            
                                         
                                       </div>
                                         <div class="row p-t-20">                                               
                                                <h4 > GRINDING SPECIFICATION</h4>
                                                <table class="table table-dark m-b-0 text-center" border="1" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">UNLOAD SIZE IN (µm)</th>
                                                        <th scope="col">Tolarance (µm)</th>        
                                                        <th scope="col">OVALITY / O.D. VERY. MAX. (µm)</th>      
                                                        <th scope="col">LOT Variation (µm)</th>      
                                                      
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                     <tr>
                                                        <td><input type="text" class="form-control"  placeholder="Unloading Gauge" name="gs_unloading_gauge"  value="{{isset($ball_data) ? $ball_data->gs_unloading_gauge : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Tolarance (µm)"   name="gs_tolerance" value="{{isset($ball_data) ? $ball_data->gs_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="OVALITY / O.D. VERY. MAX. (µm)"  name="gs_ovality"   value="{{isset($ball_data) ? $ball_data->gs_ovality : ''}}" ></td>                                                   
                                                                                                            
                                                        <td><input type="text" class="form-control" placeholder="LOT Variation (µm)" name="gs_lot_variation"  value="{{isset($ball_data) ? $ball_data->gs_lot_variation : ''}}" ></td>   
                                                        
                                                                                                           
                                                    </tr>
                                                </tbody>
                                            </table>                                            
                                         
                                       </div>   

                                         <div class="row p-t-20">                                               
                                                <h4 > Lapping SPECIFICATION</h4>
                                                <table class="table table-dark m-b-0 text-center" border="1" id="coil_data">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">UNLOAD SIZE IN (µm)</th>
                                                        <th scope="col">Tolarance (µm)</th>        
                                                        <th scope="col">OVALITY / O.D. VERY. MAX. (µm)</th>      
                                                        <th scope="col">LOT Variation (µm)</th>      
                                                      
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                     <tr>
                                                        <td><input type="text" class="form-control"  placeholder="Unloading Gauge" name="ls_unloading_gauge"  value="{{isset($ball_data) ? $ball_data->ls_unloading_gauge : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="Tolarance (µm)"   name="ls_tolerance" value="{{isset($ball_data) ? $ball_data->ls_tolerance : ''}}"></td>                                                    
                                                        <td><input type="text" class="form-control" placeholder="OVALITY / O.D. VERY. MAX. (µm)"  name="ls_ovality"   value="{{isset($ball_data) ? $ball_data->ls_ovality : ''}}" ></td>                                                   
                                                                                                            
                                                        <td><input type="text" class="form-control" placeholder="LOT Variation (µm)" name="ls_lot_variation"  value="{{isset($ball_data) ? $ball_data->ls_lot_variation : ''}}" ></td>   
                                                        
                                                                                                           
                                                    </tr>
                                                </tbody>
                                            </table>                                            
                                         
                                       </div>   
                                     </div>


                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection                 