@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">User</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/userslist">User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Registration Add</li>                                    
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
                                <h4 class="card-title">User Registration Info</h4>                               
                               
                                  <form class="m-t-30" role="form" method="POST" action="/user/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('userid', isset($userdetails) ? $userdetails->id : '') }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                         <div class="col-lg-5">
                                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="Username"  placeholder="Enter Username" required="" value="{{isset($userdetails) ? $userdetails->name : old('name') }}">

                                        @if ($errors->has('name'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                         @endif 
                                         </div>                                       
                                    </div>

                                    <div class="form-group">
                                    <label>Usertype</label>
                                        <div class="col-lg-5">
                                            <select class="custom-select col-12" name="user_type_id" id="inlineFormCustomSelect" required> 
                                            <option value="">Select Usertype</option>
                                            @foreach($usertypes as $usertype)                                    
                                           <option value="{{$usertype->user_type_id}}" @if(isset($userdetails) && $userdetails->user_type_id==$usertype->user_type_id)  selected  @endif>{{$usertype->name}}</option>
                                             @endforeach  
                                                
                                            </select>
                                            @if ($errors->has('user_type_id'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('user_type_id') }}</strong>
                                                    </span>
                                         @endif 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <div class="col-lg-5">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" placeholder="Enter Email" value="{{isset($userdetails) ? $userdetails->email : old('email') }}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if ($errors->has('email'))
                                                <span class="help-block" style="color: red;">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                         @endif 
                                    </div>
                                    
                                </div>

                               
                                <div class="form-group">
                                    <label for="password" >{{ __('Password') }}</label>

                                    <div class="col-lg-5">
                                        <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" value="{{isset($userdetails) ? $userdetails->textpass : '' }}">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @if(!isset($userdetails)) 
                                <div class="form-group ">
                                    <label for="password-confirm" >{{ __('Confirm Password') }}</label> 
                                    <div class="col-lg-5">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                    </div>
                                </div>
                                @endif
                     

                                    <div class="form-group">
                                    <label>Status</label>
                                    <div class="col-lg-5">
                                        <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                            <option value="1" @if(isset($userdetails) && $userdetails->status==1)  selected  @endif>Active</option>
                                            <option value="0" @if(isset($userdetails) && $userdetails->status==0)  selected  @endif>Inactive</option>
                                            
                                        </select>
                                    </div>
                                </div>                                   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection                 