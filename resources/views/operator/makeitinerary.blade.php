@extends('operator.template.base')

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
			right: -30px;
			top: 18px;
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
			width: 500px;
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
		footer{display:none;}
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
						<div class="card-header">
							<h4 class="card-title">Basic Info</h4>
						</div>
						<form method="post" class="for_basic_info"/>
						<div class="col s6" style="border-right: 1px solid; padding-right: 25px;">
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
								
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="3">
										
									</td>
								</tr>
							</table>
						</div>
						<div class="col s6" style="padding-left: 25px;">
							<table>
								<tr>
									<td>Arrival Date & Time</td>
									<td><i class="material-icons">chevron_right</i></td>
									<td> <input type="text" name="arrival_date" id="arrival_date" class="filter_date" autocomplete="off"/></td>
									<td> -</td>
									<td> <input type="text" name="arrival_time" id="arrival_time" class="filter_time" autocomplete="off"/></td>
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
									<td> <input type="text" name="drop_date" id="drop_date" class="filter_date" autocomplete="off"/></td>
									<td> -</td>
									<td> <input type="text" name="drop_time" id="drop_time" class="filter_time" autocomplete="off"/></td>
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
											<td>{{ $transport->car->car_name }}</td>
											<td>{{ $transport->car_seats->seats }}</td>
											<td>{{ $transport->perday_km }}</td>
											<td>{{ $transport->perkm_fare }}</td>
											<td>{{ $transport->fare }}</td>
											<td><img src="/storage/app/{{$transport->car->car_image}}" width="100px"></td>
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
							<table id="car_area_data" style="width:550px;display: inline-block;">
								
							</table>
						</div>
						<div class="col s12 button_area">
							<button class="btn waves-effect waves-light right" type="button" name="action" id="save_transport">Next<i class="material-icons right">send</i> 
							</button>
						</div>
					</div>
					
					<!-- /Trasport -->
					
					<!-- Route Area -->
					<div class="route_area">
						<div class="card-header">
							<h4 class="card-title">Select Route</h4>
						</div>
						<div class="col s12">
							<table id="add_more_dis">
								<tr>
									<td>
										Start Distination<br>
										<select name="start_distination" id="start_distination" class="get_route start_distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
									</td>
									<td>
										To Distination<br>
										<select name="to_distination" id="to_distination" class="get_route to_distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
									</td>
									<td>
										Via/Way Sightseeing<br>
										<span class="route_list show_select">
											
										</span>
									</td>
									<td>
										Distance<br>
										<span class="distance_val"></span>KM
									</td>
									<td>
										Journey Time<br>
										<span class="duration_val"></span> H
									</td>
									<td></td> 
								</tr>
								
							</table>
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
										<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMoreHotel()" style="float:right;">
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
							<table id="add_more_activity">
								
								
							</table>
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
					<div class="price_area" style="display:block;">
						<div class="col s12">
							<center>
								<h2 style="color: #4CAF50;margin: 40px 0 50px;">Total Price: </h2><a href="javascript:void(0)" class="view_price"> View Price</a>
							
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
    <!--<script src="{{ URL::asset('public/asset/js/custom/custom-script.js') }}" type="text/javascript"></script>-->
    <script src="{{ URL::asset('public/asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('public/asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
	<script>
		function addMore(){
    		$('#add_more_dis').append(`<tr class="dis_row">
									<td class="show_select">
										Start Distination<br>
										<span>
										<select class="get_route start_distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
										</span>
									</td>
									<td class="show_select">
										To Distination<br>
										<span>
										<select class="get_route to_distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
										</span>
									</td>
									<td class="">
										Via/Way Sightseeing<br>
										<span class="route_list show_select">
											
										</span>
									</td>
									<td>
										Distance<br>
										<span class="distance_val"></span> KM
									</td>
									<td>
										Journey Time<br>
										<span class="duration_val"></span> H
									</td>
									 
									<td><a href="javascript:void(0);" onclick="remove($(this))" style="color: #ff4081;"><i class="material-icons">remove_circle</i></a></td>
								</tr>`);
    	}
		
		function addMoreHotel(){
    		$('#add_more_hotel').append(`<tr class="dis_row">
				<td class="show_select">
					Distination<br>
					<select class="route_citied" id="distination"><option>Select City</option></select>
				</td>
				<td class="show_select">
					Hotel<br>
					<select name="hotel" id="hotel_list" class="hotel_list" onchange="hotelRateAW($(this));">
						<option>Select Hotel</option>
					</select>
				</td>
				<td class="show_select">
					Select Room Type<br>
					<select name="room_type" id="room_type" class="room_type_list" onchange="hotelRateAW($(this));">
						<option>Select Room Type</option>
					</select>
				</td>
				<td class="show_select">
					Select Meal Plan<br>
					<select name="meal_plan" id="meal_plan" onchange="hotelRateAW($(this));">
						<option value="">Select Meal Plan</option>
						<option value="ep_price">EP (Room Only)</option>
						<option value="cp_price">CP (Room with Breakfast)</option>
						<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
						<option value="ap_price">AP (Room with all meals plan)</option>
					</select>
				</td>
				<td width="120px">
					No Of Rooms<br>
					<input type="number" name="no_of_rooms" id="no_of_rooms" onkeyup="hotelRateAW($(this));"/>
				</td>
				<td width="120px">
					No Of Nights<br>
					<input type="number" name="no_of_nights" id="no_of_nights" onkeyup="hotelRateAW($(this));" />
				</td>
				<td width="80px">
					Rates<br>
					<input type="hidden" name="rate" id="rate" />
					<span id="hotel_price">--</span> /-
				</td>
				<td> 
					View<br>
					<a href="javascript:void(0);" id="hotel_link" target="_blank" style="color: #ff4081;"><i class="material-icons">remove_red_eye</i></a>
				</td>				 
				<td style="position: relative;"><a href="javascript:void(0);" onclick="remove($(this))" style="color: #ff4081;"><i class="material-icons">remove_circle</i></a>
				<div class="loader_box" style="display: none;">
					<img src="/asset/images/loader/loader.gif" class="img-responsive">
				</div>
				</td>
			</tr>`);
    	}
		
		function addMoreActivity(){
    		$('#add_more_activity').append(`<tr class="dis_row"> 
									<td class="show_select">
										Distination<br>
										<select name="distination" id="activity_city" class="distination">
											<option>Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->city_id}}">{{$city->name}}</option>
											@endforeach
										</select>
									</td>
									<td class="show_select">
										Activity<br>
										<select name="activities" id="activities" class="activities">
											<option>Select Activity</option>
										</select>
									</td>
									<td>
										Price<br>
										<span class="activiti_price">--</span>/- SR
									</td>
									<td><a href="javascript:void(0);" onclick="remove($(this))" style="color: #ff4081;"><i class="material-icons">remove_circle</i></a></td> 
								</tr>`);
    	}
		
		function remove(e){
			e.parents('.dis_row').remove()
		}
		
		
		// Get hotel rate
		function hotelRateAW(thisdiv){
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
			var arrival_date = jQuery("#arrival_date").val();
			var adult = jQuery("#adult").val();
			var child = jQuery("#kids").val();
			if(hotel_id != ""){
				thisdiv.parent().parent().find(".loader_box").show();
			  $.ajax({
				url: "ajaxgetHotelRate",
				type:"post",
				cache: false,
				async:false,
				data: {'hotel_id':hotel_id,'room_type':room_type,'arrival_date':arrival_date,'meal_plan':meal_plan, 'no_of_night':no_of_night, 'no_of_room':no_of_room, 'adult':adult, 'child':child, 'itinerary_no_val':itinerary_no_val, 'distination':distination},
				success: function(data){
					var data = JSON.parse(data);
					thisdiv.parent().parent().find("#hotel_price").text(data.price);
					thisdiv.parent().parent().find("#hotel_link").attr("href", data.hotel_link);
					thisdiv.parent().parent().parent().parent().find(".hotel_img_area img").attr("src",data.hotel_image);
					console.log(data);    
					thisdiv.parent().parent().find(".loader_box").hide();
					if(data.status == 0){
						thisdiv.parent().parent().parent().find(".moreroomselect").show();
					}else{
						thisdiv.parent().parent().parent().find(".moreroomselect").hide();
					}
				}
			  });
			}
		}
		
		
	</script>
	<script>
		
		jQuery(document).ready(function(){
			
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
				
				var arrival_date = jQuery("#arrival_date").val();
				var arrival_time = jQuery("#arrival_time").val();
				var arrival_city = jQuery("#arrival_city").val();
				var drop_date = jQuery("#drop_date").val();
				var drop_time = jQuery("#drop_time").val();
				var drop_city = jQuery("#drop_city").val();
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				
				if(adult != "" && kids != "" && infant != "" && tour_type != "" && arrival_date != "" && arrival_time != "" && arrival_city != "" && drop_date != "" && drop_time != "" && drop_city != ""){
					jQuery("#basic_info_loader").show();
				  $.ajax({
					url: "ajaxitibasicinfo",
					type:"post",
					cache: false,
					async:false,
					data: {'adult':adult,'kids':kids,'infant':infant,'tour_type':tour_type, 'arrival_date':arrival_date, 'arrival_time':arrival_time, 'arrival_city':arrival_city, 'drop_date':drop_date, 'drop_time':drop_time, 'drop_city':drop_city, 'itinerary_no_val':itinerary_no_val},
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
				$.ajax({
					url: "getRoutes",
					type:"post",
					cache: false,
					async:false,
					data: {'start_distination':start_distination,'to_distination':to_distination},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
						this_div.parent().parent().parent().find(".route_list").html(data.route_data);
					}
				});
			});
			
			
			// Get Routes Distance And Duration
			jQuery("#add_more_dis").delegate(".route_id","change", function(){
				this_div = jQuery(this);
				var itinerary_no_val = jQuery("#itinerary_no_val").val();
				var route_id = jQuery(this).val();
				$.ajax({
					url: "getRoutesDetail",
					type:"post",
					cache: false,
					async:false,
					data: {'route_id':route_id, 'itinerary_no_val':itinerary_no_val},
					success: function(data){
						var data = JSON.parse(data);
						console.log(data);
						this_div.parent().parent().parent().find(".distance_val").text(data.distance);
						this_div.parent().parent().parent().find(".duration_val").text(data.duration);
					}
				});
			});
			
			// save_transport
			jQuery("#save_transport").click(function(){
				jQuery(".route_area").show();
				var top_div = jQuery(".route_area").position().top;
				jQuery("html, body").animate({ scrollTop: top_div });
			});
			
			// save_route
			jQuery("#save_route").click(function(){
				jQuery(".hotel_area").show();
				var top_div = jQuery(".hotel_area").position().top;
				jQuery("html, body").animate({ scrollTop: top_div });
				addMoreHotel();
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
				addMoreActivity();
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
						//var data = JSON.parse(data);
						console.log(data);
						thidiv.html(data);
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
				jQuery("#add_more_activity tr").each(function(){
					var this_div = jQuery(this);
					var city_id = jQuery(this).find("#activity_city").val();
					var activity = jQuery(this).find("#activities").val();
					var activiti_price = jQuery(this).find(".activiti_price").text();
					var itinerary_no_val = jQuery("#itinerary_no_val").val();
					jQuery.ajax({
						type: 'post',
						url: 'addActivities',
						cache: false,
						async: true,
						data: {'itinerary_no_val':itinerary_no_val, 'city_id':city_id, 'activity':activity, 'activiti_price':activiti_price},
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
			jQuery("#very_user").click(function(){ 
				var this_div = jQuery(this);
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
						jQuery(".very_user_dis").attr('disabled','disabled');
						jQuery(".mobile_put_div").css({"opacity":"0.4"});						
						jQuery(".otp_put_div").show();
						//$('.mobile_verify_popup').bPopup('close');
						//$('.OTP_verify_popup').bPopup({modalClose: false});
					}
				});
			});
		});
		
	</script>
@endsection