@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard | Lead Followup')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
    <style>
        .step-actions {
            float: right;
        }
        .show_select select{display:block;}
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
						<h3 class="card-title follow_title"><strong>Lead Details</strong></h3>
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
					
					<div class="col s12 m4">
						<h3 class="card-title follow_title"><strong>Lead Followup</strong></h3>
						<div class="row" style="padding-left: 5px;">
							<div class="col s12 m5">
								<label for="name" class="">Followup Date</label>
								<input class="validate invalid"  aria-required="true" id="name" type="date" name="followup_date" value="{{$lead->followup_date}}">
							</div>
							<div class="col s12 m4">
								<label for="name" class="">Followup Time</label>
								<input class="validate invalid"  aria-required="true" id="name" type="time" name="followup_time" value="{{$lead->followup_time}}">
							</div>
							<div class="col s12 m3">
								<br>
								<!-- Close Lead -->
								@if($lead->lead_status != 'CLOSED')
								  <a class="waves-effect waves-light btn modal-trigger" href="#modal{{$lead->id}}">Close</a><br>
								@endif
							
								<!--<label for="name" class="">Followup Status</label>
								<select name="followup_status">
									<option value="">Select Followup Status</option>
									<option value="START" @if($lead->followup_status=='START') {{ 'selected' }} @endif>START</option>
									<option value="CONTINUE" @if($lead->followup_status=='CONTINUE') {{ 'selected' }} @endif>CONTINUE</option>
									<option value="STOP" @if($lead->followup_status=='STOP') {{ 'selected' }} @endif>STOP</option>
								</select>-->
							</div>
							<div class="col s12">
								<label for="name" class="">Followup Comment</label>
								<textarea name="comment" class="leadfc"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col s12">
								<button class="btn waves-effect waves-light" type="button" onclick="window.history.back();">Cancel
								<i class="material-icons right">cancel</i>
								</button>
								
								@if($lead->lead_status == 'CLOSED')
									<button class="btn waves-effect waves-light right" type="button" name="action" desabled>Closed
									</button>
								@else
									<button class="btn waves-effect waves-light right" type="submit" name="action">Submit
									<i class="material-icons right">send</i>
									</button>
								@endif
							</div>
						</div>
					</div>
					
					<div class="col s12 m4">
						<h3 class="card-title follow_title"><strong>Lead Followup History</strong></h3>
						<div class="commect_history">
							<ul>
								@foreach($followUps as $followUp)
								<li>
									<p>{{$followUp->comment}}</p> 
									<span>Followup date: {{ date('d-m-Y', strtotime($followUp->followup_date))}}, {{ date('h:i:s A', strtotime($followUp->followup_time))}}</span>
									<span style="color: blue; float: right;">{{$followUp->getOperator->name}}</span>
								</li>
								@endforeach
							</ul>
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

	
	<!-- Modal Structure -->
	  <div id="modal{{$lead->id}}" class="modal modal-fixed-footer" style="width:400px; height:300px;">
	  <form method="POST" action="{{ url('/operator/leadclose') }}">
	  {{csrf_field()}}
		<div class="modal-content" style="width: 348px; text-align:left;">
		  <h5>Lead Close</h5>
			<div class="form-group">
			  <label for="email">Close Status:</label>
			  <select class="form-control" name="closed_status" required>
				<option value="">Select Reason</option>
				<option value="BOOKED">BOOKED</option>
				<option value="POSTPONED">POSTPONE</option>
				<option value="LOST">LOST</option>
			  </select>
			</div>
			<div class="form-group">
			  <label for="pwd">Closed Reason:</label>
			  <textarea class="form-control" name="closed_reason"></textarea>
			</div>
		</div>
		<div class="modal-footer" style="width: 348px;">
			<input type="hidden" name="lead_id" value="{{ $lead->id }}" />
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</div>
		</form>
	  </div>
	  <!-- /Modal Trigger -->


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
    <script src="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('asset/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script>
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