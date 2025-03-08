@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard ')

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
                        <h4 class="card-title">Create New Hotel</h4>
                    </div> 
                    
			<form class="add_hotel_form" id="add_hotel_form" method="POST" action="{{route('hotel.update', $hotel->id )}}" enctype='multipart/form-data'>
			{{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class="input-field col s4"> 
					<label for="hotel_name" class="">Hotel Name*</label>
					<input class="validate invalid" required="" aria-required="true" id="hotel_name" name="hotel_name" type="text" value="{{$hotel->hotel_name }}">
                </div>
				<div class="input-field col s4">
                  <!--<label for="start_category" class="">Contact Email *</label>-->
				  <select class="validate invalid" required="" aria-required="true" id="property_type" name="property_type">
					<option value="" @if($hotel->property_type=="") selected @endif>Property Type</option>
					<option value="HOTEL" @if($hotel->property_type=="HOTEL") selected @endif>Hotel</option>
					<option value="RESORT" @if($hotel->property_type=="RESORT") selected @endif>Resort</option>
					<option value="MOTEL" @if($hotel->property_type=="MOTEL") selected @endif>Motel</option>
				  </select>
                </div>
				<div class="input-field col s4">
                  <!--<label for="start_category" class="">Contact Email *</label>-->
				  <select class="validate invalid" required="" aria-required="true" id="start_category" name="start_category">
					<option value="" @if($hotel->start_category=="") selected @endif>Start Category</option>
					<option value="ONE" @if($hotel->start_category=="ONE") selected @endif>One</option>
					<option value="TWO" @if($hotel->start_category=="TWO") selected @endif>Two</option>
					<option value="THREE" @if($hotel->start_category=="THREE") selected @endif>Three</option>
					<option value="FOUR" @if($hotel->start_category=="FOUR") selected @endif>Four</option>
					<option value="FIVE" @if($hotel->start_category=="FIVE") selected @endif>Five</option>
				  </select>
                </div>
				<div class="input-field col s4">
					<!--<label for="country">country*</label>-->
					<select  id="country_id" name="country_id" class="country_id">
						<option value="">Select Country</option>
                                    @foreach($Countries as $Country)
                                        <option value="{{ $Country->id }}" @if($hotel->country_id==$Country->id) selected @endif>{{ $Country->name }}</option>
                                    @endforeach
					</select>
                </div>
				<div class="input-field col s4 region_list">
					<!--<label for="state">State*</label>-->
					<select   id="region_id" name="region_id" class="validate region_id">
                    	<option value="">Select State</option>
                                    @foreach($Regions as $Region)
                                        <option value="{{ $Region->id }}" @if($hotel->region_id==$Region->id) selected @endif >{{ $Region->name }}</option>
                                    @endforeach
                </select>
                </div>
				<div class="input-field col s4 city_list get_suc_cat">
                    <!--<label for="city">City*</label>-->
                    <select  id="city_id" name="city_id" class="validate get_suc_cat">
                      <option value="">Select City</option>
                                  @foreach($Cities as $City)
                                        <option value="{{ $City->id }}" @if($hotel->city_id==$City->id) selected @endif >{{ $City->name }}</option>
                                    @endforeach

                </select>
                </div>
                <div class="input-field col s4">
					<!--<label for="googleaddress">Hotel Address By Google*</label>-->
					<input class="validate" required="" aria-required="true" id="googleaddress" type="text" name="googleaddress" value="{{$hotel->googleaddress }}">
                </div>
				<div class="input-field col s4">
					<label for="lat">Latitide*</label>
					<input class="validate" required="" aria-required="true" id="lat" type="text" name="lat" value="{{$hotel->lat }}">
                </div>
				<div class="input-field col s4">
					<label for="long">Longitude*</label>
					<input class="validate" required="" aria-required="true" id="long" type="text" name="long" value="{{$hotel->long }}">
                </div>
				
                <div class="input-field col s4">
					<label for="address">Address *</label>
					<input name="address" class="validate" type="text" required="" aria-required="true" id="address" value="{{$hotel->address }}"/>
                </div>
                <div class="input-field col s4">
					<label for="total_room" class="">Total Room *</label>
					<input class="validate invalid" required="" aria-required="true" id="total_room" type="number" name="total_room" value="{{$hotel->total_room }}">
                </div>
                <div class="input-field col s4">
                    <select  required="" aria-required="true" id="vender_id" name="vender_id" class="vender_id"> 
                                    <option value="">Select Vender</option>
                                    @foreach($venders as $vender)
                                        <option value="{{ $vender->id }}" @if($hotel->vender_id==$vender->id) selected @endif>{{ $vender->name }}</option>
                                    @endforeach
                                </select>
                </div>
                <div class="input-field col s4">
                  <label for="contact_name" class="">Contact Name *</label>
                  <input class="validate invalid" required="" aria-required="true" id="contact_name" type="text" name="contact_name" value="{{$hotel->contact_name }}">
                </div>
				<div class="input-field col s4">
                  <label for="contact_email" class="">Contact Email *</label>
                  <input class="validate invalid" required="" aria-required="true" id="contact_email" type="email" name="contact_email" value="{{$hotel->contact_email }}">
                </div>
				<div class="input-field col s4">
                  <label for="contact_number" class="">Contact Number *</label>
                  <input class="validate invalid" required="" aria-required="true" id="contact_number" type="number" name="contact_number" min="10" value="{{$hotel->contact_number }}">
                </div>
               
				
				
				<div class="divider"></div>
				
				<div class="row section">
				  <div class="col s12 m4 l3">
					<p>Set Hotel Base Image</p>
				  </div>
                  @if($hotel->hotel_image)
                      <div class="col s12 m4 9">
                        <img src="{{ url('storage/app/'.$hotel->hotel_image) }}" width="200px"/>
                      </div>
                    @endif
				  <div class="col s12 m8 l9">
					<input type="file" id="input-file-now-custom-2" name="hotel_image" class="dropify"/>
				  </div>
				</div>
				
				<div class="row section">
				  <div class="col s12 m4 l3">
					<p>Set Hotel Gallery Images</p>
				  </div>
                  @if($hotelgalleries)
                    @foreach($hotelgalleries as $hotelgallery)
                      <div class="col s12 m4 9">
                        <img src="{{ url('storage/app/'.$hotelgallery->image) }}" width="200px"/>
                      </div>
                    @endforeach
                  @endif
				  <div class="col s12 m8 l9">
					<input type="file" id="input-file-now-custom-2" name="image[]" class="dropify" multiple />
				  </div>
				</div>
				
				<h5>Amenities</h5>
				<hr>
				<div class="row">
					@foreach($hotelamenity as $h_amenity)
                        @php 
							$amenity_ids[] = $h_amenity->amenity_id 
						@endphp
					@endforeach
               @foreach($amenities as $amenity)
					<div class="col s2">
						<p>
						<label>
						  <input class="validate" aria-required="true" value="{{$amenity->id}}" id="tnc_select1" name="amenities[]" type="checkbox" @if(in_array($amenity->id, $amenity_ids)) checked @endif>
						  <span>{{$amenity->name}}</span>
						</label>
						</p>
						<div class="input-field">
						</div>
					</div>
				@endforeach
				</div>
				<h5>Hotel Room Category</h5>
				<div class="">
				<div class="row" id="details">
                @if($hotelroomcategoires)
                  @foreach($hotelroomcategoires as $hotelroomcategory)
                
					<div class="row group">
						<div class="col s11">
							<div class="input-field col s4">
								<select id="type" name="room_type_id[]" tabindex="-1" required="">
									<option value="">Select Room Category</option>
									@foreach($roomtypes as $roomtype)
                                    <option value="{{$roomtype->id}}" @if($hotelroomcategory->room_type_id==$roomtype->id) selected @endif>{{$roomtype->room_type}}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col s4">
								<label for="name" class="">Room Category Name</label>
								<input class="validate invalid" required="" aria-required="true" id="name" type="text" name="name[]" value="{{$hotelroomcategory->name }}">
							</div>
							
							<div class="input-field col s4">
								<label for="room_count" class="">Number Of Rooms</label>
								<input class="validate invalid" required="" aria-required="true" id="room_count" type="text" name="room_count[]" value="{{$hotelroomcategory->room_count }}">
							</div>
							
						</div>
						<div class="col s1">
							<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))">
								<i class="material-icons">delete_sweep</i>
							</a>
						</div>
					</div>
                    @endforeach
				@else 
                     <div class="row group">
                        <div class="col s11">
                            <div class="input-field col s4">
                                <select id="type" name="room_type_id[]" tabindex="-1" required="">
                                    <option value="" selected>Select Room Category</option>
                                    @foreach($roomtypes as $roomtype)
                                    <option value="{{$roomtype->id}}">{{$roomtype->room_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-field col s4">
                                <label for="name" class="">Room Category Name</label>
                                <input class="validate invalid" required="" aria-required="true" id="name" type="text" name="name[]">
                            </div>
                            
                            <div class="input-field col s4">
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
                @endif
                </div>
				</div>
				<div class="col s12 text-right">
					<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
						<i class="material-icons">note_add</i>
					</a>
				</div>
				
                <div class="col s6">
                  <p>Status</p>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" value="ACTIVE" name="status" type="radio" @if($hotel->status=='ACTIVE') checked @endif>
                      <span>ACTIVE</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required="" aria-required="true" value="INACTIVE" name="status" type="radio" @if($hotel->status=='INACTIVE') checked @endif>
                    <span>INACTIVE</span>
                  </label>
                  <div class="input-field">
                  </div>
                </div>
                
                <div class="col s6">
                  <p>Approve Vender</p>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" value="1" name="vender_approved" type="radio" @if($hotel->vender_approved==1) checked @endif>
                      <span>Approved</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required="" aria-required="true" value="0" name="vender_approved" type="radio" @if($hotel->vender_approved==0) checked @endif>
                    <span>Not Approved</span>
                  </label>
                  <div class="input-field">
                  </div>
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
								<select id="type" name="room_type_id[]" tabindex="-1" required="">
									<option value="" selected>Select Room Category</option>
									@foreach($roomtypes as $roomtype)
                                    <option value="{{$roomtype->id}}">{{$roomtype->room_type}}</option>
                                    @endforeach
                                </select>
							</div>
							<div class="input-field col s4">
								<label for="name" class="">Room Category Name</label>
								<input class="validate invalid" required="" aria-required="true" id="name" type="text" name="name[]">
							</div>
							
							<div class="input-field col s4">
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