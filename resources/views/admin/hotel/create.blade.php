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
                  <li class="breadcrumb-item"><a href="#">Add Hotel</a>
                  </li>
                  
                </ol>
              </div>
              <div class="col s12 m2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><span class="hide-on-small-onl">Settings</span><i class="material-icons right">arrow_drop_down</i></a>
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
                        <h4 class="card-title">Create New Hotel</h4>
                    </div>
					<div class="divider"></div><br>
					
			<form class="add_hotel_form" id="add_hotel_form" method="POST" action="{{ route('hotel.store') }}" enctype='multipart/form-data'>
			{{csrf_field()}}
              <div class="row">
                <div class=" col s12 m2"> 
					<label for="hotel_name" class="">Hotel Name*</label>
					<input class="validate invalid" required="" aria-required="true" id="hotel_name" name="hotel_name" type="text">
                </div>
				<div class=" col s12 m2">
                  <label for="start_category" class="">Property Type *</label>
				  <select class="validate invalid" required="" aria-required="true" id="property_type" name="property_type">
					<option value="">Property Type</option>
					<option value="HOTEL">Hotel</option>
					<option value="RESORT">Resort</option>
					<option value="MOTEL">Motel</option>
				  </select>
                </div>
				<div class=" col s12 m2">
                  <label for="start_category" class="">Hotel Category *</label>
				  <select class="validate invalid" required="" aria-required="true" id="start_category" name="start_category">
					<option value="">Start Category</option>
					<option value="ONE">One</option>
					<option value="TWO">Two</option>
					<option value="THREE">Three</option>
					<option value="FOUR">Four</option>
					<option value="FIVE">Five</option>
				  </select>
                </div>
				<div class=" col s12 m2">
					<label for="country">country*</label>
					<select  required="" aria-required="true" id="country_id" name="country_id" class="country_id"> 
						<option value="">Select Country</option>
						@foreach($Countries as $Country)
							<option value="{{ $Country->id }}">{{ $Country->name }}</option>
						@endforeach
					</select>
                </div>
				<div class=" col s12 m2 region_list">
					<label for="state">State*</label>
					<select id="region_id" name="region_id" class="validate region_id">
                        <option value="">Select State</option>
                    </select>
                </div>
				<div class=" col s12 m2 city_list get_suc_cat">
					<label for="city">City*</label>
					<select id="city_id" name="city_id" class="validate get_suc_cat">
					  <option value="">Select City</option>
					</select>
                </div>
                <div class=" col s12 m2">
					<label for="googleaddress">Hotel Address By Google*</label>
					<input class="validate" required="" aria-required="true" id="googleaddress" type="text" name="googleaddress">
                </div>
				<div class=" col s12 m2">
					<label for="lat">Latitide*</label>
					<input class="validate" required="" aria-required="true" id="lat" type="text" name="lat">
                </div>
				<div class=" col s12 m2">
					<label for="long">Longitude*</label>
					<input class="validate" required="" aria-required="true" id="long" type="text" name="long">
                </div>
				
                <div class=" col s12 m2">
					<label for="address">Address *</label>
					<input name="address" class="validate" type="text" required="" aria-required="true" id="address"/>
                </div>
                <div class=" col s12 m2">
					<label for="total_room" class="">Total Room *</label>
					<input class="validate invalid" required="" aria-required="true" id="total_room" type="number" name="total_room">
                </div>
                <div class=" col s12 m2">
					<label for="vender_id" class="">Vender</label>
                    <select  required="" aria-required="true" id="vender_id" name="vender_id" class="vender_id"> 
						<option value="">Select Vender</option>
						@foreach($venders as $vender)
							<option value="{{ $vender->id }}">{{ $vender->name }}</option>
						@endforeach
					</select>
                </div>
                <div class=" col s12 m2">
                  <label for="contact_name" class="">Contact Name *</label>
                  <input class="validate invalid" required="" aria-required="true" id="contact_name" type="text" name="contact_name">
                </div>
				<div class=" col s12 m2">
                  <label for="contact_email" class="">Contact Email *</label>
                  <input class="validate invalid" required="" aria-required="true" id="contact_email" type="email" name="contact_email">
                </div>
				<div class=" col s12 m2">
                  <label for="contact_number" class="">Contact Number *</label>
                  <input class="validate invalid" required="" aria-required="true" id="contact_number" type="number" name="contact_number" min="10">
                </div>
            </div>
				
				
				<div class="divider"></div>
				<div class="row section">
				  <div class="col s12 m6">
					<label>Set Hotel Base Image</label>
					<input type="file" id="input-file-now-custom-2" name="hotel_image" class="dropify"/>
				  </div>
				  <div class="col s12 m6">
					<label>Set Hotel Gallery Images</label>
					<input type="file" id="input-file-now-custom-2" name="image[]" class="dropify" multiple />
				  </div>
				</div>
				
				
				<h4 class="card-title">Amenities</h4>
				<div class="divider"></div><br>
				<div class="row">
				@foreach($amenities as $amenity)
					<div class="col s12 m2 ameniti">
						<p>
						<label>
						  <input class="validate" aria-required="true" value="{{$amenity->id}}" id="tnc_select1" name="amenities[]" type="checkbox">
						  <span>{{$amenity->name}}</span>
						</label>
						</p>
						<div class="">
						</div>
					</div>
				@endforeach
				</div>
				<h4 class="card-title">Hotel Room Category</h4>
				<div class="divider"></div><br>
				<div class="">
				<div class="" id="details">
					<div class="row group">
						<div class="col s11">
							<div class=" col s4">
								<label for="type" class="">Room Category</label>
								<select id="type" name="room_type_id[]" tabindex="-1" required="">
									<option value="" selected>Select Room Category</option>
                                    @foreach($roomtypes as $roomtype)
									<option value="{{$roomtype->id}}">{{$roomtype->room_type}}</option>
									@endforeach
								</select>
							</div>
							<div class=" col s4">
								<label for="name" class="">Room Name</label>
								<input class="validate invalid" required="" aria-required="true" id="name" type="text" name="name[]">
							</div>
							
							<div class=" col s4">
								<label for="room_count" class="">Number Of Rooms</label>
								<input class="validate invalid" required="" aria-required="true" id="room_count" type="text" name="room_count[]">
							</div>
							
						</div>
						<div class="col s1">
							<!--<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))">
								<i class="material-icons">delete_sweep</i>
							</a>-->
						</div>
					</div>
				</div>
				
				<h4 class="card-title">Payment details</h4>
				<div class="divider"></div><br>
				<div class="">
				<div class="" id="details">
					<div class="row group">
						<div class="col s11">
							<textarea class="texthtml1" name="payment_details"></textarea>						
						</div>
					</div>
				</div> 
				
				<h4 class="card-title">Cancelation policy</h4>
				<div class="divider"></div><br>
				<div class="">
				<div class="" id="details">
					<div class="row group">
						<div class="col s11">
							<textarea class="texthtml1" name="cancelation_policy"></textarea>						
						</div>
					</div>
				</div> 
				</div>
				<div class="col s12 text-right">
					<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
						<i class="material-icons">note_add</i>
					</a>
				</div>
				
                <div class="col s3">
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
                <div class="col s3">
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
                <div class="col s3">
                  <label for="tnc_select1">T&amp;C *</label>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" id="tnc_select1" type="checkbox">
                      <span>Please agree to our policies</span>
                    </label>
                  </p>
                  <div class="">
                  </div>
                </div>
                <div class=" col s3 text-center">
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

	<script>
		function addMore(){
    		$('#details').append(`<div class="row group">
						<div class="col s11">
							<div class=" col s4 show_select">
								<label for="type" class="">Room Category</label>
								<select id="type" name="room_type_id[]" tabindex="-1" required="">
									<option value="" selected>Select Room Category</option>
									@foreach($roomtypes as $roomtype)
                                    <option value="{{$roomtype->id}}">{{$roomtype->room_type}}</option>
                                    @endforeach
								</select>
							</div>
							<div class=" col s4">
								<label for="name" class="">Room Name</label>
								<input class="validate invalid" required="" aria-required="true" id="name" type="text" name="name[]">
							</div>
							
							<div class=" col s4">
								<label for="room_count" class="">Number Of Rooms</label>
								<input class="validate invalid" required="" aria-required="true" id="room_count" type="text" name="room_count[]">
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
    <!--<script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>-->
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
