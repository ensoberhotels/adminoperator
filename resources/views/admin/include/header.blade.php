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
	
	