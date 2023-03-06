<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	
	<meta content="Payment Approval - {{ getHotelName(@$payment_detail->hotel) }} - {{ @$payment_detail->name }} - {{ getPaymentSource(@$payment_detail->payment_to) }} - {{ @$payment_detail->amount }} /-" itemprop="name">
	<meta content="Payment Approval - {{ getHotelName(@$payment_detail->hotel) }} - {{ @$payment_detail->name }} - {{ getPaymentSource(@$payment_detail->payment_to) }} - {{ @$payment_detail->amount }} /-" property="og:title">
	
	<meta content="{{ url('/storage/app/'.@$payment_detail->pay_screenshort) }}" itemprop="image">
	<meta content="{{ url('/storage/app/'.@$payment_detail->pay_screenshort) }}" property="og:image">
	
	<meta content="100" property="og:image:width">
	<meta content="100" property="og:image:height">
	
	<meta content="Payment Approval - {{ getHotelName(@$payment_detail->hotel) }} - {{ @$payment_detail->name }} - {{ getPaymentSource(@$payment_detail->payment_to) }} - {{ @$payment_detail->amount }} /-" itemprop="description">
	<meta content="Payment Approval - {{ getHotelName(@$payment_detail->hotel) }} - {{ @$payment_detail->name }} - {{ getPaymentSource(@$payment_detail->payment_to) }} - {{ @$payment_detail->amount }} /-" property="og:description">
	
    <title>Payment Approval - {{ getHotelName(@$payment_detail->hotel) }} - {{ @$payment_detail->name }} - {{ getPaymentSource(@$payment_detail->payment_to) }} - {{ @$payment_detail->amount }} /-</title>
    <link rel="apple-touch-icon" href="{{URL::asset('public/asset/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/asset/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/login.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/custom/custom_hide.css')}}">
    <!-- END: Custom CSS-->
	<style>
		.user_details {
			position: absolute;
			background-color: #0000009c;
			color: #fff;
			bottom: 1px;
			width: 100%;
			padding: 0 5px 0;
		}
		button.btn {
			padding: 0 11px 0 !important;
			font-size: 12px;
		}
	</style>
  </head>
  <!-- END: Head-->
  <body >
    <div class="row">
		<div class="col s12" style="text-align: center; padding: 0;">
			<div style="margin: 15px 0 0;">
				<a href="https://www.ensoberhotels.com/"><img src="https://www.ensoberhotels.com/images/logo.png" id="logo" style="width: 105px;"></a>
			</div><br>
			
			@if(@$payment_detail->payment_received == 'Y')
				<b style="color:green;">Payment Accepted</b><br>
				<img src="{{ url('public/asset/images/payment_accept.gif') }}" class="img-responsive" style="width: 250px;">
				<h5>{{ getHotelName(@$payment_detail->hotel) }}</h5>
				<p>
					Name: {{ @$payment_detail->name }}<br>
					Sourse: {{ getPaymentSource(@$payment_detail->payment_to) }}<br>
					Amount: {{ @$payment_detail->amount }} /-
				</p>
			@elseif(@$payment_detail->payment_received == 'N')
				<b style="color:red;">Payment Declined</b><br>
				<img src="{{ url('public/asset/images/payment_decline.gif') }}" class="img-responsive" style="width: 250px;">
				<h5>{{ getHotelName(@$payment_detail->hotel) }}</h5>
				<p>
					Name: {{ @$payment_detail->name }}<br>
					Sourse: {{ getPaymentSource(@$payment_detail->payment_to) }}<br>
					Amount: {{ @$payment_detail->amount }} /-
				</p>
			@else
			<img src="/storage/app/{{ @$payment_detail->pay_screenshort }}" class="img-responsive" style="height: 600px;">
			<div class="user_details">
				<h5 style="color:#fff;">{{ getHotelName(@$payment_detail->hotel) }}</h5>
				<p>
					Name: {{ @$payment_detail->name }}<br>
					Sourse: {{ getPaymentSource(@$payment_detail->payment_to) }}<br>
					Amount: {{ @$payment_detail->amount }} /-
				</p>
				<div class="row">
					<form class="quotation" method="post" action="/paymentapprovalaction">
					{{csrf_field()}}
						<input type="hidden" value="{{ @$payment_detail->id }}" name="id" />
						<div class="col s4">
							<button type="submit" value="N" class="btn" name="payment_received">Decline</button>
						</div>
						
						<div class="col s4">
							<button type="submit" value="P" class="btn" style="background-color: #007cba;" name="payment_received">Pending</button>
							<span style="font-size:12px; color:#fff;">{!! Session::get('flash_success') !!}</span>
						</div>
						
						<div class="col s4">
							<button type="submit" value="Y" class="btn" style="background-color: #14b214;" name="payment_received">Accept</button>
						</div>
					</form>
				</div><br>
			</div>
			@endif
        </div>
      </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ URL::asset('public/asset/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('public/asset/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
</html>