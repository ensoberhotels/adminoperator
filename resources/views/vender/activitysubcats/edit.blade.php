@extends('vender.template.base')

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
                        <h4 class="card-title">Create New Activity Cat</h4>
                    </div>
					
					
			<form class="add_car_form" id="add_car_form" method="POST" action="{{route('activitysubcats.update', $activitysubcat->id )}}" enctype="multipart/form-data" role="form">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class="col s4">
				  <div class="col s12 m12">
					<p>Activity Cat</p>
				  </div>
				  <div class="col s12 m12">
					<select name="activity_cat_id" class="validate invalid" required="" aria-required="true" id="activity_cat_id">
						<option value="">Select Activity Cat</option>
						@foreach($ActivityCats as $ActivityCat)
							@if($activitysubcat->activity_cat_id == $ActivityCat->id)
								<option value="{{ $ActivityCat->id }}" selected>{{ $ActivityCat->activity_cat }}</option>
							@else
								<option value="{{ $ActivityCat->id }}">{{ $ActivityCat->activity_cat }}</option>
							@endif
						@endforeach
					</select>
				  </div>
				</div>	

				<div class="col s4">
				  <div class="col s12 m12">
					<p>Activity Name</p>
				  </div>
				  <div class="col s12 m12 activity_name">
					<select name="activity_name_id" class="validate invalid activity_name" required="" aria-required="true" id="activity_name_id">
						<option value="">Select Activity Name</option>
						@foreach($ActivityNames as $ActivityName)
							@if($activitysubcat->activity_name_id == $ActivityName->id)
								<option value="{{ $ActivityName->id }}" selected>{{ $ActivityName->activity_name }}</option>
							@else
								<option value="{{ $ActivityName->id }}">{{ $ActivityName->activity_name }}</option>
							@endif
						@endforeach
					</select>
				  </div>
				</div>
				
				<div class="input-field col s4">
					<label for="activity_subcat" class="">Activity Sub Cat *</label>
					<input class="validate invalid" required="" aria-required="true" id="activity_subcat" type="text" name="activity_subcat" value="{{ $activitysubcat->activity_subcat}}">
                </div>
               	
				<div class="col s4">
				  <div class="input-field col s12">
					<select id="country_id" name="country_id" class="country_id"> 
						<option value="">Select Country</option>
						@foreach($Countries as $Country)
							@if($activitysubcat->country_id == $Country->id)
								<option value="{{ $Country->id }}" selected>{{ $Country->name }}</option>
							@else
								<option value="{{ $Country->id }}">{{ $Country->name }}</option>
							@endif
						@endforeach
					</select>
					<label for="country_id" >Country</label>
				  </div>
				</div>
				<div class="col s4">
				  <div class="input-field col s12 region_list">
					<select id="region_id" name="region_id">
					  <option value="">Select State</option>
						@foreach($Regions as $Region)
							@if($activitysubcat->region_id == $Region->id)
								<option value="{{ $Region->id }}" selected>{{ $Region->name }}</option>
							@else
								<option value="{{ $Region->id }}">{{ $Region->name }}</option>
							@endif 
						@endforeach
					</select>
					<label for="region_id">State</label>
				  </div>
				</div>
				<div class="col s4">
				  <div class="input-field col s12 city_list">
					<select id="city_id" name="city_id">
					  <option value="">Select City</option>
						@foreach($Citys as $City)
							@if($activitysubcat->city_id == $City->id)
								<option value="{{ $City->id }}" selected>{{ $City->name }}</option>
							@else
								<option value="{{ $City->id }}">{{ $City->name }}</option>
							@endif
						@endforeach
					</select>
					<label for="city_id">City</label>
				  </div>
				</div>
				
                <div class="col s12">
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