   <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img src="{{ URL::asset('public/asset/images/logo/logo.png') }}" alt="logo"/><span class="logo-text hide-on-med-and-down"></span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="active"><a class="collapsible-body active" href="{{URL::to('/vender/dashboard')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Dashboard</span></a>
        </li>
		
		<li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
		
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
		       <!-- Vender  -->
               <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">store</i><span class="menu-title" data-i18n="">Vender</span></a>
            <div class="collapsible-body">
                <ul class="collapsible" data-collapsible="accordion">
                    <li><a class="collapsible-body" href="{{URL::to('/vender/venders')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Venders</span></a>
                    </li>
                    
                </ul>
            </div>
        </li>
          @if(session()->get('vender.vender_type')[0]=='HOTEL VENDER')
	 			<!-- Hotels --> 
				<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="">Hotel</span></a>
			<div class="collapsible-body">
				<ul class="collapsible" data-collapsible="accordion">
					<li><a class="collapsible-body" href="{{URL::to('/vender/hotels')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Hotels</span></a>
					</li>
					<li><a class="collapsible-body" href="{{URL::to('/vender/hotels/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Hotel</span></a>
					</li>
				</ul>
			</div>
        </li>
        
        <!-- Htels Season Rate --> 
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">poll</i><span class="menu-title" data-i18n="">Hotel Season Rate</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/hotelseasonrates')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Rate</span></a>
                                        </li>
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/hotelseasonrates/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Season Rate</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
      <!-- Htels Group Season Rate --> 
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">network_check</i><span class="menu-title" data-i18n="">Hotel Group S. Rate</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/hotelgroupseasonrates')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Group Rate</span></a>
                                        </li>
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/hotelgroupseasonrates/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Group S. Rate</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif    
                                   
                        @if(session()->get('vender.vender_type')[0]=='TRANSPORT VENDER')
                     
                            <!-- Transport --> 
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">local_car_wash</i><span class="menu-title" data-i18n="">Transport</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/transports')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Transports</span></a>
                                        </li>
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/transports/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Transport</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif 
                        @if(session()->get('vender.vender_type')[0]=='EVENT VENDER')
                        
                            
                            <!-- Activities --> 
                            <!--<li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">hot_tub</i><span class="menu-title" data-i18n="">Activities Items</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                    
                                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Activity Cats</span></a>
                                        <div class="collapsible-body">
                                            <ul class="collapsible" data-collapsible="accordion">
                                                <li><a class="collapsible-body" href="{{URL::to('/vender/activitycats')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activity Cats</span></a> 
                                                </li>
                                                <li><a class="collapsible-body" href="{{URL::to('/vender/activitycats/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity Cat</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    
                                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Activity Names</span></a>
                                        <div class="collapsible-body">
                                            <ul class="collapsible" data-collapsible="accordion">
                                                <li><a class="collapsible-body" href="{{URL::to('/vender/activitynames')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activity Names</span></a> 
                                                </li>
                                                <li><a class="collapsible-body" href="{{URL::to('/vender/activitynames/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity Name</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    
                                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">loupe</i><span class="menu-title" data-i18n="">Activity Subcats</span></a>
                                        <div class="collapsible-body">
                                            <ul class="collapsible" data-collapsible="accordion">
                                                <li><a class="collapsible-body" href="{{URL::to('/vender/activitysubcats')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activity Subcats</span></a> 
                                                </li>
                                                <li><a class="collapsible-body" href="{{URL::to('/vender/activitysubcats/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity Subcat</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    </ul>
                                </div>
                            </li>-->
                            
                            <!-- Add Activities --> 
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">pool</i><span class="menu-title" data-i18n="">Activities</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/activities')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>All Activities</span></a> 
                                        </li>
                                        <li><a class="collapsible-body" href="{{URL::to('/vender/activities/create')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Activity</span></a> 
                                        </li>
                                    </ul>
                                </div>
                            </li>
                          @endif  
        <li class="bold"><a class="waves-effect waves-cyan " href="{{URL::to('/vender/makeitinerary')}}"><i class="material-icons">line_weight</i><span class="menu-title" data-i18n="">Make Itinerary</span></a>
        </li>
		
		<li class="bold"><a class="waves-effect waves-cyan " href="{{URL::to('/vender/makeitinerarynew')}}"><i class="material-icons">line_weight</i><span class="menu-title" data-i18n="">Make Itinerary New</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{URL::to('/vender/itinerarylist')}}"><i class="material-icons">line_weight</i><span class="menu-title" data-i18n="">Itinerary List</span></a>
        </li>

        
		
        <li class="bold"><a class="waves-effect waves-cyan " href="#"><i class="material-icons">help_outline</i><span class="menu-title" data-i18n="">Support</span></a>
        </li>
      </ul>
    </aside>
    <!-- END: SideNav-->