
	<style>
		td.lable_text {
			text-align: center;
			background-color: #009688;
				color:#fff;
			padding: 5px 0;
		}
		table.footer {
			border-top: 1px solid #555;
			padding: 10px 0 0; 
			font-size: 13px;
		}
		table {
			width: 700px;
			font-size: 18px;
			font-family: sans-serif;
			margin: 0 auto;
		}
		table.header {
			text-align: center;
		}
		table.header tr {
			border:none !important;
		}
		table.body td {
			padding: 10px 0 !important; 
			border:none !important;
		}
		table.body tr { 
			border:none !important;
		}
		/**table.body tr:nth-child(even) {background-color: #8b5050; color:#fff;}
		table.body tr:nth-child(odd) {background-color: #26237a; color:#fff;}**/
		
		.bottom_area {
			width: 100%;
			text-align: center;
			padding-top: 24px;
			border-top: 1px solid #555;
			margin-top: 15px;
			margin-bottom: 15px;
		}
		td.lable_text {
			text-align: center;
			background-color: #009688;
			color:#fff;
			padding: 5px 0;
		}
		.hotel_img {
			width: 90px;
			height: 90px;
			border: 1px solid #b3b0b0;
			padding: 5px;
			margin-top: 5px;
		}
		table.body td {
			padding: 9px 15px;
			margin: 0px -2px;
			font-size:14px;
			border-bottom: 0.5px solid #ddd3d3;
		}
		
		table.body {
			width:100%;
			color:#000;
			border-spacing: -1px;
			border:collapse; 
		}
		footer {
			height: 120px;
			padding: 10px 0px 0;
			background-color: #2b9b84;
			color: #000;
			text-align: center;
			font-family: sans-serif;
		}
		.iti_foo_left {
			padding: 10px 10px 0;
			margin: 10px 0 0;
			width: 400px;
			font-size: 13px;
			text-align: left;
			color: #fff;
			border-right: 0.5px solid #fff;
			float: left;
		}
		
		.iti_foo_right {
			float: left;
			width: 250px;
			font-size: 13px;
			padding: 10px 10px 0;
			color: #fff;
			text-align: left;
			line-height: 18px;
		}
		header {
			color: black;
			text-align: center;
			font-family: sans-serif;
		}
		.iti_hea_right {
			float: right;
			width: 250px;
			vertical-align: middle;
			height: 98px;
			background-color: #66350957;
			padding-top: 32px;
		}
		.iti_hea_left {
			float: left;
			text-align: left;
			padding: 11px 12px;
			line-height: 45px;
		}
		footer {
			padding-left: 0px !important;
		}
		*{margin:0px; padding:0px;}
		li{list-style:none;}
	</style>

