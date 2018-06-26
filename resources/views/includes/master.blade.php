<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Favicon -->
<link type="image/x-icon" rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" />
<title>@yield('title')</title>
<meta name="keywords" content="@yield('keywords')">
<meta name="description" content="@yield('description')">
<meta name="_token" content="{{ csrf_token() }}">
<!-- Bootstrap stylesheet -->

<link href="{{ asset('public/libs/bootstrap-4.0.0-dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- icofont -->
<link href="{{ asset('public/libs/icofont/css/icofont.css') }}" rel="stylesheet" type="text/css" />
<!-- crousel css -->
<link href="{{ asset('public/libs/owlcarousel2/assets/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
<!-- mb.YTPlayer css -->
<link href="{{ asset('public/libs/mb.YTPlayer/css/jquery.mb.YTPlayer.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Switch Style css -->
<link href="{{ asset('public/switch-style/switch-style.css') }}" rel="stylesheet" type="text/css"/>
<!-- Theme Stylesheet -->
<link href="{{ asset('public/css/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('public/css/custome.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('public/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('public/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- Switch Color Style css -->
@yield('css')
</head>
<body>
<div class="wrapper"> 
  <!--  Header Start  -->
  <header> 
    <!--Top Header Start --> 
    @include('includes.header') 
    <!--Top Header End --> 
  </header>
  <!-- Header End   --> 
  @yield('content') 
  
  <!-- Newsletter Start -->
  <div id="newsletter">
    @include('includes.newslatter')
  </div>
  <!-- Newsletter End --> 
  <!-- Footer Start -->
  <footer> @include('includes.footer') </footer>
  <!-- Footer End  --> 
</div>
<!-- jquery --> 
<script src="{{ asset('public/libs/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('public/js/caterindia-validation.js') }}"></script>
<!-- jquery Validate --> 
<script src="{{ asset('public/libs/jquery-validation/jquery.validate.min.js') }}"></script> 
<!-- popper js --> 
<script src="{{ asset('public/libs/popper/popper.min.js') }}"></script> 
<!-- bootstrap js --> 
<script src="{{ asset('public/libs/bootstrap-4.0.0-dist/js/bootstrap.min.js') }}"></script> 
<!-- owlcarousel js --> 
<script src="{{ asset('public/libs/owlcarousel2/owl.carousel.min.js') }}"></script> 
<!--inview js code--> 
<script src="{{ asset('public/libs/jquery.inview/jquery.inview.min.js') }}"></script> 
<!--CountTo js code--> 
<script src="{{ asset('public/libs/jquery.countTo/jquery.countTo.js') }}"></script> 
<!-- mb.YTPlayer js code--> 
<script src="{{ asset('public/libs/mb.YTPlayer/jquery.mb.YTPlayer.min.js') }}"></script> 
<!-- Switch Style js --> 
<script src="{{ asset('public/switch-style/switch-style.js') }}"></script> 
<!--internal js--> 
<script src="{{ asset('public/js/internal.js') }}"></script>
<script src="{{ asset('public/js/bootstrap-datepicker.js') }}"></script> 
<script src="{{ asset('public/js/jquery-ui.min.js') }}"></script> 
@stack('script') 
<script type="text/javascript">
$.ajaxSetup({
	headers: {
		'X-CSRF-Token': $('meta[name="_token"]').attr('content')
	}
});
</script>
</body>
</html>
