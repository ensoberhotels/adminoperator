@extends('vender.template.base')

@section('title', 'Ensober Vender Dashboard ')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
    <style>
        .step-actions {
            float: right;
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

                    <ul class="stepper linear" id="linearStepper">
                        <li class="step active">
                            <div class="step-title waves-effect">Step 1</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="firstName1">First Name: <span class="red-text">*</span></label>
                                        <input type="text" id="firstName1" name="firstName1" class="validate" required>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="lastName1">Last Name: <span class="red-text">*</span></label>
                                        <input type="text" id="lastName1" class="validate" name="lastName1" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="Email">Email: <span class="red-text">*</span></label>
                                        <input type="email" class="validate" name="Email" id="Email" required>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="contactNum">Contact Number: <span class="red-text">*</span></label>
                                        <input type="number" class="validate" name="contactNum" id="contactNum"
                                            required>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="reset">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step" disabled>
                                                <i class="material-icons left">arrow_back</i>
                                                Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step"
                                                type="submit">
                                                Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="step">
                            <div class="step-title waves-effect">Step 2</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="proposal1">Proposal Title: <span class="red-text">*</span></label>
                                        <input type="text" class="validate" id="proposal1" name="proposal1" required>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="job1">Job Title: <span class="red-text">*</span></label>
                                        <input type="text" class="validate" id="job1" name="job1" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="company1">Previous Company:</label>
                                        <input type="text" class="validate" id="company1" name="company1">
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="url1">Video Url:</label>
                                        <input type="url" class="validate" id="url1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="exp1">Experience: <span class="red-text">*</span></label>
                                        <input type="text" class="validate" id="exp1" name="exp1">
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="desc1">Short Description: <span class="red-text">*</span></label>
                                        <textarea name="desc" id="desc1" rows="4"
                                            class="materialize-textarea"></textarea>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="reset">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>
                                                Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step"
                                                type="submit">
                                                Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="step">
                            <div class="step-title waves-effect">Step 3</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="eventName1">Event Name: <span class="red-text">*</span></label>
                                        <input type="text" class="validate" id="eventName1" name="eventName1" required>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <select>
                                            <option value="Select" disabled selected>Select Event Type</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="Party">Party</option>
                                            <option value="FundRaiser">Fund Raiser</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <select>
                                            <option value="Select" disabled selected>Select Event Status</option>
                                            <option value="Planning">Planning</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <select>
                                            <option value="Select" disabled selected>Event Location</option>
                                            <option value="New York">New York</option>
                                            <option value="Queens">Queens</option>
                                            <option value="Washington">Washington</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="Budget1">Event Budget: <span class="red-text">*</span></label>
                                        <input type="Number" class="validate" id="Budget1" name="Budget1">
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <p> <label>Requirments</label></p>
                                        <p> <label>
                                                <input type="checkbox">
                                                <span>Staffing</span>
                                            </label></p>
                                        <p><label>
                                                <input type="checkbox">
                                                <span>Catering</span>
                                            </label></p>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m6 s12 mb-1">
                                            <button class="red btn mr-1 btn-reset" type="reset">
                                                <i class="material-icons">clear</i>
                                                Reset
                                            </button>
                                        </div>
                                        <div class="col m6 s12 mb-1">
                                            <button class="waves-effect waves-dark btn btn-primary"
                                                type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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