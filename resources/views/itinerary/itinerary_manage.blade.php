@extends('vender.template.base')

@section('title', 'Ensober Operator Dashboard | Create Ititnerary')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
    <style>
        .step-actions {
            float: right;
        }
        .show_select select{display:block;}
		table, th, td {
		  /*border: 1px solid black;*/
		  border-collapse: collapse;
		}
		th, td {
		  padding: 1px;
		  text-align: left; 
			border:0px 0px 0px 1px;
		}
		ul.custom_tabs {
			float: left;
			width: 100%;
		}
		li.custom_tab {
			float: left;
		}
		li.custom_tab a {
			background-color: #00bcd4;
			padding: 12px 35px;
			color: #fff;
			font-size: 17px;
			margin-right: 10px;
			margin-bottom: 10px;
			display: inline-block;
		}
		li.custom_tab a.active {
			border-bottom: 5px solid #ff4081;
			padding: 12px 35px 6px;
		}
		.comment_main {
			float: left;
			text-align: left;
			width: 100%;
			box-shadow: 0 0px 1px 1px;
			height: 280px;
			overflow-y: scroll;
			padding: 15px 0;
		} 
		.comment_main ul {
			float: left;
			margin: 0;
			padding: 0;
		}
		.comment_main li a {
			float: left;
			width: 100%;
			padding: 5px 10px;
			cursor: pointer;
		}
		.comment_main li:hover >a {
			background-color: #faf7f7;
		}
		.sidebar .sidebar-content .sidebar-menu ul li.active{
			padding-left: 0px !important;
		}
		.sidebar .sidebar-content .sidebar-menu ul li.active {
			padding: 2px 0;
			font-size: 16px;
			margin: 0 0 12px;
		}
		ul.email-list.display-grid {
			margin: 0;
		}
		a.text-sub {
			float: left;
			width: 100%;
			margin: 0;
			padding: 0 10px 0 !important;
		}
		.follow_text {
			float: left;
			width: 100%;
			padding: 0px 0 0 10px;
			box-sizing: border-box;
			word-break: break-all;
		}
		.follow_input {
			float: left;
			width: 100%;
		}
		.carousel.carousel-slider .carousel-item{min-height:500px;}
		.sidebar .sidebar-content .sidebar-menu ul li {
			cursor: auto;
			color: #fff;
		}
		.follow_text span {
			float: right;
			text-align: left;
			width: 88%;
			padding: 3px 13px 0 0;
		}
		b.mobile_msg {
			float: left;
			background-color: red;
			color: #fff;
			width: 51px;
			margin: -7px 7px 0;
			border-radius: 5px;
			font-size: 13px;
			box-shadow: inset 0 0 6px 2px #fff;
			display:none;
		}
		.carousel.carousel-slider .carousel-fixed-item {
			z-index: unset;
		}
		.indicators{display:none;}
		.contact_input {
			color: #fff;
			border-bottom: 1px solid #fff !important;
			padding: 0 !important;
			margin: 0 !important;
			height: 100% !important;
			display:none;
		}
		.fixed-action-btn i {
			font-size: 36px !important;
			margin-top: 30px;
		}
		.fixed-action-btn {
			display: block !important;
		}
		.hotel_details {
			float: left;
			width: 100%;
			border-bottom: 1px solid #555;
			padding-bottom: 5px;
		}
		.btn-floating {
			font-size: 0px !important;
			padding: 0px !important;
			width: 24px !important;
			height: 24px !important;
			margin: 1px !important;
		}
		.daywaise_details {
			float: left;
			width: 100%;
		}
		.daywaise_info {
			float: left;
			width: 100%;
			border-bottom: 1px solid #d1cccc;
			padding-bottom: 8px;
		}
		.email_body {
			padding: 0 0px;
			height: 500px;
			overflow-y: auto;
		}
		div#email_body footer {
			position: unset;
		}
		div#email_body header {
			position: unset;
		}
		div#email_body main {
			margin-top: 0px;
			margin-bottom: 0px;
		}
		.generate_send_quo:disabled {
			color: #fff !important;
		}
		li.custom_tab {
			height: auto !important; 
		}
		#final_cost_check {
			position: unset;
			opacity: 1;
			pointer-events: auto;
			width: 13px !important;
			height: 13px !important;
		}
		footer{display:none;}
		.fgsilement{display:none;}
		.hotel_view_mobile {
			float: left;
			width: 95%;
			background-color: #fff;
		}
		.hotel_view_mobile .hotel_detail_main {
			margin: 3px;
		}
		.hotel_view_mobile .close_btn {
			position: absolute;
			right: 3%;
			display:block !important;
			cursor:pointer;
		}
		.hotel_view_mobile .detal_1 {
			width:100%;
		}
		.hotel_view_mobile .hotel_img {
			width: 100%;
			height: auto;
		}
		div#daywaise_info:first-child .remove_horoty {
			display: none;
		}
		div#daywaise_info:first-child .btn_text {
			display: none;
		}
		.room_inventory_fields {
			float: left;
			width: 100%;
			display:none;
		}
		.url_qrcode{display:none;}
		.upload_image_popup {
			background-color: #fff;
			display:none;
		}
		span.b-close.close_btn {
			position: absolute;
			color: #fff;
			right: 6px;
			cursor: pointer;
		}
		div#details {
			margin-bottom: 0px !important;
		}
		button#addbookingbtn {
			margin-top: 20px !important;
		}
		.same_agent_cbox {
			display: none;
			font-size: 12px;
		}
		@media only screen and (max-width: 430px)
			li.custom_tab {
				height: auto !important; 
			}
			li.custom_tab a{padding: 8px 12px 8px !important;}
			li.custom_tab a.active {
				padding: 8px 12px 3px !important;
			}
		}
		
	</style>
