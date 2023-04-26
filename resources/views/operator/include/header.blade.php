<!--- Loader for ajax call start -->
<div id="loader-wrapper">
  <div id="loader"> <img src="{{ URL::asset('public/asset/images/loader/loader.gif') }}" alt="Loader gif"> </div>
</div>


	<!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed"> 
		@if(Request::segment(2) != 'scanvisitingcard')
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
          <div class="nav-wrapper">
            <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
              <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize">
            </div>
            <ul class="navbar-list right">
              <li class="hide-on-med-and-down" title="Click for check grievance status"><a href="{{ url('/grievance') }}"><i class="material-icons">question_mark</i></a></li>
              <!-- start grievance model pop up -->
              <li class="hide-on-med-and-down" title="Click for raise grievance"><a href="#" id="modelGrievance"><i class="material-icons">error</i></a></li>
              <!-- Modal -->
              <div class="modal mt-5" id="staticBackdrop" style="display:none;z-index:5; max-height: 430px; min-height:430px;">
                  <button type="button" class="b-close" title="Click for close model" style="position: absolute;border: 0px;top: 2px;right: 0px;color: #4963c1;background-color: white;"><i class="material-icons" style="font-size: 32px;">cancel</i></button>
                  <div id="modal-Grievance">
                    <div class="row" style="border-bottom: 1px solid #a99c9cb3;padding-left: 20px;">
                      <div class="col s10 m10">
                        <h5 class="modal-title" id="staticBackdropLabel">Raise New Grievance</h5>
                      </div>
                    </div>
                    <div class="modal-body">
                      <form id="grievance_form">
                        <!-- Start Header -->      
                        <div class="row" style="padding: 0px 20px;">
                          <div class=" col s12 m6">
                            <div class=" col s12 m12">
                              <h6>Title<span style="color: red;">*</span></h6>
                              <input class="titleGrievance" aria-required="true" id="title" type="text" name="title" required>
                            </div>	
                                    
                            <div class="col s12 m12">
                              <div class="col s12 m12 l12">
                                <h6 style="margin-bottom: 0px;">Description<span style="color: red;">*</span></h6> 
                              </div>
                              <div class="col s12 m12 l12">
                                <textarea name="description" id="description" cols="30" rows="10" class="descriptionGrievance" style="height:113px !important;" required></textarea>
                              </div>
                            </div>
                          </div>
                                
                          <div class="col s12 m6">
                            <div class="col s12">
                              <h6 style="margin-bottom: 0px;">Upload Image<span style="color: red;">*</span></h6>
                            </div>
                            <div class="col s12">
                              <input type="file" id="input-file-now-custom-2" name="attachment" class="dropify attachmentGrievance" accept=".jpg,.png" required/>
                            </div>
                            <input type="hidden" name="" id="urlGrivance" value="{{url('/')}}">
                          </div>
                        </div>
                      <!-- End Header -->

                      <!-- Start footer -->
                      <div class="row" style="border-top: 1px solid #a99c9cb3;">
                        <div style="padding:20px 20px 0px 20px;">
                          <div class="col s6 m6">
                            <span id="errorGrievance">&nbsp;</span>
                          </div>
                          <div class="col s6 m6" style="text-align: right;">
                            <img src="{{ URL::asset('public/asset/images/loader/loader.gif') }}" id="po_search_loader1" class="input_loader po_search_loader" style="width: 22px;height: 22px;display: none;padding-top: 5px;">
                              <button type="submit" class="btn " name="action" id="raiseGrievance" style="background-color: green;padding: 1px 8px;" title="Click for submit grievance">Submit
                              </button>
                          </div>
                        </div>
                      </div>
                      <!-- End footer -->
                      </form>
                    </div>
                  </div>

                  <div class="row mt-10 mr-5 ml-5" id="successGrievance" style="display:none;">
                    <div class="col s12 m12" style="text-align: center;">
                      <div><img src="{{ URL::asset('public/asset/images/namaste.png') }}" alt="Namaste gif" style="height: 100px;width: 100px;"></div>
                      <h2 style="color:green;">Thank You! </h2> 
                      <h6>We will resolve this issue as soon possible</h6>
                    </div>
                  </div>
                </div>
              <!-- end grievance model pop up -->
              <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
              <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
              <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons noti_m_icon" >notifications_none<!--<small class="notification-badge">5</small>--></i></a></li>
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{ URL::asset('public/asset/images/avatar/avatar-7.png') }}" alt="avatar"></span></a></li>
              <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out"><i class="material-icons">format_indent_increase</i></a></li>
            </ul>
            
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
              </li>
              <li class="divider"></li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
              </li>
            </ul>
            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
              <!--<li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
              <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>-->
              <li class="divider"></li>
              <!--<li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>-->
              <li><a class="grey-text text-darken-1" href="{{ url('/operator/logout') }}"><i class="material-icons">keyboard_tab</i> Logout</a></li>
            </ul>
          </div>
          <nav class="display-none search-sm">
            <div class="nav-wrapper">
              <form>
                <div class="input-field">
                  <input class="search-box-sm" type="search" required="">
                  <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                </div>
              </form>
            </div>
          </nav>
        </nav>
		@endif
	 </div>
    </header>
    <!-- END: Header-->