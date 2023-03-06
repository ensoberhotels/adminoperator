@extends('vender.template.base')

@section('title', 'Ensober | Make Itinerary')

@section('styles')
    
   <style>
        .step-actions {
            float: right;
        }
		.show_select select{display:block;}
		.price_box {
			float: left;
			width: 100%;
			border: 2px solid #3949ab; 
			height: 149px;
			background-image: url(http://ensoberhotels.com/Stingo-Adm/images/logo/1560581749logo.png);
			background-size: 100% 100%;
		} 
		.price_box .hotel_rate {
			font-size: 35px;
			float: left;
			width: 100%;
			text-align: center;
			padding: 16% 0 0;
			color: #fff;
			background-color: rgba(0,0,0,0.7);
			height: 100%;
		}
		.hotel_price {
			float: left;
			width: 100%;
			font-size: 23px;
			text-align: center;
			background-color: #1b1f36;
			color: #fff;
		}
		.hotel_img_area {
			float: left;
			width: 100%;
			height: 120px;
			background-color: #eee;
		}
		.hotel_img_area img{height:100%;width:100%}
		.hotel_de_area {
			float: right;
			width: 100%;
			border-left: 1px solid #555;
			padding-left: 20px;
		}
		.loader_box {
			float: left;
			width: 26px;
			position: absolute;
			right: 0px;
			top: -2px;
			display: none;
		}
		.loader_box img {
			width: 49px;
		}
		.moreroomselect{display:none;}
		.remove_row a i {
			font-size: 19px;
			margin: -4px 0.5px;
		}
		.remove_row a {
			width: 31px;
			height: 31px;
		}
		.remove_row {
			float: left;
			position: absolute;
			right: 1px;
			top: -22px;
		}
		.hotel_dist,.hotel_area,.price_area {
			float: left;
			margin-top: 15px;
			width: 100%;
		}
		.price_area {
			border-top: 2px solid #ff4081;
			margin-top: 25px;
			margin-bottom: 700px;
		}
		td, th {
			padding: 0 5px !important;
		}
		.route_area {
			float: left;
			width: 100%;
			margin-top: 25px;
		}
		tr {
			border-bottom: 0px !important;
		}
		.price_area{
			border-top: 2px solid #ff4081;
			margin-top: 25px;
		}
		.card-header {
			border-bottom: 1px solid;
			float: left;
			width: 100%;
			margin-bottom: 15px;
		}
		#car_area_data td, #car_area_data th {
			border: 1px solid #eee;
			
		}
		#car_area_data{
			 border-collapse: collapse;
		}
		.transport_popup {
			background-color: #fff;
			width: 95%;
			padding: 5px 0px;
			box-shadow: 0 0 5px 3px #fff;
			display:none;
			border-radius:5px;
		}
		.cu_mod_header {
			font-size: 17px;
			border-bottom: 1px solid #eee;
			margin-bottom: 12px;
			padding: 0 10px 10px;
		}
		.cu_mod_body {
			padding: 0 10px;
			height: 250px;
			overflow-x: scroll;
		}
		.cu_mod_footer {
			border-top: 1px solid #eee;
			padding: 15px 10px 5px;
			margin-top: 12px;
		}
		.transport_are {
			float: left;
			width: 100%;
			display:none;
		}
		.route_area {
			float: left;
			width: 100%;
			display:none;
		}
		.hotel_area, .Actibities_area, .price_area{
			float: left;
			width: 100%;
			display:none;
		}
		.mobile_verify_popup .cu_mod_body {
			height: 110px;
			overflow: auto;
		}
		#verify_number {
			width: 210px;
			margin: 0 12px;
		}
		.mobile_put_div {
			width: 300px;
			display: none;
			margin: 20px 0 0;
		}
		.otp_put_div{
			width: 300px;
			display: none;
			margin: 20px 0 0;
		}
		#verify_OTP {
			width: 210px;
			margin: 0 12px;
		}
		.route_popup {
			background-color: #fff;
			padding: 10px;
			box-shadow: 0 0 1px 1px #fff;
			display: none;
			width:230px;
		}
		.pop_footer {
			float: left;
			width: 100%;
			margin: 13px 0 0;
			text-align: right;
		}
		select[readonly]{
			pointer-events: none;
		}
		
		table.iti_price_tbl input {
			height: 22px !important;
			padding: 0 3px !important;
			margin-top: 5px !important;
		}
		tr.iti_price_head {
			background-color: #6529a175;
		}
		table.iti_price_tbl td {
			border: 1px solid #4444444d;
			color: #000;
			font-size: 12px;
		}
		.delete_transport {
			color: #ff4081;
			font-size: 20px;
			cursor: pointer;
		}
		body{font-size: 12px;}
		table#add_more_dis td {
			vertical-align: top;
		}
		.dis_row {
			float: left;
			width: 100%;
		}
    </style>
@endsection