@endsection

@section('content')

<!-- Hotel Details in mobile -->
<div class="hotel_view_mobile_hide animated slideInUp">

</div>
<!-- /Hotel Details in mobile -->
@php
	if(@$_GET['update'] == 1){
		$con_class = 'ven_update_mode';
	}else{
		$con_class = '';
	}
@endphp
<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-content">
					<!-- Tab Start 
					<div class=" active custom_tab_main tab_border">
						<div class="col s12">
							<ul class="custom_tabs" style="margin-bottom: 0;">
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'makeitineraryv1') active @endif;" href="{{URL::to('/operator/makeitineraryv1/')}}">Itinerary By Lead </a>
								</li>
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'pastcontactfollowup') active @endif;" href="{{URL::to('/operator/pastcontactfollowup/')}}">New Itinerary </a>
								</li>
								<li class="custom_tab">
									<a class="@if(Request::segment(2) == 'makequotation') active @endif;" href="{{URL::to('/operator/makequotation/')}}">Send Quotation</a>
								</li>
							</ul> 
						</div>
					</div> 
					 /Tab End -->
				
					<div class="row" id="details">
						<div class="col s12 m1"></div>
						<div class="col s12 m10">
							<h3 class="card-title follow_title"><strong>New Ensober Itinerary Preview</strong></h3>
							<div class="preview_itinerary_main">
								<iframe style="width:100%; height:500px;" src="{{URL::to('/vender/itinerary/view/')}}/{{ $itinerary_no }}">
								
								</iframe>
							</div>

							<div>
								<!--<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_send_quo" onclick="sendQuotation();" style="display:none;">Send Quotation</button>
													
													
								<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo" onclick="downloadQuotation();" style="display:none;">View</button>-->
													
								<a href="{{URL::to('/vender/itinerary/download/')}}/{{ $itinerary_no }}" target="_blank" class=""><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo">Download</button></a>

								<a href="{{URL::to('/vender/itinerary/view/')}}/{{ $itinerary_no }}" target="_blank"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo">View</button></a>

								<a href="{{URL::to('/vender/itineraryupdate/')}}/{{ $itinerary_no }}" target="_blank"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo">Update Info</button></a>
								<br>
								<a href="{{URL::to('/vender/daywiseitiupdate/')}}/{{ $itinerary_no }}" target="_blank"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo">Edit Daywise Itinerary</button></a>
								
								<a href="{{URL::to('/vender/regenerateDayWiseIti/')}}/{{ $itinerary_no }}"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light btn_copy_quo">Regenerate</button></a>
								
							</div>
						</div>
						
						
					</div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script src="{{ URL::asset('asset/js/ckeditor.js') }}" type="text/javascript"></script>
	
    <!-- ITINERARY SCRIPT JS-->
		<script src="{{ URL::asset('asset/js/custom/itinerary_script.js') }}"></script>
    <!-- ITINERARY SCRIPT JS-->
	
	<script>
		ClassicEditor.create( document.querySelector( '.editor_hide' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		}).then( editor => {
			window.editor = editor;
		}).catch( err => {
			console.error( err.stack );
		});
	</script>
    <script>
		ClassicEditor.create( document.querySelector( '.editor1' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		}).then( editor => {
			window.editor = editor;
		}).catch( err => {
			console.error( err.stack );
		});
		
		ClassicEditor.create( document.querySelector( '.editor2' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		}).then( editor => {
			window.editor = editor;
		}).catch( err => {
			console.error( err.stack );
		});


		// this fuinction use for same info for agent.  
		function copyGuestInfo(){
			jQuery("#agent_name").val(jQuery("#name").val());
			jQuery("#agent_email").val(jQuery("#email").val());
			jQuery("#agent_mobile").val(jQuery("#mobile").val());
		}
		jQuery(document).ready(function(){
			// this fuinction use for same info for agent.  
			jQuery("#same_info").change(function(){
				var status = jQuery(this).prop("checked");
				if(status){
					jQuery("#agent_name").val(jQuery("#name").val());
					jQuery("#agent_email").val(jQuery("#email").val());
					jQuery("#agent_mobile").val(jQuery("#mobile").val());
				}else{
					jQuery("#agent_name").val('');
					jQuery("#agent_email").val('');
					jQuery("#agent_mobile").val('');
				}
			});
			
			// Hide show payment screenshot
			jQuery(".pay_img_sh").click(function(){
				jQuery(".payment_img").slideToggle();
			});
			
			// Open uoload image popup
			jQuery(".upload_img").click(function(){
				jQuery(".upload_image_popup").bPopup();
			});
			
			// Hide show email details
			jQuery("#email_details_checkbox").change(function(){
				jQuery(".email_details").toggle();
			});
			
			// Hide show agent_details
			jQuery("#agent_details").change(function(){
				jQuery(".agent_detail").toggle(); 
			});
			
			// Get payment source by hotel id
			//var hotel_id = jQuery("#hotel_list").val();
			//getPaymentSourceByHotelId(hotel_id);
			jQuery("#hotel_list").change(function(){
				var hotel_id = jQuery(this).val();
				getPaymentSourceByHotelId(hotel_id);
			});
			
			// Check quotation type is voucher
			jQuery("#quotation_type").change(function(){
				var quotation_type = jQuery(this).val();
				if(quotation_type == 'voucher'){
					//jQuery(".ens_popup").bPopup();
					jQuery(".voucher_details").show();
				}else{
					jQuery(".voucher_details").hide();
				}
			});
			
			// Check Final cost is greterthan 0 then hide rate calculation rate
			checkFinalCostAply();
			
			var send_quotation_no = jQuery("#send_quotation_no").val();
			jQuery("#sendquomo").val(send_quotation_no);
			
			// Open Basic Info
			jQuery("#lead_details").addClass("active");
			jQuery("#lead_details .collapsible-body").show();
			
			jQuery(".generate_send_quo").click(); 
			
			// Room inventory check box-shadow
			jQuery("#room_inventory_checkbox").change(function(){
				var check_status = jQuery(this).prop("checked");
				if(check_status == true){
					jQuery(".room_inventory_fields").show();
				}else{
					jQuery(".room_inventory_fields").hide();
				}
			});
			
			var check_status = jQuery("#room_inventory_checkbox").prop("checked");
			if(check_status == true){
				jQuery(".room_inventory_fields").show();
			}else{
				jQuery(".room_inventory_fields").hide();
			}
		});
    </script>
    
@endsection