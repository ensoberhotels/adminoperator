@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
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
			width: 230px;
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
			height: 129px;
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
                 <li class="breadcrumb-item"><a href="#">Amenities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Voucher</a>
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
  <!-- Multi Select -->

  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="row">
            <div style="width: 800px; margin: 0 auto;">
				<header>
			<div class="iti_hea_left">
				<span style="font-size: 35px;">Itinerary</span><br>
				<span style="font-size: 35px;">Ensober Hotels</span>
			</div>
			<div class="iti_hea_right">
				Total Amount (INR)<br>
				<span style="font-size: 35px;"><img src="/asset/images/rupee.jpg" style="width: 19px; margin-right: -8px;"/> 200.00</span> 
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
			
			<!---- ======== Basic Details Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a;color: #72534a;"><b>Basic Info</b></td>
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
			<!---- ======== /Basic Details Area ======== ------>
			<br>
			<!---- ======== Transport Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a;color: #72534a;"><b>Transport Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b>Car Pic</b>
					</td>
					<td>
						<b>Car Name</b>
					</td>
					<td>
						<b>Total Seat</b>
					</td>
					<td>
						<b>Max KM</b>
					</td>
					<td>
						<b>Per KM</b>
					</td>
					<td>
						<b>Day Fare</b>
					</td>
				</tr>
				<tr>
					<td>
						<img src="/storage/app/car/2SPfwSkTdmduZF8PG16jn4RMytbVyrjSU9JJJIlO.jpeg" width="100px">
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
						05
					</td>
					<td>
						555.00 /-
					</td>
				</tr>
				<tr>
					<td>
						<img src="/storage/app/car/2SPfwSkTdmduZF8PG16jn4RMytbVyrjSU9JJJIlO.jpeg" width="100px">
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
						05
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
					<td style="font-size:20px;border-bottom: 3px dotted #72534a;color: #72534a;"><b>Route Info</b></td>
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
			
			<!---- ======== Hotel & Rooms Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a;color: #72534a;"><b>Hotel & Rooms Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td>
						<b>Distination</b>
					</td>
					<td>
						<b>Hotel</b>
					</td>
					<td>
						<b>Room Type</b>
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
						<b>Rates</b>
					</td>
				</tr>
				<tr>
					<td>
						Mussooree
					</td>
					<td>
						Highland (THREE STAR)<br>
						<img src="/storage/app/hotel_images/E47vsFB7pc7UQyykngtU9IBDo0y1XKTmddQKwLVV.jpeg" class="hotel_img" />
					</td>
					<td>
						Deluxe Room (Without Balcony)
					</td>
					<td>
						CP (Room with Breakfast)
					</td>
					<td>
						01
					</td>
					<td>
						01
					</td>
					<td>
						839.00 /-
					</td>
				</tr>
				<tr>
					<td>
						Kausyan
					</td>
					<td>
						Kausani Retreat (THREE STAR)<br>
						<img src="/storage/app/hotel_images/ClwwFNbgNRDgU4l7IOnjMCzRoMHf3CxNx582h5bj.jpeg" class="hotel_img"/>
					</td>
					<td>
						Deluxe Room (Without Balcony)
					</td>
					<td>
						AP (Room with all meals plan)
					</td>
					<td>
						01
					</td>
					<td>
						01
					</td>
					<td>
						1500.00 /-
					</td>
				</tr>
			</table>
			<!---- ======== Hotel & Rooms Area ======== ------>
			<br>
			<!---- ======== Activities Area ======== ------>
			<table class="body">
				<tbody>
				<tr> 
					<td style="font-size:20px;border-bottom: 3px dotted #72534a;color: #72534a;"><b>Activities Info</b></td>
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
						<img src="/storage/app/activities/rafting.jpg" class="hotel_img" />
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
						<img src="/storage/app/activities/rafting1.jpeg" class="hotel_img" />
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
					<td style="font-size:20px;border-bottom: 3px dotted #72534a;color: #72534a;"><b>Day Wise Itinerary Info</b></td>
				</tr>
				</tbody>
			</table>
			<table class="body">
				<tr>
					<td style="width: 110px;">
						<img src="/storage/app/daywaiseiti/day1.jpg" class="hotel_img" />
					</td>
					<td>
						<h3>Day 01 - Haridwar</h3>
						<p>Haridwar is an ancient city and important Hindu pilgrimage site in North India's Uttarakhand state, where the River Ganges exits the Himalayan foothills. The largest of several sacred ghats (bathing steps), Har Ki Pauri hosts a nightly Ganga Aarti (river-worshipping ceremony) in which tiny flickering lamps are floated off the steps. Worshipers fill the city during major festivals including the annual Kanwar Mela.</p>
					</td>
				</tr>
				<tr>
					<td style="width: 110px;">
						<img src="/storage/app/daywaiseiti/day2.jpg" class="hotel_img" />
					</td>
					<td>
						<h3>Day 02 - Mussoorie</h3>
						<p>Mussoorie is a hill station and a municipal board in the Dehradun district of the Indian state of Uttarakhand. It is about 35 kilometres from the state capital of Dehradun and 290 km north of the national capital of New Delhi. The hill station is in the foothills of the Garhwal Himalayan range. </p>
					</td>
				</tr>
				<tr>
					<td style="width: 110px;">
						<img src="/storage/app/daywaiseiti/day3.jpg" class="hotel_img" />
					</td>
					<td>
						<h3>Day 03 - Kausyan</h3>
						<p>Kalyan is a city in Thane district of Maharashtra state in Konkan division and a part of Mumbai Metropolitan Region. It is a neighbouring city of Mumbai and is governed by Kalyan-Dombivli Municipal Corporation. Kalyan is within the administrative division at a taluka level of Thane district.</p>
					</td>
				</tr>
			</table>
			<!---- ======== Day Wise Itinerary Area ======== ------>
        </main>
		
		<footer>
			<div class="iti_foo_left">
				<img src="/asset/images/Ensober.jpg"/>
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
			
			
			<div class="bottom_area"> 
				<a href="{{ url('admin/itinerary/download/'.$voucher->id) }}"><button type="button" class="btn btn-info">Download PDF</button></a> 
				<form class="form-inline" action="{{ url('admin/voucher/send') }}" method="post" style="display: inline-block; margin-left: 15px;">
				{{csrf_field()}}
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" style="   display: inline-block; width: 260px !important;" required>
					<input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
					<button type="submit" class="btn btn-primary">Send</button>
				</form>
			</div>
          </div>
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
	
	<script>
		/* jQuery(document).ready(function(){
			jQuery(".car_delete").click(function(event){
				event.preventDefault();
				var car_id = jQuery(this).attr("carid");
				jQuery.ajax({
					type: 'get',
					url: '/admin/car/destroy/'+car_id,
					//data: {'delete':'delete'},
					success: function(res){
						console.log(res);
					}
				});
			});
		}); */
	</script>
@endsection