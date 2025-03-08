@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard | Lead Followup')

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
                  <li class="breadcrumb-item"><a href="index.html">Lead</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Followup lead</a>
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
    
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-content">
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
                    
                    
            <form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="POST" action="{{ url('/operator/lead/followupaction') }}" >
            {{csrf_field()}}
			<input type="hidden" value="{{$lead->id}}" name="lead_id" /> 
              <div class="">
                <div class="">
                <div class="row" id="details">
					<div class="col s12 m4">
						<h3 class="card-title follow_title"><strong>Itinerary Details</strong></h3>
						
						<div class="itin_detail_main">
							<ul class="collapsible" data-collapsible="accordion">
								<li>
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
													<a target="_blank" href="{{ route('leads.edit',$lead->id) }}">
														<button type="button" class=" buttons-html5 mb-6 btn waves-effect gradient-45deg-red-pink waves-light car_delete" tabindex="0" aria-controls="multi-select" title="Update"><span>Update Lead</span></button>
													</a>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li>
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
												<button type="button" class=" buttons-html5 mb-6 btn waves-effect gradient-45deg-red-pink waves-light car_delete" tabindex="0" aria-controls="multi-select" title="Update"><span>Create</span></button>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="collapsible-header">
										<i class="material-icons">emoji_transportation</i>Trasport
									</div>
									<div class="collapsible-body">
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
									</div>
								</li>
								<li>
									<div class="collapsible-header">
										<i class="material-icons">alt_route</i>Route Area
									</div>
									<div class="collapsible-body">
										<div class="route_main">
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
									</div>
								</li>
								<li>
									<div class="collapsible-header">
										<i class="material-icons">hotel</i>Hotel
									</div>
									<div class="collapsible-body">
										
									</div>
								</li>
								<li>
									<div class="collapsible-header">
										<i class="material-icons">rowing</i>Actibities
									</div>
									<div class="collapsible-body">
										
									</div>
								</li>
								<!--<li>
									<div class="collapsible-header">
										<i class="material-icons">whatshot</i>Total Price
									</div>
									<div class="collapsible-body">
										
									</div>
								</li>-->
							</ul>
						</div>
					
					
					</div>
					
					<div class="col s12 m8">
						<h3 class="card-title follow_title"><strong>Preview Itinerary</strong></h3>
						<div class="preview_itinerary_main">
							<table style="font-size: 13px;width:100%;line-height: 30px;color: #000; margin-top:5px;">
								<tr>
									<td colspan="10"style= "text-align:center;background-color: #1a1a1a;color: #fff;">itinerary details</td>
								</tr>
							  <tr>
								<th>Quote ID</th>
								<th>Trip Period</th>
								<th>Total Nights</th>
								<th>Total Adults</th>
								<th>Total Kids/Infant</th>
								<th colspan="20" style="text-align:center">Total Cost</th>
								</tr>
							  <tr>
								<td>23212</td>
								<td>23 Aug'20-30 sep'20</td>
								<td>2</td>
								<td>8</td>
								<td>4</td>
								<td  colspan="10"style="text-align:center">60000</td>
							  </tr>
								<tr>
									<td colspan="5" style="text-align:center">Transport Cost (1 innova)</td>
										<th colspan="5"></th>
									</tr>
									
									<tr>
										<td colspan="5" style="text-align:center">Activities Cost(safari & Rafting)</td>
										<th colspan="10"></th>
									</tr>
									<tr>
										<th colspan="5" style="text-align:center">Total Package Cost</th>
										<td colspan="5" style="text-align:center">6000</td>
									</tr>
									<tr>
										<td colspan="10" style="padding-bottom:6%">* How Can We Show Transport & Activities Cost Individually, if needed</td>

									</tr>
									
									<tr colspan="10">
									
										<th>S.No.</th>
										<th>Check in Date</th>
										<th>Nights</th>
										<th>Destination</th>
										<th>Hotel</th>
										<th>Room Category & Count</th>
										<th>Meal Plan</th>
									</tr>
										<tr>
											<td>1</td>
											<td>23-Aug</td>
											<td>3</td>
											<td>Corbet</td>
											<td>corbett Panorama</td>
											<td>2 Poolview & 2 Whirlpool(With 2 extra bed)</td>
											<td>Breakfast,Lunch & Dinner</td>
										</tr>
										
										<tr>
											<td>2</td>
											<td>26-Aug</td>
											<td>2</td>
											<td>Nainital</td>
											<td>Pine Crest</td>
											<td>2 Cottage & 2 Vally View(With 2 extra bed)</td>
											<td>Breakfast,Lunch & Dinner</td>
										</tr>
										
										<tr>
											<td>3</td>
											<td>28-Aug</td>
											<td>2</td>
											<td>Haridwar</td>
											<td>Hotel Vinayak</td>
											<td>2 Mountain & 2 Executive (With 2 extra bed)</td>
											<td>Breakfast,Lunch & Dinner</td>
										</tr>
										<tr>
											<th colspan="9" style="padding:5% 0% 0% 7%" > itinerary Plan & Schedule in Details<br>Itinerary iD</th>

										</tr>
										<tr>
											
											<td colspan="9">
											<p>23 Aug 2020 Wednesday</p><p style="margin:-33px 0px 20px 338px; line-height:18px; word-spacing:5px;">Arival at Delhi ,Meet and greet,Proceed to Corbett(Delhi to Corbett 250 KM Approx)<br> After Arival at resort ,enjoy inhouse aminities and releax, Overnight Stay at Hotel/resort</p>
											
											<p> 23 Aug 2020 Wednesday</p><p style="margin:-45px 0px 200px 338px;line-height:18px; word-spacing:5px;">after breakfast, go for local sightseeing e.g Gargia Devi temple, corbett fall<br> Overnight stay at resort</p>
										
											<p>26 Aug 2020 Wednesday</p><p style="margin:-220px 0px 20px 338px; line-height:18px; word-spacing:5px;">after breakfast, go for local sightseeing e.g Gargia Devi temple,Corbett fall<br>Overnight stay at resort</p>
											
											</td>
										</tr>
										
							</table>
						</div>
					</div>
                </div>
                </div>
              </div>
              <div class="">
                
              </div>
            </form>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- END RIGHT SIDEBAR NAV -->
            <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
    <!--<ul>
        <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
        <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
        <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
        <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
    </ul>-->
</div>
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
    <script src="{{ URL::asset('public/asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('public/asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    
    <script>
    
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById("googleaddress")),
            {types: ["geocode"]});
    }
    
    $(document).ready(function() {
      $('#lead_source').change(function() {
            var value = $(this).val();
            if (value == 'Travel Agent' || value == 'Reference'){
                $('#reference_name_field').show();
            }else{
                $('#reference_name_field').hide();
            }
      });
      
      $('#enquiry_type').change(function() {
            var value = $(this).val();
            if (value == 'Own Hotel' || value == 'Partner Hotel'){
                $('#hotel_enquiry').show();
                $('#other_enquiry_field').hide();
                
            }else if (value == 'Other'){
                $('#hotel_enquiry').hide();
                $('#other_enquiry_field').show();
            }else{
               $('#hotel_enquiry').hide();
                $('#other_enquiry_field').hide(); 
            }
      });
      
      $('#lead_status').change(function() {
            var value = $(this).val();
            if (value == 'CLOSED'){
                $('#closed_reason_field').show();
            }else{
                $('#closed_reason_field').hide();
            }
      });
});

    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1mefnF88BCHGzDBEmv2FYFYWkjtVli0w&libraries=places&callback=initAutocomplete"
    async defer></script>
@endsection