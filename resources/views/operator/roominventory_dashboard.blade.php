@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard ') 

@section('styles')
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/css/pages/dashboard-modern.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/css/pages/intro.css') }}">
   <!-- BEGIN: VENDOR CSS-->
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/vendors.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/animate-css/animate.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/chartist-js/chartist.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
    <!-- END: VENDOR CSS-->
	
	<style>
		.ens_das_tab {
			float: left;
			width: 100%;
			min-height: 85px;
			background-color: #fff;
			border-radius: 5px;
			padding:5px;
			box-shadow: 0 0px 7px 0 #d6d8db;
			position: relative;
		}
		.box{
			float: left;
			width: 100%;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0px 7px 0 #d6d8db;
		}
		.row .col.s6 {
			width: 48%;
			margin: 3px 3px 11px!important;
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
		span.ens_das_tab_main_count {
			float: left;
			width: 100%;
			text-align: center;
			font-size: 18px;
			font-weight: bold;
			margin: 7px 0 0px;
		}
		span.ens_das_tab_title {
			float: left;
			width: 100%;
			color: #000;
			font-weight: bold;
			font-size: 16px;
			text-align: center;
		}
		.ens_das_tab_lable {
			float: left;
			width: 100%;
			font-size: 12px;
			text-align: center;
			margin: 0 0 10px;
		}
		span.ens_das_tab_lable_ele {
			float: left;
			width: 50%;
		}
		.r_i_heading {
			float: left;
			width: 100%;
			padding: 0 5px;
			font-weight: bold;
			color: hsl(270deg 66% 55%);
			font-size: 16px;
		}
		.ens_tab_left {
			float: left;
			width: 50%;
		}
		.ens_tab_right {
			float: left;
			width: 50%;
		}
		.ens_tab_left i {
			font-size: 49px !important;
			margin-top: 10px;
		}
		span.ens_das_tab_lable_pax {
			float: left;
			width: 33%;
			font-size: 14px;
		}
		.tab_color{color: hsl(150deg 54% 44%);}
		.tab_color1{color: hsl(205deg 91% 59%);}
		.tab_color2{color: hsl(313deg 51% 67%);}
		.tab_color3{color: hsl(0deg 91% 77%);}
		.tab_color4{color: hsl(270deg 66% 55%);}
		.filter_data_main{display:none;}
		.filter_data_loader {
			background-image: url(/asset/images/mobile_loader.gif);
			height: 700px;
			background-size: 100%;
		}
		.payment_details {
			float: left;
			width: 100%;
			font-size: 12px;
			color: #000;
			display:none;
		}
		button.payment_detail_btn {
			background-color: #fff;
			font-size: 10px;
			border: 1px solid hsl(1deg 76% 66%);
			border-radius: 3px;
			padding: 1px 7px;
			position: absolute;
			right: 3px;
			font-weight: bold;
		}
		li.custom_tab a {
			float: left;
		}
		@media only screen and (max-width: 430px){
			.custom_tab_div{
				margin-bottom: 10px !important;
			}
		}
		.custom_tab_div{
			float: left;
		}
	</style>
@endsection

@section('content') 
   <!-- BEGIN: Page Main-->
    <div id="main">
		<div class="container">
			<!-- Tab Start -->
			<div class=" active custom_tab_main tab_border row">
				<div class="col s12 custom_tab_div">
					<ul class="custom_tabs" style="margin-bottom: 10px;">
						<li class="custom_tab">
							<a class="@if(Request::segment(2) == 'roominventorydashboardoffline'){{'active'}}@endif" href="{{URL::to('/operator/roominventorydashboardoffline/')}}">Offline <input type="hidden" value="3" class="datamode"/></a>
						</li> 
						<li class="custom_tab">
							<a class="@if(Request::segment(2) == 'roominventorydashboardonline'){{'active'}}@endif" href="{{URL::to('/operator/roominventorydashboardonline/')}}">Online <input type="hidden" value="2" class="datamode"/></a>
						</li>
						<li class="custom_tab">
							<a class="@if(Request::segment(2) == 'roominventorydashboard'){{'active'}}@endif" href="{{URL::to('/operator/roominventorydashboard/')}}">Total <input type="hidden" value="1" class="datamode"/></a>
						</li>
					</ul> 
				</div>
			</div> 
			<!-- /Tab End -->
			
			<div class="row">
				<div class="box">
					<div class="col s12 m12">
						@if(@$operator->room_inventory == 'Y')
							<span class="r_i_hotel_name">{{ @$hotel->hotel_name }}</span>
							<input type="hidden" value="{{ @$hotel->id }}" id="log_hotel_id" />
						@else
							<select class="form-control" id="log_hotel_id" onchange="roomInventoryDashboardData();">
								<option value="">Select Hotel</option>
								@foreach($hotels as $hotellist)
									<option value="{{ $hotellist->id }}" @if(@$hotel->id == $hotellist->id) {{ 'selected' }} @endif>{{ $hotellist->hotel_name }}</option>
								@endforeach
							</select>
						@endif
					</div>
					<div class="col s6 m3">
						<label for="from_date" class="active">From Date</label>
						<input type="date" name="from_date" id="from_date" value="{{date('Y-m-01')}}" autocomplete="off" onchange="roomInventoryDashboardData();">
					</div>
					<div class="col s5 m5">
						<label for="to_date" class="active">To Date</label>
						<input type="date" name="to_date" value="{{date('Y-m-d')}}" id="to_date" autocomplete="off" onchange="roomInventoryDashboardData();">
					</div>
					<div class="col s1"><br>
						<i class="material-icons icon" onclick="roomInventoryDashboardData();" style="cursor: pointer;">refresh</i>
					</div>
				</div>
			</div>
			<div class="filter_data_loader"></div>
			<div class="filter_data_main">				
				<div class="row" style="margin-bottom: 0px !important;">
					<div class="col s12 m3">
						<div class="r_i_heading">
							Billing
						</div>
						<div class="ens_das_tab">
							<button class="payment_detail_btn">Explore</button>
							
							<span class="ens_das_tab_main_count tab_color">Rs. <span id="total_bill"></span></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Rooms Booked: <span id="total_bill_booked_r"></span></span>
								<span class="ens_das_tab_lable_ele">Inventory: <span id="total_bill_total_r"></span></span>
							</div>
							<span class="ens_das_tab_title">Total Billing</span>
							
							<div class="payment_details">
								
							</div>
						</div>
					</div>
					
					<div class="col s12 m3">
						<div class="r_i_heading">
							Average Room Rate
						</div>
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color1">Rs. <span id="arr"></span></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Total Billing: <span id="arr_total_bill_r"></span></span>
								<span class="ens_das_tab_lable_ele">Rooms Booked: <span id="arr_booked_r"></span></span>
							</div>
							<span class="ens_das_tab_title">ARR</span>
						</div>
					</div>
				</div>
				
				<div class="r_i_heading">
					Occupancy
				</div>
				
				<div class="row" style="margin-bottom: 0px !important;">
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color"><span id="today_acc"></span>%</span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Booked: <span id="today_acc_booked_r"></span></span>
								<span class="ens_das_tab_lable_ele">Rooms: <span id="today_acc_total_r"></span></span>
							</div>
							<span class="ens_das_tab_title" style="font-size: 15px;">Today Occupancy</span>
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color"><span id="acc"></span>%</span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Booked: <span id="acc_booked_r"></span></span>
								<span class="ens_das_tab_lable_ele">Rooms: <span id="acc_total_r"></span></span>
							</div>
							<span class="ens_das_tab_title" style="font-size: 15px;">Occupancy</span>
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color1"><span id="weekday_acc">--</span>%</span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Booked: <span id="weekday_acc_booked_rooms">--</span></span>
								<span class="ens_das_tab_lable_ele">Rooms: <span id="weekday_acc_total_rooms">--</span></span>
							</div>
							<span class="ens_das_tab_title" style="font-size: 15px;">Week Day Occupancy</span>
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color2"><span id="weekend_acc">--</span>%</span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Booked: <span id="weekend_acc_booked_rooms">--</span></span>
								<span class="ens_das_tab_lable_ele">Rooms: <span id="weekend_acc_total_rooms">--</span></span>
							</div>
							<span class="ens_das_tab_title" style="font-size: 15px;">Weekend Occupancy</span>
						</div>
					</div>
				</div>
				
				<!--<div class="r_i_heading">
					Average Room Rate
				</div>-->
				<div class="row" style="margin-bottom: 0px !important;">
					
					<!-- We are diable to show the meal plane wise ARR because of as of now we are update total amount. -->
					<!--<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color2">Rs. <span id="aparr"></span></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Rs. <span id="aparr_total_bill_r"></span></span>
								<span class="ens_das_tab_lable_ele">Booked. <span id="aparr_booked_r"></span></span>
							</div>
							<span class="ens_das_tab_title">AP ARR</span>
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color3">Rs. <span id="maparr"></span></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Rs. <span id="maparr_total_bill_r"></span></span>
								<span class="ens_das_tab_lable_ele">Booked. <span id="maparr_booked_r"></span></span>
							</div>
							<span class="ens_das_tab_title">MAP ARR</span>
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color3">Rs. <span id="cparr"></span></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Rs. <span id="cparr_total_bill_r"></span></span>
								<span class="ens_das_tab_lable_ele">Booked. <span id="cparr_booked_r"></span></span>
							</div>
							<span class="ens_das_tab_title">CP ARR</span>
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color3">Rs. <span id="eparr"></span></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_ele">Rs. <span id="eparr_total_bill_r"></span></span>
								<span class="ens_das_tab_lable_ele">Booked. <span id="eparr_booked_r"></span></span>
							</div>
							<span class="ens_das_tab_title">EP ARR</span>
						</div>
					</div>-->
				</div>
				
				<div class="r_i_heading">
					Guests 
				</div>
				<div class="row" style="margin-bottom: 0px !important;">
					<div class="col s12 m6">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color"><span id="today_total_pax"></span></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_pax tab_color1">
									<i class="material-icons noti_m_icon">wc</i> Adults: <span id="today_noofadult"></span>
								</span>
								<span class="ens_das_tab_lable_pax tab_color3">
									<i class="material-icons noti_m_icon">escalator_warning</i> Kids: <span id="today_noofchield"></span>
								</span>
								<span class="ens_das_tab_lable_pax tab_color4">
									<i class="material-icons noti_m_icon">baby_changing_station</i> Infants: <span id="today_noofinfant"></span>
								</span>
							</div>
							<span class="ens_das_tab_title" style="font-size: 15px;">Today's Inhouse Guests</span>
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 0px !important;">
					<div class="col s12 m6">
						<div class="ens_das_tab">
							<span class="ens_das_tab_main_count tab_color"></span>
							<div class="ens_das_tab_lable">
								<span class="ens_das_tab_lable_pax">
									<i class="material-icons noti_m_icon">wc</i> Adults: <span id="total_adult"></span></span>
								</span>
								<span class="ens_das_tab_lable_pax">
									<i class="material-icons noti_m_icon">escalator_warning</i> Kids: <span id="total_chield"></span>
								</span>
								<span class="ens_das_tab_lable_pax">
									<i class="material-icons noti_m_icon">baby_changing_station</i> Infants: <span id="total_infant"></span>
								</span>
							</div>
							<span class="ens_das_tab_title" style="font-size: 15px;">MTD Inhouse Guests</span>
						</div>
					</div>
				</div>
				<div class="row hide" style="margin-bottom: 0px !important;">
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<div class="ens_tab_left">
								<i class="material-icons noti_m_icon tab_color1">wc</i>
							</div>
							<div class="ens_tab_right">
								<span class="ens_das_tab_main_count tab_color1"><span id="total_adult"></span></span>
								<span class="ens_das_tab_title" style="font-size: 15px;">Total Adults</span>
							</div>
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<div class="ens_tab_left">
								<i class="material-icons noti_m_icon tab_color4">escalator_warning</i>
							</div>
							<div class="ens_tab_right">
								<span class="ens_das_tab_main_count tab_color4"> <span id="total_chield"></span></span>
								<span class="ens_das_tab_title" style="font-size: 15px;">Total Chields</span>
							</div>						
						</div>
					</div>
					<div class="col s6 m3">
						<div class="ens_das_tab">
							<div class="ens_tab_left">
								<i class="material-icons noti_m_icon tab_color3">baby_changing_station</i>
							</div>
							<div class="ens_tab_right">
								<span class="ens_das_tab_main_count tab_color3"><span id="total_infant"></span></span>
								<span class="ens_das_tab_title" style="font-size: 15px;">Total Infants</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div> 
   <!-- END: Page Main-->
   
   
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
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist.min.js') }}" type="text/javascript"></script>
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-tooltip.js') }}" type="text/javascript"></script>
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}" type="text/javascript"></script>

   <!-- BEGIN PAGE LEVEL JS-->
      <script src="{{URL::asset('public/asset/js/scripts/dashboard-modern.js') }}" type="text/javascript"></script>
      <script src="{{URL::asset('public/asset/js/scripts/intro.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	<script src="{{URL::asset('public/asset/js/scripts/dashboard-analytics.js') }}" type="text/javascript"></script>
	<script src="{{URL::asset('public/asset/js/custom/itinerary_script.js') }}" type="text/javascript"></script>
	
	<script>
		jQuery(document).ready(function(){
			jQuery(".payment_detail_btn").click(function(){
				jQuery(".payment_details").slideToggle();
			});
			roomInventoryDashboardData();
		});
	</script>
@endsection