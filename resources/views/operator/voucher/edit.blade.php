@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard | Create Ititnerary')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
    <style>
        .step-actions {
            float: right;
        }
		.head_hotel_name {
			font-size: 18px;
			color: #ff4081;
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
		#final_cost_check {
			position: unset;
			opacity: 1;
			pointer-events: auto;
			width: 13px !important;
			height: 13px !important;
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
		.room_inventory_fields {
			float: left;
			width: 100%;
			display:none;
		}
		.url_qrcode{display:none;}
		.upload_image_popup {
			background-color: #fff;
			display:none;
		}
		span.b-close.close_btn {
			position: absolute;
			color: #fff;
			right: 6px;
			cursor: pointer;
		}
		div#details {
			margin-bottom: 0px !important;
		}
		button#addbookingbtn {
			margin-top: 20px !important;
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
@php
	if(@$_GET['update'] == 1){
		$con_class = 'ven_update_mode';
	}else{
		$con_class = '';
	}
@endphp
<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-content">
					<!-- Tab Start -->
					<div class=" active custom_tab_main tab_border">
						<div class="col s12">
							<ul class="custom_tabs" style="margin-bottom: 0;">
								<!--<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'makeitineraryv1') active @endif;" href="{{URL::to('/operator/makeitineraryv1/')}}">Itinerary By Lead </a>
								</li>
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'pastcontactfollowup') active @endif;" href="{{URL::to('/operator/pastcontactfollowup/')}}">New Itinerary </a>
								</li>-->
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'makequotation') active @endif;" href="{{URL::to('/operator/makequotation/')}}">Send Quotation</a>
								</li>
							</ul> 
						</div>
					</div> 
					<!-- /Tab End -->
				
					<div class="row" id="details">
						<form class="form-inline {{$con_class}}" action="javascript:openUpdateQuotationPage()" >
							<label for="sendquomo" class="mb-2 mr-sm-2">Search Quotation:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="sendquomo" placeholder="Enter Send Quotation No" name="sendquomo" style="width:130px !important;">
							   
							<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light" onclick="openUpdateQuotationPage();" style="margin-top:7px !important;">Search</button>
						</form>
						<div class="col s12 m4">
							<h3 class="card-title follow_title"><strong>Quotation Details</strong></h3>
							<div class="itin_detail_main">
							<form class="quotation" id="quotation" method="post" action="" enctype="multipart/form-data">
							@php
								$checkroominv = Session::get('operator.room_inventory');
								$session_data = Session::get('operator');
							@endphp
							{{csrf_field()}} 
								<ul class="collapsible" data-collapsible="accordion">
									<li id="basic_info" class="iti_input_form"> 
										<div class="collapsible-header">
											<i class="material-icons">dvr</i>Basic Info
										</div>
										<div class="collapsible-body">
											@if(@$_GET['update'] == 1)
											<div class="hotel_details">
												@foreach($hotels as $hotel)
													@if(@$quotation[0]->hotel_id == $hotel->id)
														<center><b>{{ $hotel->hotel_name }} ({{ $hotel->start_category}} STAR)</b></center>
													@endif
												@endforeach
											</div>
											@endif
											
											<div class="hotel_details {{$con_class}}">
												@if(@$checkroominv[0] == 'Y')
													<div class="col s12 m12">
														<b class="head_hotel_name">{{getHotelName($session_data['hotel'][0])}}</b>
													</div>
													<input type="hidden" value="{{$session_data['hotel'][0]}}" name="hotel" id="hotel_list" class="hotel_list"/>
												@else
													<div class="col s12 m6">
														<label for="arrival_city" class="">Destination</label>
														<select name="destination" id="distination" class="distination" tabindex="0">
															<option>Select Destination</option>
															@foreach($citiesh as $city)
															<option value="{{$city->city_id}}" @if(@$quotation[0]->destination == $city->city_id) {{'selected'}} @endif>{{$city->name}}</option>
															@endforeach
														</select>          
													</div>
													<div class="col s12 m6">
														<label for="arrival_city" class="">Hotel</label>
														<select name="hotel" class="hotel_list" id="hotel_list" tabindex="0" onchange="getHotelDetailView();"> 
															<option>Select Hotel</option>
															@foreach($hotels as $hotel)
																<option value="{{ $hotel->id }}" @if(@$quotation[0]->hotel_id == $hotel->id) {{ 'selected' }} @endif>{{ $hotel->hotel_name }} ({{ $hotel->start_category}} STAR)</option>
															@endforeach
														</select>          
													</div>
												@endif
											</div> 
											<div class="daywaise_details">
												@foreach($quotation as $quot)
												<div class="daywaise_info" id="daywaise_info">
													<div class="col s12 m5">
														<label for="checkin" class="">CheckIN</label>
														<input type="date" name="daywaise[checkin][]" id="checkin" class="filter_date" value="{{ $quot->checkin }}" autocomplete="off">         
													</div>
													<div class="col s12 m5">
														<label for="checkout" class="">CheckOut</label>
														<input type="date" name="daywaise[checkout][]" id="checkout" class="filter_date" value="{{ $quot->checkout }}" autocomplete="off">         
													</div>
													<div class="col s12 m2">
														<label for="night" class="" title="No Of Nights">Nights</label>
														<input type="number" value="{{ $quot->night }}" name="daywaise[night][]" id="night" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="room_type" class="">Rooms Type</label>
														<select name="daywaise[room_type][]" id="room_type" class="room_type_list" tabindex="0">
															<option>Select Rooms Type</option>
															@foreach($quot->roomtypes as $roomtype)
																<option value="{{ $roomtype->room_type_id }}" @if($quot->room_type == $roomtype->room_type_id) {{ 'selected' }} @endif> {{ $roomtype->type }} ( {{ $roomtype->name}} )</option>
															@endforeach
														</select>
													</div>
													<div class="col s12 m6"> 
														<label for="meal_type" class="">Meal Plan</label>
														<select name="daywaise[meal_type][]" id="meal_type" tabindex="0">
															<option value="">Select Meal Plan</option>
															<option value="ep_price" @if($quot->meal_type == 'ep_price') {{'selected'}} @endif>EP (Room Only)</option>
															<option value="cp_price" @if($quot->meal_type == 'cp_price') {{'selected'}} @endif>CP (Room with Breakfast)</option>
															<option value="map_price" @if($quot->meal_type == 'map_price') {{'selected'}} @endif>MAP (Room with Brkfst &amp; Dnr)</option>
															<option value="ap_price" @if($quot->meal_type == 'ap_price') {{'selected'}} @endif>AP (Room with all meals plan)</option>
														</select>
													</div>
													<div class="col s12 m2">
														<label for="rooms" class="" title="No Of Rooms">Rooms</label>
														<input type="number" name="daywaise[rooms][]" value="{{ $quot->rooms }}" id="rooms">
													</div>
													<!--<div class="col s12 m2">
														<label for="night" class="" title="No Of Nights">Nights</label>
														<input type="number" value="{{ $quot->night }}" name="daywaise[night][]" id="night">
													</div>-->
													<div class="col s12 m2">
														<label for="adult" class="" title="No Of Adults">Adults</label>
														<input type="number" value="{{ $quot->adult }}" name="daywaise[adult][]" id="adult" class="check_das">
													</div> 
													<div class="col s12 m3">
														<label for="kids" class="" title="Kids (5-12 Years) with bad" style="font-size: 11px !important;">Kids WB</label>
														<input type="number" value="{{ $quot->kidswd }}" name="daywaise[kids][]" id="kids" class="check_das">       
													</div>
													
													<div class="col s12 m3">
														<label for="kids" class="" title="Kids (5-12 Years) without bad" style="font-size: 11px !important;">Kids WOB</label>
														<input type="number" name="daywaise[kidswod][]" value="{{ $quot->kidswod }}" id="kids" class="check_das">       
													</div>
													
													<div class="col s12 m2">
														<label for="infant" class="" title="Infant (below 5 Years)">Infant</label>
														<input type="number" value="{{ $quot->infant }}" name="daywaise[infant][]" id="infant" class="check_das">
													</div>
													<div class="col s6 s6">
														<a class="mb-6 btn-floating gradient-45deg-purple-deep-orange remove_horoty_hide" title="Delete" onclick="remove($(this))">
															<i class="material-icons">delete_sweep</i>
														</a>
														<span class="btn_text" style="font-size: 11px; margin: 0 5px;">Remove Room</span>
													</div>
													<div class="col s6 s6">
														<a class="mb-6 btn-floating gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
															<i class="material-icons">note_add</i>
														</a>
														<span class="btn_text" style="font-size: 11px; float:right; margin: 5px 5px; display:block;">Add Room</span>
													</div>
												</div>
												@endforeach
											</div>
											<div class="col s12 m12" style="text-align: center; margin-top: 26px !important;">
												<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('lead_details');">Next Step</button>
											</div>
										</div>
									</li>
									<li id="lead_details" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">dvr</i>Lead Details
										</div>
										<div class="collapsible-body">
											<div class="">
												<div class="col s12 m6">
													<label for="name" class="">Name</label>
													<input type="text" name="name" id="name" value="{{ $lead->name }}">
												</div>
																			
												<div class="col s12 m6">
													<label for="mobile" class="">Mobile</label>
													<input type="number" name="mobile" id="mobile" class="mobile_trim" value="{{ $lead->mobile }}">       
												</div>
												
												<div class="col s12 m6">
													<label for="email" class="">Email</label>
													<input type="email" name="email" id="email" value="{{ $lead->email }}">
												</div>
												<div class="col s12 m6" style="display:none;">
													<label for="discount" class="">Discount</label>
													<input type="number" min="0" value="0" name="discount" id="discount" value="{{ @$quotation[0]->discount }}">
												</div> 
												<div class="col s12 m6 {{$con_class}}">
													<label for="discount" class="">Type</label>
													<select id="quotation_type" name="quotation_type" onchange="changeSendQuotationBtnText();">
														<option value="quotation" @if(@$quotation[0]->quotation_type == 'quotation') {{ 'selected' }} @endif>Quotation</option>
														<option value="confirmation" @if(@$quotation[0]->quotation_type == 'confirmation') {{ 'selected' }} @endif>Confirmation</option>
														<option value="voucher" @if(@$quotation[0]->quotation_type == 'voucher') {{ 'selected' }} @endif>Voucher</option>
													</select>
												</div>
												<!-- Quotation Note -->
													<div class="col s12 m12"> 
														<label for="quotation_note">Quotation Comments:</label><input type="checkbox" value="1" name="quotation_note_status" id="quotation_note_status" style="opacity: 1;position: unset;width: 15px !important;height: 15px !important; pointer-events: auto;" @if(@$quotation[0]->quotation_note_status == '1') {{ 'checked' }} @endif><br>
														<textarea class="form-control " name="quotation_note" id="quotation_note" style="font-size: 12px;">{{ @$quotation[0]->quotation_note }}</textarea>
													</div>
												<!-- /Quotation Note -->
												
												
												<div class="col s12 m6" style="display:none;">
													<label for="discount" class="">CC Email</label>
													<input type="email" name="ccemail" id="ccemail" value="">
												</div>
												<!-- Voucher Details Fiels -->
												<div class="voucher_details" style="display: @if(@$quotation[0]->quotation_type == 'voucher') {{ 'block' }} @else {{'none'}} @endif">
													
													<div class="col s12 m6">
														<label for="confirmed_by" class="">Confirmed By</label>
														<input type="text" name="confirmed_by" id="confirmed_by" value="{{ @$quotation[0]->confirmed_by ?? '' }}"> 
													</div>
													<div class="col s12 m12"></div>
													
													<!-- For Room Inventory -->
													<div class="col s12 m6"> 
														<label for="booking_from">Booking From:</label><br>
														<select class="form-control" name="booking_from" id="booking_from">
															<option value=""></option>
															@foreach($booking_froms as $booking_from)
																<option value="{{$booking_from->title}}" @if(@$quotation[0]->booking_from == $booking_from->title) {{ 'selected' }} @endif>{{$booking_from->title}}</option>
															@endforeach
														</select>
													</div>
													<div class="col s12 m6">
														<label for="source">Source:</label><br>
														<select class="form-control" name="source" id="source">
															<option value=""></option>
															@foreach($booking_sources as $booking_source)
																<option value="{{$booking_source->title}}" @if(@$quotation[0]->source == $booking_source->title) {{ 'selected' }} @endif>{{$booking_source->title}}</option>
															@endforeach
														</select>
													</div>
													<div class="col s12 m6">
														<label for="advance_received" class="">Advance Received</label>
														<input type="number" name="advance_received" id="advance_received" value="{{ @$quotation[0]->advance_received }}" min="1">
													</div>
													<div class="col s12 m6">
														<label for="payment_source">Payment Source:</label><br>
														<select name="payment_source" id="payment_source" class="form-control" tabindex="0">
															<option></option>
															@foreach($quot->paymentsources as $paymentsource)
																<option value="{{ $paymentsource->source }}" @if($quot->payment_source == $paymentsource->source) {{ 'selected' }} @endif> {{ $paymentsource->source }}</option>
															@endforeach
														</select>
														
														<!--<select class="form-control" name="payment_source" id="payment_source">
															<option value=""></option>
															<option value="PANORMASBIACCOUNT" @if(@$quotation[0]->payment_source == 'PANORMASBIACCOUNT') {{ 'selected' }} @endif>Panorma SBI Account</option>
															<option value="UPIQRCODE" @if(@$quotation[0]->payment_source == 'UPIQRCODE') {{ 'selected' }} @endif>UPI/QR Code</option>
															<option value="PAYUMONEY" @if(@$quotation[0]->payment_source == 'PAYUMONEY') {{ 'selected' }} @endif>PayUMoney</option>
															<option value="DAYAWAY" @if(@$quotation[0]->payment_source == 'DAYAWAY') {{ 'selected' }} @endif>DayAway</option>
														</select>-->
													</div>
													
													<div class="col s12 m6">
														<label for="date_of_advance">Date Of Advance:</label><br>
														<input type="date" class="form-control" name="date_of_advance" id="date_of_advance" value="{{ @$quotation[0]->date_of_advance }}"/>
													</div>
													<div class="col s12 m6 {{$con_class}}">
														<label for="booking_status">Booking Status:</label><br>
														<select class="form-control" name="booking_status" id="booking_status">
															<option value="Confirmed" @if(@$quotation[0]->booking_status == 'Confirmed') {{ 'selected' }} @endif>Confirmed</option>
															<option value="Hold" @if(@$quotation[0]->booking_status == 'Hold') {{ 'selected' }} @endif>Hold</option>
														</select>
													</div>
													<div class="col s12 m12"> 
														<label for="comment">Internal Comments:</label><br>
														<textarea class="form-control " name="comment" id="comment" style="font-size: 12px;">{{ @$quotation[0]->comment }}</textarea>
													</div>
													<!-- For Room Inventory -->
													
													<div class="col s12 m6 hide">
														<label for="balance" class="">Balance</label>
														<input type="text" name="balance" id="balance" value="{{ @$quotation[0]->balance }}">
													</div>
													<div class="col s12">
														<label for="voucher_note" class="">Comments For Voucher:</label>
														<textarea name="voucher_note" style="font-size: 12px;" id="voucher_note" class="">{{ @$quotation[0]->voucher_note }}</textarea>
													</div>
												</div>
												<!-- /Voucher Details Fiels -->
												
												<div class="col s6 m6 {{$con_class}}"> 
													<label for="agent_details" class="">Agent Details</label><br>
													<input type="checkbox" id="agent_details" style="opacity: 1;position: unset;width: 15px !important;height: 15px !important; pointer-events: auto;" >
													&nbsp; &nbsp;
													<div class="same_agent_cbox agent_detail"> 
														<input type="checkbox" id="same_info" style="opacity: 1;position: unset;width: 15px !important;height: 15px !important; pointer-events: auto;"> Same As Guest
													</div>
												</div>
												@if(@$_GET['update'] == 1)
													<div class="col s12 m6">
														<label for="agent_name" class="">Agent Name</label>
														<input type="text" name="agent_name" id="agent_name" value="{{ @$quotation[0]->agent_name }}">
													</div>
												@else
													<div class="col s12 m6 agent_detail" style="display:none;">
														<label for="agent_name" class="">Agent Name</label>
														<input type="text" name="agent_name" id="agent_name" value="{{ @$quotation[0]->agent_name }}">
													</div>
												@endif
												
												<div class="col s12 m6 agent_detail {{$con_class}}" style="display:none;">
													<label for="agent_email" class="">Agent Email</label>
													<input type="text" name="agent_email" id="agent_email" value="{{ @$quotation[0]->agent_email }}">
												</div>
												<div class="col s12 m6 agent_detail {{$con_class}}" style="display:none;">
													<label for="agent_mobile" class="">Agent Mobile</label>
													<input type="number" name="agent_mobile" id="agent_mobile" class="mobile_trim" value="{{ @$quotation[0]->agent_mobile }}">
												</div>
												
												<div class="col s6 m6 {{$con_class}}">
													<label for="email_details_checkbox" class="">Change Mail Subject</label><br>
													<input type="checkbox" id="email_details_checkbox" style="opacity: 1;position: unset;width: 15px !important;height: 15px !important; pointer-events: auto;">
												</div>
												<div class="col s12 m12 email_details" style="display:none;">
													<label for="discount" class="">Email Subject</label>
													<input type="text" id="email_subject" />
												</div>
												<div class="col s12 m12 email_details" style="display:none;">
													<label for="discount" class="">Email Message</label>
													<textarea id="email_message" name="email_message" style="background-color: rgb(255, 255, 255);position: relative;z-index: 9;" class="editor" aria-invalid="false"></textarea>
												</div>
												@if(@$quotation[0]->quotation_type != 'quotation')
												<div class="col s12 m12">
													<label for="discount" class="">Payment Snapshot:</label>
													<a href="javascript::void(0)" class="pay_img_sh">View</a> <a href="javascript::void(0)" class="upload_img"><i class="material-icons">edit</i></a><br>
													<input type="hidden" name="payment_snapshot" id="payment_snapshot" value="{{ @$quotation[0]->payment_snapshot }}">
													<img src="/storage/app/{{ @$quotation[0]->payment_snapshot }}" class="img-responsive payment_img" style="display:none;"/>
												</div>
												@endif
												
												<div class="col s12 m12 send_q_btn_area" style="text-align: center; margin-top: 5px !important;">
												<!--<h6 class="final_cost_val"></h6>-->
													<input type="hidden" value="{{ @$quotation[0]->send_quotation_no }}" name="send_quotation_no" id="send_quotation_no"/>
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light generate_send_quo" onclick="createVoucher();">View</button>
													
													@if(@$_GET['update'] == 1)
														<a href="/operator/roomsstatus"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light">Go Back</button></a>
														
														<a href="https://ensoberfiles.s3.amazonaws.com/quotations/{{ @$quotation[0]->send_quotation_no }}.pdf" target="_blank" class="" download ><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo" >Download</button></a>
													
														<h5>Total Price: <span class="update_mode_t_price">2633</span>/-</h5>
													@endif
													
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_send_quo {{$con_class}}" onclick="sendQuotation();" style="display:none;">Send Quotation</button>
													<input type="hidden" value="https://ensoberfiles.s3.amazonaws.com/quotations/{{ @$quotation[0]->send_quotation_no }}.pdf" id="quot_pdf" />
													
													<a href="https://ensoberfiles.s3.amazonaws.com/quotations/{{ @$quotation[0]->send_quotation_no }}.pdf" target="_blank" class="{{$con_class}}" ><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo {{$con_class}}" style="display:none;">View</button></a>
													
													<a href="https://ensoberfiles.s3.amazonaws.com/quotations/{{ @$quotation[0]->send_quotation_no }}.pdf" target="_blank" class="{{$con_class}}" download ><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo" style="display:none;">Download</button></a>
													
													<p style="color:green;" class="send_quotation_msg"></p>
													<p style="color:red;" class="error_msg"></p>
													<span class=""><input type="checkbox" id="final_cost_check" @if(@$quot->final_cost > 0) {{ 'checked' }} @endif/> Change Total Cost
													</span>
													<div class="final_cost_area" style="display:@if(@$quot->final_cost > 0) {{ 'block' }} @else {{ 'none' }} @endif;">
														<div class="col s12 m6">
															<input type="number" name="final_cost" id="final_cost" value="{{ @$quot->final_cost }}">
															<span style="color:red; font-size:11px;" class="num_for_error"></span>
														</div>
														<div class="col s12 m6">
															<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_edit_final_cost" onclick="updateFinalCost();">Update Cost</button>
														</div>
													</div>
													
													<div class="quotation_update_rate rate_canculate {{$con_class}}">
														<table style="font-size:12px; margin:10px 0px 5px;" class="dayhotelrate body">
															<tbody>
																<tr> 
																	<th>Room Rate</th>
																	<th title="One Occupancy Discount">Single Ocpncy Discount</th>
																	<th>Extra Adult</th>
																	<th title="Kids Without Bed Charge">Kids W-Bed</th>
																	<th title="Kids Without Bed Charge">Kids Wo-Bed</th>
																	<th>Total Cost</th>
																</tr>
																@foreach($roomsrate as $rate)
																<tr title="{{ $rate->RoomType->room_type }}">
																<td>
																	<span class="quo_show_fiels">{{ $rate->per_night_cost }}</span>
																	<input type="number" value="{{ $rate->per_night_cost }}" style="text-align: center; width: 53px !important; padding: 0px !important; height: 20px !important;" class="quo_edit_fiels" name="quorate[per_night_cost][]">

																	<input type="hidden" value="{{ $rate->id }}" class="quo_edit_fiels" name="quorate[id][]" style="display: inline-block;">
																</td> 
																<td style="background-color: #ff000040;">
																	<span class="quo_show_fiels" >{{ $rate->one_occupancy_cost }}</span>
																	<input type="number" value="{{ $rate->one_occupancy_cost }}" style="text-align: center; width: 53px !important; padding: 0px !important; height: 20px !important;" name="quorate[one_occupancy_cost][]" class="quo_edit_fiels">
																</td>
																<td style="background-color: #ff000040;">
																	<span class="quo_show_fiels">{{ $rate->adult_extra_cost }}</span>
																	<input type="number" value="{{ $rate->adult_extra_cost }}" style="text-align: center; width: 53px !important; padding: 0px !important; height: 20px !important;" name="quorate[adult_extra_cost][]" class="quo_edit_fiels" autocomplete="off">
																</td>
																<td style="background-color: #ff000040;">
																	<span class="quo_show_fiels">{{ $rate->child_extra_cost_wd }}</span>
																	<input type="number" value="{{ $rate->child_extra_cost_wd }}" style="text-align: center; width: 53px !important; padding: 0px !important; height: 20px !important;" name="quorate[child_extra_cost_wd][]" class="quo_edit_fiels">
																</td>
																<td style="background-color: #ff000040;">
																	<span class="quo_show_fiels">{{ $rate->child_extra_cost_wod }}</span>
																	<input type="number" value="{{ $rate->child_extra_cost_wod }}" style="text-align: center; width: 53px !important; padding: 0px !important; height: 20px !important;" name="quorate[child_extra_cost_wod][]" class="quo_edit_fiels"> 
																</td>
																<td>{{ $rate->cost }}</td> 
															</tr>
															@endforeach
														</tbody>
													</table> 
													</div> 
													<div style="text-align:right;" class="rate_canculate {{$con_class}}"> 
														<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_edit_rate_quo fgsilement" onclick="editQuotationRate();">Edit Price</button>
														<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_confirm_rate_quo" onclick="updateQuotationRate();" style="display:none;">Confirm</button>
													</div> 
												</div>
											</div>
										</div>
									</li>
								</ul>
							</form>  
								
								<!-- Upload Image -->
								<div class="upload_image_popup" style="">
									<form method="POST" action="{{url('/operator/uploadimage')}}" enctype="multipart/form-data">
									{{csrf_field()}} 
									<div class="row" id="details"> 
										<div class="col s12">
											<span class="b-close close_btn"><i class="material-icons">close</i></span>
											<h3 class="card-title follow_title" style="padding:6px 0 !important;"><strong>Upload Payment Snapshot</strong></h3>
											<div class="booking_form_main">
												<div class="">
													<div class="col s12 m12">
														<label for="payment_snapshot">Payment Snapshot:</label><br>
														<input type="file" id="payment_snapshot" name="payment_snapshot" class="dropify">
													</div>
												</div>
																								
												<div class="col s12 m12" style="text-align: center;">
													<input type="hidden" name="payment_snapshot_old" id="payment_snapshot_old" value="{{ @$quotation[0]->payment_snapshot }}">
													<input type="hidden" name="booked_no" id="booked_no" value="{{@$booking_detail[0]->parent_booking_no}}">
													<input type="hidden" name="send_quotation_no" id="booked_no" value="{{ @$quotation[0]->send_quotation_no }}">
													<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" id="addbookingbtn" >Submit</button>
													<p style="color:green;" id="add_room_msg"></p>
													<input type="hidden" value="{{@$_GET['update']}}" name="update_mode" />
												</div>
											</div>
										</div>
									</div>
									</form>
								</div>
								<!-- Upload Image -->
							</div>
						</div> 
						
						<div class="col s12 m8 {{$con_class}}">
							<h3 class="card-title follow_title"><strong>Preview Quotation</strong></h3>
							<div class="preview_itinerary_main">
								<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo" onclick="CopyToClipboard('email_body'); return false;" style="display:none; margin: 10px 0 0 !important;">Copy</button>
								<div class="email_body" id="email_body">
									
								</div>
								
								<!--<iframe style="width:100%; height:500px;" src="/storage/app/quotations/ENS237846.pdf">
								
								</iframe>-->
							</div>
						</div>
						
						
					</div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script src="{{ URL::asset('public/asset/js/ckeditor.js') }}" type="text/javascript"></script>
	
    <!-- ITINERARY SCRIPT JS-->
		<script src="{{ URL::asset('public/asset/js/custom/itinerary_script.js?update3=test') }}"></script>
    <!-- ITINERARY SCRIPT JS-->
	
	<script>
		ClassicEditor.create( document.querySelector( '.editor_hide' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		}).then( editor => {
			window.editor = editor;
		}).catch( err => {
			console.error( err.stack );
		});
	</script>
    <script>
		ClassicEditor.create( document.querySelector( '.editor1' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		}).then( editor => {
			window.editor = editor;
		}).catch( err => {
			console.error( err.stack );
		});
		
		ClassicEditor.create( document.querySelector( '.editor2' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		}).then( editor => {
			window.editor = editor;
		}).catch( err => {
			console.error( err.stack );
		});


		// this fuinction use for same info for agent.  
		function copyGuestInfo(){
			jQuery("#agent_name").val(jQuery("#name").val());
			jQuery("#agent_email").val(jQuery("#email").val());
			jQuery("#agent_mobile").val(jQuery("#mobile").val());
		}
		jQuery(document).ready(function(){
			// this fuinction use for same info for agent.  
			jQuery("#same_info").change(function(){
				var status = jQuery(this).prop("checked");
				if(status){
					jQuery("#agent_name").val(jQuery("#name").val());
					jQuery("#agent_email").val(jQuery("#email").val());
					jQuery("#agent_mobile").val(jQuery("#mobile").val());
				}else{
					jQuery("#agent_name").val('');
					jQuery("#agent_email").val('');
					jQuery("#agent_mobile").val('');
				}
			});
			
			// Hide show payment screenshot
			jQuery(".pay_img_sh").click(function(){
				jQuery(".payment_img").slideToggle();
			});
			
			// Open uoload image popup
			jQuery(".upload_img").click(function(){
				jQuery(".upload_image_popup").bPopup();
			});
			
			// Hide show email details
			jQuery("#email_details_checkbox").change(function(){
				jQuery(".email_details").toggle();
			});
			
			// Hide show agent_details
			jQuery("#agent_details").change(function(){
				jQuery(".agent_detail").toggle(); 
			});
			
			// Get payment source by hotel id
			//var hotel_id = jQuery("#hotel_list").val();
			//getPaymentSourceByHotelId(hotel_id);
			jQuery("#hotel_list").change(function(){
				var hotel_id = jQuery(this).val();
				getPaymentSourceByHotelId(hotel_id);
			});
			
			// Check quotation type is voucher
			jQuery("#quotation_type").change(function(){
				var quotation_type = jQuery(this).val();
				if(quotation_type == 'voucher'){
					//jQuery(".ens_popup").bPopup();
					jQuery(".voucher_details").show();
				}else{
					jQuery(".voucher_details").hide();
				}
			});
			
			// Check Final cost is greterthan 0 then hide rate calculation rate
			checkFinalCostAply();
			
			var send_quotation_no = jQuery("#send_quotation_no").val();
			jQuery("#sendquomo").val(send_quotation_no);
			
			// Open Basic Info
			jQuery("#lead_details").addClass("active");
			jQuery("#lead_details .collapsible-body").show();
			
			jQuery(".generate_send_quo").click(); 
			
			// Room inventory check box-shadow
			jQuery("#room_inventory_checkbox").change(function(){
				var check_status = jQuery(this).prop("checked");
				if(check_status == true){
					jQuery(".room_inventory_fields").show();
				}else{
					jQuery(".room_inventory_fields").hide();
				}
			});
			
			var check_status = jQuery("#room_inventory_checkbox").prop("checked");
			if(check_status == true){
				jQuery(".room_inventory_fields").show();
			}else{
				jQuery(".room_inventory_fields").hide();
			}
			
			
			// From and to date vailidation
			jQuery("#checkin").change(function(){
				var checkin = jQuery(this).val();
				jQuery("#checkout").attr('min', checkin);
			});
			
			var checkin = jQuery("#checkin").val();
			jQuery("#checkout").attr('min', checkin);
			
			jQuery("#final_cost").keyup(function(e){
				var final_cost = jQuery(this).val();
				if(e.keyCode == '69' || e.keyCode == '189'){
					final_cost = final_cost.replace("e","");
					final_cost = final_cost.replace("-","");
					jQuery(this).val(final_cost);
					jQuery(".num_for_error").text('Please enter numbers only!');
				}
			});
			
		});
    </script>
    
@endsection