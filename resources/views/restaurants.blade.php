@extends('includes.master')
@section('title') {{ $seo_info[0]->meta_title.' || Restaurants' }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop
@section('content') 
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="inner">
      <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="_3mZgT">
      <div class="Al5GE">
        <div class="_3Um38 _2oQ4_">
          <input type="text" class="search _search _searchbar" value="" name="location" id="location" autocomplete="off" tabindex="1" placeholder="Enter your delivery location" maxlength="30">
          <div id="area"></div>
          <label class="_1Cvlf _2tL9P" for="location"></label>
        </div>
        <div class="_1fiQt"><span class="icon-location-crosshair _25lQg"></span></div>
      </div>
      <a class="_3iFC5">FIND FOOD</a></div>
      </div>
    <div class="col-md-2"></div>
    </div>
    </div>

  </div>
</div>
<!-- Breadcrumb End --> 

<div class="shop">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mainpage">
          <!-- Product View Start -->
          <div class="row">
        @if($count_restaurants == 0)
            <div>
                <h1>No restaurants</h1>  
            </div>
        @endif
          @foreach ($restaurants as $res)
            <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <a class="link" href="{{ URL::to('restaurant') }}/{{ base64_encode(base64_encode($res->rest_id)) }}/{{ $res->restaurant_name }}">
              <div class="product-thumb">
                <div class="image"> 
                <img src="{{ asset('public/restaurant') }}/{{ $res->image }}" alt="Food image" title="{{ $res->restaurant_name }}" class="img-fluid" />
                </div>
                <div class="caption">
                  <h4>{{ $res->restaurant_name }}</h4>
                  <p>{{ $res->description }}</p>
                  <div class="rating"><i class="icofont icofont-star"></i>{{ $res->rating }}</div>
                  <p>{{ $res->delivery_time }} MINS</p>
                </div>
              </div>
              </a>
            </div>
          @endforeach
          </div>
          <!-- Product View End --> 
        </div>
      </div>
    </div>
  </div>
@stop 