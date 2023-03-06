@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard | Create Ititnerary')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
    <style>
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
					<div class="row" id="details">
						<div class="col s12">
							<h3 class="card-title follow_title"><strong>Add Room Booking</strong></h3>
							<form class="add_hotel_form" id="add_hotel_form" method="POST" action="{{ url('/operator/addroombookaction') }}" enctype='multipart/form-data'>
							{{csrf_field()}}
							<div class="booking_form_main">
								<div class=""> 
									<div class="col s12 m3">
										@php 
											$operator = session()->get('operator');
										@endphp
										<label for="hotel">Hotel:</label><br>
										<select class="form-control hotel_list" name="hotel" id="hotel">
											<option></option>
											@foreach($hotels as $hotel)
												<option value="{{ $hotel->id }}" @if(@$operator['hotel'][0] == $hotel->id) {{'selected'}} @endif>{{ $hotel->hotel_name }}</option>
											@endforeach
										</select>
									</div>
									<div class="col s6 m1">
										<label for="ff_c_name"></label><br> 
										<select class="form-control" name="ff_c_name" id="ff_c_name">
											<option value="Mr.">Mr.</option>
											<option value="Mrs.">Mrs.</option>
											<option value="Ms.">Ms.</option>
										</select>
									</div>
									<div class="col s6 m2">
										<label for="client_name">Client Name:</label><br>
										<input type="text" class="form-control" name="client_name" id="client_name" required />
									</div>
									<div class="col s6 m3">
										<label for="agent_name">Agent Name:</label><br>
										<input type="text" class="form-control" name="agent_name" id="agent_name" />
									</div>
									<div class="col s4 m3">
										<label for="total_rooms">Total Rooms:</label><br>
										<input type="number" class="form-control" name="total_rooms" id="total_rooms" required/>
									</div>
									<div class="col s4 m3">
										<label for="total_rooms">Total Billing:</label><br>
										<input type="number" class="form-control" name="total_bill" id="total_rooms" required />
									</div>
									<div class="col s4 m3">
										<label for="booking_from">Booking From:</label><br>
										<select class="form-control" name="booking_from" id="booking_from">
											<option value="ONLINE">ONLINE</option>
											<option value="ENSOBER" selected>ENSOBER</option>
											<option value="OPERATIONTEAM">OPERATION TEAM</option>
										</select>
									</div>
									<div class="col s4 m3">
										<label for="source">Source:</label><br>
										<select class="form-control" name="source" id="source">
											<option value=""></option>
											<option value="AGENT">AGENT</option>
											<option value="DIRECT">DIRECT</option>
											<option value="HOTELPARTNER">HOTEL PARTNER</option>
											<option value="ONLINE">ONLINE</option>
										</select>
									</div>
									<div class="col s4 m3">
										<label for="confirmed_by">Confirmed By:</label><br>
										<input type="text" class="form-control" name="confirmed_by" id="confirmed_by" required />
									</div>
									<div class="col s4 m3">
										<label for="advance_amount">Advance Amount:</label><br>
										<input type="number" class="form-control" name="advance_amount" id="advance_amount" required />
									</div>
									<div class="col s4 m3">
										<label for="payment_source">Payment Source:</label><br>
										<select class="form-control" name="payment_source" id="payment_source" required>
											<option value=""></option>
										</select>
									</div>
									<div class="col s4 m3">
										<label for="date_of_advance">Date Of Advance:</label><br>
										<input type="date" class="form-control" name="date_of_advance" id="date_of_advance"/>
									</div>
									<div class="col s12 m3">
										<label for="payment_snapshot">Payment Snapshot:</label><br>
										<input type="file" id="payment_snapshot" name="payment_snapshot" class="dropify">
									</div>
									<div class="col s4 m3">
										<label for="booking_status">Booking Status:</label><br>
										<select class="form-control" name="booking_status" id="booking_status" required>
											<option value="Confirmed">Confirmed</option>
											<option value="Hold">Hold</option>
										</select>
									</div>
									<div class="col s12 m3">
										<label for="comment">Comment:</label><br>
										<textarea class="form-control" name="comment" id="comment"></textarea>
									</div>
									<div class="col s12 m3">
										<label for="comment_for_balace">Comment For Balace:</label><br>
										<textarea class="form-control" name="comment_for_balace" id="comment_for_balace">Balance at resort</textarea>
									</div>
								</div>
								
								<div class="mul_cat_room_main">
									<div class="mul_cat_room_details" id="mul_cat_room_details">
										<div class="col s6 m3">
											<label for="room_type">Room Category:</label><br>
											<select class="form-control room_type_list checkRoomAvailability" name="room_type[]" id="room_type">
												
											</select>
										</div>
										<div class="col s6 m3">
											<label for="check_in">Check In:</label><br>
											<input type="date" class="form-control checkRoomAvailability" name="check_in[]" id="check_in"  />
										</div>
										<div class="col s6 m3">
											<label for="check_out">Check Out:</label><br>
											<input type="date" class="form-control" name="check_out[]" id="check_out"/>
										</div>
										<div class="col s6 m3">
											<label for="noofrooms">No Of Rooms:</label><br>
											<input type="number" class="form-control checkRoomAvailability" name="noofrooms[]" id="noofrooms" />
											<span style="font-size:12px; color:red;" class="check_room_error"></span>
										</div>
										<div class="col s4 m3">
											<label for="plan">Meal Plan:</label><br>
											<select class="form-control" name="plan[]" id="plan" required>
												<option value="">Select Meal Plan</option>
												<option value="ep_price">EP (Room Only)</option>
												<option value="cp_price">CP (Room with Breakfast)</option>
												<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
												<option value="ap_price">AP (Room with all meals plan)</option>
											</select>
										</div>
										<div class="col s3 m3">
											<label for="adults">Adults:</label><br>
											<input type="number" class="form-control" name="adults[]" id="adults"/>
										</div>
										<div class="col s3 m3">
											<label for="kidswd">Kids WB:</label><br>
											<input type="number" class="form-control" name="kidswd[]" id="kidswd"/>
										</div>
										<div class="col s3 m3">
											<label for="kidswod">Kids WOB:</label><br>
											<input type="number" class="form-control" name="kidswod[]" id="kidswod"/>
										</div>
										<div class="col s3 m3">
											<label for="infant">Infant:</label><br>
											<input type="number" class="form-control" name="infant[]" id="infant"/>
										</div>
										
										<div class="col s6 m3">
											<label for="kidswd">&nbsp;</label><br>
											<div style="width: 50%; float: left; vertical-align: middle;" class="remove_btn_room_cat">
												<a class="mb-6 btn-floating gradient-45deg-purple-deep-orange" title="Delete" onclick="removeRoom($(this))" style="height: 30px;width: 30px;line-height: 32px;">
													<i class="material-icons">delete_sweep</i>
												</a>
												<span class="btn_text" style="font-size: 11px; margin: 0 5px;">Remove Room</span>
											</div>
											<div style="width: 50%; float: left; vertical-align: middle;">
												<a class="mb-6 btn-floating gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMoreRoom()" style="float:right;height: 30px;width: 30px;line-height: 32px;">
													<i class="material-icons">note_add</i>
												</a>
												<span class="btn_text" style="font-size: 11px; float:right; margin: 11px 5px 0; display:block;">Add Room</span>
											</div>
										</div>
									</div>
								</div>
																
								<div class="col s12 m12" style="text-align: right;">
									<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" id="addbookingbtn" onclick="addRoomBooking1();">Submit Room Booking</button>
									<p style="color:green;" id="add_room_msg"></p>
								</div>
							</div>
							</form>
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
			var hotel_id = jQuery("#hotel").val();
			getPaymentSourceByHotelId(hotel_id);
				
			jQuery("#hotel").change(function(){
				var hotel_id = jQuery(this).val();
				getPaymentSourceByHotelId(hotel_id);
			});
			
			jQuery("#check_in").change(function(){
				var checkin = jQuery(this).val();
				jQuery(this).parents('.mul_cat_room_details').find("#check_out").attr('min',checkin);
			});
		});
    </script>
@endsection