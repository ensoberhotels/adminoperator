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
                  <li class="breadcrumb-item"><a href="#">Edit Hotel Season Rate</a>
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
                        <h4 class="card-title">Update Hotel Season Rate</h4>
                    </div>
			<form class="add_hotel_season_rate1_form" id="add_hotel_season_rate1_form" method="POST" action="{{ route('hotelseasonrate.update',$hotelseasonrate->id) }}" >
			{{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
              <div class="row"> 
			  
				<div class="">
								
				<div class="" id="details">
					<div class="row group">
						<div class=" col s12 m2">
							<label for="room_type_id" class="">Room Category</label>
							<select name="room_type_id" class="validate invalid" required="" aria-required="true" id="room_category_id">
								@foreach($roomcategories as $roomcategory)
									<option value="{{ $roomcategory->room_type_id }}" @if($roomcategory->room_type_id==$hotelseasonrate->room_type_id) selected @endif >{{ $roomcategory->type }} </option>
								@endforeach
							</select>
						</div>
						<div class=" col s12 m2">
							<label for="start_date" class="">Start Date</label>
							<input class="validate" required="" aria-required="true" id="start_date" type="date" name="start_date" value="{{ $hotelseasonrate->start_date }}">
						</div>
						<div class=" col s12 m2">
							<label for="end_date" class="">End Date</label>
							<input class="validate" required="" aria-required="true" id="end_date" type="date" name="end_date" value="{{ $hotelseasonrate->end_date }}">
						</div>
						
						<div class=" col s12 m1">
							<label for="ap_price" class="">AP Price</label>
							<input class="validate invalid" required="" aria-required="true" id="ap_price" type="number" name="ap_price" value="{{ $hotelseasonrate->ap_price }}">
						</div>
						
						<div class=" col s12 m1">
							<label for="map_price" class="">MAP Price</label>
							<input class="validate invalid" required="" aria-required="true" id="map_price" type="number" name="map_price" value="{{ $hotelseasonrate->map_price }}">
						</div>
						
						<div class=" col s12 m1">
							<label for="cp_price" class="">CP Price</label>
							<input class="validate invalid" required="" aria-required="true" id="cp_price" type="number" name="cp_price" value="{{ $hotelseasonrate->cp_price }}">
						</div>
						
						<div class=" col s12 m1">
							<label for="ep_price" class="">EP Price</label>
							<input class="validate invalid" required="" aria-required="true" id="ep_price" type="number" name="ep_price" value="{{ $hotelseasonrate->ep_price }}">
						</div>
						<div class="col s12 m2">
						<p>Status</p>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" value="ACTIVE" name="status" type="radio" @if($hotelseasonrate->status=='ACTIVE') checked @endif>
                      <span>ACTIVE</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required="" aria-required="true" value="INACTIVE" name="status" type="radio" @if($hotelseasonrate->status=='INACTIVE') checked @endif>
                    <span>INACTIVE</span>
                  </label>
                  <div class="">
                  </div>
                </div>
            </div>
            </div>
			</div>
				</div>
								
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

