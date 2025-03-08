@extends('vender.template.base')

@section('title', 'Ensober | Make Itinerary')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
   <style>
        .step-actions {
            float: right;
        }
		.show_select select{display:block;}
		.price_box {
			float: left;
			width: 100%;
			border: 2px solid #3949ab;
			height: 149px;
			background-image: url(http://ensoberhotels.com/Stingo-Adm/images/logo/1560581749logo.png);
			background-size: 100% 100%;
		} 
		.price_box .hotel_rate {
			font-size: 35px;
			float: left;
			width: 100%;
			text-align: center;
			padding: 16% 0 0;
			color: #fff;
			background-color: rgba(0,0,0,0.7);
			height: 100%;
		}
		.hotel_price {
			float: left;
			width: 100%;
			font-size: 23px;
			text-align: center;
			background-color: #1b1f36;
			color: #fff;
		}
		.hotel_img_area {
			float: left;
			width: 100%;
			height: 120px;
			background-color: #eee;
		}
		.hotel_img_area img{height:100%;width:100%}
		.hotel_de_area {
			float: right;
			width: 100%;
			border-left: 1px solid #555;
			padding-left: 20px;
		}
		.loader_box {
			float: left;
			width: 236px;
			position: absolute;
			padding: 54px 94px;
			right: 26px;
			height: 155px;
			background-color: rgba(0,0,0,0.6);
			display:none;
		}
		.loader_box img {
			width: 49px;
		}
		.moreroomselect{display:none;}
		.remove_row a i {
			font-size: 19px;
			margin: -4px 0.5px;
		}
		.remove_row a {
			width: 31px;
			height: 31px;
		}
		.remove_row {
			float: left;
			position: absolute;
			right: 1px;
			top: -22px;
		}
		.hotel_dist {
			float: left;
			margin-top: 15px;
			width: 100%;
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
                  <li class="breadcrumb-item"><a href="index.html">Make Itinerary</a>
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
                <div class="card-content" style="height: 1000px;">
                    <div class="card-header">
                        <h4 class="card-title">Make Itinerary</h4>
                    </div>
					
			<form class="add_hotel_form" id="add_hotel_form" method="POST" action="{{ route('hotels.store') }}" enctype='multipart/form-data'>
			{{csrf_field()}}
            
              <div class="row">
                <div class="input-field col s3"> 
					<label for="adult" class="active">Adult</label>
					<select class="validate invalid" required="" aria-required="true" id="adult" name="property_type" onchange="hotelRate();">
						<option value="">Adult</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
					</select>
                </div>
				<div class="input-field col s3">
                  <label for="child" class="active">Child</label>
				  <select class="validate invalid" required="" aria-required="true" id="child" name="child" onchange="hotelRate();">
						<option value="">Child</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
					</select>
                </div>
				<div class="input-field col s3">
                  <label for="infant" class="active">Infant</label>
				  <select class="validate invalid" required="" aria-required="true" id="infant" name="infant" onchange="hotelRate();">
						<option value="">Infant</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
                </div>
				<div class="input-field col s3">
					<label for="date" class="active">Start Date</label>
					<input class="validate"  required="" aria-required="true" id="date" type="date" name="date" onchange="hotelRate();">
                </div>
				<div class="hotel_iten_area">
				<div class="hotel_dist">
				<div class="col s9">
					<div class="row">
					<div class="input-field col s4">
						<label for="city_id" class="active">Distination</label>
						<select  required="" aria-required="true" id="get_hotels" name="city_id" class="city_id" onchange="hotelRate();"> 
							<option value="">Select Distination</option>
							@foreach($cities as $city)
							<option value="{{$city->city_id}}">{{$city->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="input-field col s4 hotel_list">
						<label for="hotel_id" class="active">Hotel</label>
						<select  id="hotel_id" name="hotel_id" class="validate hotel_id" onchange="hotelRate();">
							<option value="">Select Hotel</option>
						</select>
					</div>
					<div class="input-field col s4 room_type_list">
						<label for="room_type" class="active">Room Type</label>
						<select id="room_type" name="room_type" class="validate get_suc_cat" onchange="hotelRate();">
							<option value="">Select Room Type</option>
						</select>
					</div>
					</div>
					<div class="row">
					<div class="input-field col s4 city_list">
						<label for="meal_plan" class="active">Meal Plan</label>
						<select id="meal_plan" name="meal_plan" class="validate" onchange="hotelRate();">
							<option value="">Select Meal Plan</option>
							<option value="ep_price">EP (Room Only)</option>
							<option value="cp_price">CP (Room with Breakfast)</option>
							<option value="map_price">MAP (Room with Brkfst & Dnr)</option>
							<option value="ap_price">AP (Room with all meals plan)</option>
						</select>
					</div>
					<div class="input-field col s4 city_list">
						<label for="no_of_room" class="active">No Of Room</label>
						<select id="no_of_room" name="no_of_room" class="validate" onchange="hotelRate();">
							<option value="">Select No Of Room</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
						</select>
						<b style="color:red;font-size:12px;" class="moreroomselect">Please Select More Rooms!</b>
					</div>
					<div class="input-field col s4">
						<label for="no_of_night" class="active">No Of Night</label>
						<select id="no_of_night" name="no_of_night" class="validate" onchange="hotelRate();">
							<option value="">Select No Of Night</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option> 
						</select>
					</div>
					</div>
				</div>
				<div class="col s3">
					<div class="hotel_de_area">
						<div class="hotel_img_area">
							<img src="{{ URL::asset('asset/images/blank_hotel.jpg') }}" class="img-responsive" />
						</div>
						<div class="hotel_price">
							<span class="hotel_rate">&#8377; <span id="hotel_price">0 </span></span>
						</div>
					</div>
					<div class="loader_box">
						<img src="{{ URL::asset('asset/images/loader/loader.gif') }}" class="img-responsive"/>
					</div>
					<!--<div class="price_box">
						<span class="hotel_rate"><span id="hotel_price">0 </span>&#8377;</span>
					</div>-->
				</div>
				<div class="divider"></div>
				</div>
				</div>
                
				<div class="input-field col s12">
                  <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMore()" style="float:right;">
						<i class="material-icons">note_add</i>
					</a>
                </div>
				
                <div class="input-field col s12">
                  <!--button class="btn waves-effect waves-light right" type="submit" name="action" id="add_hotel">Submit
                    <i class="material-icons right">send</i>
                  </button-->
                </div>
              </div>
            </form>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- END RIGHT SIDEBAR NAV -->
            <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top">
				<a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
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
	
	<script>
		function addMore(){
    		$('.hotel_iten_area').append(`<div class="hotel_dist">
				<div class="col s9">
					<div class="row">
					<div class="input-field col s4 show_select">
						<label for="city_id" class="active">Distination</label>
						<select  required="" aria-required="true" name="city_id" id="city_id" class="get_hotels_aw" onchange="hotelRateAW($(this));"> 
							<option value="">Select Distination</option>
							@foreach($cities as $city)
							<option value="{{$city->city_id}}">{{$city->name}}</option>
							@endforeach
						</select> 
					</div>
					<div class="input-field col s4 hotel_list show_select">
						<label for="hotel_id" class="active">Hotel</label>
						<select  name="hotel_id" class="validate hotel_id hotel_id_aw" onchange="hotelRateAW($(this));">
							<option value="">Select Hotel</option>
						</select>
					</div>
					<div class="input-field col s4 room_type_list show_select">
						<label for="room_type" class="active">Room Type</label>
						<select id="room_type1" name="room_type" class="validate get_suc_cat" onchange="hotelRateAW($(this));">
							<option value="">Select Room Type</option>
						</select>
					</div>
					</div>
					<div class="row">
					<div class="input-field col s4 city_list show_select">
						<label for="meal_plan" class="active">Meal Plan</label>
						<select id="meal_plan" name="meal_plan" class="validate" onchange="hotelRateAW($(this));">
							<option value="">Select Meal Plan</option>
							<option value="ep_price">EP (Room Only)</option>
							<option value="cp_price">CP (Room with Breakfast)</option>
							<option value="map_price">MAP (Room with Brkfst & Dnr)</option>
							<option value="ap_price">AP (Room with all meals plan)</option>
						</select>
					</div>
					<div class="input-field col s4 show_select">
						<label for="no_of_room" class="active">No Of Room</label>
						<select id="no_of_room" name="no_of_room" class="validate" onchange="hotelRateAW($(this));">
							<option value="">Select No Of Room</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
						</select>
						<b style="color:red;font-size:12px;" class="moreroomselect">Please Select More Rooms!</b>
					</div>
					<div class="input-field col s4 show_select">
						<label for="no_of_night" class="active">No Of Night</label>
						<select id="no_of_night" name="no_of_night" class="validate" onchange="hotelRateAW($(this));">
							<option value="">Select No Of Night</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option> 
						</select>
					</div>
					</div>
				</div>
				<div class="col s3" style="position:relative;">
					<div class="remove_row">
						<div class="input-field col s12">
							<a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" title="Delete" onclick="remove($(this))"><i class="material-icons">delete_sweep</i></a>
						</div>
					</div>
					<div class="hotel_de_area">
						<div class="hotel_img_area">
							<img src="{{ URL::asset('asset/images/blank_hotel.jpg') }}" class="img-responsive" />
						</div>
						<div class="hotel_price">
							<span class="hotel_rate">&#8377; <span id="hotel_price">0 </span></span>
						</div>
					</div>
					<div class="loader_box">
						<img src="{{ URL::asset('asset/images/loader/loader.gif') }}" class="img-responsive"/>
					</div>
				</div>
				<div class="divider"></div>
				</div>`);
    	}
		
		function remove(e){
			e.parents('.hotel_dist').remove()
		}
		
		
	</script>
	
	<script>
		jQuery(document).ready(function(){
			// Get hotels by city id for added row 
			jQuery(".hotel_iten_area").delegate(".get_hotels_aw", "change", function(){
				var this_div = jQuery(this);
				var city_id = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: baseUrlV+'ajaxgetHotelDetailAW',
					cache: false,
					async: true,
					data: {'city_id':city_id},
					success: function(res){
						this_div.parent().parent().parent().find(".hotel_list").html(res);
					}
				});
			});
			
			// Get hotels room type by hotel id for added row
			jQuery(".hotel_iten_area").delegate('.hotel_id_aw', 'change', function(){
				var this_div = jQuery(this);
				var hotel_id = jQuery(this).val();
				jQuery.ajax({
					type: 'post',
					url: baseUrlV+'ajaxgetHotelRoomTypeDetailAw',
					cache: false,
					async: true,
					data: {'hotel_id':hotel_id},
					success: function(res){
						this_div.parent().parent().find(".room_type_list").html(res);
					}
				});
			});
		});
		
		// Get hotel rate
		function hotelRateAW(thisdiv){
			$.ajaxSetup({
				headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var hotel_id = thisdiv.parent().parent().parent().find("#hotel_id").val();
			var room_type = thisdiv.parent().parent().parent().find("#room_type").val();
			var meal_plan = thisdiv.parent().parent().parent().find("#meal_plan").val();
			var no_of_room = thisdiv.parent().parent().parent().find("#no_of_room").val();
			var no_of_night = thisdiv.parent().parent().parent().find("#no_of_night").val();
			var date = jQuery("#date").val();
			var adult = jQuery("#adult").val();
			var child = jQuery("#child").val();
			if(hotel_id != ""){
				thisdiv.parent().parent().parent().find(".loader_box").show();
			  $.ajax({
				url: "ajaxgetHotelRate",
				type:"post",
				cache: false,
				async:false,
				data: {'hotel_id':hotel_id,'room_type':room_type,'date':date,'meal_plan':meal_plan, 'no_of_night':no_of_night, 'no_of_room':no_of_room, 'adult':adult, 'child':child},
				success: function(data){
					var data = JSON.parse(data);
					thisdiv.parent().parent().parent().parent().find("#hotel_price").text(data.price);
					thisdiv.parent().parent().parent().parent().find(".hotel_img_area img").attr("src",data.hotel_image);
					console.log(data);    
					thisdiv.parent().parent().parent().find(".loader_box").hide();
					if(data.status == 0){
						thisdiv.parent().parent().parent().find(".moreroomselect").show();
					}else{
						thisdiv.parent().parent().parent().find(".moreroomselect").hide();
					}
				}
			  });
			}
		}
	</script>
@endsection