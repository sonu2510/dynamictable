@extends('layouts.admin.default')
@section('header')
       
                  
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Vendor</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/supplier">Vendor</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Vendor Add</li>                                    
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
                                <h4 class="card-title">Vendor Details</h4>                               
                               
                                 <form class="form-horizontal"  role="form" method="POST" action="/supplier/save" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ Form::hidden('vendor_id', isset($vendor_details) ? $vendor_details->id : '') }}
                                <div class="card-body">                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Company Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="company_name" placeholder="Company Name Here" required="" value="{{isset($vendor_details) ? $vendor_details->company_name : ''}}">
                                                     @if ($errors->has('company_name'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('company_name') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                          <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Contact No.</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="fname2" name="contact_no" placeholder="Contact No"  value="{{isset($vendor_details) ? $vendor_details->contact_no : ''}}">
                                                     @if ($errors->has('contact_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('contact_no') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               
                                            </div>
                                        </div>
                                    </div>

                                      <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Email (1)</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="fname2" name="email_1" placeholder="Email"  value="{{isset($vendor_details) ? $vendor_details->email_1 : ''}}">
                                                     @if ($errors->has('email_1'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('email_1') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Email (2)</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="fname2" name="email_2" placeholder="Secondary Email"  value="{{isset($vendor_details) ? $vendor_details->email_2 : ''}}">
                                                     @if ($errors->has('email_2'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('email_2') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label class="col-sm-3 text-right control-label col-form-label">Company Address</label>
                                               <div class="col-sm-9">
                                                 <textarea class="form-control" name="address" aria-label="With textarea" placeholder="Address Here">{{isset($vendor_details) ? $vendor_details->address : ''}}</textarea>
                                             </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Postal Code</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="postal_code" placeholder="Postal Code"  value="{{isset($vendor_details) ? $vendor_details->postal_code : ''}}">
                                                     @if ($errors->has('postal_code'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('postal_code') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">GST/TAX No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="gst_no" placeholder="GST/ TAX no"  value="{{isset($vendor_details) ? $vendor_details->gst_no : ''}}">
                                                     @if ($errors->has('gst_no'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('gst_no') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Website</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="website" placeholder="Website"  value="{{isset($vendor_details) ? $vendor_details->website : ''}}">
                                                     @if ($errors->has('website'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('website') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               
                                            </div>
                                        </div>
                                    </div>


                                      <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">State</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="state" placeholder="state"  value="{{isset($vendor_details) ? $vendor_details->state : ''}}">
                                                     @if ($errors->has('state'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('state') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">City</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" name="city" placeholder="city"  value="{{isset($vendor_details) ? $vendor_details->city : ''}}">
                                                     @if ($errors->has('city'))
                                                            <span class="help-block" style="color: red;">
                                                                    <strong>{{ $errors->first('city') }}</strong>
                                                                </span>
                                                     @endif 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label class="col-sm-3 text-right control-label col-form-label">Remark</label>
                                               <div class="col-sm-9">
                                                 <textarea class="form-control" name="remark" aria-label="With textarea" placeholder="Remark Here">{{isset($vendor_details) ? $vendor_details->remark : ''}}</textarea>
                                             </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                                    <option value="1" @if(isset($vendor_details) && $vendor_details->status==1)  selected  @endif>Active</option>
                                                    <option value="0" @if(isset($vendor_details) && $vendor_details->status==0)  selected  @endif>Inactive</option>
                                                    
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                               
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