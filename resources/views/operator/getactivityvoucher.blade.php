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
		.comment_for_advance_div{display:none;}
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
<div class="hotel_view_mobile animated slideInUp">

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
									<a class="@if(Request::segment(2) == 'makeactivityvoucher') active @endif;" href="{{URL::to('/operator/makeactivityvoucher/')}}">Activity Voucher</a>
								</li>
							</ul>
						</div>
					</div> 
					<!-- /Tab End -->
				
					<div class="row" id="details"> 
						<form class="form-inline" action="#" >
							<label for="a_voucher_no" class="mb-2 mr-sm-2">Search Voucher:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="a_voucher_no" placeholder="Enter Activity Voucher No" name="a_voucher_no" style="width:130px !important;" value="{{$voucher->voucher_no}}">
							   
							<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light" onclick="openUpdateQuotationPage();" style="margin-top:7px !important;">Search</button>
						</form>
						<div class="col s12 m4">
							<h3 class="card-title follow_title"><strong>Voucher Details</strong></h3>
							<div class="itin_detail_main">
							<form class="avtivity_voucher" id="avtivity_voucher" method="post" action="" >
							{{csrf_field()}}
								@php
								$session_data = Session::get('operator');
								@endphp
								<ul class="collapsible" data-collapsible="accordion">
									<li id="basic_info" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">dvr</i>Basic Info
										</div>
										<div class="collapsible-body">
											<div class="daywaise_details">
												<div class="daywaise_info" id="daywaise_info">
													<div class="col s12 m4">
														<label for="arrival_city" class="">Activity</label>
														<select name="activity_id" class="" id="activity_id" tabindex="0"> 
															<option>Select Activity</option>
															@foreach($activities as $activ)
															<option value="{{$activ->id}}" @if($activity->activity_cat_id == $activ->id) {{'selected'}} @endif>{{$activ->activity_cat}}</option>
															@endforeach
														</select>          
													</div>
													<div class="col s12 m4">
														<label for="arrival_city" class="">Destination</label>
														<select name="destination" id="activity_distination" class="activity_distination" tabindex="0">
															<option>Select Destination</option>
															@foreach($citiesh as $city)
															<option value="{{$city->city_id}}" @if($city->city_id == $voucher->destination) {{'selected'}} @endif>{{$city->name}}</option>
															@endforeach
														</select>          
													</div>
													<div class="col s12 m4">
														<label for="arrival_city" class="">Activity</label>
														<select name="activity_id" class="activity_list" id="activity_list" tabindex="0"> 
															<option value="{{$voucher->activity_id}}" selected>{{@$activity->activitySubCat->activity_subcat}}</option>
														</select>          
													</div>
													<div class="col s12 m5">
														<label for="date" class="">Date</label>
														<input type="date" name="date" id="date" class="filter_date" autocomplete="off" value="{{$voucher->date}}">
													</div>
													<div class="col s12 m4">
														<label for="night" class="" title="No Of Nights">Slot</label>
														<select name="slot" id="slot" class="slot" tabindex="0">
															<option>Select Slot</option>
															<option value="morning_slot" @if($voucher->slot == 'morning_slot') {{'selected'}} @endif>Morning</option>
															<option value="evening_slot" @if($voucher->slot == 'evening_slot') {{'selected'}} @endif>Evening</option>
														</select>
													</div>
													<div class="col s12 m3">
														<label for="slot_time" class="">Time</label>
														<input type="text" name="time" id="slot_time" class="filter_date disabled" autocomplete="off" value="{{$voucher->time}}">
													</div>
													<div class="col s12 m4">
														<label for="adult" class="" title="No Of Adults">Adults</label>
														<input type="number" name="adult" id="adult" onkeyup="setTotalVisitor();" onblur="setTotalVisitor();" onchange="setTotalVisitor();" value="{{$voucher->adults}}">
													</div> 
																				
													<div class="col s12 m4">
														<label for="kids" class="" title="Kids (5-12 Years) with bed" style="font-size: 11px !important;">Kids</label>
														<input type="number" name="kids" id="kids" onkeyup="setTotalVisitor();" onblur="setTotalVisitor();" onchange="setTotalVisitor();" value="{{$voucher->chields}}">       
													</div>
													
													<div class="col s12 m4">
														<label for="total_visitor" class="">Total Visitor</label>
														<input type="number" name="total_visitor" class="disabled" id="total_visitor" value="{{$voucher->total_visitors}}">
													</div>
													<div class="col s6 s6">
														<a class="mb-6 btn-floating gradient-45deg-purple-deep-orange remove_horoty" title="Delete" onclick="remove($(this))">
															<i class="material-icons">delete_sweep</i>
														</a>
														<span class="btn_text" style="font-size: 11px; margin: 0 5px;">Remove Room</span>
													</div>
													<!--<div class="col s6 s6">
														<a class="mb-6 btn-floating gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
															<i class="material-icons">note_add</i>
														</a>
														<span class="btn_text" style="font-size: 11px; float:right; margin: 5px 5px; display:block;">Add Room</span>
													</div>-->
												</div>
											</div>
											<div class="col s12 m12" style="text-align: center; margin-top: 26px !important;">
												<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('lead_details');">Next Step</button>
											</div>
										</div>
									</li>
									<li id="lead_details" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">dvr</i>Voucher Details
										</div>
										<div class="collapsible-body">
											<div class="">
												<div class="col s12 m6">
													<label for="name" class="">Name</label>
													<input type="text" name="client_name" id="name" value="{{$voucher->client_name}}">
												</div>
																			
												<div class="col s12 m6">
													<label for="mobile" class="">Mobile</label>
													<input type="number" name="mobile" id="mobile" value="{{$voucher->mobile}}">       
												</div>
												
												<div class="col s12 m6">
													<label for="email" class="">Email</label>
													<input type="email" name="email" id="email" value="{{$voucher->email}}">
												</div>
												<div class="col s12 m6">
													<label for="discount" class="">CC Email</label>
													<input type="email" name="ccemail" id="ccemail" value="{{$voucher->ccemail}}">
												</div> 
												<div class="col s12 m6">
													<label for="actual_cost" class="">Actual Cost</label> 
													<input type="number" name="actual_cost" id="actual_cost" value="{{$voucher->actual_cost}}">
												</div>
												<div class="col s12 m6">
													<label for="total_bill" class="">Cost To Customer</label> 
													<input type="number" name="total_bill" id="total_bill" value="{{$voucher->total_bill}}">
												</div>
												<!--<div class="col s12 m6">
													<label for="advance_received" class="">Payment Type</label>
													<select class="form-control" name="payment_type" id="payment_type">
														<option value="Full" @if($voucher->payment_type == 'Full') {{'selected'}} @endif>Full</option>
														<option value="Partial" @if($voucher->payment_type == 'Partial') {{'selected'}} @endif>Partial</option>
													</select>
												</div>-->
												<div class="col s12 m6 advance_received_input_hide">
													<label for="advance_received" class="">Advance Received</label>
													<input type="number" name="advance_received" id="advance_received" value="{{$voucher->advance_received}}">
												</div>
												<div class="col s12 m6">
													<label for="payment_received_by" class="">Received By</label>
													<select class="form-control" name="payment_received_by" id="payment_received_by">
														<option value="Ensober" @if($voucher->payment_received_by == 'Ensober') {{'selected'}} @endif>Ensober</option>
														<option value="Vendor" @if($voucher->payment_received_by == 'Vendor') {{'selected'}} @endif>Vendor</option>
														<option value="Other" @if($voucher->payment_received_by == 'Other') {{'selected'}} @endif>Other</option>
													</select>
												</div>
												<div class="col s12 m6">
													<label for="vendor_id" class="">Vendor</label>
													<select class="form-control" name="vendor_id" id="vendor_id">
														<option value=""></option>
														@foreach($venders as $vender)
														<option value="{{$vender->id}}" @if($voucher->vendor_id == $vender->id) {{'selected'}} @endif>{{$vender->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="col s12 m6 advance_received_input_hide">
													<label for="no_of_jeeps" class="">No Of Jeeps</label>
													<input type="text" name="no_of_jeeps" id="no_of_jeeps" value="{{$voucher->no_of_jeeps}}">
												</div>
												
												<div class="col s12 comment_for_advance_div">
													<label for="comment_for_advance" class="">Comment For Advance</label>
													<textarea name="comment_for_advance" id="comment_for_advance" >{{$voucher->comment_for_advance}}</textarea>
												</div>
												<div class="col s12">
													<label for="pickup_point" class="">Pickup Point</label>
													<input type="text" name="pickup_point" id="pickup_point" value="{{$voucher->pickup_point}}">
												</div>
												<div class="col s12">
													<label for="comment" class="">Comment</label>
													<textarea name="comment" id="comment" >{{$voucher->comment}}</textarea>
												</div>
												
												<div class="col s12 m12 send_q_btn_area" style="text-align: center; margin-top: 5px !important;">
													<input type="hidden" name="activity_voucher_no" id="activity_voucher_no" value="{{$voucher->voucher_no}}"/>
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light generate_activity_voucher" onclick="generateActivityVoucher();">Generate</button> 
													
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light hide don_voucher" onclick="downloadActivityVoucher();" style="">View</button>
													
													<a href="/operator/downloadactivityvoucher/{{$voucher->voucher_no}}" target="_bank"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light hide don_voucher" style="">Download</button></a>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</form>
							</div>
						</div>
					
						<div class="col s12 m8">
							<h3 class="card-title follow_title"><strong>Preview Voucher</strong></h3>
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
													
    <script>
		// Set total visitor
		function setTotalVisitor(){
			var adult = jQuery("#adult").val();
			var kids = jQuery("#kids").val();
			if(adult == ''){adult=0;}
			if(kids == ''){kids=0;}
			var total_visitor = parseInt(adult)+parseInt(kids);
			console.log(total_visitor);
			jQuery("#total_visitor").val(total_visitor);
		}
		
		jQuery(document).ready(function(){
			// Open Basic Info
			jQuery("#lead_details").addClass("active");
			jQuery("#lead_details .collapsible-body").show();
			
			jQuery(".generate_activity_voucher").click();
			jQuery("#payment_received_by").change(function(){
				var thisother = jQuery(this).val();
				if(thisother == 'Other'){
					jQuery(".comment_for_advance_div").show();
				}else{
					jQuery(".comment_for_advance_div").hide(); 
				}
			});
			
			var thisval = jQuery("#payment_type").val();
			if(thisval == 'Partial'){
				jQuery(".advance_received_input").show();
			}else{
				jQuery(".advance_received_input").hide();
			}
			jQuery("#payment_type").change(function(){
				var thisval = jQuery(this).val();
				if(thisval == 'Partial'){
					jQuery(".advance_received_input").show();
				}else{
					jQuery(".advance_received_input").hide();
				}
			});
			
		});
    </script>
    
@endsection