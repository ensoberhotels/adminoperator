@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard | Create Ititnerary')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
    <style>
       .collapsible-header {
			padding: 6px 5px;
			font-weight: bold;
			color: #000;
		}
		table.rstbl td, th {
			border: 1px solid #eee;
			color: #000;
			font-size: 12px;
			padding: 2px 5px !important;
			text-align:center;
		}
		table.rstbl {
			float: left;
			width: 100%;
		}
		table.rstbl thead {
			background-color: blanchedalmond;
		}
		.book_d_head {
			float: left;
			width: 100%;
			font-size: 13px;
			color: #1a0d67;
			font-weight: bold;
			margin: 15px 0 1px;
		}
		.room_details_main {
			float: left;
			width: 100%;
		}
		.booking_details{
			float: left;
			width: 100%;
			overflow: auto;
		}
		.room_cat_for_m{display:none; float:left; width:100%;}
		.room_cat_for_d{float:left; width:100%;}
		.room_cat_for_m .col {
			vertical-align: top;
			display: inline-flex;
		}
		@media only screen and (max-width: 600px) {
			.room_cat_for_m{display:block;}
			.room_cat_for_d{display:none;}
			.mobile_f_s_rc{font-size:11px;}
		}
		.hotel_view_mobile {
			float: left;
			width: 90%;
			background-color: #fff;
			box-shadow: 0 0 1px 0;
		}
		.room_booked_update_popup {
			float: left;
			width: 90%;
			background-color: #fff;
			box-shadow: 0 0 1px 0;
			
			left: 74.28px;
			position: absolute;
			top: 433.212px;
			z-index: 9999;
			opacity: 1;
		}
		.close_btn {
			position: absolute;
			right: 8px;
			color: #fff;
			top: 4px;
			cursor:pointer;
		}
		.mul_cat_room_details {
			float: left;
			width: 100%;
			border-top: 1px solid #555;
			padding: 5px 0 0;
			margin: 5px 0 0;
		}
		.mul_cat_room_details:first-child .remove_btn_room_cat {
			visibility: hidden;
		}
		
		.booking_delete_msg {
			color: red;
			float: left;
			width: 100%;
			font-size: 11px;
			display: none;
			text-align: right;
			margin: 5px 0 0;
		}
		tr.cancel_room_booking {
			background-color: #ff000040 !important; 
		}
		span.reason_msg {
			float: left;
			width: 60px;
			margin: 6px 0 0;
			color: #000;
			font-size: 11px;
		}
		.box {
			float: left;
			width: 100%;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0px 7px 0 #d6d8db;
		}
		span.r_i_hotel_name {
			color: hsl(1deg 76% 66%);
			font-size: 16px;
			font-weight: bold;
			float: left;
			width: 100%;
			text-align: center;
			border-bottom: 1px solid hsl(270deg 51% 53%);
		}
		.row .col.s6 {
			width: 48%;
			margin: 3px 3px 11px!important;
		}
		.filter_data_loader {
			background-image: url(/asset/images/mobile_loader.gif);
			height: 700px;
			background-size: 100%;
		}
		.cencel_refund_status_popup {
			float: left;
			padding: 10px;
			background-color: #ffff;
			border-radius: 5px;
			box-shadow: 0 0 6px 1px #fff;
			font-size: 13px;
			display:none;
		}
		.refund_status_btn {
			opacity: 1 !important;
			position: unset !important;
			pointer-events: auto !important;
			width: 14px !important;
			height: 14px !important;
		}
		.extra_charge_details{
			display:none;
		}
		#cancel_loader_img{
			display:none;
		}
		.booking_form_main {
			height: 600px;
			overflow: auto;
		}
		
	</style>
@endsection

@section('content')

<!-- Cancel refund status popup -->
<div class="cencel_refund_status_popup">
	<input type="hidden" id="cancel_booking_id" />
	<input type="hidden" id="cancel_reason" />
	<div class="row">
		Are you refunding advance payment? <br> <span>Yes <input type="radio" name="rstatus" value="Y" class="refund_status_btn" checked /></span> <span>No <input type="radio" name="rstatus" value="N" class="refund_status_btn" /></span> 
	</div>
	<div class="row extra_charge_details">
		Charging Extra?: <input type="number" id="extra_bill" /><br><br>
		Comment: <textarea id="extra_bill_comment"></textarea>
	</div>
	<div class="row" style="margin-bottom: 0 !important;">
		<button type="button" class="b-close btn waves-effect gradient-45deg-red-pink waves-light " style="margin: 2px 0 !important;padding: 0 5px !important;height: 20px !important;line-height: 2px !important;">Cancel</button>
		
		<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light" style="float: right;margin: 2px 0 !important;padding: 0 5px !important;height: 20px !important;line-height: 2px !important;" id="cancel_booking_details">Submit</button> <img src="/asset/images/loader/loader.gif" style="width: 14px;float: right;margin: 5px 3px;" class="img-responsive" id="cancel_loader_img">
	</div>
</div>
<!-- /Cancel refund status popup -->


<!-- Hotel Details in mobile -->
<div class="hotel_view_mobile animated slideInUp">

</div>
<!-- /Hotel Details in mobile -->
<!-- BEGIN: Page Main-->

<div class="room_booked_update_popup">
	<form method="POST" action="{{ url('/operator/updateroombookaction') }}" enctype="multipart/form-data">
	@csrf
		<div class="room_b_update_pop">
			
		</div>
	</form>
