@if(Request::segment(2) != 'scanvisitingcard')
@if(!session()->exists('operator'))
<script>window.location.href="{{ URL::to('/operator') }}"</script>
@endif
@endif

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="theme-color" content="#8e24aa" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ URL::asset('public/asset/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/asset/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/jquery-jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/data-tables/css/buttons.dataTables.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/dashboard.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
	<!-- Ebsober Style -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/themes/ensober_style.css') }}">
    <!-- Ensober Style -->
	<!-- BEGIN: app-sidebar.css-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/app-sidebar.css') }}">
    <!-- END: app-sidebar.css-->
	
	<!-- BEGIN: app-email.css-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/app-email.css') }}">
    <!-- END: app-email.css-->
	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/page-contact.css') }}">
	
	<!-- Date Picker -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/custom/jquery.datetimepicker.css') }}"/>
	<!-- /Date Picker -->
	<!-- Animated -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/custom/animate.css') }}">
	<!-- / Animated -->
	
	<!-- Select2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #main{
            width: 99% !important;
        }
    </style>
	<!-- /Select2 -->
    @yield('styles')

  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('operator.include.header')
    <!-- END: Header-->



    <!-- BEGIN: SideNav-->
    @include('operator.include.nav')
    <!-- END: SideNav-->
    
    <!-- Alert Message -->
    @include('common.notify')
    <!-- /Alert Message -->
    

    <!-- BEGIN: Page Main-->
    @yield('content')
    <!-- END: Page Main-->

    
    <!-- BEGIN: Footer-->
	@yield('footer')
    <!-- END: Footer-->
	
    <!-- BEGIN VENDOR JS-->
    <script src="{{ URL::asset('public/asset/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('public/asset/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--<script src="{{ URL::asset('public/asset/vendors/chartjs/chart.min.js') }}"></script>--> 
    <script src="{{ URL::asset('public/asset/vendors/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('public/asset/vendors/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('public/asset/js/plugins.js') }}" type="text/javascript"></script>
	<!-- Open mobile view pages -->
	<script src="{{ URL::asset('public/asset/js/custom/mobile_view_pages.js') }}" type="text/javascript"></script>
	<!-- Open mobile view pages -->
    <script src="{{ URL::asset('public/asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('public/asset/js/scripts/dashboard-analytics.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/scripts/vectormap-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/scripts/advance-ui-modals.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- PASS THE CSRF TOKEN FOR AJAX REQUERT -->
    <script>
      jQuery.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    </script>
    <!-- /PASS THE CSRF TOKEN FOR AJAX REQUERT -->
    <script src="{{ URL::asset('public/asset/js/jquery.bpopup.min.js') }}" type="text/javascript"></script>
    
    <!-- This js is use for grievance module -->
    <script src="{{ URL::asset('public/asset/js/grievance.js') }}"></script>
    <script src="{{ URL::asset('public/asset/js/menuSearch.js') }}"></script>
	@yield('scripts')
    <script src="{{ URL::asset('public/asset/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/buttons.html5.min.js') }}" type="text/javascript"></script>
	
	<!-- Date Picker -->
		<script src="{{ URL::asset('public/asset/js/jquery.datetimepicker.full.js') }}" type="text/javascript"></script>
	<!-- /Date Picker -->
	<!-- Select2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		jQuery(document).ready(function() {
			jQuery('.select2').select2();
		});
	</script>
	<!-- /Select2 -->
    
  </body>
  
</html>