
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
			font-size:16px;
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
			background-color: #2b9b84;
			color: #000;
			text-align: center;
			font-family: sans-serif;
		}
		.iti_foo_left {
			display:inline-block;
			height:110px;
			width: 200px;
			text-align: left;
			padding: 0px 10px 0;
			margin: 10px 0 0;
			vertical-align: middle;
		}
		.iti_foo_middil {
			display:inline-block;
			width: 230px;
			font-size: 13px;
			padding: 0px 10px 0;
			text-align: left;
			color: #fff;
			height:110px;
			border-right:0.5px solid #fff;
			vertical-align: middle;
		}
		.iti_foo_right {
			display:inline-block;
			width: 250px;
			font-size: 13px;
			padding: 0px 10px 0;
			color: #fff;
			height:110px;
			text-align: right;
			vertical-align: middle;
		}
		header {
			height: 130px;
			color: white;
			text-align: center;
			font-family: sans-serif;
			background-color: #b46d2e;
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
		img{max-width:100%;}
	</style>

            <div style="width: 770px; margin: 0 auto;">
				<header>
			<div class="iti_hea_left">
				<span style="font-size: 35px;">Itinerary</span><br>
				<span style="font-size: 35px;">Ensober Hotels</span>
			</div>
			<div class="iti_hea_right">
				Total Amount (INR)<br>
				<span style="font-size: 35px;"><img src="{{ URL::asset('asset/images/rupee.jpg') }}" style="width: 19px; margin-right: -8px;"/> 200.00</span> 
			</div>
        </header>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
			<table class="body">
				<tbody>
				<tr>
					<td><b>Itinerary No: </b> ENS9877687687</td>
					<td style="text-align: center;"><b>Create Date: </b> 20 May 2020</td>
					<td style="text-align: right;"><b>Payment Due: </b> 150.00 /-</td>
				</tr>
				</tbody>
			</table> <br>
			
			<!---- ======== Guest Details Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Guest Details</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/adult.JPG') }}" alt=""/></span> <b>No Of Adults:</b>  01
					</td>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/chield1.JPG') }}" alt=""/></span> <b>Kids (5-12 Years):</b> 02
					</td>
				</tr>
				<tr>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/chield.JPG') }}" alt=""/></span> <b>Infant (below 5 Years):</b>  01
					</td>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/tour.JPG') }}" alt=""/></span> <b>Tour Type:</b> Hotel With Transport.
					</td>
				</tr>
				<tr>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/map.JPG') }}" alt=""/></span> <b>Arrival City:</b>  Haridwar 
					</td>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/map.JPG') }}" alt=""/></span> <b>Drop City:</b>  Kausyan
					</td>
				</tr>
				<tr>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/cal.JPG') }}" alt=""/></span> <b>Arrival Date & Time:</b>  22 June 2020 10:30 AM
					</td>
					<td>
						<span><img src="{{ URL::asset('asset/images/icon/cal.JPG') }}" alt=""/></span> <b>Drop Date & Time:</b>  22 June 2020 10:30 AM
					</td>
				</tr>
			</table>
			<!---- ======== /Guest Details Area ======== ------>
			<br>
			<!---- ======== Hotel & Rooms Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Hotel & Rooms Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b>Distination</b>
					</td>
					<td>
						<b>Hotel Name</b>
					</td>
					<td>
						<b>Room Category</b>
					</td>
					<td>
						<b>Meal Plan</b>
					</td>
					<td>
						<b>No Of Rooms</b>
					</td>
					<td>
						<b>No Of Nights</b>
					</td>
					<td>
						<b>Extra Bed</b>
					</td>
					<td>
						<b>Rates</b>
					</td>
				</tr>
				<tr>
					<td>
						Mussooree
					</td>
					<td>
						Highland <span style="font-size:12px">(THREE STAR)</span>
					</td>
					<td>
						Deluxe Room <span style="font-size:12px">(Without Balcony)</span>
					</td>
					<td>
						CP <span style="font-size:12px">(Room with Breakfast)</span>
					</td>
					<td>
						01
					</td>
					<td>
						01
					</td>
					<td>No</td>
					<td>
						839.00 /-
					</td>
				</tr>
				<tr>
					<td>
						Kausyan
					</td>
					<td>
						Kausani Retreat <span style="font-size:12px">(THREE STAR)</span>
					</td>
					<td>
						Deluxe Room <span style="font-size:12px">(Without Balcony)</span>
					</td>
					<td>
						AP <span style="font-size:12px">(Room with all meals plan)</span>
					</td>
					<td>
						01
					</td>
					<td>
						01
					</td>
					<td>
						Yes
					</td>
					<td>
						1500.00 /-
					</td>
				</tr>
			</table>
			<!---- ======== Hotel & Rooms Area ======== ------>
			<br>
			<!---- ======== Transport Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Transport Info</b></td>
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
					<td>
						<b>Day Fare</b>
					</td>
				</tr>
				<tr>
					<td>
						SUB
					</td>
					<td>
						Test Car New
					</td>
					<td>
						04
					</td>
					<td>
						55
					</td>
					<td>
						Y
					</td>
					<td>
						Y
					</td>
					<td>
						Y
					</td>
					<td>
						Y
					</td>
					<td>
						555.00 /-
					</td>
				</tr>
				<tr>
				<td>
						SUB
					</td>
					<td>
						Test Car New
					</td>
					<td>
						04
					</td>
					<td>
						55
					</td>
					<td>
						Y
					</td>
					<td>
						Y
					</td>
					<td>
						Y
					</td>
					<td>
						Y
					</td>
					<td>
						555.00 /-
					</td>
				</tr>
			</table>
			<!---- ======== Transport Area ======== ------>
			<br>
			<!---- ======== Route Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Route Info</b></td>
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
				<tr>
					<td>
						Haridwar
					</td>
					<td>
						Mussooree
					</td>
					<td>
						Test2
					</td>
					<td>
						100 KM
					</td>
					<td>
						200 H
					</td>
				</tr>
				<tr>
					<td>
						Mussooree
					</td>
					<td>
						Kausyan
					</td>
					<td>
						gvgbhj111
					</td>
					<td>
						200011 KM	
					</td>
					<td>
						3001 H	
					</td>
				</tr>
			</table>
			<!---- ======== Route Area ======== ------>
			<br>
			<!---- ======== Activities Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Activities Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b></b>
					</td>
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
						<b>Rates</b>
					</td>
				</tr>
				<tr>
					<td>
						<img src="{{ URL::to('/') }}/storage/app/activities/rafting.jpg" class="hotel_img" style="min-width:115x;"/>
					</td>
					<td>
						demo cat name12
					</td>
					<td>
						demo cat1
					</td>
					<td>
						demo sub cat
					</td>
					<td>
						Haryana
					</td>
					<td>
						Haridwar
					</td>
					<td>
						839.00 /-
					</td>
				</tr>
				<tr>
					<td>
						<img src="{{ URL::to('/') }}/storage/app/activities/rafting1.jpeg" class="hotel_img" style="min-width:115x;"/>
					</td>
					<td>
						demo cat name12
					</td>
					<td>
						demo cat1
					</td>
					<td>
						demo sub cat
					</td>
					<td>
						Haryana
					</td>
					<td>
						Haridwar
					</td>
					<td>
						1451.00 /-
					</td>
				</tr>
			</table>
			<!---- ======== Activities Area ======== ------>
			<br>
			<!---- ======== Day Wise Itinerary Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Day Wise Itinerary Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<h3>Day 01 - Haridwar</h3>
						<p>Haridwar is an ancient city and important Hindu pilgrimage site in North India's Uttarakhand state, where the River Ganges exits the Himalayan foothills. The largest of several sacred ghats (bathing steps), Har Ki Pauri hosts a nightly Ganga Aarti (river-worshipping ceremony) in which tiny flickering lamps are floated off the steps. Worshipers fill the city during major festivals including the annual Kanwar Mela.</p>

						<img src="{{ URL::to('/') }}/storage/app/daywaiseiti/day1.jpg" class="hotel_img" />
					</td>
				</tr>
				<tr>
					<td>
						<h3>Day 02 - Mussoorie</h3>
						<p>Mussoorie is a hill station and a municipal board in the Dehradun district of the Indian state of Uttarakhand. It is about 35 kilometres from the state capital of Dehradun and 290 km north of the national capital of New Delhi. The hill station is in the foothills of the Garhwal Himalayan range. </p>
						<img src="{{ URL::to('/') }}/storage/app/daywaiseiti/day1.jpg" class="hotel_img" />
					</td>
				</tr>
				<tr>
					<td>
						<h3>Day 03 - Kausyan</h3>
						<p>Kalyan is a city in Thane district of Maharashtra state in Konkan division and a part of Mumbai Metropolitan Region. It is a neighbouring city of Mumbai and is governed by Kalyan-Dombivli Municipal Corporation. Kalyan is within the administrative division at a taluka level of Thane district.</p>
						<img src="{{ URL::to('/') }}/storage/app/daywaiseiti/day1.jpg" class="hotel_img" />
					</td>
				</tr>
			</table>
			<!---- ======== Day Wise Itinerary Area ======== ------>
        </main>
		
		<footer>
			<div class="iti_foo_left">
				<img src="{{ URL::asset('asset/images/Ensober.jpg') }}"/>
			</div>
			<div class="iti_foo_middil">
				<b>Ensober Hotels</b><br>
				Ensober Hotels | Luxury Hotels in Uttarakhand | Corbett | Nainital | Haridwar
				I-1804, SAMRIDHI GRAND AVENUE, NOIDA, DELHI-NCR
			</div>
			<div class="iti_foo_right">
				<b>Contact Information</b><br>
				Telephone : 8383908656, 8368643151<br>
				Email : raj@ensoberhotels.com; pragya@ensoberhotels.com<br>
				Web: <a href="http://www.ensoberhotels.com/" target="_blank">http://www.ensoberhotels.com/</a>
			</div>
        </footer>
		
			</div>