</div>
													
													
<div id="main">
    <div class="row">
        <div class="container">
			<div class="row">
				<div class="box">
					<div class="col s12 m12">
						@if(@$operator->room_inventory == 'Y')
							<span class="r_i_hotel_name">{{ @$hotel->hotel_name }}</span>
							<input type="hidden" value="{{ @$hotel->id }}" id="hotel_id" />
						@else
							<select class="form-control" id="hotel_id" onchange="getRoomAvailableStatus();">
								<option value="">Select Hotel</option>
								@foreach($hotels as $hotellist)
									<option value="{{ $hotellist->id }}" @if(@$hotel->id == $hotellist->id) {{ 'selected' }} @endif>{{ $hotellist->hotel_name }}</option>
								@endforeach
							</select>
						@endif
					</div>
					<div class="col s4 m3">
						<label for="from_date" class="active">Year</label>
						<select class="form-control" id="s_year" onchange="getRoomAvailableStatus();">
							<option value="2020" @if(Request::get('year') == '2020' || date('Y') == '2020') {{ 'selected' }} @endif>2020</option>
							<option value="2021" @if(Request::get('year') == '2021' || date('Y') == '2021') {{ 'selected' }} @endif>2021</option>
						</select>
					</div>
					<div class="col s3 m5">
						<label for="to_date" class="active">Month</label>
						<select class="form-control" id="s_month" onchange="getRoomAvailableStatus();">
							<option value="01" @if(Request::get('month') == '01' || date('m') == '01') {{ 'selected' }} @endif>January</option>
							<option value="02" @if(Request::get('month') == '02' || date('m') == '02') {{ 'selected' }} @endif>February</option>
							<option value="03" @if(Request::get('month') == '03' || date('m') == '03') {{ 'selected' }} @endif>March</option>
							<option value="04" @if(Request::get('month') == '04' || date('m') == '04') {{ 'selected' }} @endif>April</option>
							<option value="05" @if(Request::get('month') == '06' || date('m') == '06') {{ 'selected' }} @endif>May</option>
							<option value="06" @if(Request::get('month') == '06' || date('m') == '06') {{ 'selected' }} @endif>June</option>
							<option value="07" @if(Request::get('month') == '07' || date('m') == '07') {{ 'selected' }} @endif>July</option>
							<option value="08" @if(Request::get('month') == '08' || date('m') == '08') {{ 'selected' }} @endif>August</option>
							<option value="09" @if(Request::get('month') == '09' || date('m') == '09') {{ 'selected' }} @endif>September</option>
							<option value="10" @if(Request::get('month') == '10' || date('m') == '10') {{ 'selected' }} @endif>October</option>
							<option value="11" @if(Request::get('month') == '11' || date('m') == '11') {{ 'selected' }} @endif>November</option> 
							<option value="12" @if(Request::get('month') == '12' || date('m') == '12') {{ 'selected' }} @endif>December</option>
						</select>
					</div>
					<div class="col s3 m3">
						<label for="from_date" class="active">Date</label>
						<input type="date" class="form-control" id="s_date" onchange="getRoomAvailableStatus();" />
					</div>
					<div class="col s1">
						<br>
						<span id="refresh_btn">
							<i class="material-icons icon" onclick="getRoomAvailableStatus();" style="cursor: pointer;">refresh</i>
						</span>
					</div>
				</div>
				<span class="booking_delete_msg"></span>
			</div>
			<div class="filter_data_loader"></div>
            <div class="card status_data_main">
                <div class="card-content">
					<div class="row" id="details"> 
						<div class="col s12">
							<h3 class="card-title follow_title"><strong>Current Hotel Rooms Details</strong></h3>
							<div class="itin_detail_main" id="">
								<ul class="collapsible" data-collapsible="accordion" id="current_room_status_main"> 
									
								</ul>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>


@php 
	$checkroominv = Session::get('operator.room_inventory');
@endphp
@if(@$checkroominv[0] != 'Y')
	<!-- Bottom Bar -->
	<div class="bottom_menu_bar"> 
		<ul>
			<li>
				<a href="{{ url('/operator/roominventorydashboard') }}">
					<i class="material-icons">grid_view</i>
					<span class="menu_name">Dashboard</span> 
				</a>
			</li>
			<li>
				<a href="{{ url('/operator/addroombook') }}">
					<i class="material-icons">add_shopping_cart</i>
					<span class="menu_name">New Booking</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/operator/roomsstatus') }}">
					<i class="material-icons">bed</i>
					<span class="menu_name">Room Status</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/operator/allbookings') }}">
					<i class="material-icons">travel_explore</i>
					<span class="menu_name">Search Booking</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- /Bottom Bar -->
@endif

@endsection

@section('scripts')
	<!-- ITINERARY SCRIPT JS-->
		<script src="{{ URL::asset('public/asset/js/custom/itinerary_script.js') }}"></script>
    <!-- ITINERARY SCRIPT JS-->
    <script>
		// Add mode room
		function addMoreRoom(){
			jQuery("#mul_cat_room_details").clone().appendTo(".mul_cat_room_main");
			//jQuery(".quotation_update_rate").html('');
		}
		
		// Remove room
		function removeRoom(e){
			e.parents('.mul_cat_room_details').remove()
		}
		
		jQuery(document).ready(function(){	
			var s_year = jQuery("#s_year").val();
			var s_month = jQuery("#s_month").val();
			var hotel_id = jQuery("#hotel_id").val();
			if(s_year != '' && s_month != '' && hotel_id != ''){
				getRoomBookingStatus();
			}
		});
    </script>
@endsection