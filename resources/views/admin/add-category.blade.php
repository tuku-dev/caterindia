@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        <li> Add Category </li>
      </ul>
    </div>
    <div class="page-header"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="widget box">
          <div class="widget-header">
            <h4><i class="fa fa-cutlery"></i> Add Category</h4>
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
              {{ Form::open(array('url' => 'add-category', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_adm_det', 'files' => 'true', 'id' => 'frm_adm_det', 'autocomplete' => 'off')) }}
              <div class="form-group">
                <label class="col-md-4 control-label">Selest Restaurant*:</label>
                <div class="col-md-8">
                 {!! Form::select('restaurant_id',$restaurant,old('restaurant_id'),array('id' => 'restaurant_id','required','class'=>'form-control','default' => '')) !!}
                </div>
              </div>
               <div class="form-group">
                <label class="col-md-4 control-label">Category Name*:</label>
                <div class="col-md-8">
                 {!! Form::text('category_name','',array('id' => 'category_name','required','class'=>'form-control','placeholder'=>'Category Name')) !!}
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-8"> 
                {{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                  
                  &nbsp;&nbsp; <a href="{{ URL::to('administrator/manage-category') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp </a> </div>
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