@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Machine Data</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/machine_master">Machine Details</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Machine Add</li>                                    
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
                               
                                  <form class="m-t-30" role="form" method="POST" action="/machine_master/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('machine_master_id', isset($machinedetails) ? $machinedetails->machine_master_id : '') }}
                                    
                                       <div class="form-group">
                                       
                                               <label for="fname2" class="control-label col-form-label">Machine Type</label>
                                               
                                                    <select class="form-control" name="machine_type_id" id="inlineFormCustomSelect" required> 
                                                        <option value="">Select Machine Type</option>
                                                        @foreach($machine_type as $type)                                    
                                                       <option value="{{$type->machine_type_id }}" @if(isset($machinedetails) && $machinedetails->machine_type_id==$type->machine_type_id )  selected  @endif>{{$type->machine_type}}</option>
                                                         @endforeach  
                                                            
                                                        </select>
                                                        @if ($errors->has('machine_type_id'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('machine_type_id') }}</strong>
                                                                </span>
                                                     @endif 
                                              
                                                                 
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Machine Info</label>
                                        <input type="text" class="form-control" name="machine_slug" id="exampleInputEmail1" aria-describedby="Usertype" placeholder="Enter Machine Slug" required="" value="{{isset($machinedetails) ? $machinedetails->machine_slug : ''}}">

                                        @if ($errors->has('machine_slug'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('machine_name') }}</strong>
                                                    </span>
                                         @endif                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Machine Slug</label>
                                        <input type="text" class="form-control" name="machine_name" id="exampleInputEmail1" aria-describedby="Usertype" placeholder="Enter Machine Name" required="" value="{{isset($machinedetails) ? $machinedetails->machine_name : ''}}">

                                        @if ($errors->has('machine_name'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('machine_name') }}</strong>
                                                    </span>
                                         @endif                                        
                                    </div> 

                                       

                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                        <option value="1" @if(isset($machinedetails) && $machinedetails->status==1)  selected  @endif>Active</option>
                                        <option value="0" @if(isset($machinedetails) && $machinedetails->status==0)  selected  @endif>Inactive</option>
                                        
                                    </select>
                                </div>                                   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection                 