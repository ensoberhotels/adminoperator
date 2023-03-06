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
		.via_main {
			float: left;
			width: 100%;
		}
		div#via_all {
			border-left: 0px solid;
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
                  <li class="breadcrumb-item"><a href="index.html">Via</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Via</a>
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
                        <h4 class="card-title">Via Route</h4>
                    </div>
					<div class="divider"></div><br>
					
			<form class="add_hotel_season_rate1_form" id="add_hotel_season_rate1_form" method="POST" action="{{ route('via.store') }}" >
			{{csrf_field()}}
              <div class="row"> 
			  
				<div class="">
				
				
				<div class="" id="details">
					<div class="row group">
						<div class="col s12"> 
							<div class="col s12 m3 room_category_id">
								<label for="start_destination" class="active">Start Distination</label>
								<select  required="" aria-required="true" id="get_hotels" name="start_destination" class="start_destination" onchange="hotelRate();"> 
									<option value="">Select Distination</option>
									@foreach($cities as $city)
									<option value="{{$city->city_id}}">{{$city->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col s12 m3">
								<label for="to_destination" class="active">To Distination</label>
								<select  required="" aria-required="true" id="get_hotels" name="to_destination" class="to_destination" onchange="hotelRate();"> 
									<option value="">Select Distination</option>
									@foreach($cities as $city)
									<option value="{{$city->city_id}}">{{$city->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="divider"></div><br>
						<div class="col s12" id="via_all"> 
							<div class="via_main">
								<div class=" col s12 m3">
									<label for="googleaddress" class="">Via</label>
									<input class="validate invalid" aria-required="true" id="googleaddress" type="text" name="via[]">
								</div>
								
								<div class=" col s12 m3">
									<label for="distance" class="">Distance (KM)</label>
									<input class="validate invalid" required="" aria-required="true" id="distance" type="number" name="distance[]">
								</div>
								
								<div class=" col s12 m3">
									<label for="duration" class="">Duration (H)</label>
									<input class="validate invalid" required="" aria-required="true" id="duration" type="text" name="duration[]">
								</div>
								<div class="col s12 m3">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="col s11 text-right">
					<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
						<i class="material-icons">note_add</i>
					</a>
				</div>
				<br>
                <div class="col s12 m6">
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
    		$('#via_all').append(`<div class="via_main">
								<div class=" col s12 m3">
									<label for="googleaddress" class="">Via</label>
									<input class="validate invalid" required="" aria-required="true" id="googleaddress" type="text" name="via[]">
								</div>
								
								<div class=" col s12 m3">
									<label for="distance" class="">Distance (KM)</label>
									<input class="validate invalid" required="" aria-required="true" id="distance" type="number" name="distance[]">
								</div>
								
								<div class=" col s12 m3">
									<label for="duration" class="">Duration (H)</label>
									<input class="validate invalid" required="" aria-required="true" id="duration" type="text" name="duration[]">
								</div>
								<div class="col s12 m3">
									<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))">
										<i class="material-icons">delete_sweep</i>
									</a>
								</div>
							</div>`);
    	}
		
		function remove(e){
			e.parents('.via_main').remove()
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYtRMxZjFO_qkNg2px9NHNbNmm7_6Xed4&libraries=places&callback=initAutocomplete"
	async defer></script>
@endsection