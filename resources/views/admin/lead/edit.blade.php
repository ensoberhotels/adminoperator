@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

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
                  <li class="breadcrumb-item"><a href="#">Update lead</a>
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
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Lead</strong></h3>
                    </div>
                    
                    
            <form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="POST" action="{{ route('lead.update',$lead->id) }}" >
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class="">
                <div class="" id="details">
					&nbsp;&nbsp;<strong>Lead Number : {{ $lead->lead_no }}</strong> &nbsp;&nbsp; <strong>Date :  {{ date('d M Y', strtotime($lead->create_date)) }}</strong>
                    <div class="row group">
                        <div class="col s12"> 
                            <div class=" col s12 m2" style="display:none;">
                               <strong>Lead Number : {{ $lead->lead_no }}</strong>
                            </div>
                            <div class=" col s12 m2" style="display:none;">
                                <strong>Date :  {{ $lead->create_date }}</strong>
                            </div>
                            <div class=" col s12 m2">
                                <label for="mobile" class="">Mobile</label>
                                <input class="validate invalid" required="" aria-required="true" id="mobile" type="number" name="mobile" value="{{ $lead->mobile }}">
                            </div>
                            <div class=" col s12 m2">
                                <label for="name" class="">Guest Name</label>
                                <input class="validate invalid" required="" aria-required="true" id="name" type="text" name="name" value="{{ $lead->name }}">
                            </div>      
                            <div class=" col s12 m2">
								<label for="lead_source" class="">Lead Source</label>
                                <select id="lead_source" name="lead_source">
                                  <option value="" @if( $lead->lead_source == '') selected @endif>Select Lead Source</option>
                                  <option value="Travel Agent" @if( $lead->lead_source == 'Travel Agent') selected @endif>Travel Agent</option>
                                  <option value="Website" @if( $lead->lead_source == 'Website') selected @endif>Website</option>
                                  <option value="Reference" @if( $lead->lead_source == 'Reference') selected @endif>Reference</option>
                                  <option value="Direct" @if( $lead->lead_source == 'Direct') selected @endif>Direct</option>
                                  <option value="Emailer" @if( $lead->lead_source == 'Emailer') selected @endif>Emailer</option>
                                  <option value="Existing Cust" @if( $lead->lead_source == 'Existing Cust') selected @endif>Existing Cust</option>
                                  <option value="Calling" @if( $lead->lead_source == 'Calling') selected @endif>Calling</option>
                                </select>
                                    <!--<label for="lead_source">Lead Source *</label> -->              
                             </div>
                            
                            <div class=" col s12 m2" id="reference_name_field"  @if( $lead->lead_source == 'Travel Agent' || $lead->lead_source == 'Reference')  @else  style="display: none;" @endif>
                                <label for="name" class="">Agent/Refrence Name</label>
                                <input class="validate invalid"  id="reference_name" type="text" name="reference_name" value="{{ $lead->reference_name }}">
                            </div>
							<div class=" col s12 m2">
								<label for="assign_to" class="">Assign To</label>
								<select id="assign_to" name="assign_to"> 
                                    <option value="">Assign To</option>
                                    @foreach($Operators as $Operator)
                                        <option value="{{ $Operator->id }}" @if($lead->assign_to==$Operator->id) selected @endif >{{ $Operator->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class=" col s12 m2" id="lead_comment_field" >
                                <label for="infant" class="">Lead Comment</label>
                                <textarea cols="" rows="" id="lead_comment" name="lead_comment">{{ $lead->lead_comment }} </textarea>
							</div>
                            <div class=" col s12 m2">
                                <label for="email" class="">Email</label>
                                <input class="validate invalid" required="" aria-required="true" id="email" type="email" name="email" value="{{ $lead->email }}">
                            </div>
                            
							<div class=" col s12 m2">
                                <label for="location" class="">Location</label>
								<input class="validate invalid" required="" aria-required="true" id="googleaddress" type="text" name="location"  value="{{ $lead->location }}" placeholder="Enter a location" autocomplete="off">
                                
                            </div>
							
                           <!-- <div class=" col s12 m2">
                                <label for="location" class="">Location</label>
                                <select id="location" name="location" class="location"> 
                                    <option value="">Select Country</option>
                                    @foreach($Countries as $Country)
                                        <option value="{{ $Country->id }}">{{ $Country->name }}</option>
                                    @endforeach
                                </select>

                            </div>-->
                            <div class=" col s12 m2">    
                                <label for="customer_type" class="">Customer Type</label>
                                <select id="customer_type" name="customer_type">
                                  <option value="" @if( $lead->customer_type == '') selected @endif>Select Customer Type</option>
                                  <option value="B2B" @if( $lead->customer_type == 'B2B') selected @endif>B2B</option>
                                  <option value="B2C" @if( $lead->customer_type == 'B2C') selected @endif>B2C</option>
                                  <option value="Referred" @if( $lead->customer_type == 'Referred') selected @endif>Referred</option>
                                </select> 
                            </div> 
                            <div class=" col s12 m2">    
                                <label for="lead_priority" class="">Lead Priority</label>
                                <select id="lead_priority" name="lead_priority">
                                  <option value="" @if( $lead->lead_priority == '') selected @endif>Select Lead Priority</option>
                                  <option value="Hot" @if( $lead->lead_priority == 'Hot') selected @endif>Hot</option>
                                  <option value="Warm" @if( $lead->lead_priority == 'Warm') selected @endif>Warm</option>
                                  <option value="Cold" @if( $lead->lead_priority == 'Cold') selected @endif>Cold</option>
                                </select>
                            </div>
                            <div class=" col s12 m2">    
                               <label for="trip_type" class="">Trip Type</label>
                                <select id="trip_type" name="trip_type">
                                  <option value="" @if( $lead->trip_type == '') selected @endif>Select Trip Type</option>
                                  <option value="Single" @if( $lead->trip_type == 'Single') selected @endif>Single</option>
                                  <option value="Return" @if( $lead->trip_type == 'Return') selected @endif>Return</option>
                                  </select>  
                            </div>
                            
							                     </div>
                   </div>
                </div>
                </div>
              </div>
              <div class="row">
               <div class="card-header">
                        <h3 class="card-title"><strong>Query Details</strong></h3>
                    </div>
                    
              <div class="" id="details">
                <div class="row group">
                  <div class="col s12">
                         <div class=" col s12 m2">
							<label for="enquiry_type" class="">Enquiry Type</label>
                                <select id="enquiry_type" name="enquiry_type">
                                  <option value="" @if( $lead->enquiry_type == '') selected @endif>Select Enquiry Type</option>
                                  <option value="Own Hotel" @if( $lead->enquiry_type == 'Own Hotel') selected @endif>Own Hotel</option>
                                  <option value="Partner Hotel" @if( $lead->enquiry_type == 'Partner Hotel') selected @endif>Partner Hotel</option>
                                  <option value="Other" @if( $lead->enquiry_type == 'Other') selected @endif >Other</option>
                                </select>
                            </div>
                            <div class=" col s12 m2" id="hotel_enquiry" @if( $lead->enquiry_type == 'Own Hotel' || $lead->enquiry_type == 'Partner Hotel')  @else  style="display: none;" @endif>
                                <label for="hotel_id" class="">Select Hotel</label>
                                <select name="hotel_id" class="validate invalid" id="hotel_id">
                                        <option value=""  selected >Select Hotel</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}"  @if($lead->hotel_id==$hotel->id) selected @endif >{{ $hotel->hotel_name }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class=" col s12 m2" id="other_enquiry_field" @if( $lead->enquiry_type == 'Other')  @else  style="display: none;" @endif>
                                <label for="other_enquiry" class="">Other Enquiry</label>
                                <input class="validate invalid"  aria-required="true" id="other_enquiry" type="text" name="other_enquiry" value="{{ $lead->other_enquiry }}" >
                            </div>
                            <div class=" col s12 m2">
								<label for="hotel_type" class="">Hotel Type</label>
                                <select id="hotel_type" name="hotel_type"> 
                                    <option value="" @if( $lead->hotel_type == '') selected @endif >Select Hotel Type</option>
                                    <option value="one" @if( $lead->hotel_type == 'one') selected @endif  >One Start</option>
                                    <option value="two" @if( $lead->hotel_type == 'two') selected @endif >Two Start</option>
                                    <option value="three" @if( $lead->hotel_type == 'three') selected @endif >Three Start</option>
                                    <option value="four" @if( $lead->hotel_type == 'four') selected @endif >Four Start</option>
                                    <option value="five" @if( $lead->hotel_type == 'five') selected @endif >Five Start</option>
                                    
                                </select>
                            </div>
                            
                            <div class=" col s12 m2">
                                <label for="d_country" class="">Destination Country</label>
                                <select id="country_id" name="country_id" class="country_id"> 
                                    <option value="">Select Country</option>
                                    @foreach($Countries as $Country)
                                        <option value="{{ $Country->id }}" @if($lead->country_id==$Country->id) selected @endif>{{ $Country->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        <div class=" col s12 m2 region_list">
                                <label for="d_region" class="">Destination State</label>
                                <select id="region_id" name="region_id" class="region_id">
                                  <option value="">Select State</option>
                                    @foreach($Regions as $Region)
                                        <option value="{{ $Region->id }}" @if($lead->region_id==$Region->id) selected @endif >{{ $Region->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class=" col s12 m2 city_list get_suc_cat">
                               <label for="d_city" class="">Destination City</label>
                                <select id="city_id" name="city_id" class="get_suc_cat">
                                  <option value="">Select City</option>
                                  @foreach($Cities as $City)
                                        <option value="{{ $City->id }}" @if($lead->city_id==$City->id) selected @endif >{{ $City->name }}</option>
                                    @endforeach
                                </select>
                        </div>                         
                         <div class=" col s12 m2">
                                <label for="start_date" class="">Start Date</label>
                                <input class="validate invalid" required="" aria-required="true" id="start_date" type="date" name="start_date" value="{{ $lead->start_date }}" >
                         </div>
                         <!--<div class=" col s12 m2">
                                <label for="end_date" class="">End Date</label>
                                <input class="validate invalid" required="" aria-required="true" id="end_date" type="date" name="end_date">
                         </div>-->
                         <div class=" col s12 m2">
                                <label for="end_date" class="">No Of Nights</label>
                                <input class="validate invalid" required="" aria-required="true" id="no_nights" type="number" name="no_nights" value="{{ $lead->no_nights }}">
                         </div>
                         
                         <div class=" col s12 m2">
                                <label for="no_room" class="">No of Room</label>
                                <input class="validate invalid" required="" aria-required="true" id="no_room" type="number" name="no_room" value="{{ $lead->no_room }}">
                         </div>
                         <div class=" col s12 m2">
							<label for="sharing" class="">Sharing</label>
                            <select id="sharing" name="sharing"> 
                                <option value="" @if( $lead->sharing == '') selected @endif  >Select Sharing</option>
                                <option value="single" @if( $lead->sharing == 'single') selected @endif >single Sharing</option>
                                <option value="double" @if( $lead->sharing == 'double') selected @endif >double Sharing</option>
                                <option value="triple" @if( $lead->sharing == 'triple') selected @endif>triple Sharing</option>
                                <option value="quad" @if( $lead->sharing == 'quad') selected @endif>quad Sharing</option>
                                <option value="penta" @if( $lead->sharing == 'penta') selected @endif>penta Sharing</option>
                            </select>
                                
                         </div>
                         <div class=" col s12 m2">
                                <label for="pax" class="">No of Adults</label>
                                <input class="validate invalid" required="" aria-required="true" id="pax" type="number" name="pax" value="{{ $lead->pax }}">
                         </div>
                         <div class=" col s12 m2">
                                <label for="kids" class="">No of Kids</label>
                                <input class="validate invalid" required="" aria-required="true" id="kids" type="number" name="kids" value="{{ $lead->kids }}">
                         </div>
                         <div class=" col s12 m2">
                                <label for="infant" class="">No of Infant</label>
                                <input class="validate invalid" required="" aria-required="true" id="infant" type="number" name="infant" value="{{ $lead->infant }}">
                         </div>
                         <div class=" col s12 m2">
							<label for="lead_status" class="">Lead Status</label>
                                <select id="lead_status" name="lead_status">
                                  <option value="" @if( $lead->lead_status == '') selected @endif>Select Lead Status</option>
                                  <option value="LEAD" @if( $lead->lead_status == 'LEAD') selected @endif>LEAD</option>
                                  <option value="QUOTATION" @if( $lead->lead_status == 'QUOTATION') selected @endif>QUOTATION</option>
                                  <option value="CLOSED" @if( $lead->lead_status == 'CLOSED') selected @endif>CLOSED</option>
                                  </select>  
                            </div>
                            <div class=" col s12 m2" id="closed_reason_field" @if( $lead->lead_status == 'CLOSED')  @else  style="display: none;" @endif>
                                <label for="infant" class="">Closed Reason</label>
                                <textarea cols="" rows="" id="closed_reason" name="closed_reason">{{ $lead->closed_reason }} </textarea>
                          </div>
                         
                            

                         <div class="col s12 m2">
                            <p>Status</p>
                            <p>
                            <label>
                            <input class="validate" required="" aria-required="true" value="ACTIVE" name="status" type="radio" @if($lead->status=='ACTIVE') checked @endif >
                            <span>ACTIVE</span>
                            </label>
                            </p>
                            <label>
                            <input class="validate" required="" aria-required="true" value="INACTIVE" name="status" type="radio" @if($lead->status=='INACTIVE') checked @endif >
                            <span>INACTIVE</span>
                            </label>
                        <div class="">    </div>
                       </div>
						<div class=" col s12 m2">
                  <button class="btn waves-effect waves-light right" type="submit" name="action" id="add_lead">Submit
                    <i class="material-icons right">send</i>
                  </button>
                </div>
                  </div>
                </div>
              </div>
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