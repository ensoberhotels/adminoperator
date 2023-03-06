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
                  <li class="breadcrumb-item"><a href="index.html">Car</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Update Car</a>
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
                        <h4 class="card-title">Update Transport</h4>
                    </div>
                    
                    
            <form class="add_car_form" id="add_car_form" method="POST" action="{{route('transports.update', $data->id )}}" enctype="multipart/form-data" role="form">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class="input-field col s4">
                    <select id="car_id" name="car_id" tabindex="-1">
                        <option value="" selected>Select Car</option>
                        @foreach($cars as $car)
                            @if($car->id == $data->car_id)
                                <option value="{{$car->id}}" title="Car Name." selected>{{$car->car_name}}</option>
                            @else
                                <option value="{{$car->id}}" title="Car Name.">{{$car->car_name}}</option>
                            @endif
                        @endforeach
                        
                    </select>
                </div>
                
                <div class="input-field col s4"> 
                  <p>Car Segment : <span id="text_segment">{{ $car_segment->name }}</span></p> 
                  <p>Car Model : <span id="text_model">{{ $car_model->name }}</span></p> 
                  <p>Car Seats : <span id="text_seats">{{ $car_seat->seats }}</span></p> 
                  <input  id="car_segment_id" type="hidden" name="car_segment_id" value="{{ $data->car_segment_id }}">
                  <input  id="car_model_id" type="hidden" name="car_model_id" value="{{ $data->car_model_id }}">
                  <input  id="car_seats_id" type="hidden" name="car_seats_id" value="{{ $data->car_seats_id }}">
                </div>
                
                <!--<div class="input-field col s4">
                  <label for="available_seat" class="">Available Seat *</label>
                  <input class="validate invalid" required="" aria-required="true" id="available_seat" type="number" name="available_seat" value="{{ $data->available_seat }}">
                </div>-->
                
                <div class="input-field col s4">
                    <select  id="country_id" name="country_id" class="country_id">
                        <option value="">Select Country</option>
                                    @foreach($Countries as $Country)
                                        <option value="{{ $Country->id }}" @if($data->country_id==$Country->id) selected @endif>{{ $Country->name }}</option>
                                    @endforeach
                    </select>
                </div>
                <div class="input-field col s4 region_list">
                    <select   id="region_id" name="region_id" class="validate region_id">
                        <option value="">Select State</option>
                                    @foreach($Regions as $Region)
                                        <option value="{{ $Region->id }}" @if($data->region_id==$Region->id) selected @endif >{{ $Region->name }}</option>
                                    @endforeach
                </select>
                </div>
                <div class="input-field col s4 city_list get_suc_cat">
                    <select  id="city_id" name="city_id" class="validate get_suc_cat">
                      <option value="">Select City</option>
                                  @foreach($Cities as $City)
                                        <option value="{{ $City->id }}" @if($data->city_id==$City->id) selected @endif >{{ $City->name }}</option>
                                    @endforeach

                </select>
                </div>
                
                <div class="input-field col s4">
                    <select id="type" name="type" tabindex="-1">
                        <option value="" selected>Select Type</option>
                        <option value="AIRPICKUP" title="This is for airport pickup only." @if($data->type=='AIRPICKUP') selected @endif>AIRPORT PICKUP</option>
                            <option value="AIRDROPUP" title="This is for airport dropup only." @if($data->type=='AIRDROPUP') selected @endif>AIRPORT DROPUP</option>
                            <option value="PERDAY" title="This is for one day booking." @if($data->type=='PERDAY') selected @endif>PER DAY</option>
                    </select>
                </div>
                <div class="input-field col s4">
                  <label for="fare" class="">Fare *</label>
                  <input class="validate invalid" required="" aria-required="true" id="fare" type="text" name="fare" value="{{ $data->fare }}">
                </div>
                
                <div class="input-field col s4">
                  <label for="perday_km" class="">Per day KM *</label>
                  <input class="validate invalid" required="" aria-required="true" id="perday_km" type="text" name="perday_km" value="{{ $data->perday_km }}">
                </div>
                <div class="input-field col s4">
                  <label for="perkm_fare" class="">Per KM Fare*</label>
                  <input class="validate invalid" required="" aria-required="true" id="perkm_fare" type="text" name="perkm_fare" value="{{ $data->perkm_fare }}">
                </div>
               @if($data->vender_approved==1)
                    
                <div class="col s12">
                  <p>Status</p>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" value="ACTIVE" name="status" type="radio" @if($data->status=='ACTIVE') checked @endif>
                      <span>ACTIVE</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required="" aria-required="true" value="INACTIVE" name="status" type="radio" @if($data->status=='INACTIVE') checked @endif >
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
                @endif
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