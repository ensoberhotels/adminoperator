@extends('vender.template.base')

@section('title', 'Ensober | Make Itinerary')

@section('styles')
    <script src="{{ URL::asset('public/asset/js/ckeditor.js') }}" type="text/javascript"></script>
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
			width: 26px;
			position: absolute;
			right: -30px;
			top: 18px;
			display: none;
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
		.hotel_dist,.hotel_area,.price_area {
			float: left;
			margin-top: 15px;
			width: 100%;
		}
		.price_area {
			border-top: 2px solid #ff4081;
			margin-top: 25px;
			margin-bottom: 700px;
		}
		td, th {
			padding: 0 5px !important;
		}
		.route_area {
			float: left;
			width: 100%;
			margin-top: 25px;
		}
		tr {
			border-bottom: 0px !important;
		}
		.price_area{
			border-top: 2px solid #ff4081;
			margin-top: 25px;
		}
		.card-header {
			border-bottom: 1px solid;
			float: left;
			width: 100%;
			margin-bottom: 15px;
		}
		#car_area_data td, #car_area_data th {
			border: 1px solid #eee;
			
		}
		#car_area_data{
			 border-collapse: collapse;
		}
		.transport_popup {
			background-color: #fff;
			width: 500px;
			padding: 5px 0px;
			box-shadow: 0 0 5px 3px #fff;
			display:none;
			border-radius:5px;
		}
		.cu_mod_header {
			font-size: 17px;
			border-bottom: 1px solid #eee;
			margin-bottom: 12px;
			padding: 0 10px 10px;
		}
		.cu_mod_body {
			padding: 0 10px;
			height: 250px;
			overflow-x: scroll;
		}
		.cu_mod_footer {
			border-top: 1px solid #eee;
			padding: 15px 10px 5px;
			margin-top: 12px;
		}
		.transport_are {
			float: left;
			width: 100%;
			/*display:none;*/
		}
		.route_area {
			float: left;
			width: 100%;
			/*display:none;*/
		}
		.hotel_area, .Actibities_area, .price_area{
			float: left;
			width: 100%;
			/*display:none;*/
		}
		.mobile_verify_popup .cu_mod_body {
			height: 110px;
			overflow: auto;
		}
		#verify_number {
			width: 210px;
			margin: 0 12px;
		}
		.mobile_put_div {
			width: 300px;
			display: none;
			margin: 20px 0 0;
		}
		.otp_put_div{
			width: 300px;
			display: none;
			margin: 20px 0 0;
		}
		#verify_OTP {
			width: 210px;
			margin: 0 12px;
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
                <div class="card-content">
                    <div class="card-header">
                        <h4 class="card-title">Update Day Wise Itinerary</h4>
                    </div>
					<form class="add_car_form" id="add_car_form" method="POST" action="/vender/daywiseitiupdate" enctype="multipart/form-data" role="form">
					{{csrf_field()}}
				<div class="row" style="margin-bottom: 0px !important;">
					<div class=" col s12 m12" style="text-align: right;">
				  
						<a href="/vender/itinerarymanage/{{ Request::segment(3) }}">
							<button class="btn waves-effect waves-light" type="button" name="action" id="add_hotel">Back
							<i class="material-icons right">arrow_back</i>
							</button>
						</a>
						<button class="btn waves-effect waves-light" type="submit" name="action" id="add_hotel" style="margin:-10px 5px 0px !important;">Submit
						<i class="material-icons right">send</i>
						</button>
					</div>
				</div>
              <div class="row">
                <div class="col s12 m12">
                  @php
                    $x=1;
                  @endphp
                  @foreach($itineraries as $detail)
                  <div class="" id="daywisefields">
                    <div class="col s12 m12">
                      <textarea name="description[]" class="wysing_editor{{$x}}" value="{!!$detail->description!!}">{!!$detail->description!!}</textarea>
                      <input type="hidden" name="id[]" value="{{$detail->id}}"/>
                    </div>
                  </div>
				  
				  <script>
					ClassicEditor.create( document.querySelector( '.wysing_editor{{$x}}' ), {
						// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
					}).then( editor => {
						window.editor = editor;
					}).catch( err => {
						console.error( err.stack );
					});
				</script>
                  @php
                    $x++;
                  @endphp
                  @endforeach
                </div>
              </div>
              <div class="row">
                <div class=" col s12 m12" style="text-align: right;">
				  
				  <a href="/vender/itinerarymanage/{{ Request::segment(3) }}">
				  <button class="btn waves-effect waves-light" type="button" name="action" id="add_hotel">Back
                    <i class="material-icons right">arrow_back</i>
                  </button>
				  </a>
				  <button class="btn waves-effect waves-light" type="submit" name="action" id="add_hotel" style="margin:-10px 5px 0px !important;">Submit
                    <i class="material-icons right">send</i>
                  </button>
				  <input type="hidden" name="itinerary_no" value="{{ Request::segment(3) }}"/>
                </div>
              </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END RIGHT SIDEBAR NAV -->
            
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
		jQuery(document).ready(function(){
			
		});
	</script>
@endsection