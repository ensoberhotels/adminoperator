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
                  <li class="breadcrumb-item"><a href="index.html">Hotel</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Hotel Season Rate</a>
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
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">We use <a
                    href="https://kinark.github.io/Materialize-stepper/?feedback_email=r%40m.com&amp;feedback_password=sdasdasd#!">Stepper</a>
                as a Form Wizard. Stepper is a fundamental part of material design
                guidelines. It makes forms simplier and a lot of other stuffs.</p>
        </div>
    </div>

    <!-- Linear Stepper -->	
	
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h4 class="card-title">Hotel Season Rate</h4>
                    </div>
					
					
			<form class="add_hotel_form" id="add_hotel_form" method="POST" action="{{ url('/admin/addhotelgroupseasonrateaction') }}" enctype='multipart/form-data'>
			{{csrf_field()}}
              <div class="row">
			  
				<div class="">
				<div class="row" id="details">
					<div class="row group">
						<div class="col s11"> 
							<div class="input-field col s4">
								<select name="hotel_id[]" class="validate invalid" required="" aria-required="true" id="hotel_id">
									@foreach($hotels as $hotel)
										<option value="{{ $hotel->id }}">{{ $hotel->hotel_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="input-field col s4">
								<input class="validate" required="" aria-required="true" id="start_date" type="date" name="start_date[]">
							</div>
							<div class="input-field col s4">
								<input class="validate" required="" aria-required="true" id="end_date" type="date" name="end_date[]">
							</div>
														
							<div class="input-field col s3">
								<label for="from_no_person" class="">From No Person</label>
								<input class="validate invalid" required="" aria-required="true" id="from_no_person" type="number" name="from_no_person[]">
							</div>
							
							<div class="input-field col s3">
								<label for="to_no_person" class="">To No Person</label>
								<input class="validate invalid" required="" aria-required="true" id="to_no_person" type="number" name="to_no_person[]">
							</div>
							<div class="input-field col s3">
								<label for="single_sharing" class="">Single Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="single_sharing" type="number" name="single_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="double_sharing" class="">Double Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="double_sharing" type="number" name="double_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="triple_sharing" class="">Triple Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="triple_sharing" type="number" name="triple_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="quad_sharing" class="">Quad Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="quad_sharing" type="number" name="quad_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="penta_sharing" class="">Penta Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="penta_sharing" type="number" name="penta_sharing[]">
							</div>
							<!--<div class="input-field col s3">
								<label for="group_rate" class="">Group Rate</label>
								<input class="validate invalid" required="" aria-required="true" id="group_rate" type="number" name="group_rate[]">
							</div>
							<div class="input-field col s3">
								<label for="per_person_rate" class="">Per Person Rate</label>
								<input class="validate invalid" required="" aria-required="true" id="per_person_rate" type="number" name="per_person_rate[]">
							</div>
							<div class="input-field col s3">
								<label for="per_night_rate" class="">Per Night Rate</label>
								<input class="validate invalid" required="" aria-required="true" id="per_night_rate" type="number" name="per_night_rate[]">
							</div>-->
							
							
						</div>
						<div class="col s1">
							<!--<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))">
								<i class="material-icons">delete_sweep</i>
							</a>-->
						</div>
					</div>
				</div>
				</div>
				<div class="col s12 text-right">
					<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
						<i class="material-icons">note_add</i>
					</a>
				</div>
				
                <div class="col s12">
                  <label for="tnc_select1">T&amp;C *</label> 
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" id="tnc_select1" type="checkbox">
                      <span>Please agree to our policies</span>
                    </label>
                  </p>
                  <div class="input-field">
                  </div>
                </div>
                <div class="input-field col s12">
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

	<script>
		function addMore(){
    		$('#details').append(`<div class="row group">
						<div class="col s11"> 
							<div class="input-field col s4 show_select">
								<select name="hotel_id[]" class="validate invalid" required="" aria-required="true" id="hotel_id">
									@foreach($hotels as $hotel)
										<option value="{{ $hotel->id }}">{{ $hotel->hotel_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="input-field col s4">
								<input class="validate" required="" aria-required="true" id="start_date" type="date" name="start_date[]">
							</div>
							<div class="input-field col s4">
								<input class="validate" required="" aria-required="true" id="end_date" type="date" name="end_date[]">
							</div>
														
							<div class="input-field col s3">
								<label for="from_no_person" class="">From No Person</label>
								<input class="validate invalid" required="" aria-required="true" id="from_no_person" type="number" name="from_no_person[]">
							</div>
							
							<div class="input-field col s3">
								<label for="to_no_person" class="">To No Person</label>
								<input class="validate invalid" required="" aria-required="true" id="to_no_person" type="number" name="to_no_person[]">
							</div>
							<div class="input-field col s3">
								<label for="single_sharing" class="">Single Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="single_sharing" type="number" name="single_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="double_sharing" class="">Double Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="double_sharing" type="number" name="double_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="triple_sharing" class="">Triple Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="triple_sharing" type="number" name="triple_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="quad_sharing" class="">Quad Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="quad_sharing" type="number" name="quad_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="penta_sharing" class="">Penta Sharing Price</label>
								<input class="validate invalid" required="" aria-required="true" id="penta_sharing" type="number" name="penta_sharing[]">
							</div>
							<div class="input-field col s3">
								<label for="group_rate" class="">Group Rate</label>
								<input class="validate invalid" required="" aria-required="true" id="group_rate" type="number" name="group_rate[]">
							</div>
							<div class="input-field col s3">
								<label for="per_person_rate" class="">Per Person Rate</label>
								<input class="validate invalid" required="" aria-required="true" id="per_person_rate" type="number" name="per_person_rate[]">
							</div>
							<div class="input-field col s3">
								<label for="per_night_rate" class="">Per Night Rate</label>
								<input class="validate invalid" required="" aria-required="true" id="per_night_rate" type="number" name="per_night_rate[]">
							</div>
							
							
						</div>
						<div class="col s1">
							<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))">
								<i class="material-icons">delete_sweep</i>
							</a>
						</div>
					</div>`);
    	}
		
		function remove(e){
			e.parents('.group').remove()
		}
		
	</script>


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
	</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1mefnF88BCHGzDBEmv2FYFYWkjtVli0w&libraries=places&callback=initAutocomplete"
	async defer></script>
@endsection