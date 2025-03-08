@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
    <style>
		.hotel_item {
			position: relative;
			padding: 15px 10px 0;
			border: 0px solid lightsteelblue;
		}
		.smole_size {
			height: 170px;
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
                  <li class="breadcrumb-item"><a href="index.html">Hotel</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">All Hotel</a>
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
  
  <div class="card">
    <div class="card-content">
      <form action="" method="POST" >
      {{ csrf_field() }}
      <div class="row"> 
      <div class="input-field col s4"> 
        <label for="hotel_name" class="">Hotel Name*</label>
        <input class="validate invalid" required="" aria-required="true" id="hotel_name" name="hotel_name" type="text">
      </div>
      <div class="input-field col s4">
        <p>Country</p>
        <select id="country_id" name="country_id" class="country_id"> 
            <option value="">Select Country</option>
            @foreach($Countries as $Country)
                <option value="{{ $Country->id }}">{{ $Country->name }}</option>
            @endforeach
        </select>
      </div>
        <div class="input-field col s4 ">
            <p>State</p>
            <span class="region_list">
            <select id="region_id" name="region_id" class="region_id">
            <option value="">Select State</option>
            </select>
            </span>
        </div>
        <div class="input-field col s4">
            <p>City</p>
            <span class="city_list get_suc_cat">
            <select id="city_id" name="city_id" class="get_suc_cat">
              <option value="">Select City</option>
            </select>
            </span>
        </div>
        </div>
       <div class="input-field col s4">
          <button class="btn cyan waves-effect waves-light right" type="submit" name="action" id="search_hotel">Search
            <i class="material-icons right">send</i>
          </button>
       </div>
      </form>
    </div>
  </div>
  <!-- Multi Select -->

  <div class="row">
    <div class="col s12">
      <div class="card" style="padding-bottom: 600px !important;"> 
        <div class="card-content">
          <h4 class="card-title">Hotel List  </h4>
          <div class="divider"></div><br>
            <div class="row" id="hotel_listing">
                @foreach($hotels as $hotel)
                <div class="col s12 m3">
                <div class="hotel_item">
                    <div class="smole_size">
                        <img src="{{ url('/storage/app/'.$hotel->hotel_image) }}" class="img-responsive" />
                    </div>
					<lable style="font-size: 13px;float: left;width: 100%;background: linear-gradient(45deg, #8e24aa, #ff6e40) !important;color: #fff;padding: 1px 9px;">{{ $hotel->hotel_name }}<br><span style="color: #f6dee6;font-size: 12px;margin: -2px 0 0;float: left;">{{ @$hotel->city['name'] }}</span></lable>
					<div class="button_area">
						<form action="{{ route('hotel.destroy', $hotel->id) }}" method="POST" style="display: inline-block;vertical-align: top;">
						{{ csrf_field() }}
						   <input type="hidden" name="_method" value="DELETE">
							<button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange car_delete gradient-shadow" title="Delete" onclick="return confirm('Are you sure?')">
								<i class="material-icons">delete_sweep</i>
							</button>
						</form>
						<!--<a href="{{ url('admin/viewhotel123453') }}" onclick="showview('{{$hotel->id}}')">-->
						<a href="{{ url('admin/viewhotel/'.$hotel->id) }}">
						<button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan car_delete gradient-shadow" >
							<i class="material-icons">remove_red_eye</i>
						</button>
						</a>
						<a href="{{ route('hotel.edit',$hotel->id) }}">
							<button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow"><i class="material-icons">brush</i></button>
						</a>
						
					</div>
                    <div id="basic-form" class="card card card-default scrollspy hotel_blog animated">
                        <div class="hotel_img">
                            <!--<img src="https://static.dezeen.com/uploads/2017/12/mychelsea-dh-liberty-interiors-hotels-london_dezeen_2364_col_15-852x568.jpg" class="img-responsive" />-->
                            <img src="{{ url('/storage/app/'.$hotel->hotel_image) }}" class="img-responsive" />
                        </div>
						@if($hotel->vender_approved==0) <center><b style="color: red; font-size: 12px;">Vender Not Approved</b></center> @endif
                        <div class="card-content">
                            <h3 class="card-title">{{ $hotel->hotel_name }}</h3>
                            <div class="Hotel_description">
                                <p>{{ $hotel->address }}</p>
                            </div>
                            
                            <div class="button_area">
                            <form action="{{ route('hotel.destroy', $hotel->id) }}" method="POST" style="display: inline-block;vertical-align: top;">
                        {{ csrf_field() }}
                               <input type="hidden" name="_method" value="DELETE">
                                <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange car_delete gradient-shadow" title="Delete" onclick="return confirm('Are you sure?')">
                                    <i class="material-icons">delete_sweep</i>
                                </button>
                                </form>
                                <!--<a href="{{ url('admin/viewhotel123453') }}" onclick="showview('{{$hotel->id}}')">-->
                                <a href="{{ url('admin/viewhotel/'.$hotel->id) }}">
                                <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan car_delete gradient-shadow" >
                                    <i class="material-icons">remove_red_eye</i>
                                </button>
                                </a>
                                <a href="{{ route('hotel.edit',$hotel->id) }}">
                                    <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow"><i class="material-icons">brush</i></button>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                
            </div>
<!-- Modal Trigger -->
 <!--- <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> -->
  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 id="hotel_name"></h4>
      <p id='hotel_details'></p>
      <p id='hotel_address'></p>
      <p id="hotel_type"></p>
      
      <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col m3"><a class="active" href="#images">Gallery</a></li>
          <li class="tab col m3"><a href="#amenities">Amenities</a></li>
          <li class="tab col sm "><a href="#hotelroomcategoires">Room Category</a></li>
          <!--<li class="tab col m3"><a href="#test4">Test 4</a></li>-->
        </ul>
      </div>
      <div id="images" class="col s12"><p id="main_image"></p><p id="gallery_images"></p></div>
      <div id="amenities" class="col s12"></div>
      <div id="hotelroomcategoires" class="col s12"></div>
      <!--<div id="test4" class="col s12">Test 4</div>-->
    </div>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn-flat">Close</a>
    </div>
  </div>
            
        </div>
      </div>
    </div>
  </div>
</div>

<!-- START RIGHT SIDEBAR NAV -->
<aside id="right-sidebar-nav">
   <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
      <div class="row">
         <div class="slide-out-right-title">
            <div class="col s12 border-bottom-1 pb-0 pt-1">
               <div class="row">
                  <div class="col s2 pr-0 center">
                     <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
                  </div>
                  <div class="col s10 pl-0">
                     <ul class="tabs">
                        <li class="tab col s4 p-0">
                           <a href="#messages" class="active">
                              <span>Messages</span>
                           </a>
                        </li>
                        <li class="tab col s4 p-0">
                           <a href="#settings">
                              <span>Settings</span>
                           </a>
                        </li>
                        <li class="tab col s4 p-0">
                           <a href="#activity">
                              <span>Activity</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="slide-out-right-body">
            <div id="messages" class="col s12">
               <div class="collection border-none">
                  <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />
                  <ul class="collection p-0">
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Elizabeth Elliott</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                        </div>
                        <span class="secondary-content medium-small">5.00 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-1.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Mary Adams</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                        </div>
                        <span class="secondary-content medium-small">4.14 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-off avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-2.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Caleb Richards</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                        </div>
                        <span class="secondary-content medium-small">4.14 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-3.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Caleb Richards</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Keny !</p>
                        </div>
                        <span class="secondary-content medium-small">9.00 PM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-4.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">June Lane</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Ohh God</p>
                        </div>
                        <span class="secondary-content medium-small">4.14 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-off avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-5.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Edward Fletcher</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Love you</p>
                        </div>
                        <span class="secondary-content medium-small">5.15 PM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-6.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Crystal Bates</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can we</p>
                        </div>
                        <span class="secondary-content medium-small">8.00 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-off avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Nathan Watts</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Great!</p>
                        </div>
                        <span class="secondary-content medium-small">9.53 PM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-off avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-8.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Willard Wood</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Do it</p>
                        </div>
                        <span class="secondary-content medium-small">4.20 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-1.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Ronnie Ellis</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Got that</p>
                        </div>
                        <span class="secondary-content medium-small">5.20 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-9.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Daniel Russell</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                        </div>
                        <span class="secondary-content medium-small">12.00 AM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-off avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-10.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Sarah Graves</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Okay you</p>
                        </div>
                        <span class="secondary-content medium-small">11.14 PM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-off avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-11.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Andrew Hoffman</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can do</p>
                        </div>
                        <span class="secondary-content medium-small">7.30 PM</span>
                     </li>
                     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           ><img src="../../../app-assets/images/avatar/avatar-12.png" alt="avatar" />
                           <i></i>
                        </span>
                        <div class="user-content">
                           <h6 class="line-height-0">Camila Lynch</h6>
                           <p class="medium-small blue-grey-text text-lighten-3 pt-3">Leave it</p>
                        </div>
                        <span class="secondary-content medium-small">2.00 PM</span>
                     </li>
                  </ul>
               </div>
            </div>
            <div id="settings" class="col s12">
               <p class="mt-8 mb-0 ml-5 font-weight-900">GENERAL SETTINGS</p>
               <ul class="collection border-none">
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Notifications</span>
                        <div class="switch right">
                           <label>
                              <input checked type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Show recent activity</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Show recent activity</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Show Task statistics</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Show your emails</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Email Notifications</span>
                        <div class="switch right">
                           <label>
                              <input checked type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
               </ul>
               <p class="mt-8 mb-0 ml-5 font-weight-900">SYSTEM SETTINGS</p>
               <ul class="collection border-none">
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>System Logs</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Error Reporting</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Applications Logs</span>
                        <div class="switch right">
                           <label>
                              <input checked type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Backup Servers</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
                  <li class="collection-item border-none mt-3">
                     <div class="m-0">
                        <span>Audit Logs</span>
                        <div class="switch right">
                           <label>
                              <input type="checkbox" />
                              <span class="lever"></span>
                           </label>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
            <div id="activity" class="col s12">
               <div class="activity">
                  <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
                  <ul class="collection with-header">
                     <li class="collection-item">
                        <div class="font-weight-900">
                           Homepage mockup design <span class="secondary-content">Just now</span>
                        </div>
                        <p class="mt-0 mb-2">Melissa liked your activity.</p>
                        <span class="new badge amber" data-badge-caption="Important"> </span>
                     </li>
                     <li class="collection-item">
                        <div class="font-weight-900">
                           Melissa liked your activity Drinks. <span class="secondary-content">10 mins</span>
                        </div>
                        <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                        <span class="new badge light-green" data-badge-caption="Resolved"></span>
                     </li>
                     <li class="collection-item">
                        <div class="font-weight-900">
                           12 new users registered <span class="secondary-content">30 mins</span>
                        </div>
                        <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                     </li>
                     <li class="collection-item">
                        <div class="font-weight-900">
                           Tina is attending your activity <span class="secondary-content">2 hrs</span>
                        </div>
                        <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                     </li>
                     <li class="collection-item">
                        <div class="font-weight-900">
                           Josh is now following you <span class="secondary-content">5 hrs</span>
                        </div>
                        <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                        <span class="new badge red" data-badge-caption="Pending"></span>
                     </li>
                  </ul>
                  <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
                  <ul class="collection with-header">
                     <li class="collection-item">
                        <div class="font-weight-900">
                           New order received urgent <span class="secondary-content">Just now</span>
                        </div>
                        <p class="mt-0 mb-2">Melissa liked your activity.</p>
                     </li>
                     <li class="collection-item">
                        <div class="font-weight-900">System shutdown. <span class="secondary-content">5 min</span></div>
                        <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                        <span class="new badge blue" data-badge-caption="Urgent"> </span>
                     </li>
                     <li class="collection-item">
                        <div class="font-weight-900">
                           Database overloaded 89% <span class="secondary-content">20 min</span>
                        </div>
                        <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                     </li>
                  </ul>
                  <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
                  <ul class="collection with-header">
                     <li class="collection-item">
                        <div class="font-weight-900">System error <span class="secondary-content">10 min</span></div>
                        <p class="mt-0 mb-2">Melissa liked your activity.</p>
                     </li>
                     <li class="collection-item">
                        <div class="font-weight-900">
                           Production server down. <span class="secondary-content">1 hrs</span>
                        </div>
                        <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                        <span class="new badge blue" data-badge-caption="Urgent"></span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Slide Out Chat -->
   <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
      <li class="center-align pt-2 pb-2 sidenav-close chat-head">
         <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
      </li>
      <li class="chat-body">
         <ul class="collection">
            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
               <span class="avatar-status avatar-online avatar-50"
                  ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
               </span>
               <div class="user-content speech-bubble">
                  <p class="medium-small">hello!</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">How can we help? We're here for you!</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
               <span class="avatar-status avatar-online avatar-50"
                  ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
               </span>
               <div class="user-content speech-bubble">
                  <p class="medium-small">I am looking for the best admin template.?</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>
               </div>
            </li>

            <li class="collection-item display-grid width-100 center-align">
               <p>8:20 a.m.</p>
            </li>

            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
               <span class="avatar-status avatar-online avatar-50"
                  ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
               </span>
               <div class="user-content speech-bubble">
                  <p class="medium-small">Ohh! very nice</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">Thank you.</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
               <span class="avatar-status avatar-online avatar-50"
                  ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
               </span>
               <div class="user-content speech-bubble">
                  <p class="medium-small">How can I purchase it?</p>
               </div>
            </li>

            <li class="collection-item display-grid width-100 center-align">
               <p>9:00 a.m.</p>
            </li>

            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">From ThemeForest.</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">Only $24</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
               <span class="avatar-status avatar-online avatar-50"
                  ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
               </span>
               <div class="user-content speech-bubble">
                  <p class="medium-small">Ohh! Thank you.</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
               <span class="avatar-status avatar-online avatar-50"
                  ><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />
               </span>
               <div class="user-content speech-bubble">
                  <p class="medium-small">I will purchase it for sure.</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">Great, Feel free to get in touch on</p>
               </div>
            </li>
            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
               <div class="user-content speech-bubble-right">
                  <p class="medium-small">https://pixinvent.ticksy.com/</p>
               </div>
            </li>
         </ul>
      </li>
      <li class="center-align chat-footer">
         <form class="col s12" onsubmit="slide_out_chat()" action="javascript:void(0);">
            <div class="input-field">
               <input id="icon_prefix" type="text" class="search" />
               <label for="icon_prefix">Type here..</label>
               <a onclick="slide_out_chat()"><i class="material-icons prefix">send</i></a>
            </div>
         </form>
      </li>
   </ul>
</aside>
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
    <script src="{{ URL::asset('asset/js/scripts/advance-ui-modals.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('asset/js/scripts/data-tables.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    
    <script type="text/javascript">
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

$(document).ready(function(){
    
    /* jQuery(".hotel_item").mouseenter(function(){
        jQuery(this).find(".hotel_blog").show();
        jQuery(this).find(".hotel_blog").addClass("zoomIn");
        jQuery(this).find(".hotel_blog").removeClass("zoomOut");
    });
    
    jQuery(".hotel_item").mouseleave(function(){
        jQuery(this).find(".hotel_blog").addClass("zoomOut");
        jQuery(this).find(".hotel_blog").removeClass("zoomIn");
        jQuery(this).find(".hotel_blog").hide();
    }); */
    
  $("#search_hotel").click(function(){
      var hotel_name = $("#hotel_name").val();
      var country_id = $("#country_id").val();
      var region_id = $("#region_id").val();
      var city_id = $("#city_id").val();
      var dataValue = {'hotel_name':hotel_name, "country_id": country_id, 'region_id':region_id, 'city_id':city_id };
      $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
       $("#loader-wrapper").css("display","block");       
  $.ajax({
    url: "ajaxSearchHotel",
    type:"post",
    cache: false,
    async:true,
    data: dataValue,
    success: function(data){
     var data = JSON.parse(data);
      if(data.status == true){
          $("#hotel_listing").html(data.html);
          $("#loader-wrapper").css("display","none");
      }else{
          $("#loader-wrapper").css("display","none");
          alert(data.html);
      }
      
    }
  });
      
      return false;
    });
});


</script>
@endsection