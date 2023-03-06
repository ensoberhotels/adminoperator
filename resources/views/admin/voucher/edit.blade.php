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
                  <li class="breadcrumb-item"><a href="#">Amenities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Edit Amenity</a>
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
                        <h4 class="card-title">Update Voucher</h4>
                    </div>
					
					
			<form class="add_car_form" id="add_car_form" method="POST" action="{{route('voucher.update', $voucher->id )}}" enctype="multipart/form-data" role="form">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class=" col s12 m3">
					<label for="hotel_name" class="">Hotel Name</label>
					<input class="validate invalid" required="" aria-required="true" id="hotel_name" type="text" name="hotel_name" value="{{$voucher->hotel_name}}">
                </div>
				<div class=" col s12 m3">
					<label for="agent_name" class="">Agent Name</label>
					<input class="validate invalid" required="" aria-required="true" id="agent_name" type="text" name="agent_name" value="{{$voucher->agent_name}}">
                </div>
				<div class=" col s12 m3">
					<label for="car_name" class="">Confirmed By</label>
					<input class="validate invalid" required="" aria-required="true" id="confirmed_by" type="text" name="confirmed_by" value="{{$voucher->confirmed_by}}">
                </div>
				<div class=" col s12 m3">
					<label for="client_name" class="">Client Name</label>
					<input class="validate invalid" required="" aria-required="true" id="client_name" type="text" name="client_name" value="{{$voucher->client_name}}">
                </div>
				<div class=" col s12 m3">
					<label for="check_in" class="">Check In</label>
					<input class="validate invalid" required="" aria-required="true" id="check_in" type="date" name="check_in" value="{{$voucher->check_in}}">
                </div>
				<div class=" col s12 m3">
					<label for="check_out" class="">Check Out</label>
					<input class="validate invalid" required="" aria-required="true" id="check_out" type="date" name="check_out" value="{{$voucher->check_out}}">
                </div>
				<div class=" col s12 m3">
					<label for="no_of_nights" class="">No Of Nights</label>
					<input class="validate invalid" required="" aria-required="true" id="no_of_nights" type="text" name="no_of_nights" value="{{$voucher->no_of_nights}}">
                </div>
				<div class=" col s12 m3">
					<label for="no_of_pax" class="">No Of Pax</label>
					<input class="validate invalid" required="" aria-required="true" id="no_of_pax" type="text" name="no_of_pax" value="{{$voucher->no_of_pax}}">
                </div>
				<div class=" col s12 m3">
					<label for="kids" class="">Kids</label>
					<input class="validate invalid" required="" aria-required="true" id="kids" type="text" name="kids" value="{{$voucher->kids}}">
                </div>
				<div class=" col s12 m3">
					<label for="no_of_room" class="">No Of Room</label>
					<input class="validate invalid" required="" aria-required="true" id="no_of_room" type="text" name="no_of_room" value="{{$voucher->no_of_room}}">
                </div>
				<div class=" col s12 m3">
					<label for="room_type" class="">Room Type</label>
					<input class="validate invalid" required="" aria-required="true" id="room_type" type="text" name="room_type" value="{{$voucher->room_type}}">
                </div>
				<div class=" col s12 m3">
					<label for="package" class="">Package / Tariff Include</label>
					<input class="validate invalid" required="" aria-required="true" id="package" type="text" name="package" value="{{$voucher->package}}">
                </div>
				<div class=" col s12 m3">
					<label for="cost" class="">Cost</label>
					<input class="validate invalid" required="" aria-required="true" id="cost" type="text" name="cost" value="{{$voucher->cost}}">
                </div>
				<div class=" col s12 m3">
					<label for="advance_received" class="">Advance Received</label>
					<input class="validate invalid" required="" aria-required="true" id="advance_received" type="text" name="advance_received" value="{{$voucher->advance_received}}">
                </div>
				<div class=" col s12 m3">
					<label class="">Hotel Logo</label>
					<input class="validate invalid" required="" aria-required="true" id="hotel_logo" type="file" name="hotel_logo"><br>
					<a href="{{ url('storage/app/'.$voucher->hotel_logo) }}" target="_blank"><img src="{{ url('storage/app/'.$voucher->hotel_logo) }}"/></a>
                </div>
				<div class=" col s12 m3">
					<label class="">Hotel Address</label>
					<textarea class="validate invalid" name="hotel_address">{{$voucher->hotel_address}}</textarea>
                </div>
                <div class=" col s12 m5">
                  <button class="btn waves-effect waves-light right" type="submit" name="action" id="add_hotel">Submit
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