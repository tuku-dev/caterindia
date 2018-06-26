@extends('includes.master')
@section('title') {{ $seo_info[0]->meta_title.' || Restaurant Items' }} @stop
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
<div class="newd">
  <div class="container">
    <div class="row">
      <div class="col-md-4 tio"> <img src="{{ asset('public/restaurant') }}/{{ $restaurant->image }}" class="img-fluid pl-30 pr-30"/> </div>
      <div class="col-md-8">
        <h1 title="{{ $restaurant->restaurant_name }}" class="">{{ $restaurant->restaurant_name }}</h1>
        <div class="description">{{ $restaurant->description }}</div>
        <ul class="list-inline">
        <li class="list-inline-item"><i class="icofont icofont-star"></i> </span>{{ $restaurant->rating }}</span></li>
        <li class="list-inline-item">{{ $restaurant->delivery_time }} MINS</li>
        <li class="list-inline-item">Delivery Time</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Shop Start -->
<div class="shop">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <!-- Left Filter Start -->
        <div class="left-side">

            <ul class="list-block left-navigation">
            @php
              $cat_data = DB::table('category')->where('restaurant_id', '=', $restaurant->rest_id)->get();
              foreach($cat_data as $res_category){
            @endphp
              <li><a href="javascript:void(0);">{{ $res_category->category_name }}</a>
                <ul>
                @php
                  $sub_cat_data = DB::table('subcategory')->where('restaurant_id', '=', $restaurant->rest_id)->where('cate_id','=',$res_category->category_id)->get();
                  foreach($sub_cat_data as $res_sub_cat){
                @endphp
                  <li><a href="javascript:void(0);">{{ $res_sub_cat->subcategory_name }}</a></li>
                @php } @endphp
                </ul>
              </li>
            @php } @endphp
            </ul>

        </div>
        <!-- Left Filter End -->
      </div>
      <div class="col-md-9 mainpage">
        <div class="row">
        @php
           $pro_cat = DB::table('category')->where('restaurant_id', '=', $restaurant->rest_id)->get();
           foreach($pro_cat as $res_cat){
        @endphp
            <div>
              <h3>{{ $res_cat->category_name }}</h3>
            </div>
        @php
          $pro_sub_cat = DB::table('subcategory')->where('restaurant_id', '=', $restaurant->rest_id)->where('cate_id','=',$res_cat->category_id)->get();
          foreach($pro_sub_cat as $pro_subcate){
          $pro_count = DB::table('product')->where('restaurant_id', '=', $restaurant->rest_id)->where('subcategory_id', '=', $pro_subcate->sub_caid)->count();
        @endphp
          <div>
            <h6>{{ $pro_subcate->subcategory_name }}</h6>
            <p>{{ $pro_count }} ITEMS</p>
          </div>
        @php
          $product = DB::table('product')->where('restaurant_id', '=', $restaurant->rest_id)->where('category_id','=',$res_cat->category_id)->where('subcategory_id', '=', $pro_subcate->sub_caid)->get();
          foreach($product as $res){
        @endphp
          <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="product-thumb">
              <div class="image">@if($res->pimage != "")<img src="{{ asset('public/images/dishes') }}/{{ $res->pimage }}" alt="Food image" title="{{ $res->item_name }}" class="img-fluid" /> @else <img src="{{ asset('public/images/logo/logo-icon.png') }}" alt="Food image" title="{{ $res->item_name }}" class="img-fluid" /> @endif</div>
              <div class="caption">
                <h4>@if($res->type == 1)<span class="veg"></span> @else <span class="nonveg"></span> @endif {{ $res->item_name }}</h4>
                <p class="des">{{ $res->description }}</p>
                <div class="price">&#8377; {{ $res->price }}</div>
                <p><a class="btn btn-theme btn-md" href="javascript:void(0);" id="pro-add-to-cart" data-id="{{ $res->product_id }}">Add +</a></p>
                <input type="hidden" name="img_{{ $res->product_id }}" id="img_{{ $res->product_id }}" value="{{ $res->pimage }}">
                <input type="hidden" name="name_{{ $res->product_id }}" id="name_{{ $res->product_id }}" value="{{ $res->item_name }}">
                <input type="hidden" name="price_{{ $res->product_id }}" id="price_{{ $res->product_id }}" value="{{ $res->price }}">
                <input type="hidden" name="desc_{{ $res->product_id }}" id="desc_{{ $res->product_id }}" value="{{ $res->description }}">
                <input type="hidden" name="qnty_{{ $res->product_id }}" id="qnty_{{ $res->product_id }}" value="1">
                <input type="hidden" name="type_{{ $res->product_id }}" id="type_{{ $res->product_id }}" value="{{ $res->type }}">
                <input type="hidden" name="category_{{ $res->product_id }}" id="category_{{ $res->product_id }}" value="{{ $res->category_id }}">
                <input type="hidden" name="subcategory_{{ $res->product_id }}" id="subcategory_{{ $res->product_id }}" value="{{ $res->subcategory_id }}">
                <input type="hidden" name="rest_{{ $res->product_id }}" id="rest_{{ $res->product_id }}" value="{{ $restaurant->rest_id }}">
              </div>
            </div>
          </div>
       @php } } } @endphp
      </div>
      <div id="productsadded" style="display: none;"><div class="add-cart"><div class="add-cart-txticon"> <i class="icofont icofont-verification-check"></i></div><div class=" add-cart-txt"> Products Added Successfully.</div></div></div>
        <!-- Product View End -->
      </div>
    </div>
  </div>
</div>
<!-- Shop End -->
@stop