@section('content')
	

	<!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0">Dashboard</h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="index.html">Make Itinerary</a>
                  </li>
                </ol>
              </div>
              <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><span class="hide-on-small-onl">Settings</span><i class="material-icons right">arrow_drop_down</i></a>
                <ul class="dropdown-content" id="dropdown1" tabindex="0">
                  <li tabindex="0"><a class="grey-text text-darken-2" href="user-profile-page.html">Profile<span class="new badge red">2</span></a></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="app-contacts.html">Contacts</a></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="page-faq.html">FAQ</a></li>
                  <li class="divider" tabindex="-1"></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="user-login.html">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <div class="section section-form-wizard">

    <!-- Linear Stepper -->	
	
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content" style="height: 3000px;">
					<!-- /Basic Info -->
					<div class="basic_info">
						<div>
							<form class="form-inline" action="javascript:openUpdateItineraryPage()">
								<label for="itinerary_no" class="mb-2 mr-sm-2 active">Search Itinerary:</label>
								<input type="text" class="form-control mb-2 mr-sm-2" id="itinerary_no" placeholder="Enter Itinerary No" name="itinerary_no" style="width:130px !important;">
								   
								<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light" onclick="openUpdateItineraryPage();" style="margin-top:7px !important;">Search</button>
							</form>
						</div>
						<div class="card-header">
							<h4 class="card-title">Basic Info</h4>
						</div>
						<form method="post" class="for_basic_info"/>
						<div class="col s12" style="padding-right: 25px;">
							<table>
								<tr>
									<td>No Of Adults</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> <input type="number" name="adult" id="adult"/></td>
								</tr>
								<tr>
									<td>Kids (5-12 Years)</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> <input type="number" name="kids" id="kids"/></td>
								</tr>
								<tr>
									<td>Infant (below 5 Years)</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> <input type="number" name="infant" id="infant" /></td>
								</tr>
								<tr>
									<td>Guest/Agency Name</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> 
										<input type="text" name="name" id="name" class="" autocomplete="off" placeholder="Guest/Agency Name"/>
									</td>
								</tr>
								
								<tr>
									<td>Mobile</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> 
										<input type="text" name="mobile" id="mobile" class="" autocomplete="off" placeholder="Guest Mobile"/>
									</td>
								</tr>
								<tr>
									<td>Tour Type</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> 
										<p>
										  <label>
											<input type="radio" class="filled-in tour_type" name="tour_type" value="Hotel With Transport"/>
											<span>Hotel With Transport.</span>
										  </label>
										</p>
										<p>
										  <label>
											<input type="radio" class="filled-in tour_type" name="tour_type" id="tour_type" value="Only Hotel"/>
											<span>Only Hotel.</span>
										  </label>
										</p>
										<p>
										  <label>
											<input type="radio" class="filled-in tour_type" name="tour_type" id="tour_type" value="Only Transport" />
											<span>Only Transport.</span>
										  </label>
										</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										
									</td>
								</tr>
							</table>
						</div>
						<div class="col s12" style="padding-left: 25px;">
							<table>
								<tr>
									<td>Arrival Date & Time</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> <input type="datetime-local" name="arrival_date_time" id="arrival_date_time" class="filter_date1" autocomplete="off" placeholder="Arrival Date"/></td>
								</tr>
								<tr>
									<td>Arrival City</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> 
										<select name="arrival_city" id="arrival_city">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<td>Drop Date & Time</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> <input type="datetime-local" name="drop_date_time" id="drop_date_time" class="filter_date1" autocomplete="off" placeholder="Drop Date"/></td>
								</tr>
								<tr>
									<td>Drop City</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> 
										<select name="drop_city" id="drop_city">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select> 
									</td>
								</tr>
								<tr>
									<td>Show Separate Cost</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> 
										<select name="rate_show" id="rate_show">
											<option value="N">No</option>
											<option value="Y">Yes</option>
										</select> 
									</td>
								</tr>
							</table>
						</div>	
						<div class="col s12 button_area">
							<img src="{{URL::asset('public/asset/images/loader/loader.gif') }}" style="width: 28px;float: right;margin: 5px;display:none;" id="basic_info_loader"/>
							<button class="btn waves-effect waves-light right" type="button" name="action" id="save_basic_info">Next<i class="material-icons right">send</i> 
							</button>
						</div>
						</form>
					</div>
					<!-- /Basic Info -->
					
					<!-- Trasport -->
					<div class="transport_are">
						<div class="card-header">
							<h4 class="card-title">Select Transport</h4>
						</div>
						<div class="col s12 center">
							Select Transport Type 
							<input type="hidden" value="" id="itinerary_no_val" />
							<a href="javascript:void(0);" style="color: #ff4081;" id="select_trans"><i class="material-icons add_trasport_icon animated">add_circle</i></a><br><br>
							
							<!-- Transport Popup -->
							<div class="transport_popup transport_select_popup animated zoomIn">
								<div class="cu_mod_header"> 
									Select Transport
								</div>
								<div class="cu_mod_body"> 
									<table id="car_area_data">
										<tr>
											<th>Car Name</th>
											<th>Total Seat</th>
											<th>Max KM</th>
											<th>Per KM</th>
											<th>Day Fare</th>
											<th>Car Pic</th>
											<th>Action</th>
										</tr>
										@foreach($transports as $transport)
										<tr> 
											<td>{{ @$transport->car->car_name }}</td>
											<td>{{ $transport->car_seats->seats }}</td>
											<td>{{ $transport->perday_km }}</td>
											<td>{{ $transport->perkm_fare }}</td>
											<td>{{ $transport->fare }}</td>
											<td><img src="/storage/app/{{@$transport->car->car_image}}" width="100px"></td>
											<td>
												<p>
												  <label>
													<input type="checkbox" class="filled-in transport_id" value="{{$transport->id}}"/>
													<span></span>
												  </label>
												</p>
											</td>
										</tr>
										@endforeach
									</table>
								</div>
								<div class="cu_mod_footer"> 
									<a class="btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange b-close" title="Delete"><i class="material-icons">close</i></a>
									<input type="hidden" value="" id="selected_tran" />
									<a class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" style="float:right;" id="add_transports">
										<i class="material-icons">check</i>
									</a>
								</div>
							</div>
						<!-- /Transport Popup -->
							<table id="car_area_data" style="display: inline-block;">
								
							</table>
						</div>
						<div class="col s12 button_area">
							<button class="btn waves-effect waves-light right" type="button" name="action" id="save_transport">Next<i class="material-icons right">send</i> 
							</button>
							<span style="color:red; font-size:12px;float: right;width: 250px;" class="car_seat_cap_error"></span>
						</div>
					</div>
					
					<!-- /Trasport -->
					
					<!-- Route Area -->
					<div class="route_area">
						<div class="card-header">
							<h4 class="card-title">Select Route</h4>
						</div>
						<div class="col s12">
							<div id="add_more_dis">
								<div class="dis_row">
									<div class="col s6" style="position: relative;">
										Pickup Location<br>
										<select name="start_distination" id="start_distination" class="get_route start_distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
										<span class="travel_type"></span>
										<input type="hidden" class="pickup" value="0" />
									</div>
									<div class="col s6" style="position: relative;">
										To Destination<br>
										<select name="to_distination" id="to_distination" class="get_route to_distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
										<span class="travel_type_d"></span>
										<input type="hidden" class="dropup" value="0" />
										<img src="{{URL::asset('public/asset/images/loader/loader.gif') }}" style="width: 20px;height: 20px;float: right;margin: 5px;position: absolute;right: 19px !important;top: 21px !important;left: auto;display:none;" class="loader">
									</div>
									<div class="col s4" >
										Via Route<br>
										<button class="btn waves-effect waves-light" type="button" onclick="oprnRoutePop(0)" style="color: red;background: none;padding: 0 5px !important;margin: 0px !important;box-shadow: none;border: 1px solid #eee;"><i class="material-icons">alt_route</i> 
										</button>
												
										
										<div class="route_popup route_p0">
											<h4 style="font-size: 14px; margin: 0 0 10px;">Select Via Route</h4>
											<span class="route_list show_select">
											
											</span>
											<div class="pop_footer">
												<button class="btn waves-effect waves-light b-close" type="button">
													Cancel
												</button>
												<button class="btn waves-effect waves-light b-close" type="button">
													Done
												</button>
											</div>
										</div>
										
									</div>
									<div class="col s4">
										Distance<br>
										<span class="distance_val"></span>KM
									</div>
									<div class="col s4">
										Journey Time<br>
										<span class="duration_val"></span> 
									</div>
								</div>
							</div>
							<table>
								<tr>
									<td>
										<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
											<i class="material-icons">note_add</i>
										</a>
									</td>
								</tr>
							</table>
						</div>
						<div class="col s12 button_area">
							<button class="btn waves-effect waves-light right" type="button" name="action" id="save_route">Next<i class="material-icons right">send</i> 
							</button>
							<span style="font-size:12px; color:red;" class="route_drop_error"></span>
						</div>
					</div>
					<!-- /Route Area -->
					
					<!-- Hotel Area -->
					<div class="hotel_area">
						<div class="card-header">
							<h4 class="card-title">Select Hotel & Rooms</h4>
						</div>
						<div class="col s12">
							<table id="add_more_hotel">
								
							</table>
							<table>
								<tr>
									<td>
										<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow add_hotel_btn" title="Add Row" onclick="addMoreHotel()" style="float:right;">
											<i class="material-icons">note_add</i>
										</a>
									</td>
								</tr>
							</table>
							<div class="col s12 button_area">
							<button class="btn waves-effect waves-light right" type="button" name="action" id="save_hotel">Next<i class="material-icons right">send</i> 
							</button>
						</div>
						</div>
					</div>
					<!-- / Hotel Area -->
					
					<!-- Actibities -->
					<div class="Actibities_area">
						<div class="card-header">
							<h4 class="card-title">Select activities</h4>
						</div>
						<div class="col s12">
							<div id="add_more_activity">
								
								
							</div>
							<table>
								<tr>
									<td>
										<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMoreActivity()" style="float:right;">
											<i class="material-icons">note_add</i>
										</a>
									</td>
								</tr>
							</table>
						</div>
						<div class="col s12 button_area">
							<button class="btn waves-effect waves-light right save_activity" type="button" name="action" id="">Next<i class="material-icons right">send</i> 
							</button>
						</div>
					</div>
					<!-- / Actibities -->
					
					
					<!-- Total Price Area -->
					<div class="price_area" style="display:none;">
						<div class="col s12">
							<center>
								<button class="btn waves-effect waves-light" type="button" name="action" id="load_price">
									Load Price
								</button><img style="width: 20px; margin-left: 5px; margin-top: 2px;  display: none;" src="{{URL::asset('public/asset/images/loader/loader.gif') }}" class="img-responsive update_price_loader">
							</center>
							<div class="row iti_price_list"> 
								
							</div>
							<center>
								
							
								<div class="mobile_put_div">
									<input type="text" placeholder="Mobile Number" id="verify_number"/> 
									<a class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow very_user_dis" title="Add Row" id="very_user">
										<i class="material-icons">check</i>
									</a> 
								</div> 
								<!--/vender/printitinerary/816362-->
								<div class="otp_put_div">
									<input type="text" placeholder="OTP" id="verify_OTP"/>
									<a class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" id="very_otp">
										<i class="material-icons">check</i>
									</a> 
								</div>  

								<div class="view_itinerary_link">

								</div>
								
							</center>
						</div>
					</div>
					<!-- / Total Price Area -->
                </div>
            </div>
        </div>
    </div>


