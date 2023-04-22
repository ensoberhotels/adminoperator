<!--- Loader for ajax call start -->
<div id="loader-wrapper">
  <div id="loader"> <img src="{{ URL::asset('public/asset/images/loader/loader.gif') }}" alt="Loader gif"> </div>
</div>

<!--- Loader for ajax call end -->

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed"> 
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
          <div class="nav-wrapper">
            <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
              <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize">
            </div>
            <ul class="navbar-list right">
              <li class="hide-on-med-and-down" title="Click for raise grievance"><a href="{{ url('/grievance') }}"><i class="material-icons">error</i></a></li>
              <!-- start grievance model pop up -->
            <!-- Modal -->
              <div class="modal mt-5" id="staticBackdrop" style="display:none;z-index:5; max-height: 440px; min-height:440px">
                <div class="modal-dialog" id="modal-Grievance">
                  <div class="modal-content">
                    <div class="modal-header">
                      <div class="row">
                        <div class="col s10 m10" style="color: #028000;">
                          <u><h5 class="modal-title center" id="staticBackdropLabel" style="color: #028000;">Raise New Grievance</h5></u>
                        </div>
                        <div class="col s2 m2" style="text-align:right;">
                          <button type="button" class="btn waves-effect button b-close" data-bs-dismiss="modal" title="Click for close model"><i class="material-icons">cancel</i></button>
                        </div>
                      </div>
                    </div>
                    <div class="modal-body">
                      <form id="grievance_form">
                        <div class="row">
                          <div class=" col s12 m6">
                            <div class=" col s12 m12">
                              <h6 style="padding-bottom: 8px;">Title<span style="color: red;">*</span></h6>
                              <input class="titleGrievance" aria-required="true" id="title" type="text" name="title" required>
                            </div>	
                                    
                            <div class="col s12 m12">
                              <div class="col s12 m12 l12">
                                <h6>Description<span style="color: red;">*</span></h6> 
                              </div>
                              <div class="col s12 m12 l12">
                                <textarea name="description" id="description" cols="30" rows="10" class="descriptionGrievance" required></textarea>
                              </div>
                            </div>

                            <div class="col s12 m12">
                            <img src="{{ URL::asset('public/asset/images/loader/loader.gif') }}" id="po_search_loader1" class="input_loader po_search_loader" style="display: none; position: unset;width: 25px;height: 25px;text-align: left;float: left;margin-left: -20px;margin-right: 10px;margin-top: 3px;">
                              <button type="submit" class="btn waves-effect" name="action" id="raiseGrievance" style="background-color: green;" title="Click for submit grievance">Submit
                                <i class="material-icons right" onclick="raiseGrievance()">send</i>
                              </button>
                            </div>
                          </div>
                                
                          <div class="col s12 m6">
                            <div class="col s12">
                              <h6>Upload Image<span style="color: red;">*</span></h6>
                            </div>
                            <div class="col s12">
                              <input type="file" id="input-file-now-custom-2" name="attachment" class="dropify attachmentGrievance" required/>
                            </div>
                            <input type="hidden" name="" id="urlGrivance" value="{{url('/')}}">
                          </div>

                          <div class="col s12 m12">
                            <span id="errorGrievance">&nbsp;</span>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="row mt-5 mr-5 ml-5" id="successGrievance" style="display:none;">
                  <div class="col s12 m12" style="text-align:right;">
                    <button type="button" class="btn waves-effect button b-close" data-bs-dismiss="modal" title="Click for close model"><i class="material-icons">cancel</i></button>
                  </div>
                  <div class="col s12 m12">
                    <h2 style="color:green;text-align:center;">Thank You! </h2> 
                    <h3 style="color:blue;text-align:center;">We will resolve this issue as soon possible</h3>
                  </div>
                </div>
              </div>
              <!-- end grievance model pop up -->
              <li class="hide-on-med-and-down" title="Click for raise grievance"><a href="#" id="modelGrievance"><i class="material-icons">error</i></a></li>
              <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
              <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
              <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">{{count($requests)}}</small></i></a></li>
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{ URL::asset('public/asset/images/avatar/avatar-7.png') }}" alt="avatar"><i></i></span></a></li>
              <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out"><i class="material-icons">format_indent_increase</i></a></li>
            </ul>
             
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge">{{count($requests)}}</span></h6> 
              </li> 
              <li class="divider"></li>
			  @foreach($requests as $request)
				<li>
					<a class="grey-text text-darken-2" href="/admin/request" style="width:250px; margin-bottom: 10px;"><span class="material-icons icon-bg-circle cyan small">record_voice_over</span> 
					
					@if(strlen($request->comment) > 21)
						{{ str_limit($request->comment,20)}}
					@else
						{{ $request->comment}}
					@endif 
					</a>
					<lable style="font-size: .8rem;margin: 7px 0 0;">
						{{@$request->operator['name']}}
					</lable>
		<time class="media-meta">{{ date('d M h:i A', strtotime($request->create_date_time))}}</time>
				</li>
			  @endforeach
            </ul> 
            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
              <!--<li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
              <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>-->
              <li class="divider"></li>
              <!--<li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>-->
              <li><a class="grey-text text-darken-1" href="{{ url('/admin/logout') }}"><i class="material-icons">keyboard_tab</i> Logout</a></li>
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
      </div>
    </header>
    <!-- END: Header-->
	
	