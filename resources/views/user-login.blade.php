@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} || Login @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content') 
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2>Login</h2>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
        <li class="list-inline-item"><a href="javascript:void(0);">Login</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Breadcrumb End --> 

<!-- Login Start -->
<div class="login">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12 commontop text-center">
        <h4>Login to Your Account</h4>
        <div class="divider style-1 center"> <span class="hr-simple left"></span> <i class="icofont icofont-ui-press hr-icon"></i> <span class="hr-simple right"></span> </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
      </div>
      <div class="col-lg-10 col-md-12">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="loginnow">
              <div> <span id="Reg_succ" style="color:#090;"></span> <span id="Reg_error" style="color:#F00;"></span> </div>
              <!--<div class="loading"><img src="{{ asset('public/images/disk.gif') }}" /></div>-->
              <h5 id="reg_heading">Register</h5>
              {{ Form::open(array('class' =>'form-horizontal', 'id' => 'user_Reg', 'autocomplete' => 'off')) }}
              <div class="form-group"> <i class="icofont icofont-ui-user"></i> {!! Form::text('full_name',old('full_name'), array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'Your name*','autocomplete' => 'off')) !!} </div>
              <div class="form-group"> <i class="icofont icofont-phone"></i> {!! Form::text('contact_no',old('contact_no'), array('id' => 'contact_no','required','class'=>'form-control','placeholder'=>'Contact no*','autocomplete' => 'off', 'onkeypress'=>'return isNumber(event)', 'maxlength'=>'10')) !!} </div>
              <div class="form-group"> <i class="icofont icofont-ui-message"></i> {!! Form::email('user_email',old('user_email'), array('id' => 'user_email','required','class'=>'form-control','placeholder'=>'Your email*','autocomplete' => 'off')) !!} </div>
              <div class="form-group"> <i class="icofont icofont-lock"></i> {!! Form::password('user_psw', array('id' => 'user_psw','required','class'=>'form-control','placeholder'=>'Your password*','autocomplete' => 'off')) !!} </div>
              <div class="form-group">
                <div class="links">
                  <label> {!! Form::checkbox('terms', '1', false, array('id' => 'terms')) !!}
                    By signing up I agree with <a href="javascript:void(0);" target="_blank">terms & conditions.</a> </label>
                </div>
              </div>
              <div class="form-group"> {{ Form::button('Sign Up', array('class' => 'btn btn-theme btn-md btn-wide', 'id' => 'register', 'onClick' => 'return registration();')) }} </div>
              {{ Form::close() }}
              
              {{ Form::open(array('class' =>'form-horizontal', 'id' => 'otp_verification', 'autocomplete' => 'off')) }}
              <div class="form-group"> {!! Form::text('verify_mobile',old('verify_mobile'), array('id' => 'verify_mobile','required','class'=>'form-control','autocomplete' => 'off', 'readonly')) !!} </div>
              <div class="form-group" style="margin-bottom:15px;"><i class="icofont icofont-iphone"></i> {!! Form::text('otp',old('otp'), array('id' => 'otp','required','class'=>'form-control','placeholder'=>'One time password','autocomplete' => 'off', 'onkeypress'=>'return isNumber(event)', 'maxlength'=>'6')) !!} </div>
              <a href="javascript:void(0)" class="resend">Resend OTP</a>
              <div class="clearfix"></div>
              <div class="form-group"> {{ Form::button('Verify OTP', array('class' => 'btn btn-theme btn-md btn-wide', 'id' => 'otp_verify', 'onClick' => 'return otpVerify();')) }} </div>
              {{ Form::close() }} </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="loginnow">
              <div style=" line-height:0px"> @if (Session::has('success')) <span style="color:#090;"> Registration completed successfully. After verifivation your account will be activate. </span> @endif
                
                @if (Session::has('blank')) <span style="color:#F00;">Please enter all * marked controls values.</span> @endif
                
                @if (Session::has('invalid')) <span style="color:#F00;">Please enter correct email or phone no.</span> @endif
                
                @if (Session::has('invpsw')) <span style="color:#F00;">Please enter correct password.</span> @endif
                
                
                @if (Session::has('blocked')) <span style="color:#F00;">Your account not activeted.</span> @endif </div>
              <div class="form-login">
              <h5>Login</h5>
              {{ Form::open(array('url' => 'user-login', 'role' => 'form', 'class' =>'', 'name' => 'frm_usr_login', 'id' => 'frm_usr_login','files'=>true, 'autocomplete' => 'off')) }}
              <div class="form-group"> <i class="icofont icofont-ui-message"></i> {!! Form::text('user_email',old('user_email'), array('id' => 'login_email','required','class'=>'form-control','placeholder'=>'Email or phone*','autocomplete' => 'off')) !!} </div>
              <div class="form-group"> <i class="icofont icofont-lock"></i> {!! Form::password('user_psw', array('id' => 'login_psw','required','class'=>'form-control','placeholder'=>'Password*','autocomplete' => 'off')) !!} </div>
              <div class="form-group">
                <div class="links">
                  <label>
                    <input type="checkbox" class="radio-inline"/>
                    Remember Me</label>
                  <a class="float-right sign forgoten" href="javascript:void(0)">Forgot Password?</a> </div>
              </div>
              <div class="form-group"> {{ Form::submit('SIGN IN', array('class' => 'btn btn-theme btn-md btn-wide')) }} </div>
              {{ Form::close() }}
              </div>
              <div class="forgot-password">
              <div> 
                  <span id="forgot_succ" style="color:#090;"></span> 
                  <span id="forgot_error" style="color:#F00;"></span> 
              </div>
              <h5>Recover your account</h5>
                <p>If You Have a password? So <a href="javascript:void(0)" class="login-page">Login</a> And starts less than a minute</p>
                {{ Form::open(array('url' => '', 'autocomplete' => 'off', 'id' => 'forgot-otp')) }}
                        <div class="form-group">
                            <i class="icofont icofont-phone"></i>
                            {!! Form::text('phone',old('phone'), array('id' => 'phone','required','class'=>'form-control','placeholder'=>'Phone Number*', 'onkeypress'=>'return isNumber(event)','autocomplete' => 'off', 'maxlength'=>'10')) !!}
                        </div>
                        <div class="form-group">
                         {{ Form::button('Get Password', array('class' => 'btn btn-theme btn-md btn-wide', 'id' => 'btn-forgot', 'onClick' => 'return userForgotValidation();')) }} 
                        </div>
                    {{ Form::close() }}
                    
                    {{ Form::open(array('class' =>'form-horizontal', 'id' => 'forgototp_verification', 'autocomplete' => 'off')) }}
              <div class="form-group"> {!! Form::text('forgototp_mobile',old('forgototp_mobile'), array('id' => 'forgototp_mobile','required','class'=>'form-control','autocomplete' => 'off', 'readonly')) !!} </div>
              <div class="form-group" style="margin-bottom:15px;"><i class="icofont icofont-iphone"></i> {!! Form::text('forgototp_confirm',old('otp'), array('id' => 'forgototp_confirm','required','class'=>'form-control','placeholder'=>'One time password','autocomplete' => 'off', 'onkeypress'=>'return isNumber(event)', 'maxlength'=>'6')) !!} </div>
              <div class="clearfix"></div>
              <div class="form-group"> {{ Form::button('Verify OTP', array('class' => 'btn btn-theme btn-md btn-wide', 'id' => 'otp_verifyforgotbtn', 'onClick' => 'return otpverify_forgot();')) }} </div>
              {{ Form::close() }}
                </div>
                <div class="change-passworddiv">
                	<div> 
                  <span id="chgpass_succ" style="color:#090;"></span> 
                  <span id="chgpass_error" style="color:#F00;"></span> 
                  </div>
                  <h5>Change your password</h5>
                  {{ Form::open(array('url' => '', 'autocomplete' => 'off', 'id' => 'change-password')) }}
                  		<div class="form-group"> <i class="icofont icofont-lock"></i> {!! Form::password('password', array('id' => 'password','required','class'=>'form-control','placeholder'=>'password*','autocomplete' => 'off')) !!} </div>
                        <div class="form-group">
                            <i class="icofont icofont-lock"></i>
                            {!! Form::password('repeat_password', array('id' => 'repeat_password','required','class'=>'form-control','placeholder'=>'Repeat password*','autocomplete' => 'off')) !!}
                        </div>
                        <div class="form-group">
                         {{ Form::button('Change Password', array('class' => 'btn btn-theme btn-md btn-wide', 'id' => 'btn-changepass', 'onClick' => 'return userChangepassword();')) }} 
                        </div>
                    {{ Form::close() }}
                </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Login End --> 
@stop