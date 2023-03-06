@extends('vender.template.blank')

@section('title', 'Ensober | Make Itinerary')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
   <style>
        @media print {
			#printbtn {
				display :  none;
			}
		}
		.btn-primary {
			background: #2f90e6;
			border: none;
			padding: 7px 20px;
			border-radius: 3px;
			color: #fff;
			font-size: 20px; cursor: pointer;
		}
		td, th{text-transform: capitalize;}
		td, th{font-size: 18px;}
    </style>
@endsection

@section('content')
	<!-- BEGIN: Page Main-->
	<?php 
		/* echo "<pre>";
		print_r($itinerary);
		echo "</pre>"; */
	?>
    <div class="itinerary_main">
      <div class="row">
		<div class="col-12">
			<div id="Panel1Panel" style="display: inline;">
	<div id="Panel1" style="text-align: center;font-size: 29px; font-family: arial;">
		<div class="row" style="width: 95%; visibility: visible; margin:0 auto;">
			<div style="width: 48%;text-align: left;float: left;">
				<a href="http://www.ensoberhotels.com/"><img src="http://www.ensoberhotels.com/Stingo-Adm/images/logo/1560581749logo.png" id="logo"></a>
			</div>
			<div style="width:50%;float: right;text-align: right;">
				<span id="lblTitle" class="pageTitle" style="text-align:center; font-weight:bold;">Itineary View</span>
				<b style="width: 100%;float: left;font-size: 18px;">Itineary No: 987987</b>
				<b style="width: 100%;float: left;font-size: 18px;">Date: 28-03-2020</b>
			</div>
		</div>
         
        <div style="display: inline;">
							<div style="width: 95%; visibility: visible; margin:0 auto;">
								<div style=" width: 100%;margin: 0 auto 30px;">
									<table width="100%">
										<tbody>
										
										</tr> 
									</tbody>
									</table> 
								</div>
								 
								 
								<div id="" style="display: inline;">
								<table class="rgMasterTable" border="1" cellpadding="5" cellspacing="0" style="width:100%;">
											<thead>
												<tr>
													<th scope="col" class="rgHeader"> Travel Start Date </th>
													<th scope="col" class="rgHeader"> Person </th>
													<th scope="col" class="rgHeade">Vehicle </th>
													<th scope="col" class="rgHeader"> Night </th>
													<th scope="col" class="rgHeader"> Cost </th>
												</tr>
												
											</thead>
											<tbody id="show_student">
                      											  <tr>
													<td scope="col" class="rgHeader">2-feb-2021</td>
													<td scope="col" class="rgHeader">19 </td>
													<td scope="col" class="rgHeader"> Inova& Auto </td>
													<td scope="col" class="rgHeader"> 6	</td>
													<td scope="col" class="rgHeader"> 10000 </td>
												</tr>
           


                                                
											</tbody>
                      
                      										
										</table> 
										<br><br>
								</div>
								<div id="" style="display: inline;">
								<table class="rgMasterTable" border="1" cellpadding="5" cellspacing="0" style="width:100%;">
											<thead>
												<tr>
													<th scope="col" class="rgHeader"> S.no </th>
													<th scope="col" class="rgHeader"> Date </th>
													<th scope="col" class="rgHeade">Place </th>
													<th scope="col" class="rgHeader"> Hotel </th>
													<th scope="col" class="rgHeader"> Room </th>
													<th scope="col" class="rgHeader"> Room Categeary </th>
													<th scope="col" class="rgHeade">Meal </th>
													<th scope="col" class="rgHeader"> Night </th>
												</tr>
												
											</thead>
											<tbody id="show_student">
                      											  <tr>
													<td scope="col" class="rgHeader">1</td>
													<td scope="col" class="rgHeader">2-feb-2020 </td>
													<td scope="col" class="rgHeader"> Haridwar </td>
													<td scope="col" class="rgHeader"> vinajak	</td>
													<td scope="col" class="rgHeader"> 8 </td>
													<td scope="col" class="rgHeader"> Deluxe </td>
													<td scope="col" class="rgHeader"> lunch&Dinner	</td>
													<td scope="col" class="rgHeader"> 01 </td>
												</tr>
												 <tr>
													<td scope="col" class="rgHeader">2</td>
													<td scope="col" class="rgHeader">3-feb-2020 </td>
													<td scope="col" class="rgHeader"> Corbetl </td>
													<td scope="col" class="rgHeader"> Panorawa	</td>
													<td scope="col" class="rgHeader"> 8 </td>
													<td scope="col" class="rgHeader"> Poolveiw </td>
													<td scope="col" class="rgHeader"> lunch&Dinner	</td>
													<td scope="col" class="rgHeader"> 02 </td>
												</tr>
												<tr>
													<td scope="col" class="rgHeader">3</td>
													<td scope="col" class="rgHeader">3-feb-2020 </td>
													<td scope="col" class="rgHeader"> Neinital </td>
													<td scope="col" class="rgHeader"> Pinecrest	</td>
													<td scope="col" class="rgHeader"> 7 </td>
													<td scope="col" class="rgHeader"> Vallyview </td>
													<td scope="col" class="rgHeader"> lunch&Dinner$breckfast	</td>
													<td scope="col" class="rgHeader"> 01 </td>
												</tr>
           
										

                                                
											</tbody>
                      
                      										
										</table> 
								</div>
								<div style="float:left; text-align:left; width:100%;">
								<h4>Dayarise Tour Plan</h4>
								<hr>
								<table>
									<tr>
										<td><h3>Day01</h3></td>
										<td width="50px">:</td>
										<td>
											<p>Arrival: Delhi</p>
											<p>Great & Meet Traivel To Haridwar</p>
											<p>Checkin At Hotel</p>
										</td>
									</tr>
								</table>
								</div>
								
               
                
								
								<div style=" width: 100%;margin:40px auto 40px;" id="printbtn"> 
									<a onclick="window.print()">
									  <button type="button" class="btn btn-primary" style="padding: 7px 25px; font-size: 16px;">Print</button> </a>
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