@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Coil Data</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/coildetail">Coil Details</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Coil Add</li>                                    
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
                               
                                  <form class="m-t-30" role="form" method="POST" action="/coildetail/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('coil_id', isset($coildetails) ? $coildetails->id : '') }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Coil Size</label>
                                        <input type="text" class="form-control" name="coil_size" id="exampleInputEmail1" aria-describedby="Usertype" placeholder="Enter Coil Size" required="" value="{{isset($coildetails) ? $coildetails->coil_size : ''}}">

                                        @if ($errors->has('coil_size'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('coil_size') }}</strong>
                                                    </span>
                                         @endif                                        
                                    </div>  <div class="form-group">
                                        <label for="exampleInputEmail1">Coil Number</label>
                                        <input type="text" class="form-control" name="coil_number" id="coil_number" aria-describedby="Usertype" placeholder="Enter Coil NUmber" required="" value="{{isset($coildetails) ? $coildetails->coil_number : ''}}">

                                        @if ($errors->has('coil_number'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('coil_number') }}</strong>
                                                    </span>
                                         @endif                                        
                                    </div>
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                        <option value="1" @if(isset($coildetails) && $coildetails->status==1)  selected  @endif>Active</option>
                                        <option value="0" @if(isset($coildetails) && $coildetails->status==0)  selected  @endif>Inactive</option>
                                        
                                    </select>
                                </div>                                   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection                 