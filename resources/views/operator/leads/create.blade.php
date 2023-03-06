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
        
		#mobile-list {
			float: left;
			list-style: none;
			margin-top: 0px;
			padding: 0;
			width: 196px;
			height: 200px;
			position: absolute;
			z-index: 9;
			overflow-y: scroll;
		}
        #mobile-list li {
			padding: 7px;
			font-size: 13px;
			color: #f6f4f4;
			background: #0b064f;
			border-bottom: #efe8e8 1px solid;
		}
        #mobile-list li:hover{background:#f6f4f4; border-bottom: #0b064f 1px solid; color:#0b064f; cursor: pointer;}
        .select-wrapper input.select-dropdown {display: none;}
        .select-wrapper ul, .select-wrapper svg.caret { display: none !important; }
		input:focus { border: 2px solid #ac8f8f !important;}
		select:focus { border: 2px solid #ac8f8f !important;} 
		textarea:focus { border: 2px solid #ac8f8f !important;} 
        
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
                  <li class="breadcrumb-item"><a href="index.html">Lead</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add lead</a>
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
                        <h3 class="card-title"><strong>Lead</strong></h3>
                    </div>
                    
                    
            <form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="POST" action="{{ route('leads.store') }}" >
			<input type="hidden" name="assign_to" id="assign_to" value="{{ $operator_id[0] }}">
            {{csrf_field()}}
              <div class="row">
              
                <div class="">
                <div class="" id="details">
					&nbsp;&nbsp;<strong>Lead Number : ------- </strong> &nbsp;&nbsp; <strong>Date :  {{ date('d M Y') }}</strong>
                    <div class="row group">
                        <div class="col s12"> 
                            <div class="col s12 m2" style="display:none;">
								<strong>Lead Number : {{ $lead_no }}</strong>
								<input class="validate" aria-required="true" id="lead_no" type="hidden" name="lead_no" value="{{ $lead_no }}">
                            </div>
                            <div class=" col s12 m2" style="display:none;">
                                <strong>Date :  {{ date('d M Y') }}</strong>
                                <input class="validate" required="" aria-required="true" id="create_date" type="hidden" name="create_date" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class=" col s12 m2">
                                <label for="mobile" class="">Mobile</label>
								<input name="mobile" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="mobile">
                                <!--<input class="validate invalid" required="" aria-required="true" id="mobile" type="number" name="mobile" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">-->
                                <div id="suggesstion-box"></div>
								

                            </div> 
							<div class=" col s12 m2">
                                <label for="name" class="">Guest Name</label>
                                <input class="validate invalid" required="" aria-required="true" id="name" type="text" name="name">
                            </div>
                            <div class=" col s12 m2 show_select">
								<label>Lead Source</label>
                                <select id="lead_source" name="lead_source" required="">
                                  <option value="" @if( old('lead_source') == '') selected @endif>Select Lead Source</option>
                                  <option value="Travel Agent" @if( old('lead_source') == 'Travel Agent') selected @endif>Travel Agent</option>
                                  <option value="Website" @if( old('lead_source') == 'Website') selected @endif>Website</option>
                                  <option value="Reference" @if( old('lead_source') == 'Reference') selected @endif>Reference</option>
                                  <option value="Direct" @if( old('lead_source') == 'Direct') selected @endif>Direct</option>
                                  <option value="Emailer" @if( old('lead_source') == 'Emailer') selected @endif>Emailer</option>
                                  <option value="Existing Cust" @if( old('lead_source') == 'Existing Cust') selected @endif>Existing Cust</option>
                                  <option value="Calling" @if( old('lead_source') == 'Calling') selected @endif>Calling</option>
								  <option value="Just Dial" @if( old('lead_source') == 'Just Dial') selected @endif>Just Dial</option>
                                </select>             
                             </div>
							 
							<div class=" col s12 m2" id="reference_name_field" style="display: none;">
                                <label for="name" class="">Agent/Refrence Name</label>
                                <input class="validate invalid"  id="reference_name" type="text" name="reference_name">
                            </div>
							<div class=" col s12 m2" id="lead_comment_field" >
                                <label for="infant" class="">Lead Comment</label>
                                <textarea cols="" rows="" id="lead_comment" name="lead_comment" required=""></textarea>
							</div>
                        
                            
                            
						</div>
						<div class="col s12"> 
							<div class=" col s12 m2">
                                <label for="email" class="">Email</label>
                                <input class="validate invalid" aria-required="true" id="email" type="email" name="email">
                            </div>
                           <!-- <div class=" col s12 m2">
                                <label for="location" class="">Location</label>
                                <select id="location" name="location" class="location"> 
                                    <option value="">Select Country</option>
                                    @foreach($Countries as $Country)
                                        <option value="{{ $Country->id }}">{{ $Country->name }}</option>
                                    @endforeach
                                </select>

                            </div>-->
                            <div class=" col s12 m2 show_select">    
                                <label for="customer_type" class="">Lead Type</label>
                                <select id="customer_type" name="customer_type">
                                  <option value="" @if( old('customer_type') == '') selected @endif>Select Lead Type</option>
                                  <option value="B2B" @if( old('customer_type') == 'B2B') selected @endif>B2B</option>
                                  <option value="B2C" @if( old('customer_type') == 'B2C') selected @endif>B2C</option>
                                  <option value="Referred" @if( old('customer_type') == 'Referred') selected @endif>Referred</option>
                                </select> 
                            </div> 
                            <div class=" col s12 m2 show_select">    
                                <label for="lead_priority" class="">Lead Priority</label>
                                <select id="lead_priority" name="lead_priority">
                                  <option value="" @if( old('lead_priority') == '') selected @endif>Select Lead Priority</option>
                                  <option value="Hot" @if( old('lead_priority') == 'Hot') selected @endif>Hot</option>
                                  <option value="Warm" @if( old('lead_priority') == 'Warm') selected @endif>Warm</option>
                                  <option value="Cold" @if( old('lead_priority') == 'Cold') selected @endif>Cold</option>
                                </select>
                            </div>
							<div class=" col s12 m2 show_select">
								<label>Enquiry For</label>
								<select id="enquiry_type" name="enquiry_type" required>
								  <option value="" @if( old('enquiry_type') == '') selected @endif>Select Enquiry For</option>
								  <option value="Own Hotel" @if( old('enquiry_type') == 'Own Hotel') selected @endif>Own Hotel</option>
								  <option value="Partner Hotel" @if( old('enquiry_type') == 'Partner Hotel') selected @endif>Partner Hotel</option>
								  <option value="Other" @if( old('enquiry_type') == 'Other') selected @endif>Other</option>
								</select>
							</div>
                            <div class=" col s12 m2 show_select">
								<label>Send Alert</label>
								<select id="enquiry_type" name="send_message">
								  <option value="WHATSAPP">WHATS APP</option>
								  <option value="EMAIL">EMAIL</option>
								  <option value="WHATSAPPEMAIL" >WHATSAPP & EMAIL</option>
								  <option value="DON'TSEND" selected>DON'T SEND</option>
								</select>
							</div>
						</div>
                   </div>
                </div>
                </div>
              </div>
              <div class="row">
				<div class="card-header">
					<h3 class="card-title"><strong>Query Details</strong></h3>
				</div>
                    
              <div class="" id="details">
                <div class="row group">
                  <div class="col s12">
						<div class=" col s12 m2 show_select">    
                               <label for="trip_type" class="">Guest Type</label>
                                <select id="trip_type" name="trip_type">
                                  <option value="" @if( old('trip_type') == '') selected @endif>Select Guest Type</option>
                                  <option value="New" @if( old('trip_type') == 'New') selected @endif>New</option>
                                  <option value="Returning" @if( old('trip_type') == 'Returning') selected @endif>Returning</option>
                                  </select>  
                            </div>
                            <div class=" col s12 m2 show_select" id="hotel_enquiry" style="display: none;">
                                <label>Hotel Name</label>
                                <select name="hotel_id" class="validate invalid" id="hotel_id">
                                        <option value="" ) selected >Select Hotel</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->hotel_name }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class=" col s12 m2" id="other_enquiry_field" style="display: none;">
                                <label for="other_enquiry" class="">Hotel Name</label> 
                                <input class="validate invalid"  aria-required="true" id="other_enquiry" type="text" name="other_enquiry">
                            </div>
							<div class=" col s12 m2 show_select hotel_type_d">
								<label>Hotel Type</label>
                                <select id="hotel_type" name="hotel_type"> 
                                    <option value="">Select Hotel Type</option>
                                    <option value="one">One Start</option>
                                    <option value="two">Two Start</option>
                                    <option value="three">Three Start</option>
                                    <option value="four">Four Start</option>
                                    <option value="five">Five Start</option>
                                    
                                </select>
                            </div>
                            
                            <div class=" col s12 m2 show_select country_id_d">
                                <label for="d_country" class="">Destination Country</label>
                                <select id="country_id" name="country_id" class="country_id"> 
                                    <option value="">Select Country</option>
                                    @foreach($Countries as $Country)
                                        <option value="{{ $Country->id }}">{{ $Country->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        <div class=" col s12 m2 region_list show_select region_id_d">
                                <label for="d_region" class="">Destination State</label>
                                <select id="region_id" name="region_id" class="region_id">
                                  <option value="">Select State</option>
                                </select>
                        </div>
                        <div class=" col s12 m2 city_list get_suc_cat show_select city_id_d">
                               <label for="d_city" class="">Destination City</label>
                                <select id="city_id" name="city_id" class="get_suc_cat">
                                  <option value="">Select City</option>
                                </select>
                        </div> 
						<div class=" col s12 m2 googleaddress_d">
							<label for="location" class="">Location</label>
							<input class="validate invalid" aria-required="true" id="googleaddress" type="text" name="location" placeholder="Enter a location" autocomplete="off">
						</div>
                         <div class=" col s12 m2">
                                <label for="start_date" class="">Start Date</label>
                                <input class="validate invalid" aria-required="true" id="start_date" type="date" name="start_date">
                         </div>
                         <!--<div class=" col s12 m2">
                                <label for="end_date" class="">End Date</label>
                                <input class="validate invalid" required="" aria-required="true" id="end_date" type="date" name="end_date">
                         </div>-->
                         <div class=" col s12 m2">
                                <label for="end_date" class="">No Of Nights</label>
                                <input class="validate invalid" aria-required="true" id="no_nights" type="number" name="no_nights">
                         </div>
                         <div class=" col s12 m2">
                                <label for="no_room" class="">No of Room</label>
                                <input class="validate invalid"  aria-required="true" id="no_room" type="number" name="no_room">
                         </div>
                         <div class=" col s12 m2 show_select">
							<label for="sharing" class="">Room Sharing</label>
                            <select id="sharing" name="sharing"> 
                                <option value="">Select Sharing</option>
                                <option value="single">Single Sharing</option>
                                <option value="double">Double Sharing</option>
                                <option value="triple">Triple Sharing</option>
                                <option value="quad">Quad Sharing</option>
                                <option value="penta">Penta Sharing</option>
                            </select>
                                
                         </div>
                         <div class=" col s12 m2">
                                <label for="pax" class="">No of Adults</label>
                                <input class="validate invalid" aria-required="true" id="pax" type="number" name="pax">
                         </div>
                         <div class=" col s12 m2">
                                <label for="kids" class="">No of Kids</label>
                                <input class="validate invalid" aria-required="true" id="kids" type="number" name="kids">
                         </div>
                         <div class=" col s12 m2">
                                <label for="infant" class="">No of Infant</label>
                                <input class="validate invalid" aria-required="true" id="infant" type="number" name="infant">
                         </div>
                         <!--<div class=" col s12 m2 show_select">  
							<label for="lead_status" class="">Lead Status</label>
                                <select id="lead_status" name="lead_status">
                                  <option value="LEAD" @if( old('lead_status') == '') selected @endif>Select Lead Status</option>
                                  <option value="LEAD" @if( old('lead_status') == 'LEAD') selected @endif>LEAD</option>
                                  <option value="QUOTATION" @if( old('lead_status') == 'QUOTATION') selected @endif>QUOTATION</option>
                                  </select>  
                            </div>
                            
					
                        <div class="col s12 m2">
                            <p>Status</p>
                            <p>
                            <label>
                            <input class="validate" required="" aria-required="true" value="ACTIVE" name="status" type="radio" checked>
                            <span>ACTIVE</span>
                            </label>
                            </p>
                            <label>
                            <input class="validate" required="" aria-required="true" value="INACTIVE" name="status" type="radio" >
                            <span>INACTIVE</span>
                            </label>
                        <div class="">    </div>
                       </div>-->
                  </div>
                </div>
              </div>
			  
			  
			  <div class="" id="details">
                <div class="row group">
                  <div class="col s12">
					<div class="card-header">
                        <h3 class="card-title"><strong>Lead Followup</strong></h3>
						</div>
					   <div class=" col s12 m2">
							<label for="name" class="">Followup Date</label>
							<input class="validate invalid" required="" aria-required="true" id="name" type="date" name="followup_date">
						</div>
						<div class=" col s12 m2">
							<label for="name" class="">Followup Time</label>
							<input class="validate invalid" required="" aria-required="true" id="name" type="time" name="followup_time">
						</div>
						<div class=" col s12 m2">
						  <button class="btn waves-effect waves-light" type="submit" name="action" id="add_lead">Submit
							<i class="material-icons right">send</i>
						  </button>
						</div>
				  </div>
				</div>
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
		// Trim the mobile number last 10 Digits
		jQuery("#mobile").keyup(function(){ 
			var mobile = jQuery(this).val();
			if(mobile.length > 10){
				var mobile = mobile.substr(mobile.length - 10);
				jQuery(this).val(mobile);
			}
		});
		jQuery("select").each(function(){
			jQuery(this).attr('tabindex', 0);
		});
      $('#lead_source').change(function() {
            var value = $(this).val();
            if (value == 'Travel Agent' || value == 'Reference'){
                $('#reference_name_field').show();
            }else{
                $('#reference_name_field').hide();
            }
      });
      
      $('#enquiry_type').change(function() {
            var value = $(this).val();
            if (value == 'Own Hotel' || value == 'Partner Hotel'){
                $('#hotel_enquiry').show();
                $('#other_enquiry_field').hide();
				
                $('.hotel_type_d').hide();
                $('.country_id_d').hide();
                $('.region_id_d').hide();
                $('.city_id_d').hide();
                $('.googleaddress_d').hide();
				
            }else if (value == 'Other'){
                $('#hotel_enquiry').hide();
                $('#other_enquiry_field').show();
				
				$('.hotel_type_d').show();
                $('.country_id_d').show();
                $('.region_id_d').show();
                $('.city_id_d').show();
                $('.googleaddress_d').show();
            }else{
               $('#hotel_enquiry').hide();
                $('#other_enquiry_field').hide();

				$('.hotel_type_d').show();
                $('.country_id_d').show();
                $('.region_id_d').show();
                $('.city_id_d').show();
                $('.googleaddress_d').show();
            }
      });
      
      $("#mobile").keyup(function(){
          $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
		  });
      var keyword = $(this).val();
      var keywordlen = $(this).val().length;
      if(keyword!='' && keywordlen >= 7){
      //if(keyword!=''){
        $.ajax({
        type: "POST",
        url: "/admin/ajaxGetMobile",
        data:{'keyword':keyword},
        cache: false,
        async:false,
        success: function(data){
            var   data = JSON.parse(data);
            if(data.status == true && data.html != '<ul id=\"mobile-list\"><\/ul>'){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data.html);
            }else{
              $("#suggesstion-box").hide();
            $("#suggesstion-box").html('');  
            }
         }
        });
      }else{
         $("#suggesstion-box").hide();
         $("#suggesstion-box").html('');  
      }
    });
});
function selectMobile(val) {
$("#mobile").val(val);
$("#suggesstion-box").hide();
  $.ajax({
        type: "POST",
        url: "/admin/ajaxGetLeadDetail",
        data:{'mobile':val},
        cache: false,
        async:false,
        success: function(data){
            var   data = JSON.parse(data);
            
            //$('#lead_source').val(data.lead.)
            $('select option:selected').removeAttr('selected');
            $('label').addClass('active');
            $("#lead_source option[value='" + data.lead.lead_source + "']").attr("selected","selected");
            
            if (data.lead.lead_source == 'Travel Agent' || data.lead.lead_source == 'Reference'){
                $('#reference_name_field').show();
                $("#reference_name").val(data.lead.reference_name);
                $("#name").val(''); 
            }else{
                $('#reference_name_field').hide();
                $("#reference_name").val('');
            }
            $("#email").val(data.lead.email);
            $("#name").val(data.lead.name);
            //$("#googleaddress").val(data.lead.location);
            $("#other_enquiry").val(data.lead.other_enquiry);
            $("#customer_type option[value='" + data.lead.customer_type + "']").attr("selected","selected");
            $("#lead_priority option[value='" + data.lead.lead_priority + "']").attr("selected","selected");
            $("#trip_type option[value='" + data.lead.trip_type + "']").attr("selected","selected");
            $("#assign_to option[value='" + data.lead.assign_to + "']").attr("selected","selected");
            //$("#enquiry_type option[value='" + data.lead.enquiry_type + "']").attr("selected","selected");
            /* $("#hotel_type option[value='" + data.lead.hotel_type + "']").attr("selected","selected");
            
            if (data.lead.enquiry_type == 'Own Hotel' || data.lead.enquiry_type == 'Partner Hotel'){
                $('#hotel_enquiry').show();
                $('#other_enquiry_field').hide();
                $("#hotel_id option[value='" + data.lead.hotel_id + "']").attr("selected","selected");
            
            }else if (data.lead.enquiry_type == 'Other'){
                $('#hotel_enquiry').hide();
                $('#other_enquiry_field').show();
                $("#other_enquiry").val(data.lead.other_enquiry);
            }else{
               $('#hotel_enquiry').hide();
                $('#other_enquiry_field').hide(); 
            }
            
            $("#hotel_type option[value='" + data.lead.hotel_type + "']").attr("selected","selected");
            $("#country_id option[value='" + data.lead.country_id + "']").attr("selected","selected");
            $(".region_list").html(data.region_html);
            $(".region_list").addClass("show_select");
            $(".city_list").html(data.city_html);
            $(".city_list").addClass("show_select");
            $("#start_date").val(data.lead.start_date);
            $("#no_nights").val(data.lead.no_nights);
            $("#no_room").val(data.lead.no_room);
            $("#sharing option[value='" + data.lead.sharing + "']").attr("selected","selected");
            $("#pax").val(data.lead.pax);
            $("#kids").val(data.lead.kids);
            $("#infant").val(data.lead.infant); */
            
            
            
            
            //
           /* if(data.status == true){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data.html);
            }else{
              $("#suggesstion-box").hide();
            $("#suggesstion-box").html('');  
            }*/
         }
        });


}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1mefnF88BCHGzDBEmv2FYFYWkjtVli0w&libraries=places&callback=initAutocomplete"
    async defer></script>
@endsection
