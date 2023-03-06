	<?php 
		$current_route = \Request::route()->getName();
	?>
   <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img src="{{ URL::asset('public/asset/images/logo/logo.png') }}" alt="logo"/><span class="logo-text hide-on-med-and-down"></span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

		@if($admin['id'][0] == 2)	
			<!-- Add Hotel -->
			<li class="bold @if(Request::segment(2) == 'hotel') {{ 'active' }} @endif">
				<a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">local_hotel</i><span class="menu-title" data-i18n="">Hotel</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Hotel</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/hotel/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Hotels</span></a>
						</li>
					</ul>
				</div>
			</li>
			
			<!-- Htels Season Rate --> 
			<li class="bold @if(Request::segment(2) == 'hotelseasonrate') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">poll</i><span class="menu-title" data-i18n="">Hotel Season Rate</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/hotelseasonrate')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Rate</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/hotelseasonrate/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Season Rate</span></a>
						</li>
					</ul>
				</div>
			</li>
			
			<!-- Cars --> 
			<li class="bold @if(Request::segment(2) == 'car') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/car')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Cars</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/car/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car</span></a>
						</li>
					</ul>
				</div>
			</li>
			
			<!-- Cars Segment --> 
			<li class="bold @if(Request::segment(2) == 'carsegment') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars Segment</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/carsegment')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Car Segments</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/carsegment/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car Segment</span></a>
						</li>
					</ul>
				</div>
			</li>

			<!-- Cars Model --> 
			<li class="bold @if(Request::segment(2) == 'carsmodel') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars Model</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/carsmodel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Car Model</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/carsmodel/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car Model</span></a>
						</li>
					</ul>
				</div>
			</li>

			<!-- Cars Seats --> 
			<li class="bold @if(Request::segment(2) == 'carseat') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars Seats</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/carseat')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Car Seats</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/carseat/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car Seats</span></a>
						</li>
					</ul>
				</div>
			</li>
			
			
			<!-- Transport --> 
			<li class="bold @if(Request::segment(2) == 'transport') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">local_car_wash</i><span class="menu-title" data-i18n="">Transport</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/transport')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Transports</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/transport/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Transport</span></a>
						</li>
					</ul>
				</div>
			</li>
			
			<!-- Via Route --> 
			<li class="bold @if(Request::segment(2) == 'via') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">location_on</i><span class="menu-title" data-i18n="">Via Route</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/via')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Via Route</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/via/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Via Route</span></a>
						</li>
					</ul>
				</div>
			</li>

			<!-- Day Wise Details --> 
			<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">assignment_turned_in</i><span class="menu-title" data-i18n="">Day Wise Itinerary</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/admin/daywisedetail')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Day Wise</span></a> 
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/daywisedetail/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Day Wise</span></a> 
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/admin/itinerary/cities')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Update City List</span></a> 
						</li>
					</ul>
				</div>
			</li> 

		@else

        <li class="active"><a class="collapsible-body active" href="{{URL::to('/admin/dashboard')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Dashboard</span></a>
        </li>
		
		<li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
		
		<!-- View Vendors -->
		<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">View Vendors</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Hotel Vendor</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Activity Vendor</span></a> 
					</li>
					
					<li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Transport Vendor</span></a> 
					</li>
				</ul>
			</div>
		</li>
				
		<!-- Vendors Related Menus -->
		<li class="bold @if(Request::segment(2) == 'vender' || Request::segment(2) == 'hotel'|| Request::segment(2) == 'hotelseasonrate'|| Request::segment(2) == 'hotelgroupseasonrate'|| Request::segment(2) == 'paymentsource'|| Request::segment(2) == 'car'|| Request::segment(2) == 'transport'|| Request::segment(2) == 'via'|| Request::segment(2) == 'amenity'|| Request::segment(2) == 'activityname'|| Request::segment(2) == 'activitycat'|| Request::segment(2) == 'activitysubcat'|| Request::segment(2) == 'activity') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">Vendors</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<!-- Add Vender -->
					<li class="bold @if(Request::segment(2) == 'vender') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">Add Vendors</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/vender')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Vendor</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/vender/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Vendor</span></a> 
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Add Hotel -->
					<li class="bold @if(Request::segment(2) == 'hotel') {{ 'active' }} @endif">
						<a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">local_hotel</i><span class="menu-title" data-i18n="">Hotel</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Hotel</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/hotel/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Hotels</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Htels Season Rate --> 
					<li class="bold @if(Request::segment(2) == 'hotelseasonrate') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">poll</i><span class="menu-title" data-i18n="">Hotel Season Rate</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/hotelseasonrate')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Rate</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/hotelseasonrate/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Season Rate</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Htels Group Season Rate --> 
					<li class="bold @if(Request::segment(2) == 'hotelgroupseasonrate') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">network_check</i><span class="menu-title" data-i18n="">Hotel Group S. Rate</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/hotelgroupseasonrate')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Group Rate</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/hotelgroupseasonrate/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Group S. Rate</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Htels Payment Source --> 
					<li class="bold @if(Request::segment(2) == 'paymentsource') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">poll</i><span class="menu-title" data-i18n="">Hotel Payment Source</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/paymentsource')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Payment Sources</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/paymentsource/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Payment Source</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Cars --> 
					<li class="bold @if(Request::segment(2) == 'car') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/car')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Cars</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/car/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Cars Segment --> 
					<li class="bold @if(Request::segment(2) == 'carsegment') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars Segment</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/carsegment')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Car Segments</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/carsegment/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car Segment</span></a>
								</li>
							</ul>
						</div>
					</li>

					<!-- Cars Model --> 
					<li class="bold @if(Request::segment(2) == 'carsmodel') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars Model</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/carsmodel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Car Model</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/carsmodel/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car Model</span></a>
								</li>
							</ul>
						</div>
					</li>

					<!-- Cars Seats --> 
					<li class="bold @if(Request::segment(2) == 'carseat') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="">Cars Seat</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/carseat')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Car Seats</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/carseat/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Car Seats</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					
					<!-- Transport --> 
					<li class="bold @if(Request::segment(2) == 'transport') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">local_car_wash</i><span class="menu-title" data-i18n="">Transport</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/transport')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Transports</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/transport/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Transport</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Via Route --> 
					<li class="bold @if(Request::segment(2) == 'via') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">location_on</i><span class="menu-title" data-i18n="">Via Route</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/via')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Via Route</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/via/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Via Route</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Add Amenities --> 
					<li class="bold @if(Request::segment(2) == 'amenity') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">streetview</i><span class="menu-title" data-i18n="">Add Amenities</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/amenity')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Amenities</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/amenity/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Amenities</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					
					<!-- Activities --> 
					<li class="bold @if(Request::segment(2) == 'activityname' || Request::segment(2) == 'activitycat' || Request::segment(2) == 'activitysubcat') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">hot_tub</i><span class="menu-title" data-i18n="">Activities Items</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
							
							<!-- Activity Name --> 
							<li class="bold @if(Request::segment(2) == 'activitycat') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Activity Name</span></a>
								<div class="collapsible-body">
									<ul class="collapsible" data-collapsible="accordion">
										<li><a class="collapsible-body" href="{{URL::to('/admin/activitycat')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activity Name</span></a> 
										</li>
										<li><a class="collapsible-body" href="{{URL::to('/admin/activitycat/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity Name</span></a>
										</li>
									</ul>
								</div>
							</li>
							
							<!-- Activity Names --> 
							<!--<li class="bold @if(Request::segment(2) == 'activityname') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Activity Names</span></a>
								<div class="collapsible-body">
									<ul class="collapsible" data-collapsible="accordion">
										<li><a class="collapsible-body" href="{{URL::to('/admin/activityname')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activity Names</span></a> 
										</li>
										<li><a class="collapsible-body" href="{{URL::to('/admin/activityname/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity Name</span></a>
										</li>
									</ul>
								</div>
							</li>-->
							
							<!-- Activity Zone --> 
							<li class="bold @if(Request::segment(2) == 'activitysubcat') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Activity Zone</span></a>
								<div class="collapsible-body">
									<ul class="collapsible" data-collapsible="accordion">
										<li><a class="collapsible-body" href="{{URL::to('/admin/activitysubcat')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activity Zone</span></a> 
										</li>
										<li><a class="collapsible-body" href="{{URL::to('/admin/activitysubcat/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity Zone</span></a>
										</li>
									</ul>
								</div>
							</li>
							</ul>
						</div>
					</li>
					
					<!-- Add Activities --> 
					<li class="bold @if(Request::segment(2) == 'activity') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">pool</i><span class="menu-title" data-i18n="">Activities</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/admin/activity')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activities</span></a> 
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/admin/activity/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity</span></a> 
								</li>
							</ul>
						</div>
					</li>
					
				</ul>
			</div>
		</li>
				
		<!-- Operators --> 
		<li class="bold @if(Request::segment(2) == 'operator') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">airline_seat_recline_normal</i><span class="menu-title" data-i18n="">Operators</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/operator')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Operators</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/operator/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Operator</span></a>
					</li>
				</ul>
			</div>
		</li>
				
		<!-- Add Lead --> 
		<li class="bold @if(Request::segment(2) == 'lead') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">library_books</i><span class="menu-title" data-i18n="">Leads</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/lead')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Lead</span></a> 
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/lead/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Lead</span></a> 
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/viewleadstatus')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View Lead Status</span></a> 
					</li>
				</ul>
			</div>
		</li>
                
        <!-- Add contacts -->
		<li class="bold @if(Request::segment(2) == 'contact') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">airline_seat_recline_normal</i><span class="menu-title" data-i18n="">Conctacts</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/contact')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Contacts</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/contact/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Contact</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/importcontact')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Import Contact</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/assigncontact')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Assign Contact</span></a>
					</li>
				</ul>
			</div>
		</li>
				
		<!-- Emailing System -->
		<li class="bold @if(Request::segment(2) == 'addemaillist' || Request::segment(2) == 'emailtemplate' || Request::segment(2) == 'smtpemail') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">email</i><span class="menu-title" data-i18n="">Emailing System</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
				
				<!-- Add Emailing -->
				<li class="bold @if(Request::segment(2) == 'smtpemail') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">SMTP Email</span></a>
					<div class="collapsible-body">
						<ul class="collapsible" data-collapsible="accordion">
							<li><a class="collapsible-body" href="{{URL::to('/admin/smtpemail')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Email</span></a> 
							</li>
							<li><a class="collapsible-body" href="{{URL::to('/admin/smtpemail/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Email</span></a>
							</li>
						</ul>
					</div>
				</li>
				
				<!-- Email Template --> 
				<li class="bold @if(Request::segment(2) == 'emailtemplate') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Email Campaign</span></a>
					<div class="collapsible-body">
						<ul class="collapsible" data-collapsible="accordion">
							<li><a class="collapsible-body" href="{{URL::to('/admin/emailtemplate')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Campaigns</span></a> 
							</li>
							<li><a class="collapsible-body" href="{{URL::to('/admin/emailtemplate/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Campaign</span></a>
							</li>
						</ul>
					</div>
				</li>
				
				<!-- Email Campaign --> 
				<li class="bold @if(Request::segment(2) == 'addemaillist') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Campaign Contacts</span></a>
					<div class="collapsible-body">
						<ul class="collapsible" data-collapsible="accordion">
							<li><a class="collapsible-body" href="{{URL::to('/admin/addemaillist')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Contact List</span></a> 
							</li>
							<li><a class="collapsible-body" href="{{URL::to('/admin/emailcampaign')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Contact Lists</span></a> 
							</li>
						</ul>
					</div>
				</li>
				
				</ul>
			</div>
		</li>
				
		<!-- Notification Message -->
		<li class="bold @if(Request::segment(2) == 'notificationmessage') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">airplay</i><span class="menu-title" data-i18n="">Notification Message </span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/notificationmessage')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Notification Message</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/notificationmessage/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Notification Message</span></a>
					</li>
				</ul>
			</div>
		</li>
		
		<!-- Add Voucher --> 
		<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">assignment_turned_in</i><span class="menu-title" data-i18n="">Voucher</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/voucher')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Vouchers</span></a> 
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/voucher/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Voucher</span></a> 
					</li>
				</ul>
			</div>
		</li> 

		<!-- Day Wise Details --> 
		<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">assignment_turned_in</i><span class="menu-title" data-i18n="">Day Wise Itinerary</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/daywisedetail')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Day Wise</span></a> 
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/daywisedetail/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Day Wise</span></a> 
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/itinerary/cities')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Update City List</span></a> 
					</li>
				</ul>
			</div>
		</li> 
				
		<li class="bold"><a class="waves-effect waves-cyan " href="{{URL::to('/admin/request')}}"><i class="material-icons">record_voice_over</i><span class="menu-title" data-i18n="">Requests</span></a>
		</li>
				
		<!-- Reports -->
		<li class="bold @if(Request::segment(2) == 'contactfollowupreport') {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">tonality</i><span class="menu-title" data-i18n="">Reports</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/admin/contactfollowupreport')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Contacts Followup Report</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/hotel-monthly-invoice-generate')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Invoice</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/admin/websiteenquiry')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Website Enquiry</span></a>
					</li>
					
				</ul>
			</div>
		</li>
				
		<li class="bold"><a class="waves-effect waves-cyan " href="http://www.ensoberhotels.com"><i class="material-icons">help_outline</i><span class="menu-title" data-i18n="">Support</span></a>
        </li>
	@endif
      </ul>
    </aside>
    <!-- END: SideNav-->