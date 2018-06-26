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
            <h4><i class="fa fa-cutlery"></i> Edit Items</h4>
          </div>
          <div class="widget-content">
            <div class="col-xs-12 col-sm-6">
              <div style="height:20px;"> 
              @if (Session::has('success')) 
              <span style="color:#090;">Records has been Updated successfully.</span> 
              @endif
                
              @if (Session::has('blank')) 
              <span style="color:#F00;">Please enter all * marked controls values.</span> 
              @endif
            
              @if (Session::has('invformat')) 
              <span style="color:#F00;">Please upload correct file format.</span> 
              @endif 
             </div>
              {{ Form::open(array('url' => 'edit-items', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_adm_det', 'files' => 'true', 'id' => 'frm_adm_det', 'autocomplete' => 'off')) }}
              {!! Form::hidden('reference_id',$data->product_id, array('id' => 'reference_id','required')) !!}
              <div class="form-group">
                <label class="col-md-4 control-label">Selest Restaurant*:</label>
                <div class="col-md-8">
                 {!! Form::select('restaurant_id',$restaurant,$data->restaurant_id,array('id' => 'restaurant_id','required', 'onchange' => 'select_Restaurant(this.value)', 'class'=>'form-control','default' => '')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Selest Category*:</label>
                <div class="col-md-8">
                 {{ Form::select('category_name', $category, $data->category_id, ['id' => 'category_name', 'onchange' => 'select_Category(this.value)', 'class'=>'form-control','required']) }}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Selest Subcategory:</label>
                <div class="col-md-8">
                 {{ Form::select('subcategory_id', $subcategory, $data->subcategory_id, ['id' => 'subcategory_id','class'=>'form-control']) }}
                </div>
              </div>
               <div class="form-group">
                <label class="col-md-4 control-label">Items Name*:</label>
                <div class="col-md-8">
                 {!! Form::text('item_name', $data->item_name,array('id' => 'item_name','required','class'=>'form-control','placeholder'=>'Item Name')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Description:</label>
                <div class="col-md-8">
                 {{ Form::textarea('description', $data->description, ['size' => '20x2', 'id' => 'description', 'class' => 'form-control', 'placeholder'=>'Description']) }}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Price*:</label>
                <div class="col-md-8">
                 {!! Form::text('price',$data->price,array('id' => 'price','required','class'=>'form-control','placeholder'=>'Price', 'onkeypress'=>'return isNumber(event)', 'maxlength'=>'3')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Type*:</label>
                <div class="col-md-8">
                 {!! Form::radio('type', 1, $data->type=="1"? "checked" : "", array('id' => 'veg')) !!} <label for="veg"><span class="veg"></span> Veg </label> &nbsp; &nbsp; &nbsp;
                 {!! Form::radio('type', 2, $data->type=="2"? "checked" : "", array('id' => 'nonveg')) !!} <label for="nonveg"><span class="nonveg"></span> Nonveg</label>
                </div>
              </div>
              <div class="form-group">
                 <label class="col-md-4 control-label">Item  Photo:</label>
                 <div class="col-md-8"> 
                  {!! Form::file('image', array('id' => 'image', 'class'=>'','placeholder'=>'')) !!}
                  </div>
                 <span style="color:#F00;">
                        Note : For better quality photo  <strong>width = </strong> 150 &  <strong>Height =</strong> 140<br>
                     Upload only <strong>png,jpg,jpeg</strong> extension Image.
                 </span>
               </div>
               <div class="clearfix"></div>
              <div class="form-group col-md-8">
                @if($data->pimage)
                <img src="{{ asset('public/images/dishes/'.$data->pimage) }}" alt="" style="width:30%;"/>
                @endif
              </div>
              <div class="clearfix"></div>
              <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-8"> 
                {{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                  
                  &nbsp;&nbsp; <a href="{{ URL::to('administrator/manage-items') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp </a> </div>
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