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
                  <li class="breadcrumb-item"><a href="#">Add Hotel Season Rate</a>
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
                        <h4 class="card-title">Add Hotel Season Rate</h4>
                    </div>
					<div class="divider"></div><br>
					
			<form class="add_hotel_season_rate1_form" id="add_hotel_season_rate1_form" method="POST" action="{{ route('hotelseasonrate.store') }}" >
			{{csrf_field()}}
              <div class="row"> 
			  
				<div class="">
				<div class="row" style="border-bottom: 2px solid #4f508e; padding: 0 0 8px; margin: 0 0 17px;">
					<div class="col s12 m2">
						<select class="form-control distination" id="distination" onchange="getRoomBookingStatus();">
							<option value="">Select Hotel Destination</option>
							@foreach($citiesh as $city)
								<option value="{{ $city->city_id }}" @if($city->city_id == @$hotel->city_id) {{ 'selected' }} @endif>{{ getCityName($city->city_id) }}</option>
							@endforeach
						</select>
					</div>
					<div class="col s12 m2">
						<select name="hotel_id" class="validate invalid hotel_list" required="" aria-required="true" id="hotel_id">
                                <option value="">Please Select Hotel</option>
							@foreach($hotels as $hotel)
								<option value="{{ $hotel->id }}">{{ $hotel->hotel_name }}</option>
							@endforeach
						</select>
					</div>
					<!--<div class=" col s12 m2">
						<label for="one_occupancy_cost" class="" title="Single Occupancy Discount (-%)">Single Occupancy Dis. (-%)</label>
						<input class="validate invalid" required="" aria-required="true" id="one_occupancy_cost" type="text" name="one_occupancy_cost">
					</div> 
					<div class=" col s12 m2">
						<label for="child_age" class="">Chargeable Child Age *</label>
						<input class="validate invalid" required="" aria-required="true" id="child_age" type="text" name="child_age">
					</div>
					<div class=" col s12 m2"> 
						<label for="child_extra_cost" class="">Chargeable Child Cost (%)</label>
						<input class="validate invalid" required="" aria-required="true" id="child_extra_cost" type="text" name="child_extra_cost">
					</div>
					<div class=" col s12 m2">
						<label for="chable_adult_age" class="">Chargeable Adult Age *</label>
						<input class="validate invalid" required="" aria-required="true" id="chable_adult_age" type="text" name="chable_adult_age">
					</div>
					<div class=" col s12 m2">
						<label for="adult_extra_cost" class="">Chargeable Adult Cost (%)</label>
						<input class="validate invalid" required="" aria-required="true" id="adult_extra_cost" type="text" name="adult_extra_cost">
					</div>-->
					
				
				
				<div class="" id="details">
					<div class="row group">
						<div class="col s11"> 
							<div class=" col s12 m3 room_category_id">
								<label for="room_type_id" class="">Room Category</label>
								<select name="room_type_id[]" class="validate invalid" required="" aria-required="true" id="room_type_id">
                                  <option value="">Please Select Room Category</option>
								</select>
							</div>
							<div class=" col s12 m2">
								<label for="start_date" class="">Start Date</label>
								<input class="validate" required="" aria-required="true" id="start_date" type="date" name="start_date[]">
							</div>
							<div class=" col s12 m2">
								<label for="end_date" class="">End Date</label>
								<input class="validate" required="" aria-required="true" id="end_date" type="date" name="end_date[]">
							</div>
							
							<div class=" col s12 m1">
								<label for="ap_price" class="">AP Price</label>
								<input class="validate invalid" required="" aria-required="true" id="ap_price" type="number" step="any" name="ap_price[]">
							</div>
							
							<div class=" col s12 m1">
								<label for="map_price" class="">MAP Price</label>
								<input class="validate invalid" required="" aria-required="true" id="map_price" type="number" step="any" name="map_price[]">
							</div>
							
							<div class=" col s12 m1">
								<label for="cp_price" class="">CP Price</label>
								<input class="validate invalid" required="" aria-required="true" id="cp_price" type="number" step="any" name="cp_price[]">
							</div>
							
							<div class=" col s12 m1">
								<label for="ep_price" class="">EP Price</label>
								<input class="validate invalid" required="" aria-required="true" id="ep_price" type="number" step="any" name="ep_price[]">
							</div>
							
							
						</div>
						<div class="col s1">
							<!--<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))">
								<i class="material-icons">delete_sweep</i>
							</a>-->
						</div>
					</div>
				</div>
				<div class="col s12 text-right">
					<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
						<i class="material-icons">note_add</i>
					</a>
				</div>
				</div>
				</div>
				<div class="row" style=" padding: 0 0 8px; margin: 0 0 17px;">
					<div class=" col s12 m2">
						<label for="one_occupancy_cost" class="" title="Single Occupancy Discount (-%)">Single Occupancy Dis. (-%)</label>
						<input class="validate invalid" required="" aria-required="true" id="one_occupancy_cost" type="text" name="one_occupancy_cost">
					</div> 
					<div class=" col s12 m2">
						<label for="child_age" class="">Chargeable Child Age *</label>
						<input class="validate invalid" required="" aria-required="true" id="child_age" type="text" name="child_age">
					</div>
					<div class=" col s12 m2"> 
						<label for="child_extra_cost" class="">Chargeable Child Cost (%)</label>
						<input class="validate invalid" required="" aria-required="true" id="child_extra_cost" type="text" name="child_extra_cost">
					</div>
					<div class=" col s12 m2">
						<label for="chable_adult_age" class="">Chargeable Adult Age *</label>
						<input class="validate invalid" required="" aria-required="true" id="chable_adult_age" type="text" name="chable_adult_age">
					</div>
					<div class=" col s12 m2">
						<label for="adult_extra_cost" class="">Chargeable Adult Cost (%)</label>
						<input class="validate invalid" required="" aria-required="true" id="adult_extra_cost" type="text" name="adult_extra_cost">
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
                <div class=" col s12 m4">
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
	<!-- ITINERARY SCRIPT JS-->
		<script src="{{ URL::asset('public/asset/js/custom/itinerary_script.js') }}"></script>
    <!-- ITINERARY SCRIPT JS-->
	<script>
		function addMore(){
             var hotel_id = $('#hotel_id').val();
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
      
        $.ajax({
            type:'POST',
            url: 'ajaxGetRoomCategory',
            data: {'hotel_id':hotel_id},
            type:"post",
            cache: false,
            async:true,
            success: function(data){
                
                var data = JSON.parse(data);
      if(data.status == true){
           var roomcategories = data.roomcategories;
           var room_cat_html ='<select name="room_type_id[]" class="validate invalid" required="" aria-required="true" id=""><option value="">Please Select Room Category</option>';  
           $.each(roomcategories, function(idx, val) {
            //room_cat_html = room_cat_html.concat('<option value="'+val.room_category_id+'">'+val.type+'</option>');
            room_cat_html = room_cat_html.concat('<option value="'+val.room_type_id+'">'+val.type+'</option>');
           });
      room_cat_html = room_cat_html.concat('</select>');
          
                }else{
               var room_cat_html ='<select name="room_type_id[]" class="validate invalid" required="" aria-required="true" id=""><option value="">Please Select Room Category</option></select>';     
                }
                
                
                $('#details').append('<div class="row group"><div class="col s11"><span></span><div class=" col s12 m3 room_category_id show_select"><label for="room_type_id" class="">Room Category </label>'+room_cat_html+'</div><div class=" col s12 m2"><label for="start_date" class="">Start Date</label><input class="validate" required="" aria-required="true" id="start_date" type="date" name="start_date[]"></div><div class=" col s12 m2"><label for="end_date" class="">End Date</label><input class="validate" required="" aria-required="true" id="end_date" type="date" name="end_date[]"></div><div class=" col s12 m1"><label for="ap_price" class="">AP Price</label><input class="validate invalid" required="" aria-required="true" id="ap_price" type="text" name="ap_price[]"></div><div class=" col s12 m1"><label for="map_price" class="">MAP Price</label><input class="validate invalid" required="" aria-required="true" id="map_price" type="text" name="map_price[]"></div><div class=" col s12 m1"><label for="cp_price" class="">CP Price</label><input class="validate invalid" required="" aria-required="true" id="cp_price" type="text" name="cp_price[]"></div><div class=" col s12 m1"><label for="ep_price" class="">EP Price</label><input class="validate invalid" required="" aria-required="true" id="ep_price" type="text" name="ep_price[]"></div></div><div class="col s12 m1"><a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))"><i class="material-icons">delete_sweep</i></a></div></div>');
                
            }
        });
            
    		
    	}
		
		function remove(e){
			e.parents('.group').remove()
		}
        
   $(document).ready(function(){
       
       $("#hotel_id").change(function(){
        var hotel_id = $(this).val();
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
      
        $.ajax({
            type:'POST',
            url: 'ajaxGetRoomCategory',
            data: {'hotel_id':hotel_id},
            type:"post",
            cache: false,
            async:true,
            success: function(data){
                
                var data = JSON.parse(data);
				console.log(data);
      if(data.status == true){
           var roomcategories = data.roomcategories;
           var room_cat_html ='<label for="room_type_id" class="">Room Category</label><select name="room_type_id[]" class="validate invalid" required="" aria-required="true" id=""><option value="">Please Select Room Category</option>';  
           $.each(roomcategories, function(idx, val) {
            room_cat_html = room_cat_html.concat('<option value="'+val.room_type_id+'">'+val.type+' ('+val.name+')</option>');
           });
      room_cat_html = room_cat_html.concat('</select>');
      $(".room_category_id").html(room_cat_html);
      $(".room_category_id").addClass("show_select");
          
                }else{
          
          alert('Please add the room category first in the hotel');
      }
                
            }
        });
    });
   });     
		
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