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
                  <li class="breadcrumb-item"><a href="#">Activity</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Activity Cat</a>
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
                        <h4 class="card-title">Create New Activity</h4>
                    </div>
					
					
			<form class="add_car_form" id="add_car_form" method="POST" action="{{ route('activity.store') }}" enctype="multipart/form-data" role="form">
			{{csrf_field()}}
              <div class="row" style="margin-bottom:20px;">
				<!--<div class="col s12 m3">
				  <div class="">
					<label>Activity</label>
					<input class="validate invalid" required="" aria-required="true" type="text" name="activity_name">
				  </div>
				</div>-->
				
                <div class="col s12 m3">
					<label>Activity Cat</label>
					<select name="activity_cat_id" class="validate invalid activity_cat_id get_suc_cat" required="" aria-required="true" id="activity_cat_id">
						<option value="">Select Activity Cat</option>
						@foreach($ActivityCats as $ActivityCat)
							<option value="{{ $ActivityCat->id }}">{{ $ActivityCat->activity_cat }}</option>
						@endforeach
					</select>
				</div>	
				<div class="col s12 m3">
				  <div class="activity_subcat_list">
					<label>Activity Sub Cat</label>
						<select id="activity_subcat_id" name="activity_subcat_id">
							<option value="">Select Activity Sub Cat</option>
						</select>
				  </div>
				</div>

				<!--<div class="col s12 m3">
				  <div class="activity_name">
					<label>Display Name</label>
					<select name="activity_name_id" class="validate invalid activity_name" required="" aria-required="true" id="activity_name_id">
						<option value="">Select Activity Name</option>
					</select>
				  </div>
				</div>-->
				
				<div class="col s12 m3">
					<label>Country</label>
					<select id="country_id" name="country_id" class="country_id"> 
						<option value="">Select Country</option>
						@foreach($Countries as $Country)
							<option value="{{ $Country->id }}" @if($Country->id == '96') {{'selected'}} @endif>{{ $Country->name }}</option>
						@endforeach
					</select>
				</div>
			
				<div class="col s12 m3">
				  <div class="region_list">
					<label>State</label>
					<select id="region_id" name="region_id" class="region_id">
					  <option value="">Select State</option>
					</select>
				  </div>
				</div>
				
				<div class="col s12 m3">
				  <div class="city_list">
					<label>City</label>
					<select id="city_id" name="city_id">
					  <option value="">Select City</option>
					</select>
				  </div>
				</div>
			
				<div class="col s12 m3">
					<label>Actual Price</label>
					<input class="validate invalid" required="" aria-required="true" id="actual_price" type="text" name="actual_price">
				</div>
				<div class="col s12 m3">
					<label>Price</label>
					<input class="validate invalid" required="" aria-required="true" id="price" type="text" name="price">
				</div>
                <!--<div class=" col s12 m3">
					<label>Vendor</label>
                    <select aria-required="true" id="vender_id" name="vender_id" class="vender_id"> 
						<option value="">Select Vendor</option>
						@foreach($venders as $vender)
							<option value="{{ $vender->id }}">{{ $vender->name }}</option>
						@endforeach
					</select>
                </div>-->
				
				<div class="col s12 m3">
					<label>Morning Time</label>
					<input class="validate invalid" required="" aria-required="true" id="morning_slot" type="text" name="morning_slot" value="06:00 AM - 06:30 AM">
				</div>
			
				<div class="col s12 m3">
					<label>Evening Time</label>
					<input class="validate invalid" required="" aria-required="true" id="evening_slot" type="text" name="evening_slot" value="02:00 PM - 02:30 PM">
				</div>
                <div class=" col s12 m3">
					<label>Activity Image</label>
                    <input class="validate invalid" required="" aria-required="true" id="image" type="file" name="image">
                </div>
				
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
                  <p>Approve Vendor</p>
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
                <div class="col s12 m3">
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
                <div class=" col s12 m3">
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
    <!--<script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>-->
    <script src="{{ URL::asset('asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
@endsection