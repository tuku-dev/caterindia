@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        <li> Edit Restaurant </li>
      </ul>
    </div>
    <div class="page-header"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="widget box">
          <div class="widget-header">
            <h4><i class="fa fa-cutlery"></i> Edit Restaurant</h4>
          </div>
          <div class="widget-content">
            <div class="col-xs-12 col-sm-6">
              <div style="height:20px;"> 
              @if (Session::has('success')) 
              <span style="color:#090;">Records has been saved successfully.</span> 
              @endif
                
              @if (Session::has('blank')) 
              <span style="color:#F00;">Please enter all * marked controls values.</span> 
              @endif
            
              @if (Session::has('invformat')) 
              <span style="color:#F00;">Please upload correct file format.</span> 
              @endif 
             </div>
              {{ Form::open(array('url' => 'edit-restaurant', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_adm_det', 'files' => 'true', 'id' => 'frm_adm_det', 'autocomplete' => 'off')) }}
              {!! Form::hidden('reference_id',$data->rest_id, array('id' => 'reference_id','required')) !!}
              <div class="form-group">
                <label class="col-md-4 control-label">Selest Area Name*:</label>
                <div class="col-md-8">
                 {!! Form::select('area_id',$area,$data->area_id,array('id' => 'area_id','required','class'=>'form-control','default' => '')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Restaurant Name*:</label>
                <div class="col-md-8">
                 {!! Form::text('restaurant_name',$data->restaurant_name,array('id' => 'restaurant_name','required','class'=>'form-control','placeholder'=>'Restaurant Name')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Delivery Time*:</label>
                <div class="col-md-8">
                 {!! Form::text('delivery_time',$data->delivery_time,array('id' => 'delivery_time','required','class'=>'form-control','placeholder'=>'Delivery Time', 'onkeypress'=>'return isNumber(event)', 'maxlength'=>'2')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Description*:</label>
                <div class="col-md-8">
                 {!! Form::textarea('description',$data->description,array('size' => '20x2','id' => 'description','required','class'=>'form-control','placeholder'=>'Description')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Email*:</label>
                <div class="col-md-8">
                 {!! Form::text('email',$data->email,array('id' => 'email','required','class'=>'form-control','placeholder'=>'Email')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Phone*:</label>
                <div class="col-md-8">
                 {!! Form::text('phone',$data->phone,array('id' => 'phone','required','class'=>'form-control','placeholder'=>'Phone', 'onkeypress'=>'return isNumber(event)', 'maxlength'=>'10')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Minimum Order*:</label>
                <div class="col-md-8">
                 {!! Form::text('minimum_order',$data->minimum_order,array('id' => 'minimum_order','required','class'=>'form-control','placeholder'=>'Minimum Order', 'onkeypress'=>'return isNumber(event)', 'maxlength'=>'3')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Rating*:</label>
                <div class="col-md-8">
                 <button type="button" id="minus" class="minus">-</button>
                  {!! Form::text('rating',$data->rating,array('id' => 'rating','required','class'=>'form-control','placeholder'=>'Rating', 'max'=>'5', 'style'=>'width:20%; float:left;')) !!}
                 <button type="button" id="plus" class="plus">+</button>
                </div>
              </div>
              <div class="form-group">
                 <label class="col-md-4 control-label">Restaurant  Photo*:</label>
                 <div class="col-md-8"> 
                  {!! Form::file('image', array('id' => 'image', 'class'=>'','placeholder'=>'')) !!}
                  </div>
                 <span style="color:#F00;">
                        Note : For better quality photo  <strong>width = </strong> 370 &  <strong>Height =</strong> 280<br>
                     Upload only <strong>png,jpg,jpeg</strong> extension Image.
                 </span>
               </div>
               <div class="clearfix"></div>
              <div class="form-group col-md-8">
                @if($data->image)
                <img src="{{ asset('public/restaurant/'.$data->image) }}" alt="" style="width:30%;"/>
                @endif
              </div>
              <div class="clearfix"></div>
              <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-8"> {{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                  
                  &nbsp;&nbsp; <a href="{{ URL::to('administrator/restaurant') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp </a> </div>
              </div>
              {{ Form::close() }} </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop