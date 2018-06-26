@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')

<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>   
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> User Details</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-pencil-square-o"></i> User Details</h4> </div>
                <div class="widget-content">
                    <div class="form-group col-xs-12">
                          <div class="form-group col-xs-4">
                            <strong> Registered user information</strong><br /><br />
                            <strong>Company Name :</strong> {{ $data[0]->company_name }} <br />
                            <strong>Email :</strong> {{ $data[0]->email }} <br />
                            <strong>Contact Number :</strong> {{ $data[0]->bill_phone_number }} <br />
                          </div>
                          
                          <div class="form-group col-xs-4">
                          <strong> Billing information</strong><br /><br />
                          {{ $data[0]->bill_first_name." ".$data[0]->bill_last_name }} <br />
                          {{ $data[0]->bill_address1 }} <br /> 
                          @if($data[0]->bill_address2!='') {{ $data[0]->bill_address2 }} <br /> @endif
                          
                          <strong>City :</strong> {{ $data[0]->bill_city }} 
                          <strong>Postcode : </strong>{{ $data[0]->bill_post_code }} <br />
                          
                          <strong>Country :</strong> {{ $data[0]->bill_country }} 
                          <strong>County :</strong> {{ $data[0]->bill_state }}  <br /> <br />
                          </div>
                          
                          <div class="form-group col-xs-4">
                          <strong> Shipping information</strong><br /><br />
                          {{ $data[0]->ship_first_name." ".$data[0]->ship_last_name }} <br />
                          {{ $data[0]->ship_address1 }} <br /> 
                          @if($data[0]->ship_address2!='') {{ $data[0]->ship_address2 }} <br /> @endif
                          
                          <strong>City :</strong> {{ $data[0]->ship_city }} 
                          <strong>Postcode : </strong>{{ $data[0]->ship_post_code }} <br />
                          
                          <strong>Country :</strong> {{ $data[0]->ship_country }} 
                          <strong>County :</strong> {{ $data[0]->ship_state }}  <br />
                          <strong>Contact Number :</strong> {{ $data[0]->ship_phone_number }} <br /><br />
                          
                          
                          </div>
                          
                          <div class="form-group col-md-12">
                           <a href="{{ URL::to('administrator/manage-users') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to Manage Users &nbsp; <i class="icon-angle-right"></i></a>
                        </div>
                          
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@stop