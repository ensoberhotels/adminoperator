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
	<!-- /Select2 -->
	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
	
    <style>
		span.canceled {
			background-color: red;
			padding: 0 5px 1px;
			border-radius: 3px;
			color: #fff;
			text-transform: capitalize;
		}
		span.ordered {
			background-color: green;
			padding: 0 5px 1px;
			border-radius: 3px;
			color: #fff;
			text-transform: capitalize;
		}
		.preview_payment_his {
			float: left;
			width: 100%;
			overflow: auto;
		}
        .step-actions { 
            float: right;
        }
		span.notify_msg {
			position: absolute;
		}
		li.page-item.active {
			padding: 7px;
			line-height: 15px;
			color: #fff;
		}
        .show_select select{display:block;}
		table, th, td {
		  /*border: 1px solid black;*/
		  border-collapse: collapse;
		}
		th, td { 
		  padding: 1px;
		  text-align: left; 
			border:0px 0px 0px 1px;
		}
		ul.custom_tabs {
			float: left;
			width: 100%;
			margin-bottom: 1px;
		}
		li.custom_tab {
			float: left;
		}
		li.custom_tab a {
			background-color: #00bcd4;
			padding: 12px 35px;
			color: #fff;
			font-size: 17px;
			margin-right: 10px;
			margin-bottom: 10px;
			display: inline-block;
		}
		li.custom_tab a.active {
			border-bottom: 5px solid #ff4081;
			padding: 12px 35px 6px;
		}
		.comment_main {
			float: left;
			text-align: left;
			width: 100%;
			box-shadow: 0 0px 1px 1px;
			height: 280px;
			overflow-y: scroll;
			padding: 15px 0;
		} 
		.comment_main ul {
			float: left;
			margin: 0;
			padding: 0;
		}
		.comment_main li a {
			float: left;
			width: 100%;
			padding: 5px 10px;
			cursor: pointer;
		}
		.comment_main li:hover >a {
			background-color: #faf7f7;
		}
		.sidebar .sidebar-content .sidebar-menu ul li.active{
			padding-left: 0px !important;
		}
		.sidebar .sidebar-content .sidebar-menu ul li.active {
			padding: 2px 0;
			font-size: 16px;
			margin: 0 0 12px;
		}
		ul.email-list.display-grid {
			margin: 0;
		}
		a.text-sub {
			float: left;
			width: 100%;
			margin: 0;
			padding: 0 10px 0 !important;
		}
		.follow_text {
			float: left;
			width: 100%;
			padding: 0px 0 0 10px;
			box-sizing: border-box;
			word-break: break-all;
		}
		.follow_input {
			float: left;
			width: 100%;
		}
		.carousel.carousel-slider .carousel-item{min-height:500px;}
		.sidebar .sidebar-content .sidebar-menu ul li {
			cursor: auto;
			color: #fff;
		}
		.follow_text span {
			float: right;
			text-align: left;
			width: 88%;
			padding: 3px 13px 0 0;
		}
		b.mobile_msg {
			float: left;
			background-color: red;
			color: #fff;
			width: 51px;
			margin: -7px 7px 0;
			border-radius: 5px;
			font-size: 13px;
			box-shadow: inset 0 0 6px 2px #fff;
			display:none;
		}
		.carousel.carousel-slider .carousel-fixed-item {
			z-index: unset;
		}
		.indicators{display:none;}
		.contact_input {
			color: #fff;
			border-bottom: 1px solid #fff !important;
			padding: 0 !important;
			margin: 0 !important;
			height: 100% !important;
			display:none;
		}
		.fixed-action-btn i {
			font-size: 36px !important;
			margin-top: 30px;
		}
		.fixed-action-btn {
			display: block !important;
		}
		.hotel_details {
			float: left;
			width: 100%;
			border-bottom: 1px solid #555;
			padding-bottom: 5px;
		}
		.btn-floating {
			font-size: 0px !important;
			padding: 0px !important;
			width: 24px !important;
			height: 24px !important;
			margin: 1px !important;
		}
		.daywaise_details {
			float: left;
			width: 100%;
		}
		.daywaise_info {
			float: left;
			width: 100%;
			border-bottom: 1px solid #d1cccc;
			padding-bottom: 8px;
		}
		.email_body {
			padding: 0 0px;
			height: 500px;
			overflow-y: auto;
		}
		div#email_body footer {
			position: unset;
		}
		div#email_body header {
			position: unset;
		}
		div#email_body main {
			margin-top: 0px;
			margin-bottom: 0px;
		}
		.generate_send_quo:disabled {
			color: #fff !important;
		}
		li.custom_tab {
			height: auto !important; 
		}
		footer{display:none;}
		.fgsilement{display:none;}
		.hotel_view_mobile {
			float: left;
			width: 95%;
			background-color: #fff;
		}
		.hotel_view_mobile .hotel_detail_main {
			margin: 3px;
		}
		.hotel_view_mobile .close_btn {
			position: absolute;
			right: 3%;
			display:block !important;
			cursor:pointer;
		}
		.hotel_view_mobile .detal_1 {
			width:100%;
		}
		.hotel_view_mobile .hotel_img {
			width: 100%;
			height: auto;
		}
		div#daywaise_info:first-child .remove_horoty {
			display: none;
		}
		div#daywaise_info:first-child .btn_text {
			display: none;
		}
		
		.rate_no_ava_error {
			background-color: red;
			color: #fff;
			font-size: 12px;
			padding: 5px 0;
			text-align: center;
			font-weight: bold;
			display: none;
		}
		.head_hotel_name {
			font-size: 18px;
			color: #ff4081;
		}
		.same_agent_cbox {
			display: none;
			font-size: 12px;
		}
		@media only screen and (max-width: 430px)
			li.custom_tab {
				height: auto !important; 
			}
			li.custom_tab a{padding: 8px 12px 8px !important;}
			li.custom_tab a.active {
				padding: 8px 12px 3px !important; 
			}
		}
		
		
		
	</style>

  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
  
