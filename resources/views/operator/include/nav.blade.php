@php 
	$checkroominv = Session::get('operator.room_inventory');
@endphp

@if(@$checkroominv[0] == 'Y')
	<!-- Bottom Bar -->
	<div class="bottom_menu_bar"> 
		<ul>
			<li>
				<a href="{{ url('/operator/roominventorydashboard') }}">
					<i class="material-icons">grid_view</i>
					<span class="menu_name">Dashboard</span> 
				</a>
			</li>
			<li>
				<!--<a href="{{ url('/operator/addroombook') }}">-->
				<a href="{{URL::to('/operator/makequotation')}}">
					<i class="material-icons">add_shopping_cart</i>
					<span class="menu_name">New Booking</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/operator/roomsstatus') }}">
					<i class="material-icons">bed</i>
					<span class="menu_name">Room Status</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/operator/allbookings') }}">
					<i class="material-icons">travel_explore</i>
					<span class="menu_name">Search Booking</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- /Bottom Bar -->
@endif
   
   <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar"> 
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img src="{{ URL::asset('public/asset/images/logo/logo.png') }}" alt="logo"/><span class="logo-text hide-on-med-and-down"></span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
      </div>
	  
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
		@if(@$checkroominv[0] == 'Y')
			<li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
			</li>
		
			<!-- Room Inventory Menus -->
			<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">Rooms Inventory</span></a>
				<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a class="collapsible-body" href="{{URL::to('/operator/roominventorydashboardoffline')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Dashboard</span></a>
						</li>
						<li><a class="collapsible-body" href="{{URL::to('/operator/roomsstatus')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Room Status</span></a> 
						</li>
						<li>
							<!--<a class="collapsible-body" href="{{URL::to('/operator/addroombook')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Booking</span></a>-->
							<a class="collapsible-body" href="{{URL::to('/operator/makequotation')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Booking</span></a>
						</li>
						
						<li><a class="collapsible-body" href="{{URL::to('/operator/allbookings')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Bookings</span></a>
						</li>
						
						<li><a class="collapsible-body" href="{{URL::to('/operator/getcheckinhotelorder')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Bookings Accounting</span></a>
						</li>
						
					</ul>
				</div>
			</li>
			<!-- /Room Inventory Menus -->
		@endif
		
		@if(@$operator->room_status != 'Y')
		@if(@$checkroominv[0] != 'Y')
        <li class="active"><a class="collapsible-body active" href="{{URL::to('/operator/dashboard')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Home</span></a>
        </li>
		@endif
		
		
		<!--<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Admin</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="#" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Admin</span></a>
					</li>
					<li><a class="collapsible-body" href="#" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Admin</span></a>
					</li>
				</ul>
			</div>
        </li>-->
				
				@if(@$checkroominv[0] == 'Y')
					<!-- Room Inventory Menus -->
					<li class="bold hide"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">Rooms Inventory</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/roominventorydashboardoffline')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Dashboard</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/roomsstatus')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Room Status</span></a> 
								</li>
								<li>
									<!--<a class="collapsible-body" href="{{URL::to('/operator/addroombook')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Booking</span></a>-->
									<a class="collapsible-body" href="{{URL::to('/operator/makequotation')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Booking</span></a>
								</li>
								
								<li><a class="collapsible-body" href="{{URL::to('/operator/allbookings')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Bookings</span></a>
								</li>
								
								<li><a class="collapsible-body" href="{{URL::to('/operator/getcheckinhotelorder')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Bookings Accounting</span></a>
								</li>
								
							</ul>
						</div>
					</li>
					<!-- /Room Inventory Menus -->
				@else
					<li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
					</li>
		
					<!-- View Vendors -->
					<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">View Vendors</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Hotel Vendor</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Activity Vendor</span></a> 
								</li>
								
								<li><a class="collapsible-body" href="{{URL::to('/operator/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Transport Vendor</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Leads --> 
					<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Leads</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/leads/')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Leads</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/leads/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Lead</span></a>
								</li>
							</ul>
						</div>
					</li>

					<!-- Quotation 
					<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Quotation</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/quotation/')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Quotations</span></a>
								</li>
							</ul>
						</div>
					</li>--> 
					
					<!--- Sales   
					<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Sales</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/sales/')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Sales</span></a>
								</li>
								
							</ul>
						</div>
					</li>-->
					
					<!--- -->
					<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Calling Assignment </span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/contactfollowup/')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Follow up Contacts</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/mycontact')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>My Contacts</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/assigncontacts')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Assign Contacts</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/mycontacthistory')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>My Contacts History</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/mycontactfavoritehistory')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>My Contacts Favorite</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/emailhistory')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Sent Emails</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Bulk Email -->
					<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Bulk Email </span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/bulkemail/')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Send Bulk Email</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/bulkemailreport')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Report</span></a>
								</li>
							</ul>
						</div>
					</li>
					
					<!-- Room Inventory Menus -->
					<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">Room Inventory</span></a>
						<div class="collapsible-body">
							<ul class="collapsible" data-collapsible="accordion">
								<li><a class="collapsible-body" href="{{URL::to('/operator/roominventorydashboardoffline')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Dashboard</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/roomsstatus')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Room Status</span></a> 
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/addroombook')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Booking</span></a>
								</li>
								<li><a class="collapsible-body" href="{{URL::to('/operator/allbookings')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Bookings</span></a>
								</li>
							</ul>
						</div>
					</li>
					<!-- /Room Inventory Menus -->
			
					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/makequotation')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Send Quotation</span></a>
					</li>
					
					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/makeactivityvoucher')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Activity Voucher</span></a>
					</li>
					
					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/sendquotationhistory')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Send Quotation History</span></a>
					</li>
					
					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/getallactivityvouchers')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Activity Voucher History</span></a>
					</li>	
					
					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/paymenthistory')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Payment History</span></a>
					</li>
					
					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/websiteorders')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Website Bookings</span></a>
					</li>
					
					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/getcheckinorder')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Bookings Accounting</span></a>
					</li>		

					<li class="bold">
						<a class="waves-effect waves-cyan " href="{{URL::to('/operator/getcheckinhotelorder')}}"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Hotel Bookings Accounting</span></a>
					</li>
					
					
					
					<!--<li class="bold">
						<a class="waves-effect waves-cyan " href="#"><i class="material-icons">help_outline</i><span class="menu-title" data-i18n="">Support</span></a>
					</li>-->
				@endif
	@endif
      </ul>
	  
    </aside>
    <!-- END: SideNav-->
	