<!-- Mobile Verification Popup -->
	<!--div class="transport_popup mobile_verify_popup animated flipInX">
		<div class="cu_mod_header"> 
			Enter Mobile Number
		</div>
		<div class="cu_mod_body"> <br>
			<input type="text" placeholder="Mobile Number" id="verify_number"/>
		</div>
		<div class="cu_mod_footer"> 
			<a class="btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange b-close" title="Delete"><i class="material-icons">close</i></a>
			<input type="hidden" value="" id="selected_tran" />
			<a class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" style="float:right;" id="very_user">
				<i class="material-icons">check</i>
			</a>
		</div>
	</div-->
<!-- /Mobile Verification Popup -->

<!-- OTP Verification Popup -->
	<!--div class="transport_popup OTP_verify_popup animated flipInX">
		<div class="cu_mod_header"> 
			Enter Verification OTP
		</div>
		<div class=""> <br>
			<input type="text" placeholder="OTP" id="verify_OTP"/>
		</div>
		<div class="cu_mod_footer"> 
			<a class="btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange b-close" title="Delete"><i class="material-icons">close</i></a>
			<input type="hidden" value="" id="selected_tran" />
			<a class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" style="float:right;" id="very_user" href="/vender/printitinerary/816362">
				<i class="material-icons">check</i>
			</a>
		</div>
	</div-->