<!-- Hotel Details in mobile -->
<div class="hotel_view_mobile_hide animated slideInUp">

</div>
<!-- /Hotel Details in mobile -->
<!-- BEGIN: Page Main-->
<div id="main1">
    <div class="row">
        <div class="container">
			<div style="margin: 15px 0 0; text-align:center;">
				<a href="https://www.ensoberhotels.com/"><img src="https://www.ensoberhotels.com/images/logo.png" id="logo" style="width: 105px;"></a>
			</div><br>
            <div class="card">
                <div class="card-content">
				
					<div class="row" id="details">					
						<div class="col s12 m12">
							<h3 class="card-title follow_title"><strong>Accept Order Accounting And Closed</strong></h3>
							<div class="preview_payment_his">
								<table class="table" style="font-size:12px;color:#000;">
									<thead>
										<tr>
											<th style="font-size: 15px;">Order No</th>
											<th style="font-size: 15px;">Name</th>
											<th style="font-size: 15px; display:none;">Email</th>
											<th style="font-size: 15px; display:none;">Mobile</th>
											<!--<th style="font-size: 15px;">Adult</th>
											<th style="font-size: 15px;">Kids</th>
											<th style="font-size: 15px;">Infant</th>
											<th style="font-size: 15px;">Hotel</th>-->
											<th style="font-size: 15px;">CheckIn</th>
											<th style="font-size: 15px;">CheckOut</th>
											<th style="font-size: 15px; display:none;">Create Date</th>
											<th style="font-size: 15px;">Total Amount</th>
											<th style="font-size: 15px;">Advance Hotel</th>
											<th style="font-size: 15px;">Received Ensober</th>
											<th style="font-size: 15px;">Direct At Hotel</th>
										</tr>
									</thead>
									<tbody>
										@foreach($orders as $order)
										@php
											$total_amount = $order->cost;
											$hotel_receive = getHotelReceivedAmount($order->send_quotation_no);
											$owner_receive = getOwnerReceivedAmount($order->send_quotation_no);
											$total_receive = $hotel_receive+$owner_receive;
											$direct_hotel_receive = $total_amount-$total_receive;
										@endphp
										<tr>
											<td style="width:100px; padding:5px 5px 20px!important; font-size: 15px;">{{$order->send_quotation_no}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px;">{{$order->name}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px; display:none;">{{$order->email}}</td> 
											<td style="padding:5px 5px 20px!important; font-size: 15px; display:none;">{{$order->mobile}}</td>
											<!--<td style="padding:5px 5px 20px!important; font-size: 15px;">{{$order->adult}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px;">{{$order->kids}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px;">{{$order->infant}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px;">{{getHotelName($order->hotel_id)}}</td>-->
											<td style="padding:5px 5px 20px!important; font-size: 15px;">{{date('d M, Y', strtotime($order->checkin))}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px;">{{date('d M, Y', strtotime($order->checkout))}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px; display:none;">{{date('d M, Y h:i A', strtotime($order->created_at))}}</td>
											<td style="padding:5px 5px 20px!important; font-size: 15px;">{{$order->cost}}</td>
<td style="padding:5px 5px 20px!important; font-size: 15px;" title="Advance Hotel">{{$hotel_receive}}</td>
											
<td style="padding:5px 5px 20px!important; font-size: 15px;" title="Received Ensober">{{$owner_receive}}</td>
											
<td style="padding:5px 5px 20px!important; font-size: 15px;" title="Direct At Hotel">{{$direct_hotel_receive}}</td>
											
										</tr>
										<tr>
											<td colspan="13" class="{{$order->send_quotation_no}}" style="font-size:12px;border: 1px solid #eee;background-color: #2962ff0d;" border="1">
												<table class="table" style="font-size:12px;">
													<thead>
														<tr>
															<th>#</th>
															<th>Name</th>
															<th>Amount</th>
															<th>Payment Source</th>
															<th>Screenshort</th>
															<!--<th>Hotel</th>
															<th>CheckIn</th>-->
															<th>Status</th>
															<!--<th>Create Date</th>-->
															<th>Approval Date</th>
														</tr>
													</thead>
													<tbody>
														@php $x = 1; @endphp
														@foreach(@$order->orderpayment as $paymenthistory)
														<tr>
															<td>
																{{$x}} 
															</td>
															<td>{{$paymenthistory->name}}</td>
															<td>{{$paymenthistory->amount}}</td>
															<td>{{$paymenthistory->payment_to}}</td>
															<td><a href="{{asset('storage/app/'.$paymenthistory->pay_screenshort)}}" target="_blank"><img src="{{asset('storage/app/'.$paymenthistory->pay_screenshort)}}" style="width:50px;" /></a></td>
															<!--<td>{{getHotelName($paymenthistory->hotel)}}</td>
															<td>{{date('d M, Y', strtotime($paymenthistory->checkin_date))}}</td>-->
															<td>
																@if($paymenthistory->payment_received == 'Y')
																	<span style="width: 20px;height: 20px;background-color: green;float: left;border-radius: 100%;" title="Payment Accepted"></span>
																@elseif($paymenthistory->payment_received == 'N')
																	<span style="width: 20px;height: 20px;background-color: red;float: left;border-radius: 100%;" title="Payment Declined"></span>
																@elseif($paymenthistory->payment_received == 'P')
																	<span style="width: 20px;height: 20px;background-color: yellow;float: left;border-radius: 100%;" title="Payment Pending"></span>
																@endif
															</td>
															<!--<td>{{date('d M, Y h:i A', strtotime($paymenthistory->created_at))}}</td>-->
															<td>{{date('d M, Y h:i A', strtotime($paymenthistory->approval_date))}}</td>
														</tr>
														@php $x++; @endphp
														@endforeach
													</tbody>
												</table>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="col s12 m12" style="text-align:center;"><br>
							@if($order->$closefrom == '1') 
								<h4>Closed</h4> 
							@else
								<form action="/operator/closedstatus" method="post" onsubmit="return confirm('Are you sure you want to close this order?');">
								{{csrf_field()}}
									<input type="hidden" name="send_quotation_no" value="{{$order->send_quotation_no}}" />
									<input type="hidden" name="closedfrom" value="{{$closefrom}}" />
									<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" >Accepted</button>
								</form>
							@endif
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>


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

	
    <script src="{{ URL::asset('public/asset/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/buttons.html5.min.js') }}" type="text/javascript"></script>
	
	<!-- Date Picker -->
		<script src="{{ URL::asset('public/asset/js/jquery.datetimepicker.full.js') }}" type="text/javascript"></script>
	<!-- /Date Picker -->
    <script src="{{ URL::asset('public/asset/js/jquery.bpopup.min.js') }}" type="text/javascript"></script>
	
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