<div style="width: 770px; margin: 0 auto;">
		<header>
			<br>
			<img src="https://www.ensoberhotels.com/images/logo.png" style="width: 150px;" alt="LOGO"/><br><br>
			<p style="font-size: 24px; margin-bottom:10px;">{{$routes}} Tour </p>
			<p>({{$basic_info->total_night}} Night/ {{$basic_info->total_night+1}} Days) </p><br>
			<p style="text-align:left; margin-bottom:5px;"><b>Travelling Date:</b> - {{date('d M Y', strtotime($basic_info->arrival_date))}}</p>
			<p style="text-align:left;"><b>Destinations:</b> - {{$routes}}.</p>
        </header><br>
		<hr style="color: #de7c00;"/>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main> <br>
			<table class="body">
				<tbody>
				<tr>
					<td style="text-align: left;"><b>Total Cost: </b> {{number_format($basic_info->total_price,2)}} /-</td>
					<td style="text-align: center;"><b>Create Date: </b> {{date('d M Y', strtotime($basic_info->created_at))}}</td>
					<td style="text-align: right;"><b>Itinerary No: </b> {{$basic_info->itinerary_no}}</td>
				</tr>
				</tbody>
			</table>
			<hr style="color: #de7c00;"/>

			<!---- ======== Guest Details Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size: 18px;color: #2a9986;"><b>Guest Details</b></td>
				</tr>
				</tbody>
			</table>
			
			<table class="body">
				<tr>
					<td>
						<b>Guest/Agency Name : </b> {{$basic_info->name}}
					</td>
					<td>
						<b>Mobile : </b> {{$basic_info->mobile}}
					</td>
				</tr>
				<tr>
					<td>
						<span><img src="{{ URL::asset('public/asset/images/icon/adult.JPG') }}" alt=""/></span> <b>Adults:</b>  {{$basic_info->adult}}
					</td>
					<td>
						<span><img src="{{ URL::asset('public/asset/images/icon/chield1.JPG') }}" alt=""/></span> <b>Kids (5-12 Y):</b> {{$basic_info->kids}}
					</td>
					<td>
						<span><img src="{{ URL::asset('public/asset/images/icon/chield.JPG') }}" alt=""/></span> <b>Infant (below 5 Y):</b>  {{$basic_info->infant}}
					</td>
				</tr>
			</table>
			<hr style="color: #de7c00;"/>

			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size: 18px;color: #2a9986;"><b>Tour Details</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<span><img src="{{ URL::asset('public/asset/images/icon/tour.JPG') }}" alt=""/></span> <b>Tour Type:</b> {{$basic_info->tour_type}}
					</td>
					<td>
						<span><img src="{{ URL::asset('public/asset/images/icon/map.JPG') }}" alt=""/></span> <b>Arrival City:</b>  {{@$basic_info->arrivalCity->name}} 
					</td>
					<td>
						<span><img src="{{ URL::asset('public/asset/images/icon/map.JPG') }}" alt=""/></span> <b>Drop City:</b>  {{@$basic_info->dropCity->name}}
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<table style="width: 100%;">
							<tr>
								<td>
									<span><img src="{{ URL::asset('public/asset/images/icon/cal.JPG') }}" alt=""/></span> <b>Arrival Date & Time:</b>  {{date('d M Y', strtotime($basic_info->arrival_date))}} {{date('H:i A', strtotime($basic_info->arrival_time))}}
								</td>
								<td>
									<span><img src="{{ URL::asset('public/asset/images/icon/cal.JPG') }}" alt=""/></span> <b>Drop Date & Time:</b>  {{date('d M Y', strtotime($basic_info->drop_date))}} {{date('H:i A', strtotime($basic_info->drop_time))}}
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<hr style="color: #de7c00;"/>
			<!---- ======== /Guest Details Area ======== ------>
			<br>
			<!---- ======== Hotel & Rooms Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size: 18px;color: #2a9986;"><b>Hotel & Rooms Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b>Hotel Name</b>
					</td>
					<td>
						<b>Distination</b>
					</td>
					<td>
						<b>Room Category</b>
					</td>
					<td>
						<b>Meal Plan</b>
					</td>
					<td>
						<b>Rooms</b>
					</td>
					<td>
						<b>Nights</b>
					</td>
					<!--<td>
						<b>Extra Bed</b>
					</td>-->
					@if($basic_info->rate_show == 'Y')
					<td>
						<b>Rates</b>
					</td>
					@endif
				</tr>
				@foreach($hotel_info as $hotel)
				<tr>
					<td>
						{{$hotel->getHotel->hotel_name}} <br><span style="font-size:12px">({{@$hotel->getHotel->start_category}} STAR)</span>
					</td>
					<td>
						{{$hotel->getdistination->name}}
					</td>
					<td>
						{{$hotel->getRoomType->room_type}} <br><span style="font-size:12px">({{ getHotelRoomName($hotel->hotel, $hotel->room_type) }})</span>
					</td>
					<td>
						@php 
							$plane_m = '';
							if($hotel->meal_plan == 'ep_price'){
								$plane_m = 'EP <br><span style="font-size:12px">(Room Only)</span>';
							}elseif($hotel->meal_plan == 'cp_price'){
								$plane_m = 'CP <br><span style="font-size:12px">(Room with Breakfast)</span>';
							}elseif($hotel->meal_plan == 'map_price'){
								$plane_m = 'MAP <br><span style="font-size:12px">(Room with Brkfst &amp; Dnr)</span>';
							}elseif($hotel->meal_plan == 'ap_price'){
								$plane_m = 'AP <br><span style="font-size:12px">(Room with all meals plan)</span>';
							}
						@endphp 
						{!!$plane_m!!}
					</td>
					<td>
						{{$hotel->no_of_rooms}}
					</td>
					<td>
						{{$hotel->no_of_nights}}
					</td>
					<!--<td>No</td>-->
					@if($basic_info->rate_show == 'Y')
					<td>
						{{number_format($hotel->rate,2)}} /-
					</td>
					@endif
				</tr>
				@endforeach
			</table>
			<hr style="color: #de7c00;"/>
			<!---- ======== Hotel & Rooms Area ======== ------>
			<br>
			<!---- ======== Transport Area ======== ------>
			<table class="body">
				<tbody>
					<tr> 
						<td style="font-size: 18px;color: #2a9986;"><b>Transport Info</b></td>
					</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b>Vehicle Type</b>
					</td>
					<td>
						<b>Vehicle Name</b>
					</td>
					<td>
						<b>Seating Capecity</b>
					</td>
					<td>
						<b>Max KM Run</b>
					</td>
					<td>
						<b>TOll</b>
					</td>
					<td>
						<b>Tax</b>
					</td>
					<td>
						<b>Parking</b>
					</td>
					<td>
						<b>Allowance</b>
					</td>
					@if($basic_info->rate_show == 'Y')
					<td>
						<b>Fare</b>
					</td>
					@endif
				</tr>
				@foreach($transport_info as $transport)
				<tr>
					<td>
						{{$transport->getTransport->car_segment->name}}
					</td>
					<td>
						{{$transport->getTransport->car->car_name}}
					</td>
					<td>
						{{@$transport->getTransport->car_seats->seats}}
					</td>
					<td>
						@php $day_n = $basic_info->total_night+1 @endphp
						{{$transport->getTransport->perday_km*$day_n}}
					</td>
					<td>
						{{$transport->getTransport->toll == 1?'Y':'N'}}
					</td>
					<td>
						{{$transport->getTransport->tax == 1?'Y':'N'}}
					</td>
					<td>
						{{$transport->getTransport->parking == 1?'Y':'N'}}
					</td>
					<td>
						{{$transport->getTransport->allowance == 1?'Y':'N'}}
					</td>
					@if($basic_info->rate_show == 'Y')
					<td>
						{{number_format(@$transport->getPrice->price,2)}} /-
					</td>
					@endif
				</tr>
				@endforeach
			</table>
			<!---- ======== Transport Area ======== ------>
			<hr style="color: #de7c00;"/>
			<br>
			<!---- ======== Route Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size: 18px;color: #2a9986;"><b>Route Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b>Start Distination</b>
					</td>
					<td>
						<b>To Distination</b>
					</td>
					<td>
						<b>Via/Way Sightseeing</b>
					</td>
					<td>
						<b>Distance</b>
					</td>
					<td>
						<b>Journey Time</b>
					</td>
				</tr>
				@foreach($route_info as $route)
				<tr>
					<td>
						{{@$route->getStartDistination->name}}
					</td>
					<td>
						{{@$route->getToDistination->name}}
					</td>
					<td>
						{{$route->via}}
					</td>
					<td>
						{{$route->distance}} KM
					</td>
					<td>
						{{$route->duration}}
					</td>
				</tr>
				@endforeach
			</table>
			<hr style="color: #de7c00;"/>
			<!---- ======== Route Area ======== ------>
			<br>
			<!---- ======== Activities Area ======== ------>
			@if(count($activity_info) >1)
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size: 18px;color: #2a9986;"><b>Activities Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b>Name</b>
					</td>
					<td>
						<b>Category</b>
					</td>
					<td>
						<b>Sub-Category</b>
					</td>
					<td>
						<b>State</b>
					</td>
					<td>
						<b>City</b>
					</td>
					<td>
						<b>Date</b>
					</td>
					<td>
						<b>Time</b>
					</td>
					@if($basic_info->rate_show == 'Y')
					<td>
						<b>Rates</b>
					</td>
					@endif
				</tr>
				@foreach($activity_info as $activity)
				<tr>
					<td>
						{{@$activity->getActivity->activityCat->activity_cat}} {{@$activity->getActivity->activitySubCat->activity_subcat}}
					</td>
					<td>
						{{@$activity->getActivity->activityCat->activity_cat}}
					</td>
					<td>
						{{@$activity->getActivity->activitySubCat->activity_subcat}}
					</td>
					<td>
						{{@$activity->getActivity->stateName->name}}
					</td>
					<td>
						{{@$activity->getActivity->cityName->name}}
					</td>
					<td>
						{{date('d M Y', strtotime($activity->activity_date))}}
					</td>
					<td>
						{{$activity->activity_time}}
					</td>
					@if($basic_info->rate_show == 'Y')
					<td>
						{{number_format($activity->price,2)}} /-
					</td>
					@endif
				</tr>
				@endforeach
			</table>
			<hr style="color: #de7c00;"/>
			@endif
			<!---- ======== Activities Area ======== ------>
			<br>
			@if($basic_info->comment != '')
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size: 18px;color: #2a9986;"><b>Comment</b></td>
				</tr>
				<tr> 
					<td>{{$basic_info->comment}}</td>
				</tr>
				</tbody>
			</table>
			<hr style="color: #de7c00;"/>
			@endif
			<br>
			<!---- ======== Day Wise Itinerary Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size: 18px;color: #2a9986;"><b>Day Wise Itinerary Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				@foreach($daywiseiti_info as $daywiseiti)
				<tr>
					<td>
						@if($daywiseiti->pickup == 0 && $daywiseiti->dropup == 0)
							<h3>Day {{ $daywiseiti->day }}:- </h3>
						@endif
						{!!$daywiseiti->description!!}
						<br><br>
						@if($daywiseiti->pickup == 0 && $daywiseiti->dropup == 0 && $daywiseiti->image != '')
							<center><img src="{{ URL::to($daywiseiti->image) }}" style="width:380px;height:200px;box-shadow: 0 0 15px;border-radius: 5px;"/></center>
						@endif
					</td>
				</tr>
				@endforeach
			</table>
			<!---- ======== Day Wise Itinerary Area ======== ------>
        </main>
		
		<footer>
			<div class="iti_foo_left">
				<b>Ensober Hotels</b><br>
				Luxury Hotels in Uttarakhand | Corbett | Nainital | Haridwar<br><br>
				<b>Address:</b> <br>I-1804, SAMRIDHI GRAND AVENUE, NOIDA, DELHI-NCR
			</div>
			<div class="iti_foo_right">
				<b>Contact Information</b><br>
				Telephone : 8383908656, 8368643151<br>
				Email : raj@ensoberhotels.com; pragya@ensoberhotels.com<br>
				Web: <a href="http://www.ensoberhotels.com/" target="_blank">http://www.ensoberhotels.com/</a>
			</div>
        </footer>
		
			</div>
