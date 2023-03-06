@extends('operator.template.base')

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
                  <li class="breadcrumb-item"><a href="index.html">Sale</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Update Sales</a>
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
                        <h3 class="card-title"><strong>Sales</strong></h3>
                    </div>
                    
                    
            <form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="POST" action="{{ route('sales.update',$sale->id) }}" >
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class="">
                <div class="row" id="details">
                    <div class="row group">
                        <div class="col s11"> 
                            <div class="input-field col s3">
                               <strong>Lead Id : {{ $sale->lead_id }}</strong>
                            </div>
                            <div class="input-field col s3">
                                <strong>Quotation Id:  {{ $sale->quotation_id }}</strong>
                            </div>
                            <div class="input-field col s3">
                                <strong>Operator id     :  {{ $sale->operator_id }}</strong>
                            </div>
                            <div class="input-field col s3">
                                <strong>Vender id     :  {{ $sale->vender_id }}</strong>
                            </div>
                            <div class="input-field col s3">
                                <strong>User id     :  {{ $sale->user_id }}</strong>
                            </div>
                            <div class="input-field col s3">
                                <label for="mobile" class="">Total Amount</label>
                                <input class="validate invalid" required="" aria-required="true" id="total_amount" type="text" name="total_amount" autocomplete="off" value="{{ $sale->total_amount }}" >
                            </div>
                            <div class="input-field col s3">
                                <label for="mobile" class="">Paid Amount</label>
                                <input class="validate invalid" required="" aria-required="true" id="paid_amount" type="text" name="paid_amount" autocomplete="off" value="{{ $sale->paid_amount }}" >
                            </div>
                            <div class="input-field col s3">
                                <label for="mobile" class="">Due Amount</label>
                                <input class="validate invalid" required="" aria-required="true" id="due_amount" type="text" name="due_amount" autocomplete="off" value="{{ $sale->due_amount }}" >
                            </div>
                            <div class="input-field col s3">
                                <label for="mobile" class="">Payment Method</label>
                                <input class="validate invalid" required="" aria-required="true" id="payment_method" type="text" name="payment_method" autocomplete="off" value="{{ $sale->payment_method }}" >
                            </div>
                     <div class="col s12">
                            <p>Status</p>
                            <p>
                            <label>
                            <input class="validate" required="" aria-required="true" value="PAID" name="status" type="radio" @if($sale->status=='PAID') checked @endif >
                            <span>PAID</span>
                            </label>
                            </p>
                            <label>
                            <input class="validate" required="" aria-required="true" value="UNPAID" name="status" type="radio" @if($sale->status=='UNPAID') checked @endif >
                            <span>UNPAID</span>
                            </label>
                       </div>                        
                           
                        </div>
                   </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light right" type="submit" name="action" id="add_lead">Submit
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
    
    <script>
    
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById("googleaddress")),
            {types: ["geocode"]});
    }
    
    $(document).ready(function() {
     /* $('#lead_source').change(function() {
            var value = $(this).val();
            if (value == 'Travel Agent' || value == 'Reference'){
                $('#reference_name_field').show();
            }else{
                $('#reference_name_field').hide();
            }
      });*/
      
     /* $('#enquiry_type').change(function() {
            var value = $(this).val();
            if (value == 'Own Hotel' || value == 'Partner Hotel'){
                $('#hotel_enquiry').show();
                $('#other_enquiry_field').hide();
                
            }else if (value == 'Other'){
                $('#hotel_enquiry').hide();
                $('#other_enquiry_field').show();
            }else{
               $('#hotel_enquiry').hide();
                $('#other_enquiry_field').hide(); 
            }
      });*/
      
      $('#quotation_status').change(function() {
            var value = $(this).val();
            if (value == 'CLOSED'){
                $('#closed_reason_field').show();
            }else{
                $('#closed_reason_field').hide();
            }
      });
});

    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1mefnF88BCHGzDBEmv2FYFYWkjtVli0w&libraries=places&callback=initAutocomplete"
    async defer></script>
@endsection