@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
    
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
                  <li class="breadcrumb-item"><a href="index.html">Vendor</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Vendor</a>
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
            <div class="seaction">

 

  <!--Basic Form-->

  <!-- jQuery Plugin Initialization -->
  <div class="row">
    <div class="col s12 m12">
      <div id="basic-form" class="card card card-default scrollspy">
        <div class="card-content" style="width: 100%; display: inline-block;">
          <h4 class="card-title">Add Vendor</h4>
          <form class="col s12" id="add_vender_form" method="post" action="{{ route('vender.store') }}">
            {{csrf_field()}}
            <div class="row">
              <div class="col s12 m3">
				<label for="fn">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
              </div>
              <div class="col s12 m3">
				<label for="email">Email *</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}" required>
              </div>
              <div class="col s12 m3">
				<label for="password">Password *</label>
                <input id="password" type="password" name="password" value="{{ old('password') }}" required minlength="6">
              </div>
              <div class="col s12 m3">
				<label for="vender_type">Vendor Type *</label>
                <select id="vender_type" name="vender_type" required>
                  <option value="" @if( old('vender_type') == '') selected @endif></option>
                  <option value="HOTEL VENDER" @if( old('vender_type') == 'HOTEL VENDER') selected @endif>Hotel Vendor</option>
                  <option value="EVENT VENDER" @if( old('vender_type') == 'EVENT VENDER') selected @endif>Event Vendor</option>
                  <option value="TRANSPORT VENDER" @if( old('vender_type') == 'TRANSPORT VENDER') selected @endif>Transport Vendor</option>
                </select>
              </div>
				  <div class="col s12 m3">
				  <label for="country_id">Country</label>
					<select id="country_id" name="country_id" class="country_id" required> 
						<option value="">Select Country</option>
						@foreach($Countries as $Country)
							<option value="{{ $Country->id }}">{{ $Country->name }}</option>
						@endforeach
					</select>
				  </div>
            
				<div class="col s12 m3 region_list">
					<label for="region_id">State</label>
					<select id="region_id" name="region_id" class="region_id">
					  <option value="">Select State</option>
					</select>
				</div>
            
				<div class="col s12 m3 city_list get_suc_cat">
					<label for="city_id">City</label>
					<select id="city_id" name="city_id" class="get_suc_cat">
					  <option value="">Select City</option>
					</select>
				</div>
                <div class="col s3 verder_submit">
                  <button class="btn cyan waves-effect waves-light " type="submit" name="action" id="add_vender">Submit
                    <i class="material-icons right">send</i>
                  </button>
                </div>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
      
    </div>
  </div>
</div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection

