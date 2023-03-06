@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard | Create Ititnerary')

@section('styles') 
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
@endsection

@section('content')
<!-- Hotel Details in mobile -->
<div class="hotel_view_mobile_hide animated slideInUp">

</div>
<!-- /Hotel Details in mobile -->
<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-content">
					<!-- Tab Start -->
					<div class=" active custom_tab_main tab_border">
						<div class="col s12">
							<ul class="custom_tabs">
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'getcheckinorder') active @endif;" href="{{URL::to('/operator/getcheckinorder/')}}">Checkin Bookings </a>
								</li>
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'getcheckoutorder') active @endif;" href="{{URL::to('/operator/getcheckoutorder/')}}">Checkout Bookings </a>
								</li>
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'getclosedorder') active @endif;" href="{{URL::to('/operator/getclosedorder/')}}">Closed Bookings </a>
								</li>
							</ul>
						</div>
					</div> 
					<!-- /Tab End -->
				
					<div class="row" id="details">					
						<div class="col s12 m12">
							<h3 class="card-title follow_title"><strong>Tomorrow Checkin Bookings</strong></h3>
							<div class="preview_payment_his">
								<table class="table" style="font-size:12px;color:#000;">
									<thead>
										<tr>
											<th>Order No</th>
											<th>Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Adult</th>
											<th>Kids</th>
											<th>Infant</th>
											<th>Hotel</th>
											<th>CheckIn</th>
											<th>CheckOut</th>
											<th>Create Date</th>
											<th>Total Amount</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($orders as $order)
										<tr>
											<td style="width:100px;">{{$order->send_quotation_no}}</td>
											<td>{{$order->name}}</td>
											<td>{{$order->email}}</td> 
											<td>{{$order->mobile}}</td>
											<td>{{$order->adult}}</td>
											<td>{{$order->kids}}</td>
											<td>{{$order->infant}}</td>
											<td>{{getHotelName($order->hotel_id)}}</td>
											<td>{{date('d M, Y', strtotime($order->checkin))}}</td>
											<td>{{date('d M, Y', strtotime($order->checkout))}}</td>
											<td>{{date('d M, Y h:i A', strtotime($order->created_at))}}</td>
											<td>{{$order->cost}}</td>
											<td>
												<span class="{{$order->status}}">{{$order->status}}</span>
											</td>
											<td>
												<form action="/operator/cencelorders" method="post">
												{{csrf_field()}}
													<input type="hidden" name="order_id" value="{{$order->order_id}}" />
													<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" @if($order->status == 'canceled') {{'disabled'}} @endif>Cancel</button>
												</form>
											</td>
										</tr>
										<tr>
											<td colspan="14" class="{{$order->send_quotation_no}}" style="font-size:12px;border: 1px solid #eee;background-color: #2962ff0d; display:none;" border="1">
												<table class="table" style="font-size:12px;">
													<thead>
														<tr>
															<th>#</th>
															<th>Name</th>
															<th>Amount</th>
															<th>Payment Source</th>
															<th>Screenshort</th>
															<th>Hotel</th>
															<th>CheckIn</th>
															<th>Status</th>
															<th>Create Date</th>
															<th>Approval Date</th>
															<th>Approval URL</th>
														</tr>
													</thead>
													<tbody>
														@foreach($order->orderpayment as $paymenthistory)
														<tr>
															<td>
																<i class="material-icons" onclick="CopyToText('url{{$paymenthistory->id}}');" style="cursor: pointer;">content_copy</i> <span class="notify_msg" style="font-size:12px;"></span>
																
																<a href="whatsapp://send?text={{url('/paymentapproval/'.$paymenthistory->id)}}" data-action="share/whatsapp/share" class="btn waves-effect gradient-45deg-red-pink waves-light">Share</a> 
															</td>
															<td>{{$paymenthistory->name}}</td>
															<td>{{$paymenthistory->amount}}</td>
															<td>{{$paymenthistory->payment_to}}</td>
															<td><a href="{{asset('storage/app/'.$paymenthistory->pay_screenshort)}}" target="_blank"><img src="{{asset('storage/app/'.$paymenthistory->pay_screenshort)}}" style="width:50px;" /></a></td>
															<td>{{getHotelName($paymenthistory->hotel)}}</td>
															<td>{{date('d M, Y', strtotime($paymenthistory->checkin_date))}}</td>
															<td>
																@if($paymenthistory->payment_received == 'Y')
																	<span style="width: 20px;height: 20px;background-color: green;float: left;border-radius: 100%;" title="Payment Accepted"></span>
																@elseif($paymenthistory->payment_received == 'N')
																	<span style="width: 20px;height: 20px;background-color: red;float: left;border-radius: 100%;" title="Payment Declined"></span>
																@elseif($paymenthistory->payment_received == 'P')
																	<span style="width: 20px;height: 20px;background-color: yellow;float: left;border-radius: 100%;" title="Payment Pending"></span>
																@endif
															</td>
															<td>{{date('d M, Y h:i A', strtotime($paymenthistory->created_at))}}</td>
															<td>{{date('d M, Y h:i A', strtotime($paymenthistory->approval_date))}}</td>
															<td>
																
																<p id="url{{$paymenthistory->id}}" style="">{{url('/paymentapproval/'.$paymenthistory->id)}}</p>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								
								{{ $orders->links() }}
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="save_flag" value="{{Session::get('payment_add_back')}}" />
@endsection

@section('scripts')
    <!-- ITINERARY SCRIPT JS-->
		<script src="{{ URL::asset('public/asset/js/custom/itinerary_script.js') }}"></script>
    <!-- ITINERARY SCRIPT JS-->
	<script>
	// Show the payment history
	function showPaymentHistory (classname){
		jQuery("."+classname).slideToggle('slow');
	}
    </script>
    
@endsection