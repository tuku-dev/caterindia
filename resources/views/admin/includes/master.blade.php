<!DOCTYPE html>
<html lang="en" ng-app="yorubaModule">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="csrf-token" content="{{ csrf_token()}}" />
<title>@yield('title')</title>
<link href="{{ asset('public/admin/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('public/admin/assets/css/main.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/admin/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{  asset('public/admin/assets/css/fontawesome/font-awesome.min.css') }}">
@yield('css')
<script type="text/javascript" src="{{  asset('public/admin/assets/js/libs/jquery-1.10.2.min.js') }}"></script>
<script type="text/javascript" src="{{  asset('public/admin/bootstrap/js/bootstrap.min.js') }}"></script>
<link href="{{ asset('public/admin/assets/css/login.css') }}" rel="stylesheet" type="text/css"/>

<!--For menu Scrolling -->
<script type="text/javascript" src="{{  asset('public/admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{  asset('public/admin/plugins/slimscroll/jquery.slimscroll.horizontal.min.js') }}"></script>

<!--For menu + - -->
<script type="text/javascript" src="{{  asset('public/admin/assets/js/libs/breakpoints.js') }}"></script>
<script type="text/javascript" src="{{  asset('public/admin/assets/js/app.js') }}"></script>


<!--Table sorter-->
@if (Session::get('admin_id')!='')
   <style>
#tbl_content_filter {
	float:right;
}
.pagination {
	float:right;
}
</style>
   <script type="text/javascript" src="{{ asset('public/admin/data-tables/jquery.dataTables.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('public/admin/data-tables/dataTables.bootstrap.min.js') }}"></script>
@endif
<script type="text/javascript">
  $.ajaxSetup({
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
  });
  </script>
</head>

<body @if(Session::get('admin_id')=='')class="login"@endif>
<div id="load">
<img src="{{ asset('public/images/Disk.gif') }}" />
</div>
@if (Session::get('admin_id')!='')
          @include('admin.includes.admin-header')
      @endif
<div id="container"> @if (Session::get('admin_id')!='')
  @include('admin.includes.admin-sidebar')
  @endif
  
  @yield('content') </div>
</body>
@stack('scripts')
<script type="text/javascript" src="{{  asset('public/admin/assets/js/custom.js') }}"></script>
</html>