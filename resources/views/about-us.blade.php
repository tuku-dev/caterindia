@extends('includes.master')
@section('title') {{ $content_det[0]->meta_title }} @stop
@section('keywords') {{ $content_det[0]->meta_keyword }} @stop
@section('description') {{ $content_det[0]->meta_descr }} @stop
@section('content') 
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2>About Us</h2>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
        <li class="list-inline-item"><a href="javascript:void(0);">About us</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Breadcrumb End --> 

<!-- About Start -->
<div class="about">
  <div class="container">
    <div class="row"> 
      <!-- Title Content Start -->
      <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 commontop text-left">
        <h4>{{ $content_det[0]->page_title }}</h4>
        <div class="divider style-1 left"> <i class="icofont icofont-ui-press hr-icon left"></i> <span class="hr-simple right"></span> </div>
         {!! $content_det[0]->content !!}
      </div>
      <!-- Title Content End -->
      <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
        <div class="owl-carousel owl-theme owl-about"> 
          <!--  Slider image Start  -->
          <div class="item"> <img src="{{ asset('public/images/about/1.png') }}" alt="restaurant"> </div>
          <div class="item"> <img src="{{ asset('public/images/about/2.png') }}" alt="restaurant"> </div>
          <div class="item"> <img src="{{ asset('public/images/about/3.jpg') }}" alt="restaurant"> </div>
          <!--  Slider image End  --> 
        </div>
      </div>
    </div>
  </div>
</div>
<!-- About End --> 

<!-- Fun-Factor Start -->
<div class="fun-factor">
  <div class="container">
    <div class="row ">
      <div class="col-sm-3 col-6"> 
        <!-- Fun-Factor Box Start -->
        <div class="single-box"> <span> <i class="icofont icofont-spoon-and-fork"></i> </span>
          <h4 class="number" data-from="100" data-to="300" data-refresh-interval="10">100</h4>
          <h3>MENU ITEMS</h3>
        </div>
        <!-- Fun-Factor Box End --> 
      </div>
      <div class="col-sm-3 col-6"> 
        <!-- Fun-Factor Box Start -->
        <div class="single-box"> <span> <i class="icofont icofont-emo-simple-smile"></i> </span>
          <h4 class="number" data-from="100" data-to="600" data-refresh-interval="10">100</h4>
          <h3>VISITOR EVERYDAY</h3>
        </div>
        <!-- Fun-Factor Box End --> 
      </div>
      <div class="col-sm-3 col-6"> 
        <!-- Fun-Factor Box Start -->
        <div class="single-box"> <span> <i class="icofont icofont-waiter-alt"></i> </span>
          <h4 class="number" data-from="100" data-to="400" data-refresh-interval="10">100</h4>
          <h3>EXPERT CHEF</h3>
        </div>
        <!-- Fun-Factor Box End --> 
      </div>
      <div class="col-sm-3 col-6"> 
        <!-- Fun-Factor Box Start -->
        <div class="single-box"> <span> <i class="icofont icofont-heart-alt"></i> </span>
          <h4 class="number" data-from="10" data-to="100" data-refresh-interval="10">10</h4>
          <h3>TEST & LOVE</h3>
        </div>
        <!-- Fun-Factor Box End --> 
      </div>
    </div>
  </div>
</div>
<!-- Fun-Factor End --> 

<!-- Service Start  -->
<div class="service">
  <div class="container">
    <div class="row "> 
      <!-- Title Content Start -->
      <div class="col-sm-12 col-xs-12 commontop text-center">
        <h4>Why Choose Us ?</h4>
        <div class="divider style-1 center"> <span class="hr-simple left"></span> <i class="icofont icofont-ui-press hr-icon"></i> <span class="hr-simple right"></span> </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla. </p>
      </div>
      <div class="col-sm-4 col-xs-12"> 
        <!--  Box Start  -->
        <div class="box text-center"> <span><i class="icofont icofont-waiter-alt"></i></span>
          <h4>Best Chef</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae purus diam. Quisque vel elementum ligula. </p>
        </div>
        <!--  Box End  --> 
      </div>
      <div class="col-sm-4 col-xs-12"> 
        <!--  Box Start  -->
        <div class="box text-center"> <span><i class="icofont icofont-dining-table"></i></span>
          <h4>150 Tables</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae purus diam. Quisque vel elementum ligula. </p>
        </div>
        <!--  Box End  --> 
      </div>
      <div class="col-sm-4 col-xs-12"> 
        <!--  Box Start  -->
        <div class="box text-center"> <span><i class="icofont icofont-recycling-man"></i></span>
          <h4>Clean Environment</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae purus diam. Quisque vel elementum ligula. </p>
        </div>
        <!--  Box End  --> 
      </div>
    </div>
  </div>
</div>
<!-- Service End   --> 

<!-- Testimonials Start  -->
<div class="testimonials">
  <div class="container">
    <div class="testimonials-inner">
      <div class="row "> 
        <!-- Title Content Start -->
        <div class="col-sm-12 col-xs-12 commontop white text-center">
          <h4>What Our Customers Say</h4>
          <div class="divider style-1 center"> <span class="hr-simple left"></span> <i class="icofont icofont-ui-press hr-icon"></i> <span class="hr-simple right"></span> </div>
        </div>
        <!-- Title Content End -->
        <div class="col-sm-12 col-xs-12">
          <div class="owl-carousel owl-theme owl-testi">
            <div class="item">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
              <span>- Kapil Patel</span> </div>
            <div class="item">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
              <span>- Nicole Oliver</span> </div>
            <div class="item">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
              <span>- Brian Mills</span> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Testimonials End  --> 
@stop 