<!-- /OTP Verification Popup -->

</div>
<!-- END RIGHT SIDEBAR NAV -->
            
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection 

@section('scripts')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('public/asset/vendors/materialize-stepper/materialize-stepper.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('public/asset/js/plugins.js') }}" type="text/javascript"></script>
    <!--<script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>-->
    <script src="{{ URL::asset('public/asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('public/asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
	<script>
			
		// Check deop location add or not
		function checkDropLocationAvai(){
			let checkstatus = false;
			jQuery(".dropup").each(function(){
				let drop_status = jQuery(this).val();
				if(drop_status == 1){
					checkstatus = true;
				}
			});
			return checkstatus;
		}


		function addMore(){
			let count_tr = jQuery("#add_more_dis .dis_row").length;
			let count_tr_nex = jQuery("#add_more_dis .dis_row").length+1;
			let to_distination = jQuery("#add_more_dis .dis_row:nth-child("+count_tr+")").find(".to_distination").val();
    		$('#add_more_dis').append(`<div class="dis_row">
									<div class="show_select col s6" style="position: relative;">
										Start<br>
										<span>
										<select class="get_route start_distination" readonly>
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
										<span class="travel_type"></span>
										<input type="hidden" class="pickup" value="0" />
										</span>
									</div>
									<div class="show_select col s6" style="position: relative;">
										To<br>
										<span>
										<select class="get_route to_distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
										<span class="travel_type_d"></span>
										<input type="hidden" class="dropup" value="0" />
										</span>
										<img src="{{URL::asset('public/asset/images/loader/loader.gif') }}" style="width: 20px;height: 20px;float: right;margin: 5px;position: absolute;right: 19px !important;top: 21px !important;left: auto;display:none;" class="loader">
									</div>
									<div class="col s4">
										Via Route<br>
										<button class="btn waves-effect waves-light" type="button" onclick="oprnRoutePop(${count_tr})" style="color: red;background: none;padding: 0 5px !important;margin: 0px !important;box-shadow: none;border: 1px solid #eee;"><i class="material-icons">alt_route</i> 
										</button>
												
										
										<div class="route_popup route_p${count_tr}">
											<h4 style="font-size: 14px; margin: 0 0 10px;">Select Via Route</h4>
											<span class="route_list show_select">
											
											</span>
											<div class="pop_footer">
												<button class="btn waves-effect waves-light b-close" type="button">
													Cancel
												</button>
												<button class="btn waves-effect waves-light b-close" type="button">
													Done
												</button>
											</div>
										</div>
									</div>
									<div class="col s4">
										Distance<br>
										<span class="distance_val"></span> KM
									</div>
									<div class="col s4">
										Time<br>
										<span class="duration_val"></span> 
									</div>
									 
									<div class="col s6"><a href="javascript:void(0);" onclick="remove($(this))" style="color: #ff4081;"><i class="material-icons route_area">remove_circle</i></a></div>
								</div>`);
								setTimeout(function(){
									jQuery("#add_more_dis .dis_row:nth-child("+count_tr_nex+")").find(".start_distination").val(to_distination);
								},1000);
    	}
		
		function addMoreHotel(){
    		$('#add_more_hotel').append(`<div class="dis_row">
				<div class="show_select col s6">
					Destination<br>
					<select class="route_citied" id="distination"><option>Select City</option></select>
				</div>
				<div class="show_select col s6">
					Hotel<br>
					<select name="hotel" id="hotel_list" class="hotel_list" onchange="hotelRateAW($(this));">
						<option>Select Hotel</option>
					</select>
				</div>
				<div class="show_select col s6">
					Select Room Type<br>
					<select name="room_type" id="room_type" class="room_type_list" onchange="hotelRateAW($(this));">
						<option>Select Room Type</option>
					</select>
				</div>
				<div class="show_select col s6">
					Select Meal Plan<br>
					<select name="meal_plan" id="meal_plan" onchange="hotelRateAW($(this));">
						<option value="">Select Meal Plan</option>
						<option value="ep_price">EP (Room Only)</option>
						<option value="cp_price">CP (Room with Breakfast)</option>
						<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
						<option value="ap_price">AP (Room with all meals plan)</option>
					</select>
				</div>
				<div class="col s6">
					No Of Rooms<br>
					<input type="number" name="no_of_rooms" id="no_of_rooms" onkeyup="hotelRateAW($(this));"/>
				</div>
				<div class="col s6">
					No Of Nights<br>
					<input type="number" name="no_of_nights" id="no_of_nights" onkeyup="hotelRateAW($(this));" />
				</div>
				<div class="col s6">
					Rates<br>
					<input type="hidden" name="rate" id="rate" />
					<span id="hotel_price">--</span> /-
				</div>
				<div class="col s6" style="position: relative;">
					<a href="javascript:void(0);" id="hotel_link" target="_blank" style="color: #ff4081;"><i class="material-icons">remove_red_eye</i></a>
					
					<a href="javascript:void(0);" onclick="remove($(this))" style="color: #ff4081;float: right;"><i class="material-icons">remove_circle</i></a>
					
					<div class="loader_box" style="display: none;">
						<img src="{{URL::asset('public/asset/images/loader/loader.gif') }}" class="img-responsive">
					</div>
				</div>	
			</div>`);
    	}
		
		function addMoreActivity(){
    		$('#add_more_activity').append(`<div class="dis_row"> 
									<div class="show_select col s6">
									Destination<br>
										<select name="distination" id="activity_city" class="distination"><option>Select City</option></select>
									</div>
									<div class="show_select col s6">
										Activity<br>
										<select name="activities" id="activities" class="activities">
											<option>Select Activity</option>
										</select>
									</div>
									<div class="show_select col s6">
										Date<br>
										<input type="date" name="activity_date" id="activity_date" class="activity_date"/>
									</div>
									<div class="show_select col s6">
										Activity Time<br>
										<select name="activity_time" id="activity_time" class="activity_time">
											<option>Select Activity Time</option>
										</select>
									</div>
									<div class="col s6">
										Price<br>
										<span class="activiti_price">--</span>/- SR
									</div>
									<div class="col s6"><a href="javascript:void(0);" onclick="remove($(this))" style="color: #ff4081;"><i class="material-icons">remove_circle</i></a></div> 
								</div>`);
    	}
		
		function remove(e){
			var route_citied = e.parent().parent().find(".route_citied").val();
			var itinerary_no_val = jQuery("#itinerary_no_val").val();
			if(route_citied != ''){
				jQuery.ajax({
					type: 'post',
					url: 'deleteitihotelremove',
					cache: false,
					async: true,
					data: {'route_citied':route_citied, 'itinerary_no_val':itinerary_no_val},
					success: function(res){
						console.log(res);
					}
				});
			}
			e.parents('.dis_row').remove()
		}
		
		
		// Get hotel rate
		function hotelRateAW(thisdiv){
			jQuery(".hotel_price_error").hide();
			
			$.ajaxSetup({
				headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var itinerary_no_val = jQuery("#itinerary_no_val").val();
			var distination = thisdiv.parent().parent().find("#distination").val();
			var hotel_id = thisdiv.parent().parent().find("#hotel_list").val();
			var room_type = thisdiv.parent().parent().find("#room_type").val();
			var meal_plan = thisdiv.parent().parent().find("#meal_plan").val();
			var no_of_room = thisdiv.parent().parent().find("#no_of_rooms").val();
			var no_of_night = thisdiv.parent().parent().find("#no_of_nights").val();
			var arrival_date_time = jQuery("#arrival_date_time").val();
			var adult = jQuery("#adult").val();
			var child = jQuery("#kids").val();
			if(hotel_id != ""){
				thisdiv.parent().parent().find(".loader_box").show();
			  $.ajax({
				url: "ajaxgetHotelRate",
				type:"post",
				cache: false,
				async:false,
				data: {'hotel_id':hotel_id,'room_type':room_type,'arrival_date_time':arrival_date_time,'meal_plan':meal_plan, 'no_of_night':no_of_night, 'no_of_room':no_of_room, 'adult':adult, 'child':child, 'itinerary_no_val':itinerary_no_val, 'distination':distination},
				success: function(data){
					var data = JSON.parse(data);
					thisdiv.parent().parent().find("#hotel_price").text(data.price);
					thisdiv.parent().parent().find("#hotel_link").attr("href", data.hotel_link);
					thisdiv.parent().parent().parent().parent().find(".hotel_img_area img").attr("src",data.hotel_image);
					console.log(data);    
					thisdiv.parent().parent().find(".loader_box").hide();
					if(data.status == 0){
						thisdiv.parent().parent().parent().find(".moreroomselect").show();
						jQuery("#save_hotel").parent().append('<span class="hotel_price_error" style="color:red; font-size:12px;">'+data.message+'</span>');
						jQuery("#save_hotel").prop('disabled', true);
					}else{
						jQuery("#save_hotel").prop('disabled', false);
						thisdiv.parent().parent().parent().find(".moreroomselect").hide();
					}
				}
			  });
			}
		}
		
		// Update itinerary price
		function updateItineraryPrice(updatetype,updateid,value){	
			jQuery(".update_price_loader").show();
			$.ajaxSetup({
				headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var itinerary_no_val = jQuery("#itinerary_no_val").val();
			
			jQuery.ajax({
				url: "updateitineraryprice",
				type:"post",
				cache: false,
				async:false,
				data: {'itinerary_no_val':itinerary_no_val,'updatetype':updatetype,'updateid':updateid,'value':value},
				success: function(data){
					var data = JSON.parse(data);
					var itinerary_no_val = jQuery("#itinerary_no_val").val();
					jQuery.ajax({
						type: 'get',
						url: 'calculateItineraryPrince',
						cache: false,
						async: true,
						data: {'itinerary_no_val':itinerary_no_val},
						success: function(res){
							jQuery(".update_price_loader").hide();
							var data = JSON.parse(res);
							jQuery(".iti_price_list").html(data.price_list);
							let view_url = '<br><center><a href="'+data.view_url+'">View Created Itierary</a></center>';
							jQuery(".view_itinerary_link").html(view_url);
						}
					}); 
				}
			});
		}
		
		// Open rourte popup
		function oprnRoutePop(nopop){
			if(jQuery('.route_p'+nopop+' .show_select select').hasClass('route_id')){
				jQuery('.route_p'+nopop).bPopup();
			}
		}
		
		// This function use for open update itinerary page
		function openUpdateItineraryPage(){
			var itinerary_no = jQuery("#itinerary_no").val();
			var update_page = "/vender/itinerarymanage/"+itinerary_no;
			window.location.replace(update_page);
		}
	</script>
	<script>
		jQuery(document).ready(function(){
			
			// Get vai name
			jQuery(".add_more_dis").delegate(".route_id", "change", function(){
				var route_name = jQuery(this).attr('vname');
				//alert(route_name);
			});
			
			// Date Picker
			jQuery('.filter_date').datetimepicker({timepicker:false,format:'Y-m-d'});
			
			// Time Picker
			jQuery('.filter_time').datetimepicker({datepicker:false,format:'H:i'});
			
			// Get hotels by city id for added row 
			jQuery(".hotel_iten_area").delegate(".get_hotels_aw", "change", function(){
				var this_div = jQuery(this);
				var city_id = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: baseUrlV+'ajaxgetHotelDetailAW',
					cache: false,
					async: true,
					data: {'city_id':city_id},
					success: function(res){
						this_div.parent().parent().parent().find(".hotel_list").html(res);
					}
				});
			});
			
			// Get hotels room type by hotel id for added row
			jQuery(".hotel_iten_area").delegate('.hotel_id_aw', 'change', function(){
				var this_div = jQuery(this);
				var hotel_id = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: baseUrlV+'ajaxgetHotelRoomTypeDetailAw',
					cache: false,
					async: true,
					data: {'hotel_id':hotel_id},
					success: function(res){
						this_div.parent().parent().find(".room_type_list").html(res);
					}
				});
			});
		});
		
		
		
		jQuery(document).ready(function(){
			jQuery("#save_basic_info").click(function(){
				$.ajaxSetup({
					headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				var adult = jQuery("#adult").val();
				var kids = jQuery("#kids").val();
				var infant = jQuery("#infant").val();
				var tour_type = '';
				jQuery(".tour_type").each(function(){
					var check = jQuery(this).prop("checked");
					if(check == true){
						tour_type = jQuery(this).val();
					}
				});
				
				var arrival_date_time = jQuery("#arrival_date_time").val();
				var arrival_city = jQuery("#arrival_city").val();
				var drop_date_time = jQuery("#drop_date_time").val();
				var drop_city = jQuery("#drop_city").val();
				var rate_show = jQuery("#rate_show").val();
				var name = jQuery("#name").val();
				var mobile = jQuery("#mobile").val();
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				
				if(adult != "" && tour_type != "" && arrival_date_time != "" && arrival_city != "" && drop_date_time != "" && drop_city != ""){
					jQuery("#basic_info_loader").show();
				  $.ajax({
					url: "ajaxitibasicinfo",
					type:"post",
					cache: false,
					async:false,
					data: {'adult':adult,'kids':kids,'infant':infant,'tour_type':tour_type, 'arrival_date_time':arrival_date_time, 'arrival_city':arrival_city, 'drop_date_time':drop_date_time, 'rate_show':rate_show, 'drop_city':drop_city, 'itinerary_no_val':itinerary_no_val,'name':name, 'mobile':mobile},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
						jQuery("#itinerary_no_val").val(data.itinerary_no);
						jQuery("#basic_info_loader").hide();
						jQuery(".transport_are").show();
						var top_div = jQuery(".transport_are").position().top;
						jQuery("html, body").animate({ scrollTop: top_div });
						setTimeout(function(){ jQuery(".add_trasport_icon").addClass("heartBeat"); }, 1000);
					}
				  });
				}else{
					alert("Required Fields!");
				}
				
			}); 
			
			// Open transport popup
			jQuery("#select_trans").click(function(){
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				if(itinerary_no_val != ""){
					$('.transport_select_popup').bPopup({modalClose: false});
				}else{
					alert("Please Give Basic Info First!");
				}
			});

			

			
			
			// Select Vehicle
			jQuery(".transport_id").click(function(){
				var car_ids = []; 
				jQuery(".transport_id").each(function(){
					var check = jQuery(this).prop("checked");
					if(check == true){
						var car_id = jQuery(this).val();
						car_ids.push(car_id);
					}
				});
				jQuery("#selected_tran").val(car_ids);
			});
			
			// Add Transport
			jQuery("#add_transports").click(function(){
				var selected_tran = jQuery("#selected_tran").val();
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				$.ajax({
					url: "addTransport",
					type:"post",
					cache: false,
					async:false,
					data: {'selected_tran':selected_tran,'itinerary_no_val':itinerary_no_val},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
						jQuery("#car_area_data").html(data.transport_data);
						jQuery(".transport_select_popup").bPopup().close() 
					}
				});
			});
			
			// Get Routes
			jQuery("#add_more_dis").delegate(".get_route","change", function(){
				this_div = jQuery(this);
				var start_distination = jQuery(this).parent().parent().parent().find(".start_distination").val();
				
				var to_distination = jQuery(this).parent().parent().parent().find(".to_distination").val();
				
				//jQuery(this).parent().parent().find(".loader").show();
				
				// Check pickup
				let arrival_city = jQuery("#arrival_city").val();
				if(start_distination == arrival_city){
					jQuery(this).parent().parent().parent().find(".travel_type").text('Pickup');
					jQuery(this).parent().parent().parent().find(".pickup").val(1);
				}else{
					jQuery(this).parent().parent().parent().find(".travel_type").text('');
					jQuery(this).parent().parent().parent().find(".pickup").val(0);
				}

				// Check Dropup
				let drop_city = jQuery("#drop_city").val();
				if(to_distination == drop_city){
					jQuery(this).parent().parent().parent().find(".travel_type_d").text('Dropup');
					jQuery(this).parent().parent().parent().find(".dropup").val(1);
				}else{
					jQuery(this).parent().parent().parent().find(".travel_type_d").text('');
					jQuery(this).parent().parent().parent().find(".dropup").val(0);
				}

				jQuery.ajax({
					url: "getRoutes",
					type:"post",
					cache: false,
					async:false,
					data: {'start_distination':start_distination,'to_distination':to_distination},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
						//this_div.parent().parent().find(".loader").hide();
						this_div.parent().parent().parent().find(".route_list").html(data.route_data);
						this_div.parent().parent().parent().find(".distance_val").text(data.distance);
						this_div.parent().parent().parent().find(".duration_val").text(data.duration);
						// Set next start destination
						this_div.parent().parent().parent().next().find(".start_distination").val(to_distination);
					}
				});
			});
			
			
			// Get Routes Distance And Duration
			jQuery("#add_more_dis").delegate(".get_route","change", function(){
				this_div = jQuery(this);
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				var route_id = '';//jQuery(this).val();
				var start_distination = jQuery(this).parent().parent().parent().find(".start_distination").val();
				var to_distination = jQuery(this).parent().parent().parent().find(".to_distination").val();
				var pickup = jQuery(this).parent().parent().parent().find(".pickup").val();
				var dropup = jQuery(this).parent().parent().parent().find(".dropup").val();
				$.ajax({
					url: "addRoutesDetail",
					type:"post",
					cache: false,
					async:false,
					data: {'route_id':route_id, 'itinerary_no_val':itinerary_no_val, 'start_distination':start_distination, 'to_distination':to_distination, 'pickup':pickup, 'dropup':dropup},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
						//this_div.parent().parent().parent().find(".distance_val").text(data.distance);
						//this_div.parent().parent().parent().find(".duration_val").text(data.duration);
					}
				});
			});
			
			// save_transport
			jQuery("#save_transport").click(function(){
				//--- Set the condition for check the seat as per guest
				var seat_cap = 0;
				jQuery(".car_seats").each(function(){
					seat_cap += parseInt(jQuery(this).text());
				});
				var adult = jQuery("#adult").val();
				var kids = jQuery("#kids").val();
				
				var total_guest = parseInt(adult)+parseInt(kids);
				jQuery(".car_seat_cap_error").text('');
				if(total_guest > seat_cap){
					jQuery(".car_seat_cap_error").text('Vehicle selected does not have sufficient seats to accommodate all members, Please add another vehicle or selected vehicle with Sufficient seat for all');
					return false;
				}
				//--- Set the condition for check the seat as per guest
				
				jQuery(".route_area").show();
				var top_div = jQuery(".route_area").position().top;
				jQuery("html, body").animate({ scrollTop: top_div });
				var arrival_city = jQuery("#arrival_city").val();
				jQuery("#start_distination").val(arrival_city);
				
				jQuery(".travel_type").text('Pickup');
				jQuery(".pickup").val(1);
			});
			
			// save_route
			jQuery("#save_route").click(function(){
				jQuery(".route_drop_error").text('');
				if(!checkDropLocationAvai()){
					jQuery(".route_drop_error").text('Please Add Drop Location');
					return false;
				}
				jQuery(".hotel_area").show();
				var top_div = jQuery(".hotel_area").position().top;
				jQuery("html, body").animate({ scrollTop: top_div });
				let exist_tr_count = jQuery("#add_more_hotel tr").length;
				if(exist_tr_count == 0){
					addMoreHotel();
				}
			});
			
			/* // Transport Price Save
			jQuery("#save_route").click(function(){
				alert("dfgdfgdf");
				jQuery(".transport_data").each(function(){
					var car_name = jQuery(this).find(".car_name");
					var perday_km = jQuery(this).find(".perday_km");
					var perkm_fare = jQuery(this).find(".perkm_fare");
					var fare = jQuery(this).find(".fare");
					alert(car_name);
					alert(perday_km);
					alert(perkm_fare);
					alert(fare);
				});
			}); */
			
			// save_hotel
			jQuery("#save_hotel").click(function(){
				jQuery(".Actibities_area").show();
				var top_div = jQuery(".Actibities_area").position().top;
				jQuery("html, body").animate({ scrollTop: top_div });
				let exist_tr_count = jQuery("#add_more_activity tr").length;
				if(exist_tr_count == 0){
					addMoreActivity();
				}
			});
			
			
			
			// Get Route City
			jQuery("#add_more_hotel").delegate(".route_citied","click", function(){
				thidiv = jQuery(this);
				var var_html = jQuery(this).html();
				if(var_html == "<option>Select City</option>"){
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				$.ajax({
					url: "getRoutesCities",
					type:"post",
					cache: false,
					async:false,
					data: {'itinerary_no_val':itinerary_no_val},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
						thidiv.html(data.data);
						if(data.list_dist == 1){
							jQuery(".add_hotel_btn").hide();
						}
					}
				});
				}
			});
			
			// Get all Route City for activities
			jQuery(".Actibities_area").delegate("#activity_city","click", function(){
				thidiv = jQuery(this);
				var var_html = jQuery(this).html();
				console.log(var_html);
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				if(var_html == "<option>Select City</option>"){
					$.ajax({
						url: "getallRoutesCities",
						type:"post",
						cache: false,
						async:false,
						data: {'itinerary_no_val':itinerary_no_val},
						success: function(data){
							var data = JSON.parse(data);
							console.log(data);
							thidiv.html(data.data);
							thidiv.parent().parent().find("#activity_date").attr('min', data.arrival_date);
							thidiv.parent().parent().find("#activity_date").attr('max', data.drop_date);
						}
					});
				}
			});
			
			// Get Hotel By City Id
			jQuery("#add_more_hotel").delegate(".route_citied","change", function(){
				thidiv = jQuery(this);
				var var_html = jQuery(this).html();
				var city_id = jQuery(this).val();
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				jQuery.ajax({
					type: 'post',
					url: 'getHotelById',
					cache: false,
					async: true,
					data: {'city_id':city_id},
					success: function(res){
						thidiv.parent().parent().find(".hotel_list").html(res); 
					}
				});
			});
			
			// Get hotels room type by hotel id for added row
			jQuery("#add_more_hotel").delegate('.hotel_list', 'change', function(){
				var this_div = jQuery(this);
				var hotel_id = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: 'getRoomTypeById',
					cache: false,
					async: true,
					data: {'hotel_id':hotel_id},
					success: function(res){
						this_div.parent().parent().find(".room_type_list").html(res);
					}
				});
			});
			
			
			// Get Activity by city id
			jQuery(".Actibities_area").delegate('#activity_city', 'change', function(){
				var this_div = jQuery(this);
				var activity_city = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: 'getactivitybycity',
					cache: false,
					async: true,
					data: {'activity_city':activity_city},
					success: function(res){
						this_div.parent().parent().find(".activities").html(res);
					}
				});
			});

			// Get Activity time by activity id
			jQuery(".Actibities_area").delegate('#activities', 'change', function(){
				var this_div = jQuery(this);
				var activity_id = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: 'getactivitytimebyid',
					cache: false,
					async: true,
					data: {'activity_id':activity_id},
					success: function(res){
						this_div.parent().parent().find(".activity_time").html(res);
					}
				});
			});
			
			
			
			// Get Activity Price by Activity id
			jQuery(".Actibities_area").delegate('#activities', 'change', function(){
				var this_div = jQuery(this);
				var activity_id = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: 'getactivityprice',
					cache: false,
					async: true,
					data: {'activity_id':activity_id},
					success: function(res){
						this_div.parent().parent().find(".activiti_price").text(res);
					}
				});
			});
			
			
			// Save Activity Price by itinerary no
			jQuery(".save_activity").click(function(){
				jQuery("#add_more_activity .dis_row").each(function(){
					var this_div = jQuery(this);
					var city_id = jQuery(this).find("#activity_city").val();
					var activity = jQuery(this).find("#activities").val();
					var activiti_price = jQuery(this).find(".activiti_price").text();
					var itinerary_no_val = jQuery("#itinerary_no_val").val();
					var activity_date = jQuery(this).find("#activity_date").val();
					var activity_time = jQuery(this).find("#activity_time").val();
					jQuery.ajax({
						type: 'post',
						url: 'addActivities',
						cache: false,
						async: true,
						data: {'itinerary_no_val':itinerary_no_val, 'city_id':city_id, 'activity':activity, 'activiti_price':activiti_price, 'activity_date':activity_date, 'activity_time':activity_time},
						success: function(res){
							console.log(res);
							jQuery(".price_area").show();
							var top_div = jQuery(".price_area").position().top;
							jQuery("html, body").animate({ scrollTop: top_div });
						}
					});
				});
			});
			
			// Open mobile_verify_popup
			jQuery(".view_price").click(function(){
				//$('.mobile_verify_popup').bPopup({modalClose: false});
				jQuery(".mobile_put_div").show();
			});
			
			
			// Verify User By OTP
			jQuery("#hide-test").click(function(){ 
				var verify_number = jQuery("#verify_number").val();
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				jQuery.ajax({
					type: 'get',
					url: 'verifyUser',
					cache: false,
					async: true,
					data: {'itinerary_no_val':itinerary_no_val, 'verify_number':verify_number},
					success: function(res){
						console.log(res);
						var data = JSON.parse(res);
						//jQuery(".iti_price_list").html(data.price_list);
						jQuery(".very_user_dis").attr('disabled','disabled');
						jQuery(".mobile_put_div").css({"opacity":"0.4"});						
						jQuery(".otp_put_div").show();
						//$('.mobile_verify_popup').bPopup('close');
						//$('.OTP_verify_popup').bPopup({modalClose: false});
					}
				});
			});

			// Verify User By OTP
			jQuery("#load_price").click(function(){ 
				jQuery(".update_price_loader").show();
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				jQuery.ajax({
					type: 'get',
					url: 'calculateItineraryPrince',
					cache: false,
					async: true,
					data: {'itinerary_no_val':itinerary_no_val},
					success: function(res){
						jQuery(".update_price_loader").hide();
						var data = JSON.parse(res);
						jQuery(".iti_price_list").html(data.price_list);
						let view_url = '<br><center><a href="'+data.view_url+'">View Created Itierary</a></center>';
						jQuery(".view_itinerary_link").html(view_url);
					}
				});
			});
			
			// Delete Transport
			jQuery(".transport_are").delegate('.delete_transport', 'click', function(){
				jQuery(this).parent().find(".del_trans_loader").show();
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				var del_id = jQuery(this).attr('delid');
				
				jQuery.ajax({
					type: 'post',
					url: 'deletetransport',
					cache: false,
					async: true,
					data: {'itinerary_no_val':itinerary_no_val, 'del_id':del_id},
					success: function(res){
						jQuery(".del_trans_loader").hide();
						var data = JSON.parse(res);
						jQuery("#car_area_data").html(data.transport_data);
					}
				});
			});
			
			// Update hotel destination by change the route
			jQuery(".route_area").delegate('.get_route', 'change', function(){
				jQuery("#add_more_hotel .route_citied").each(function(){
					jQuery(this).html('<option>Select City</option>');
				});
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				$.ajax({
					url: "deleteitihotels",
					type:"post",
					cache: false,
					async:false,
					data: {'itinerary_no_val':itinerary_no_val},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
					}
				});
			});
			
			// Pickup location flag check
			jQuery(".basic_info").delegate('#arrival_city', 'change', function(){
				jQuery(".start_distination").each(function(){
					jQuery(this).parent().parent().find(".travel_type").html('');
					jQuery(this).parent().parent().find("input").val(0);
				});
			});
			
			// Dropup location flag check
			jQuery(".basic_info").delegate('#drop_city', 'change', function(){
				jQuery(".to_distination").each(function(){
					jQuery(this).parent().parent().find(".travel_type_d").html('');
					jQuery(this).parent().parent().find("input").val(0);
				});
			});
			
			// From Date And To Date Vailidation While add itinerary
			jQuery("#arrival_date_time").change(function(){
				var fromdate = jQuery(this).val();
				jQuery("#drop_date_time").attr('min', fromdate);
			});
			
		});
		
	</script>
@endsection