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
						<form class="form-inline" action="javascript:openUpdateQuotationPage()" >
							<label for="sendquomo" class="mb-2 mr-sm-2">Search Quotation:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="sendquomo" placeholder="Enter Send Quotation No" name="sendquomo" style="width:130px !important;">
							   
							<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light" onclick="openUpdateQuotationPage();" style="margin-top:7px !important;">Search</button>
						</form>
						<div class="col s12 m4">
							<h3 class="card-title follow_title"><strong>Quotation Details</strong></h3>
							<div class="itin_detail_main">
							<form class="quotation" id="quotation" method="post" action="" >
							{{csrf_field()}}
								@php
								$checkroominv = Session::get('operator.room_inventory');
								$session_data = Session::get('operator');
								@endphp
								<ul class="collapsible" data-collapsible="accordion">
									<li id="basic_info" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">dvr</i>Basic Info
										</div>
										<div class="collapsible-body">
											<div class="rate_no_ava_error">
												Hotel Season Rate Not Available!
											</div> 
											<div class="hotel_details">
												@if(@$checkroominv[0] == 'Y')
													<div class="col s12 m12">
														<b class="head_hotel_name"></b>
													</div>
													<input type="hidden" value="{{$session_data['hotel'][0]}}" name="hotel" id="hotel_list" class="hotel_list"/>
												@else
													<div class="col s12 m6">
														<label for="arrival_city" class="">Destination</label>
														<select name="destination" id="distination" class="distination" tabindex="0">
															<option>Select Destination</option>
															@foreach($citiesh as $city)
															<option value="{{$city->city_id}}">{{$city->name}}</option>
															@endforeach
														</select>          
													</div>
													<div class="col s12 m6">
														<label for="arrival_city" class="">Hotel</label>
														<select name="hotel" class="hotel_list" id="hotel_list" tabindex="0" onchange="getHotelDetailView();"> 
															<option>Select Hotel</option>
														</select>          
													</div>
												@endif
											</div>
											<div class="daywaise_details">
												<div class="daywaise_info" id="daywaise_info">
													<div class="col s12 m5">
														<label for="checkin" class="">CheckIN</label>
														<input type="date" name="daywaise[checkin][]" id="checkin" class="filter_date check_hotel_rate_available" autocomplete="off">         
													</div>
													<div class="col s12 m5">
														<label for="checkout" class="">CheckOut</label>
														<input type="date" name="daywaise[checkout][]" id="checkout" class="filter_date" autocomplete="off"> 
													</div>
													<div class="col s12 m2">
														<label for="night" class="" title="No Of Nights">Nights</label>
														<input type="number" name="daywaise[night][]" id="night" readOnly>
													</div>
													<div class="col s12 m6" style="position: relative;">
														<label for="room_type" class="">Rooms Type </label>
														<select name="daywaise[room_type][]" id="room_type" class="room_type_list check_hotel_rate_available" tabindex="0" onchange="checkHotelPriceAvailable();">
															<option>Select Rooms Type</option>
															<option value=""></option>
														</select>
														<span class="price_not_error"></span>
													</div>
													<div class="col s12 m6"> 
														<label for="meal_type" class="">Meal Plan</label>
														<select name="daywaise[meal_type][]" id="meal_type" class="" tabindex="0">
															<option value="">Select Meal Plan</option>
															<option value="ep_price">EP (Room Only)</option>
															<option value="cp_price">CP (Room with Breakfast)</option>
															<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
															<option value="ap_price">AP (Room with all meals plan)</option>
														</select>
													</div>
													<div class="col s12 m2">
														<label for="rooms" class="" title="No Of Rooms">Rooms</label>
														<input type="number" name="daywaise[rooms][]" id="rooms">
													</div>
													<!--<div class="col s12 m2">
														<label for="night" class="" title="No Of Nights">Nights</label>
														<input type="number" name="daywaise[night][]" id="night">
													</div>-->
													<div class="col s12 m2">
														<label for="adult" class="" title="No Of Adults">Adults</label>
														<input type="number" name="daywaise[adult][]" id="adult" class="check_das">
													</div> 
																				
													<div class="col s12 m3">
														<label for="kids" class="" title="Kids (5-12 Years) with bed" style="font-size: 11px !important;">Kids WB</label>
														<input type="number" name="daywaise[kids][]" id="kids" class="check_das">       
													</div>
													
													<div class="col s12 m3">
														<label for="kids" class="" title="Kids (5-12 Years) without bed" style="font-size: 11px !important;">Kids WOB</label>
														<input type="number" name="daywaise[kidswod][]" id="kids" class="check_das">       
													</div>
													
													<div class="col s12 m2">
														<label for="infant" class="" title="Infant (below 5 Years)">Infant</label>
														<input type="number" name="daywaise[infant][]" id="infant" class="check_das">
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
												<div class="col s6 m3">
													<label for="ff_c_name"></label><br> 
													<select class="form-control" name="ff_c_name" id="ff_c_name">
														<option value="Mr.">Mr.</option>
														<option value="Mrs.">Mrs.</option>
														<option value="Ms.">Ms.</option>
													</select>
												</div>
												<div class="col s12 m4">
													<label for="name" class="">Name</label>
													<input type="text" name="name" id="name" value="Guest">
												</div>
																			
												<div class="col s12 m5">
													<label for="mobile" class="">Mobile</label>
													<input type="number" name="mobile" id="mobile" class="mobile_trim" value="8383908656">       
												</div>
												
												<div class="col s12 m6">
													<label for="email" class="">Email</label>
													<input type="email" name="email" id="email">
												</div>
												
												{{--<!-- Quotation Note -->
												<div class="col s12 m12"> 
													<label for="quotation_note">Quotation Comments:</label><br>
													<textarea class="form-control " name="quotation_note" id="quotation_note" style="font-size: 12px;">{{ @$quotation[0]->quotation_note }}</textarea>
												</div>
												<!-- /Quotation Note -->--}}

												<div class="col s12 m6">
													<label for="confirmed_by" class="">Confirmed By</label>
													<input type="text" name="confirmed_by" id="confirmed_by"> 
												</div>
												<div class="col s12 m12"></div>

												<!-- For Room Inventory -->
												<div class="room_inventory_fields">
													<div class="col s12 m6"> 
														<label for="booking_from">Booking From:</label><br>
														<select class="form-control" name="booking_from" id="booking_from">
															<option value=""></option>
															@foreach($booking_froms as $booking_from)
																<option value="{{$booking_from->title}}">{{$booking_from->title}}</option>
															@endforeach
														</select>
													</div>
													<div class="col s12 m6">
														<label for="source">Source:</label><br>
														<select class="form-control" name="source" id="source">
															<option value=""></option>
															@foreach($booking_sources as $booking_source)
																<option value="{{$booking_source->title}}">{{$booking_source->title}}</option>
															@endforeach
														</select>
													</div>
													<div class="col s12 m6">
														<label for="advance_received" class="">Advance Received</label>
														<input type="number" name="advance_received" id="advance_received" min="1">
													</div>
													<div class="col s12 m6">
														<label for="payment_source">Payment Source:</label><br>
														<select name="payment_source" id="payment_source" class="form-control" tabindex="0">
															<option></option>
															@foreach($paymentsources as $paymentsource)
																<option value="{{ $paymentsource->source }}"> {{ $paymentsource->source }}</option>
															@endforeach
														</select>
													</div>
													
													<div class="col s12 m6">
														<label for="date_of_advance">Date Of Advance:</label><br>
														<input type="date" class="form-control" name="date_of_advance" id="date_of_advance">
													</div>
													<div class="col s12 m6">
														<label for="booking_status">Booking Status:</label><br>
														<select class="form-control" name="booking_status" id="booking_status">
															<option value="Confirmed">Confirmed</option>
														</select>
													</div>
													<div class="col s12 m12"> 
														<label for="comment">Internal Comments:</label><br>
														<textarea class="form-control " name="comment" id="comment" style="font-size: 12px;"></textarea>
													</div>
													</div>
													<!-- For Room Inventory -->
													
													<div class="col s12 m6 hide">
														<label for="balance" class="">Balance</label>
														<input type="text" name="balance" id="balance">
													</div>
													<div class="col s12">
														<label for="voucher_note" class="">Comments For Voucher:</label>
														<textarea name="voucher_note" style="font-size: 12px;" id="voucher_note" class=""></textarea>
													</div>
												</div>
												<!-- /Voucher Details Fiels -->

												<!-- Agent details -->
												<div class="col s6 m6">
													<label for="agent_details_val" class="">Add Agent Info</label><br>
													<input type="checkbox" value="Y" name="agent_details_val" id="agent_details_val" style="opacity: 1;position: unset;width: 15px !important;height: 22px !important; pointer-events: auto;">

													&nbsp; &nbsp;
													<div class="same_agent_cbox agent_details_field"> 
														<input type="checkbox" id="same_info" style="opacity: 1;position: unset;width: 15px !important;height: 15px !important; pointer-events: auto;"> Same As Guest
													</div>
												</div>
												<div class="col s12 m6 agent_details_field">
													<label for="name" class="">Agent Name</label>
													<input type="text" name="agent_name" id="agent_name" value="">
												</div>
																			
												<div class="col s12 m6 agent_details_field">
													<label for="mobile" class="">Agent Mobile</label>
													<input type="number" name="agent_mobile" id="agent_mobile" class="mobile_trim" value="">       
												</div>
												
												<div class="col s12 m6 agent_details_field">
													<label for="email" class="">Agent Email</label>
													<input type="email" name="agent_email" id="agent_email" value="">
												</div>
												<!-- /Agent details -->
												<div class="col s12 m6" style="display:none;">
													<label for="discount" class="">Discount</label>
													<input type="number" min="0" value="0" name="discount" id="discount">
												</div>
												<div class="col s12 m6" style="display:none;">
													<label for="discount" class="">CC Email</label>
													<input type="email" name="ccemail" id="ccemail" value="">
												</div> 
												<div class="col s12 m12 fgsilement" style="display:none;">
													<label for="discount" class="">Email Subject</label>
													<input type="text" id="email_subject" />
												</div>
												<div class="col s12 m12 fgsilement" style="display:none;">
													<label for="discount" class="">Email Message</label>
													<textarea id="email_message" style="background-color: rgb(255, 255, 255);position: relative;z-index: 9;"></textarea>
												</div>
												<div class="col s12 m12 send_q_btn_area" style="text-align: center; margin-top: 5px !important;">
												<!--<h6 class="final_cost_val"></h6>-->
													<input type="hidden" value="" name="send_quotation_no" id="send_quotation_no"/>
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light generate_send_quo" onclick="createVoucher();">Generate</button>
													
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_send_quo" onclick="sendQuotation();" style="display:none;">Send Quotation</button>
													
													
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo" onclick="downloadQuotation();" style="display:none;">Download</button>
													
													<p style="color:green;" class="send_quotation_msg"></p>
													<p style="color:red;" class="error_msg"></p>
													
													<input type="hidden" value="" name="final_cost" id="final_cost"/>
													
													<div class="quotation_update_rate">
														
													</div>
													<div style="text-align:right;">
														<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_edit_rate_quo fgsilement" onclick="editQuotationRate();">Edit Price</button>
														<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_confirm_rate_quo" onclick="updateQuotationRate();" style="display:none;">Confirm</button>
													</div> 
												</div>
											</div>
										</div>
									</li>
								</ul>
							</form>
						</div>
					
						<div class="col s12 m8">
							<h3 class="card-title follow_title"><strong>Preview Quotation</strong></h3>
							<div class="preview_itinerary_main">
								<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo" onclick="CopyToClipboard('email_body'); return false;" style="display:none; margin: 10px 0 0 !important;">Copy</button>
								<div class="email_body" id="email_body">
								
								</div> 
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
    <!-- ITINERARY SCRIPT JS-->
		<script src="{{ URL::asset('public/asset/js/custom/itinerary_script.js') }}"></script>
    <!-- ITINERARY SCRIPT JS-->

	<!-- CREATE VOUCHER SCRIPT JS-->
	<script src="{{ URL::asset('public/asset/js/custom/create_voucher.js') }}"></script>
    <!-- CREATE VOUCHER SCRIPT JS-->
	
	@if(@$checkroominv[0] == 'Y')
		<script>
			jQuery(document).ready(function(){
				getHotelDetailView();
				
				var hotel_id = jQuery("#hotel_list").val();
				jQuery.ajax({
					type: 'post',
					url: '/operator/getRoomTypeById',
					cache: false,
					async: true,
					data: {'hotel_id':hotel_id},
					success: function(res){
						jQuery(".room_type_list").html(res);
					}
				});
				
				jQuery.ajax({
					type: 'post',
					url: '/operator/gethotelnamebyid',
					cache: false,
					async: true,
					data: {'hotel_id':hotel_id},
					success: function(res){
						console.log(res);
						jQuery(".head_hotel_name").html(res);
					}
				});
				
				// From and to date vailidation
				jQuery("#checkin").change(function(){
					var checkin = jQuery(this).val();
					jQuery("#checkout").attr('min', checkin);
				});
				
			});
			
		</script>
	@endif
													
    <script>
		
		// Redirect to update mode
		function redirectToUpdateMode(quotation_no){
			window.location.href = "/operator/createvoucher/"+quotation_no;
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

			jQuery("#agent_details_val").change(function(){
				var check_status = jQuery(this).prop('checked');
				jQuery(".agent_details_field").hide();
				if(check_status == true){
					jQuery(".agent_details_field").show();
				}
			});
		});
    </script>
    
@endsection