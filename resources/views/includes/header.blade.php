@php $admin_data = Helpers::getShare(); @endphp
<div class="top">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <ul class="list-inline float-left icon">
          <li class="list-inline-item"><a href="#"><i class="icofont icofont-phone"></i> Call us : {{ $admin_data[0]->contact_no }}</a></li>
        </ul>
        <!-- Header Social Start -->
        <ul class="list-inline float-right icon">
          <li class="list-inline-item"><span>3</span><a href="{{ url('/') }}/cart"><i class="icofont icofont-cart-alt"></i> Cart</a></li>
          <li class="list-inline-item dropdown"> <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-ui-user"></i> My Account</a>
            <ul class="dropdown-menu dropdown-menu-right drophover" aria-labelledby="dropdownMenuLink">
            @if(Cookie::get('user_id')=="")
              <li class="dropdown-item"><a href="{{ url('/') }}/user-login"><i class="icofont icofont-login"></i> Login</a></li>
              <li class="dropdown-item"><a href="{{ url('/') }}/user-login"><i class="icofont icofont-user-male"></i> Register</a></li>
            @endif
            @if(Cookie::get('user_id')!="")
              <li class="dropdown-item"><a href="{{ url('/') }}/user-logout"><i class="icofont icofont-emo-wink-smile"></i> My Profile</a></li>
              <li class="dropdown-item"><a href="{{ url('/') }}/user-logout"><i class="icofont icofont-spoon-and-fork"></i> Orders</a></li>
              <li class="dropdown-item"><a href="{{ url('/') }}/user-logout"><i class="icofont icofont-ui-love"></i> Wishlist</a></li>
              <li class="dropdown-item"><a href="{{ url('/') }}/user-logout"><i class="icofont icofont-power" style="color:red;"></i> Logout</a></li>
            @endif
            </ul>
          </li>
          <li class="list-inline-item">
            <ul class="list-inline social">
              <li class="list-inline-item"><a href="{{ $admin_data[0]->facebook_url }}" target="_blank"><i class="icofont icofont-social-facebook"></i></a></li>
              <li class="list-inline-item"><a href="{{ $admin_data[0]->twitter_url }}" target="_blank"><i class="icofont icofont-social-twitter"></i></a></li>
              <li class="list-inline-item"><a href="{{ $admin_data[0]->linkedin_url }}" target="_blank"><i class="icofont icofont-social-google-plus"></i></a></li>
              <li class="list-inline-item"><a href="{{ $admin_data[0]->instagram_url }}" target="_blank"><i class="icofont icofont-social-instagram"></i></a></li>
            </ul>
          </li>
        </ul>
        <!-- Header Social End --> 
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12"> 
      <!-- Logo Start  -->
      <div id="logo"> <a href="{{ url('/') }}"><img id="logo_img" class="img-fluid" src="{{ asset('public/images/logo/logo.png') }}" alt="logo" title="logo" /></a> </div>
      <!-- Logo End  --> 
    </div>
    <div class="col-md-7 col-sm-6 col-xs-12 paddleft"> 
      <!-- Main Menu Start  -->
      <div id="menu">
        <nav class="navbar navbar-expand-md">
          <div class="navbar-header"> <span class="menutext d-block d-md-none">Menu</span>
            <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="btn btn-navbar navbar-toggler" type="button"><i class="icofont icofont-navigation-menu"></i></button>
          </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse padd0">
            <ul class="nav navbar-nav">
              <li class="nav-item"><a href="{{ url('/') }}">HOME</a></li>
              <li class="nav-item"><a href="{{ url('/') }}/about-us">about us</a></li>
              <li class="nav-item"><a href="{{ url('/') }}/our-blog">Our Blog</a></li>
              <li class="nav-item"><a href="{{ url('/') }}/contact-us">contact us</a></li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- Main Menu End --> 
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 button-top paddleft"> <a class="btn-primary btn" href='{{ url('/') }}/reservation'>Book Your Table</a> </div>
  </div>
</div>
@push('script')
<script>
    var sPageURL = window.location.href.split('/')[4];
    var param = sPageURL.split('-');
    var len = param.length;
    var menuId = param[len - 1];
    $("#chk_" + menuId).addClass('active');
</script>
@endpush