@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Processed Coil</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/processed_coil">Processed Coil</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Processed Coil Add</li>                                    
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
                               
                                  <form class="m-t-30" role="form" method="POST" action="/processed_coil/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('coil_id', isset($processedcoil_data) ? $processedcoil_data->id : '') }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Processed Coil Size</label>
                                        <input type="text" class="form-control" name="coil_size" id="exampleInputEmail1" aria-describedby="Usertype" placeholder="Enter Coil Size" required="" value="{{isset($processedcoil_data) ? $processedcoil_data->coil_size : ''}}">

                                        @if ($errors->has('coil_size'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('coil_size') }}</strong>
                                                    </span>
                                         @endif                                        
                                    </div>
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                        <option value="1" @if(isset($processedcoil_data) && $processedcoil_data->status==1)  selected  @endif>Active</option>
                                        <option value="0" @if(isset($processedcoil_data) && $processedcoil_data->status==0)  selected  @endif>Inactive</option>
                                        
                                    </select>
                                </div>                                   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection                 