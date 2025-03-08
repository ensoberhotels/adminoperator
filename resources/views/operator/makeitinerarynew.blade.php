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
		  border: 1px solid black;
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
    </style>
@endsection

@section('content')
<!-- BEGIN: Page Main-->
<input type="hidden" value="{{$lead->id}}" name="lead_id" />
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
									<a class="@if(Request::segment(2) == 'makeitineraryv1') active @endif;" href="{{URL::to('/operator/makeitineraryv1/')}}">Itinerary By Lead </a>
								</li>
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'pastcontactfollowup') active @endif;" href="{{URL::to('/operator/pastcontactfollowup/')}}">New Itinerary </a>
								</li>
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'makequotation') active @endif;" href="{{URL::to('/operator/makequotation/')}}">Send Quotation</a>
								</li>
							</ul>
						</div>
					</div> 
					<!-- /Tab End -->
					
                    <div class="card-header">
                        <div class="row" style="margin-bottom: 0px !important;">
							<div class=" col s12 m4">
                               <h5><strong>Lead Number : {{ $lead->lead_no }}</strong></h5>
                            </div>
							<div class=" col s12 m4">
                               <h5><strong>Quotation Number : -----</strong></h5>
                            </div>
                            <div class=" col s12 m4">
                                <h5><strong>Date :  {{ $lead->create_date }}</strong></h5>
                            </div>
						</div>
                    </div>
					<div class="row" id="details">
						<div class="col s12 m4">
							<h3 class="card-title follow_title"><strong>Itinerary Details</strong></h3>
							<div class="itin_detail_main">
								<ul class="collapsible" data-collapsible="accordion">
									<li id="lead_details" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">web</i>Lead Details
										</div>
										<div class="collapsible-body">
											<div class=""> 
												<div class="main_detail">
												<div class="col s12 m6">
													<label for="mobile" class="">Mobile</label>
													<input class="validate invalid" type="text" value="{{ $lead->mobile }}" readOnly>
												</div>
																			
												<div class="col s12 m6">
													<label for="lead_source" class="">Lead Source</label>
													<input class="validate invalid" type="text" value="{{ $lead->lead_source }}" readOnly>           
												 </div>
												
												<div class="col s12 m6" id="reference_name_field"  @if( $lead->lead_source == 'Travel Agent' || $lead->lead_source == 'Reference')  @else  style="display: none;" @endif>
													<label for="name" class="">Agent/Refrence Name</label>
													<input class="validate invalid" type="text" value="{{ $lead->reference_name }}" readOnly>
												</div>
												
												<div class="col s12 m6">
													<label for="email" class="">Email</label>
													<input class="validate invalid" type="text" value="{{ $lead->email }}" readOnly>
												</div>
												<div class="col s12 m6">
													<label for="name" class="">Guest Name</label>
													<input class="validate invalid" type="text" value="{{ $lead->name }}" readOnly>
												</div>
												<div class="col s12 m6">
													<label for="location" class="">Location</label>
													<input class="validate invalid" type="text" value="{{ $lead->location }}" readOnly>
												</div>
												<div class="col s12 m6">    
													<label for="customer_type" class="">Customer Type</label>
													<input class="validate invalid" type="text" value="{{ $lead->customer_type }}" readOnly>
												</div> 
												<div class="col s12 m6">    
													<label for="lead_priority" class="">Lead Priority</label>
													<input class="validate invalid" type="text" value="{{ $lead->lead_priority }}" readOnly>
												</div>
												<div class="col s12 m6">    
												   <label for="trip_type" class="">Trip Type</label>
												   <input class="validate invalid" type="text" value="{{ $lead->trip_type }}" readOnly>
												</div>
												</div>
												
												<div class="card-header">
													<h3 class="card-title"><strong>Query Details</strong></h3>
												</div>
												
												<div class=""> 
													<div class="col s12 m6">
														<label for="enquiry_type" class="">Enquiry Type</label>
														<input class="validate invalid" type="text" value="{{ $lead->enquiry_type }}" readOnly>
													</div>
													<div class="col s12 m6" @if( $lead->enquiry_type == 'Own Hotel' || $lead->enquiry_type == 'Partner Hotel')  @else  style="display: none;" @endif >
														<label for="hotel_id" class="">Hotel</label>
														<input class="validate invalid" type="text" value="{{ $lead->hotel_name }}" readOnly>                           
													</div>
													<div class="col s12 m6"  @if( $lead->enquiry_type == 'Other')  @else  style="display: none;" @endif>
														<label for="other_enquiry" class="">Other Enquiry</label>
														<input class="validate invalid" type="text" value="{{ $lead->other_enquiry }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="hotel_type" class="">Hotel Type</label>
														<input class="validate invalid" type="text" value="{{ $lead->hotel_type }}" readOnly>
													</div>
												
													<div class="col s12 m6">
														<label for="d_country" class="">Destination Country</label>
														<select id="country_id" disabled> 
															<option value="">Select Country</option>
															@foreach($Countries as $Country)
																<option value="{{ $Country->id }}" @if($lead->country_id==$Country->id) selected @endif>{{ $Country->name }}</option>
															@endforeach
														</select>
													</div> 
													<div class="col s12 m6">
														<label for="d_region" class="">Destination State</label>
														<select disabled>
														  <option value="">Select State</option>
															@foreach($Regions as $Region)
																<option value="{{ $Region->id }}" @if($lead->region_id==$Region->id) selected @endif >{{ $Region->name }}</option>
															@endforeach
														</select>
													</div>
													<div class="col s12 m6">
														<label for="d_city" class="">Destination City</label>
														<select disabled>
														  <option value="">Select City</option>
														  @foreach($Cities as $City)
																<option value="{{ $City->id }}" @if($lead->city_id==$City->id) selected @endif >{{ $City->name }}</option>
															@endforeach
														</select>
													</div>                         
													<div class="col s12 m6">
														<label for="start_date" class="">Start Date</label>
														<input class="validate invalid" type="text" value="{{ $lead->start_date }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="end_date" class="">No Of Nights</label>
														<input class="validate invalid" type="text" value="{{ $lead->no_nights }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="end_date" class="">No of Room</label>
														<input class="validate invalid" type="text" value="{{ $lead->no_room }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="end_date" class="">Sharing</label>
														<input class="validate invalid" type="text" value="{{ $lead->sharing }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="end_date" class="">No of Adults</label>
														<input class="validate invalid" type="text" value="{{ $lead->pax }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="end_date" class="">No of Kids</label>
														<input class="validate invalid" type="text" value="{{ $lead->kids }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label for="end_date" class="">No of Infant</label>
														<input class="validate invalid" type="text" value="{{ $lead->infant }}" readOnly>
													</div>
													<div class="col s12 m6">
														<label class="">Lead Status</label>
														<input class="validate invalid" type="text" value="{{ $lead->lead_status }}" readOnly>
													</div>
													
													<div class="col s12 m6" @if( $lead->lead_status == 'CLOSED')  @else  style="display: none;" @endif>
														<label for="infant" class="">Closed Reason</label>
														<textarea cols="" rows="" id="closed_reason" name="closed_reason" readOnly>{{ $lead->closed_reason }} </textarea>
													</div>
													<div class="col s12 m6">
														<label for="infant" class="">Lead Comment</label>
														<textarea cols="" rows="" id="lead_comment" name="lead_comment" readOnly>{{ $lead->lead_comment }} </textarea>
													</div>
													<div class="col s12 m6" style="text-align: center; margin-top: 26px !important;">
														<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('basic_info');">Next Step</button>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li id="basic_info" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">dvr</i>Basic Info
										</div>
										<div class="collapsible-body">
											<div class="">
												<div class="col s12 m6">
													<label for="adult" class="">No Of Adults</label>
													<input type="number" name="adult" id="adult">
												</div>
																			
												<div class="col s12 m6">
													<label for="kids" class="">Kids (5-12 Years)</label>
													<input type="number" name="kids" id="kids">       
												</div>
												
												<div class="col s12 m6">
													<label for="infant" class="">Infant (below 5 Years)</label>
													<input type="number" name="infant" id="infant">
												</div>
												<div class="col s12 m6">
													<label for="arrival_date" class="">Arrival Date	</label>
													<input type="text" name="arrival_date" id="arrival_date" class="filter_date" autocomplete="off">         
												</div>
												<div class="col s12 m6">
													<label for="arrival_time" class="">Arrival Time</label>
													<input type="text" name="arrival_time" id="arrival_time" class="filter_time" autocomplete="off">       
												</div>
												<div class="col s12 m6">
													<label for="arrival_city" class="">Arrival City</label>
													<select name="arrival_city" id="arrival_city" tabindex="0">
														<option>Select City</option>
														@foreach($citiesh as $city)
														<option value="{{$city->city_id}}">{{$city->name}}</option>
														@endforeach
													</select>          
												</div>
												<div class="col s12 m6">
													<label for="drop_date" class="">Drop Date</label>
													<input type="text" name="drop_date" id="drop_date" class="filter_date" autocomplete="off"/>           
												</div>
												<div class="col s12 m6">
													<label for="drop_time" class="">Drop Time</label>
													<input type="text" name="drop_time" id="drop_time" class="filter_time" autocomplete="off"/>     
												</div>
												<div class="col s12 m6">
													<label for="drop_city" class="">Drop City</label>
													<select name="drop_city" id="drop_city" tabindex="0">
														<option>Select City</option>
														@foreach($citiesh as $city)
														<option value="{{$city->city_id}}">{{$city->name}}</option>
														@endforeach
													</select>            
												</div>
												<div class="col s12 m6" style="text-align: center; margin-top: 26px !important;">
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('transport_info');">Next Step</button>
												</div>
											</div>
										</div>
									</li>
									<li id="transport_info" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">emoji_transportation</i>Trasport
										</div>
										<div class="collapsible-body">
											<div class="card-header">
												<h3 class="card-title"><strong>Transport Details</strong></h3>
											</div>
											<table id="car_area_data" style="color: #000; font-size: 12px;">
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
													<td style="text-align:center;">
														<input type="checkbox" class="filled-in transport_id custom_checkbox" value="{{$transport->id}}"/>
													</td>
												</tr>
												@endforeach
											</table>
											<div class="col s12 m6" style="text-align: center; margin-top: 26px !important;">
												<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('route_area');">Next Step</button>
											</div>
										</div>
									</li>
									<li id="route_area" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">alt_route</i>Route Area
										</div>
										<div class="collapsible-body">
											<div class="route_main">
												<div class="card-header">
													<h3 class="card-title"><strong>Route Area</strong></h3>
												</div>
												<div class="route_item">
													<div class="col s12 m6">
														<label for="start_distination" class="">Start Distination</label>
														<select name="start_distination" id="start_distination" class="get_route start_distination">
															<option>Select City</option>
															@foreach($citiesh as $city)
															<option value="{{$city->city_id}}">{{$city->name}}</option>
															@endforeach
														</select>
													</div>
																				
													<div class="col s12 m6">
														<label for="to_distination" class="">To Distination</label>
														<select name="to_distination" id="to_distination" class="get_route to_distination">
															<option>Select City</option>
															@foreach($citiesh as $city)
															<option value="{{$city->city_id}}">{{$city->name}}</option>
															@endforeach
														</select>           
													 </div>
													 <div class="col s12 m5">
														<label for="to_distination" class="">Via/Way Sightseeing</label>
														<span class="route_list show_select">
															
														</span>         
													 </div>
													 <div class="col s12 m3">
														<label for="to_distination" class="">Distance</label><br>
														<span class="distance_val"></span>KM        
													 </div>
													 <div class="col s12 m3">
														<label for="to_distination" class="">Journey Time</label><br>
														<span class="duration_val"></span> H        
													 </div>
													 <div class="col s12 m1">
														<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
															<i class="material-icons">note_add</i>
														</a>       
													 </div>
												</div>
											</div>
											<div class="col s12 m6" style="text-align: center; margin-top: 26px !important;">
												<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('hotel_details');">Next Step</button>
											</div>
										</div>
									</li>
									<li id="hotel_details" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">hotel</i>Hotel
										</div>
										<div class="collapsible-body">
											<div class="card-header">
												<h3 class="card-title"><strong>Hotel Details</strong></h3>
											</div>
											
											<div class="col s12 m6" style="text-align: center; margin-top: 26px !important;">
												<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('actibities_details');">Next Step</button>
											</div>
										</div>
									</li>
									<li id="actibities_details" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">rowing</i>Actibities
										</div>
										<div class="collapsible-body">
											<div class="card-header">
												<h3 class="card-title"><strong>Actibities</strong></h3>
											</div>
											
											
											<div class="col s12 m6" style="text-align: center; margin-top: 26px !important;">
												<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light iti_next_btn" onclick="itiNextBtn('price_details');">Next Step</button>
											</div>
										</div>
									</li>
									<li id="price_details" class="iti_input_form">
										<div class="collapsible-header">
											<i class="material-icons">whatshot</i>Total Price
										</div>
										<div class="collapsible-body">
											
										</div>
									</li>
								</ul>
							</div>
						</div>
					
						<div class="col s12 m8">
							<h3 class="card-title follow_title"><strong>Preview Itinerary</strong></h3>
							<div class="preview_itinerary_main">
								<iframe src="/operator/itinerary/view/147" height="550" width="790" title="Iframe Example"></iframe>
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
    
    
    
@endsection