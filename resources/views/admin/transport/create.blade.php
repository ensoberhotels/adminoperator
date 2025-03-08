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
                  <li class="breadcrumb-item"><a href="index.html">Car</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Car</a>
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
                        <h4 class="card-title">Create New Car</h4>
                    </div>
					<div class="divider"></div><br>
					
			<form class="add_car_form" id="add_car_form" method="POST" action="{{ route('transport.store') }}" enctype="multipart/form-data" role="form">
			{{csrf_field()}}
              <div class="row">
				<div class=" col s12">
                  <label>Car Segment : <span id="text_segment"></span></label>&nbsp;&nbsp; 
                  <label>Car Model : <span id="text_model"></span></label>&nbsp;&nbsp; 
                  <label>Car Seats : <span id="text_seats"></span></label> &nbsp;&nbsp;
                  <input  id="car_segment_id" type="hidden" name="car_segment_id" value="">
                  <input  id="car_model_id" type="hidden" name="car_model_id" value="">
                  <input  id="car_seats_id" type="hidden" name="car_seats_id" value="">
				 </div>
                <div class=" col s12 m2">
					<label>Car</label>
					<select id="car_id" name="car_id" tabindex="-1">
				        <option value="" selected>Select Car</option>
				        @foreach($datas as $data)
					        <option value="{{$data->id}}" title="Car Name.">{{$data->car_name}}</option>
				        @endforeach
						
					</select>
                </div>
                <div class=" col s12 m2">
					<label>Vender</label>
                    <select  required="" aria-required="true" id="vender_id" name="vender_id" class="vender_id"> 
						<option value="">Select Vender</option>
						@foreach($venders as $vender)
							<option value="{{ $vender->id }}">{{ $vender->name }}</option>
						@endforeach
                    </select>
                </div>
                <!--<div class=" col s4">
                  <label for="available_seat" class="">Available Seat *</label>
                  <input class="validate invalid" required="" aria-required="true" id="seat" type="number" name="available_seat">
                </div>-->
                
                <div class=" col s12 m2">
					<label>Country</label>
                    <select required="" aria-required="true" id="country_id" name="country_id" class="country_id"> 
						<option value="">Select Country</option>
						@foreach($Countries as $Country)
							<option value="{{ $Country->id }}">{{ $Country->name }}</option>
						@endforeach
					</select>
                </div>
                <div class=" col s12 m2 region_list">
					<label>State</label>
                    <select id="region_id" name="region_id" class="validate region_id">
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class=" col s12 m2 city_list get_suc_cat">
					<label>City</label>
                    <select id="city_id" name="city_id" class="validate get_suc_cat">
					  <option value="">Select City</option>
					</select>
                </div>
                
				<div class=" col s12 m2">
					<label>Type</label>
					<select id="type" name="type" tabindex="-1">
						<option value="" selected>Select Type</option>
						<option value="AIRPICKUP" title="This is for airport pickup only.">AIRPORT PICKUP</option>
						<option value="AIRDROPUP" title="This is for airport dropup only.">AIRPORT DROPUP</option>
						<option value="PERDAY" title="This is for one day booking.">PER DAY</option>
					</select>
                </div>
				<div class=" col s12 m2">
                  <label for="fare" class="">Fare *</label>
                  <input class="validate invalid" required="" aria-required="true" id="fare" type="text" name="fare">
                </div>
				
				<div class=" col s12 m2">
                  <label for="perday_km" class="">Per day KM *</label>
                  <input class="validate invalid" required="" aria-required="true" id="perday_km" type="text" name="perday_km">
                </div>
			      	<div class=" col s12 m2">
                  <label for="perkm_fare" class="">Per KM Fare*</label>
                  <input class="validate invalid" required="" aria-required="true" id="perkm_fare" type="text" name="perkm_fare">
                </div>
               </div>

                <div class=" col s12 m2">
					        <label>Toll</label>
                  <select id="toll" name="toll">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>

                <div class=" col s12 m2">
					        <label>Tax</label>
                  <select id="tax" name="tax">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>

                <div class=" col s12 m2">
					        <label>Parking</label>
                  <select id="parking" name="parking">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>

                <div class=" col s12 m2">
					        <label>Allowance</label>
                  <select id="allowance" name="allowance">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
               
			<div class="row">
                <div class="col s12 m3">
                  <p>Status</p>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" value="ACTIVE" name="status" type="radio" checked="">
                      <span>ACTIVE</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required="" aria-required="true" value="INACTIVE" name="status" type="radio">
                    <span>INACTIVE</span>
                  </label>
                  <div class="">
                  </div>
                </div>
                <div class="col s12 m3">
                  <p>Approve Vender</p>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" value="1" name="vender_approved" type="radio" checked="">
                      <span>Approved</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required="" aria-required="true" value="0" name="vender_approved" type="radio">
                    <span>Not Approved</span>
                  </label>
                  <div class="">
                  </div>
                </div>
                
                <div class=" col s12 m3">
                  <button class="btn waves-effect waves-light " type="submit" name="action" id="add_hotel">Submit
                    <i class="material-icons right">send</i>
                  </button>
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
	
@endsection