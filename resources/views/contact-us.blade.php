@extends('includes.master')
@section('title') {{ $seo_info[0]->meta_title.' || Contact Us' }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop
@section('content') 
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2>Contact Us</h2>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
        <li class="list-inline-item"><a href="javascript:void(0);">Contact us</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Breadcrumb End --> 

<!-- Contact us Start -->
<div class="contactus">
  <div class="container">
    <div class="row"> 
      <!-- Title Content Start -->
      <div class="col-sm-12 commontop text-center">
        <h4>Get In Touch</h4>
        <div class="divider style-1 center"> <span class="hr-simple left"></span> <i class="icofont icofont-ui-press hr-icon"></i> <span class="hr-simple right"></span> </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
      </div>
      <!-- Title Content End -->
      
      <div class="col-md-5 col-12"> 
      	  @if (Session::has('success'))
          <div style="color:#090;">
              Your message has been send successfully.
          </div>
          @endif
    
          @if (Session::has('blank'))
          <div style="color:#F00;">Please enter all * marked controls values.</div>
          @endif
        <!--  Contact form Start  -->
        {{ Form::open(array('url' => 'contact-us', 'role' => 'form', 'class' =>'form-horizontal', 'name' => 'frm_contact', 'id' => 'frm_contact','files'=>true, 'autocomplete' => 'off','onsubmit' => 'return contactValidation();')) }}
          <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-xs-12"> <i class="icofont icofont-ui-user"></i>
              {!! Form::text('full_name',old('full_name'), array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'Your name*','autocomplete' => 'off')) !!}
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-xs-12"> <i class="icofont icofont-ui-message"></i>
              {!! Form::email('user_email',old('user_email'), array('id' => 'user_email','required','class'=>'form-control','placeholder'=>'Your email*','autocomplete' => 'off')) !!}
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-xs-12"> <i class="icofont icofont-phone"></i>
              {!! Form::text('subject',old('subject'), array('id' => 'subject','required','class'=>'form-control','placeholder'=>'Subject*','autocomplete' => 'off')) !!}
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12"> <i class="icofont icofont-pencil-alt-5"></i>
              {!! Form::textarea('your_message','',array('id' => 'your_message','required','class'=>'form-control','size' => '30x5','placeholder'=>'Enter your message*')) !!}
            </div>
          </div>
          <div class="buttons">
            {{ Form::submit('Send Message', array('class' => 'btn btn-theme btn-block')) }}
          </div>
        {{ Form::close() }}
        <!--  Contact form End  --> 
      </div>
      <div class="col-md-7 col-12"> 
        <!--  Map Start  -->
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115073.2374313485!2d-73.93673358491914!3d40.72030531038137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1513832984699"></iframe>
        </div>
        <!--  Map End  --> 
      </div>
    </div>
  </div>
</div>
<!-- Contact Us End  --> 

<!-- Address Start  -->
<div class="address">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="address-box">
          <div class="box text-center">
            <div class="icon"> <i class="icofont icofont-home"></i> </div>
            <h4>ADDRESS</h4>
            <p>{!! $admin_data[0]->address !!}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="address-box">
          <div class="box text-center">
            <div class="icon"> <i class="icofont icofont-phone"></i> </div>
            <h4>PHONE NO.</h4>
            <p>{{ $admin_data[0]->contact_no }}<br />
               {{ $admin_data[0]->mobile_no }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="address-box">
          <div class="box text-center">
            <div class="icon"> <i class="icofont icofont-ui-message"></i> </div>
            <h4>EMAIL</h4>
            <p><a href="mailto:{{ $admin_data[0]->alt_email }}" class="__cf_email__" >{{ $admin_data[0]->alt_email }}</a></p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="address-box">
          <div class="box social">
            <h4>SOCIAL LINKES</h4>
            <ul class="list-inline ">
              <li class="list-inline-item"><a href="{{ $admin_data[0]->facebook_url }}" target="_blank"><i class="icofont icofont-social-facebook"></i></a></li>
              <li class="list-inline-item"><a href="{{ $admin_data[0]->twitter_url }}" target="_blank"><i class="icofont icofont-social-twitter"></i></a></li>
              <li class="list-inline-item"><a href="{{ $admin_data[0]->linkedin_url }}" target="_blank"><i class="icofont icofont-social-linkedin"></i></a></li>
              <li class="list-inline-item"><a href="{{ $admin_data[0]->instagram_url }}" target="_blank"><i class="icofont icofont-social-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Address End  --> 
@stop 