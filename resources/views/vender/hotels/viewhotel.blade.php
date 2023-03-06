@extends('vender.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
	
	<!-- Media Slider -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/advance-ui-media.css') }}">
	<!-- / Media Slider -->
	<style>
		.hotel_rating li {
			width: 30px;
			display: inline-block;
		}
		.hotel_room {
			float: left;
			width: 60%;
			font-size: 22px;
			margin: 12px 0 0;
		}
		.detal_1 {
			float: left;
			width: 100%;
		}
		.hotel_detail_main {
			float: left;
			width: 98%;
			margin-left: 15px;
			padding: 10px 20px 35px;
			border: 2px solid #7280ce;
		}
		b.hotel_name {
			font-size: 30px;
			color: #ff4081;
		}
		.hotel_detail_w60 {
			float: left;
			width: 100%;
		}
		.hotel_detail_w40 {
			float: left;
			width: 100%;
		}
		.hotel_rating {
			float: left;
			width: 40%;
		}
		ul.ho_contact_detail {
			float: left;
			width: 100%;
			margin: 0;
		}
		ul.ho_contact_detail li {
			display: inline-block;
			width: 100%;
			vertical-align: middle;
		}
		ul.ho_contact_detail li i {
			color: #ff4081;
			font-size: 28px;
			display: inline-block;
		}
		ul.ho_contact_detail li b {
			position: relative;
			display: inline-block;
			top: -10px;
			width:90%; 
		}
		b.tarif_text {
			float: left;
			width: 100%;
			border-bottom: 2px solid #7280ce;
			font-size: 20px;
			padding: 5px 0 7px;
			margin: 0 0 8px;
		}
		.price_text {
			font-size: 18px;
			color: #ff4081;
			font-weight: bold;
			margin-right: 4px;
		}
		.price_value {
			font-size: 23px;
			color: green;
			font-weight: bold;
			margin-right: 20px;
		}
		.date_text {
			font-size: 18px;
			font-weight: bold;
			color: #ff4081;
			float: left;
			width: 107px;
		}
		.date_val {
			float: left;
			width: 192px !important;
		}
		.select_date {
			float: left;
			width: 100%;
		}
		.price_main {
			float: left;
			width: 100%;
		}
		.hotel_left {
			float: left;
			width: 57%;
			border-right: 2px solid #7280ce;
			padding-right: 15px;
			margin-right: 15px;
		}
		.hotel_right {
			float: left;
			width: 41%;
		}
		.hotel_amenities {
			float: left;
			width: 100%;
			margin: 20px 0 0;
		}
		.hotel_amenities li {
			font-size: 17px;
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
                  <li class="breadcrumb-item"><a href="index.html">Lead</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">All Lead</a>
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
            <div class="section section-data-tables">
  <div class="card">
    <div class="card-content">
      <p class="caption mb-0">Tables are a nice way to organize a lot of data. We provide a few utility classes to help
        you style your table as easily as possible. In addition, to improve mobile experience, all tables on
        mobile-screen widths are centered automatically.</p>
    </div>
  </div>

  <!-- Multi Select -->

	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
                @if(isset($Hotel->id))
					<div class="row">
						<ul id="tabs-swipe-demo" class="tabs">
							<li class="tab col m4"><a href="#test-swipe-1" class="active">Overview</a></li>
							<li class="tab col m4"><a class="" href="#test-swipe-2">Financials</a></li>
							<li class="tab col m4"><a href="#test-swipe-3" class="">Internal Report</a></li>
							<li class="indicator" style="left: 15px; right: 758px;"></li>
						</ul>
						<div class="hotel_detail_main">
							<div class="hotel_left">
							<div class="hotel_detail hotel_detail_w60">
								<b class="hotel_name">{{ $Hotel->hotel_name}}</b>
								<div class="detal_1">
									<div class="hotel_rating">
                                       <ul>
                                           @if($Hotel->start_category=="ONE") @php  $star=1; @endphp
                                           @elseif($Hotel->start_category=="TWO")  @php  $star=2; @endphp
                                           @elseif($Hotel->start_category=="THREE") @php  $star=3; @endphp
                                           @elseif($Hotel->start_category=="FOUR") @php  $star=4; @endphp
                                           @elseif($Hotel->start_category=="FIVE") @php  $star=5; @endphp  @endif 
										   @for($i = 0; $i < $star; $i++)
                                             <li><img src="{{ url('asset/images/icon/star.png') }}"/></li> 
										   @endfor
										</ul>
									</div>
									<div class="hotel_room">
									 <b>Total Room: {{ $Hotel->total_room }}</b>
									</div>
									
									<ul class="ho_contact_detail">
										<li>
											<i class="material-icons">contact_phone</i> 
											<b>{{$Hotel->contact_number}}</b>
										</li>
										<li>
											<i class="material-icons">account_balance</i> 
											<b>{{$Hotel->address}}, {{$Hotel->city}}, {{$Hotel->region}}, {{$Hotel->country}}</b>
										</li>
										<li>
											<i class="material-icons">email</i>  
											<b>{{$Hotel->contact_email}}</b>
										</li>
									</ul>
								</div>
							</div>
							<div class="hotel_gallery hotel_detail_w60">
								<div class="slider">
									<ul class="slides mt-2">
									  <li>
										<img src="{{ url('/storage/app/'.$Hotel->hotel_image) }}" alt="{{ $Hotel->hotel_name}}">
										<!-- random image -->
										<div class="caption center-align">
										  <h3 class="white-text">{{ $Hotel->hotel_name}}</h3>
										  <!--<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>-->
										</div>
									  </li>
                                      @if($hotelgalleries)
                                        @foreach($hotelgalleries as $hotelgallery)
                                         <li>
                                        <img src="{{ url('/storage/app/'.$hotelgallery->image) }}" alt="{{ $Hotel->hotel_name}}">
                                        <!-- random image -->
                                        <div class="caption center-align">
                                          <h3 class="white-text">{{ $Hotel->hotel_name}}</h3>
                                          <!--<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>-->
                                        </div>
                                      </li>
                                        @endforeach
                                      @endif
                  
									</ul>
								  </div>
							</div>
							</div>
							
							<div class="hotel_right">
							<div class="hotel_price hotel_detail_w40">
								<b class="tarif_text">Tarrif: </b>
								<div class="select_date" style="width: 44%;float: left;">
									<label for="email2" class="mb-2 mr-sm-2 date_text">Room Type:</label>
									
									<select class="validate invalid" required="" aria-required="true" id="room_type_id" style="display:inline-block;">
										<option value="">Room Type</option>
										@foreach($hotelroomcategoires as $cat)
											<option value="{{$cat->room_type_id}}" @if(isset($hotelseasonrate->room_type_id) && $cat->room_type_id==$hotelseasonrate->room_type_id) selected @endif>{{$cat->type}}</option>
										@endforeach
									</select> 
								</div>
								
								<div class="select_date" style="width: 44%;float: right;">									
									<label for="email2" class="mb-2 mr-sm-2 date_text">Check In:</label>
									<input type="date" class="form-control mb-2 mr-sm-2 date_val" name="check_in_date" value="{{$current_date}}" data-id="{{$Hotel->id}}" id="check_in_date">
								</div>
								
								<b class="tarif_text">Price: </b>
								<div class="price_main">
									<label for="email2" class="mb-2 mr-sm-2 price_text">EP:</label>
									<b class="form-control mb-2 mr-sm-2 price_value" id="ep_price">@if(isset($hotelseasonrate->ep_price)){{$hotelseasonrate->ep_price}}@endif</b>
									
									<label for="email2" class="mb-2 mr-sm-2 price_text">CP:</label>
									<b class="form-control mb-2 mr-sm-2 price_value" id="cp_price">@if(isset($hotelseasonrate->cp_price)){{$hotelseasonrate->cp_price}}@endif</b>
									
									<label for="email2" class="mb-2 mr-sm-2 price_text">MAP:</label>
									<b class="form-control mb-2 mr-sm-2 price_value" id="map_price">@if(isset($hotelseasonrate->map_price)){{$hotelseasonrate->map_price}}@endif</b>
									
									<label for="email2" class="mb-2 mr-sm-2 price_text">AP:</label>
									<b class="form-control mb-2 mr-sm-2 price_value" id="ap_price">@if(isset($hotelseasonrate->ap_price)){{$hotelseasonrate->ap_price}}@endif</b>
								</div>  
							</div>
							
							<div class="hotel_amenities hotel_detail_w40">
								<b class="tarif_text">Amenities: </b>
                                @if($hotelgalleries)
								<ul class="amenities_lest">
									@foreach($hotelamenity  as $h_amenity)
                                        <li>{{$h_amenity->name}}</li>
                                    @endforeach
								</ul>
                                @endif
							</div>
							</div>
						</div>
					</div>
                @else
                 <div class="row">
                     <p> <strong>Sorry Hotel is not found.</strong></p>
                 </div>
                 @endif
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

@section('scripts')
	<!-- BEGIN VENDOR JS-->
    <script src="{{ URL::asset('asset/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('asset/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/dataTables.select.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('asset/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('asset/js/scripts/data-tables.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
	<!-- Media Slider -->
	<script src="{{ URL::asset('asset/js/scripts/advance-ui-media.js') }}" type="text/javascript"></script>
	<!-- / Media Slider -->
	
	<script>
		$(document).ready(function(){
			$('.slider').slider();
            
    $('#check_in_date, #room_type_id').change(function(){
        var room_type_id =  $('#room_type_id').val();
        var date = $('#check_in_date').val();
        var id = $('#check_in_date').attr('data-id');
        if(room_type_id !='' && date !=''){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
     $("#loader-wrapper").css("display","block");       
     $.ajax({
    url: "ajaxGetSeasonRate",
    type:"post",
    cache: false,
    async:true,
    data: {'id':id, "date": date,'room_type_id':room_type_id},
    success: function(data){
      data = JSON.parse(data);
      if(data.status == true){
          $('#ep_price').html(data.hotelseasonrate.ep_price);
          $('#cp_price').html(data.hotelseasonrate.cp_price);
          $('#map_price').html(data.hotelseasonrate.map_price);
          $('#ap_price').html(data.hotelseasonrate.ap_price);
          $("#loader-wrapper").css("display","none");       
     
      }else{
          $('#ep_price').html('');
          $('#cp_price').html('');
          $('#map_price').html('');
          $('#ap_price').html('');
          $("#loader-wrapper").css("display","none");       
          alert('Please select another date');
          
      }
    }
});
    }else{
        alert('Please select Room Type and Date');
    }
            });
		});
        
        
        /*function showview(id){
    
  $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
  $.ajax({
    url: "ajaxShowHotel",
    type:"post",
    cache: false,
    async:false,
    data: {'id':id, "_token": "{{ csrf_token() }}"},
    success: function(data){
      data = JSON.parse(data);
      $('#hotel_name').html(data.hotel.hotel_name);
      $('#hotel_details').html('<span>'+data.hotel.contact_name+' </span><span>   '+data.hotel.contact_number+'  </span><span>  '+data.hotel.contact_email+' </span>');
      $('#hotel_address').html('<span>  '+data.hotel.address+'  </span><span>   '+data.hotel.city+'  </span><span>  '+data.hotel.state+'  </span><span>  '+data.hotel.country+'</span>');
      $('#hotel_type').html('<span>'+data.hotel.property_type+'</span><span>   '+data.hotel.start_category+'  star </span><span>  '+data.hotel.total_room+'  rooms</span>');
      $('#main_image').html('<img src="/storage/app/'+data.hotel.hotel_image+'">');
      var data_gallery = data.hotelgalleries;
       var gallery_html ='';
    
    $.each(data_gallery, function(idx, val) {
       gallery_html = gallery_html.concat('<img src="/storage/app/'+val.image+'">');
    });
    $('#gallery_images').html(gallery_html);
    
      var data_roomcategoires = data.hotelroomcategoires;
       var hotelroomcategoires_html ='';
    
    $.each(data_roomcategoires, function(idx, val) {
       hotelroomcategoires_html = hotelroomcategoires_html.concat('<p><span>Room Type : '+val.type +'; </span><span>Room Name : '+val.name +'; </span><span>No of Room : '+val.room_count +'</span></p>');
    });
    $('#hotelroomcategoires').html(hotelroomcategoires_html);

    var data_hotelamenity = data.hotelamenity;
       var hotelamenity_html ='<ul>';
    
    $.each(data_hotelamenity, function(idx, val) {
       hotelamenity_html = hotelamenity_html.concat('<li>'+val.name +'</li>');
    });
       hotelamenity_html = hotelamenity_html.concat('</ul>');
    
    $('#amenities').html(hotelamenity_html);

      $('#modal1').addClass('open').css({"z-index": "1003", "display": "block", "opacity":"1","top":"10%","transform":"scaleX(1) scaleY(1)"}).after('<div class="modal-overlay" style="z-index: 1002; display: block; opacity: 0.5;"></div>');
      
    }
  });  
}  */
	</script>
@endsection