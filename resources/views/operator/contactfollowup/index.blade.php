@extends('operator.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
	<style>
		ul.custom_tabs { 
			float: left;
			width: 100%;
		}
		li.custom_tab {
			float: left;
		}
		li.custom_tab a {
			background-color: #00bcd4;
			padding: 12px 35px;
			color: #fff;
			font-size: 17px;
			margin-right: 10px;
		}
		li.custom_tab a.active {
			border-bottom: 5px solid #ff4081;
			padding: 12px 35px 6px;
		}
		.comment_main {
			float: left;
			text-align: left;
			width: 100%;
			box-shadow: 0 0px 1px 1px;
			height: 280px;
			overflow-y: scroll;
			padding: 15px 0;
		} 
		.comment_main ul {
			float: left;
			margin: 0;
			padding: 0;
		}
		.comment_main li a {
			float: left;
			width: 100%;
			padding: 5px 10px;
			cursor: pointer;
		}
		.comment_main li:hover >a {
			background-color: #faf7f7;
		}
		.sidebar .sidebar-content .sidebar-menu ul li.active{
			padding-left: 0px !important;
		}
		.sidebar .sidebar-content .sidebar-menu ul li.active {
			padding: 2px 0;
			font-size: 16px;
			margin: 0 0 12px;
		}
		ul.email-list.display-grid {
			margin: 0;
		}
		a.text-sub {
			float: left;
			width: 100%;
			margin: 0;
			padding: 0 10px 0 !important;
		}
		.follow_text {
			float: left;
			width: 100%;
			padding: 0px 0 0 10px;
			box-sizing: border-box;
			word-break: break-all;
			margin-top: -11px;
		}
		.follow_input {
			float: left;
			width: 100%;
		}
		.carousel.carousel-slider .carousel-item{min-height:500px;}
		.sidebar .sidebar-content .sidebar-menu ul li {
			cursor: auto;
			color: #fff;
		}
		.follow_text span {
			float: right;
			text-align: left;
			width: 88%;
			padding: 3px 13px 0 0;
		}
		b.mobile_msg {
			float: left;
			background-color: red;
			color: #fff;
			width: 51px;
			margin: -7px 7px 0;
			border-radius: 5px;
			font-size: 13px;
			box-shadow: inset 0 0 6px 2px #fff;
			display:none;
		}
		.carousel.carousel-slider .carousel-fixed-item {
			z-index: unset;
		}
		.indicators{display:none;}
		.contact_input {
			color: #fff;
			border-bottom: 1px solid #fff !important;
			padding: 0 !important;
			margin: 0 !important;
			height: 100% !important;
			display:none;
		}
		.fixed-action-btn i {
			font-size: 36px !important;
			margin-top: 30px;
		}
		.fixed-action-btn {
			display: block !important;
		}
		.btn-floating.btn-large {
			width: 45px;
			height: 45px;
			top: 25px;
		}
		.btn-floating.btn-large i {
			margin: 22px 0 0;
		} 
		.carousel.carousel-slider .carousel-fixed-item {
			bottom: 0px !important;
		}
		.copy_icon {
			position: absolute;
			right: 10px;
			font-size: 15px;
			margin: 7px;
			cursor: pointer;
		}
		#with_update {
			opacity: 1;
			position: unset;
			width: 15px !important;
			margin: 0 !important;
			padding: 0 !important;
			height: 13px !important;
			pointer-events: auto !important;
		}
		.con_follow_lable{
			font-size: 10px;
			line-height: 0px;
			padding: 0 13px;
			position: relative;
			top: -8px;
		}
		.btn-next {
			background-color: #ff4081;
			vertical-align: top;
		}
		.btn-next i, .btn-next span {
			color: #fff;
			display: inline-block;
			vertical-align: top;
		}
		.btn-prev {
			background-color: #ff4081;
			vertical-align: top;
		}
		.btn-prev i, .btn-prev span{
			color: #fff;
			display: inline-block;
			vertical-align: top;
		}
		.btn-next:focus {
			background-color: #ff4081;
		}
		.btn-prev:focus {
			background-color: #ff4081;
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
                  <li class="breadcrumb-item"><a href="index.html">Lead</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">All Lead</a>
                  </li>
                </ol>
              </div>
              <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdownpro"><i class="material-icons hide-on-med-and-up">settings</i><span class="hide-on-small-onl">Settings</span><i class="material-icons right">arrow_drop_down</i></a>
                <ul class="dropdown-content" id="dropdownpro" tabindex="0">
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
  
  

  <!-- Multi Select -->
<div class="row">
	<div class="col s12">
      <div class="card">
        <div class="card-content">
			<div class="row">
			    <div class="col s6">
			        <div class="contact_search">
				        <form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="GET" action="contactfollowup" >
									{{csrf_field()}}
							<div class="col s6">
                            	<input class="validate invalid" required="" aria-required="true" id="followup_date" type="text" value="{{Request::get('search_mobile')}}" name="search_mobile" placeholder="Enter Mobile Number" value="">
                            </div>
							
                            <div class="input-field col s6">
                            	<button class="btn waves-effect waves-light right" type="submit" name="action" id="add_followup">Search
                            		<i class="material-icons right">search</i>
                            	</button>
                            </div>
									
						</form>
				    </div>
			    </div>
				<!-- Tab Start -->
				<div class=" active custom_tab_main tab_border">
					<div class="col s12">
						<ul class="custom_tabs">
							<li class="custom_tab">
								<a class="@if(Request::segment(2) == 'contactfollowup') active @endif;" href="{{URL::to('/operator/contactfollowup/')}}">New Follow Up <b style="color:#000;">{{$newcount}}</b></a>
							</li>
							<li class="custom_tab">
								<a class="@if(Request::segment(2) == 'pastcontactfollowup') active @endif;" href="{{URL::to('/operator/pastcontactfollowup/')}}">Past Follow Up <b style="color:#000;">{{$pastcount}}</b></a>
							</li>
							<li class="custom_tab">
								<a class="@if(Request::segment(2) == 'todaycontactfollowup') active @endif;" href="{{URL::to('/operator/todaycontactfollowup/')}}">Today Follow Up <b style="color:#000;">{{$todaycount}}</b></a>
							</li>
							<li class="custom_tab">
								<a class="@if(Request::segment(2) == 'futurecontactfollowup') active @endif;" href="{{URL::to('/operator/futurecontactfollowup/')}}">Future Follow Up <b style="color:#000;">{{$futurecount}}</b></a>
							</li>
						</ul>
					</div>
				</div> 
				
				<!-- /Tab End -->
			
				<div class="col s12">
				    
					<div class="carousel carousel-slider center intro-carousel">
						 
                        <div class="carousel-fixed-item center middle-indicator" >
                            <div class="left">
                                <button class="movePrevCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-prev">
                                    <i class="material-icons">navigate_before</i> <span class="hide-on-small-only">Prev</span>
                                </button>
                            </div>

                            <div class="right">
                                <button class=" moveNextCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-next">
                                    <span class="hide-on-small-only">Next</span> <i class="material-icons">navigate_next</i>
                                </button>
                            </div>
                        </div>
						
                        @php $i = 1; @endphp
						
						@if(count($AssignContacts) != 0)
                        @foreach($AssignContacts as $AssignContact)
							<!--<a class="contact_counter mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow">
								<b>{{$i}}</b>
							</a>-->
							
							<div class="carousel-item slide-@php $i  @endphp">
								<div class="row">
									<form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="POST" action="{{ route('contactfollowup.store') }}" >
									{{csrf_field()}}
										<input type="hidden" name="operator_id" id="operator_id" value="{{ $operator_id[0] }}">
										<input type="hidden" name="assign_contact_id" id="assign_contact_id" value="{{ $AssignContact->id}}">
							
										<div class="input-field col s4 sidebar">
										@if(Request::segment(2) != 'contactfollowup') 
										<!-- Dropdown Trigger -->
										<!--<a class='dropdown-trigger btn' href='#' data-target='dropdown{{$i}}'>Follow Up</a>-->
										<!-- Dropdown Structure -->
										<ul id='dropdown{{$i}}' class='dropdown-content followup_comment_main'>
											
											@foreach($AssignContact->followUpComment as $comment)
											<li><a href="#!">{{date('d M Y h:i A', strtotime($comment->created_at))}}: {{$comment->comment}}  <span style="padding: 0 19px 11px;float: right;width: 100%;text-align: right;color: #555;font-weight: bold;">{{date('d M Y', strtotime($comment->followup_date))}} </span></a></li>
											@endforeach
										</ul>
										@endif
											<div class="sidebar-content">
												<div id="sidebar-list_hide" class="sidebar-menu list-group position-relative animate fadeLeft">
													<div class="sidebar-list-padding app-sidebar sidenav_hide" id="email-sidenav">
														<ul class="email-list display-grid">
															<!--<li class="sidebar-title">Contact</li>-->
		<li class="active contact_item"> 
			<span class="con_follow_lable">Contact Number</span>
			<div class="follow_text" class="text-sub" title="Contact Number">
				<i class="material-icons mr-2"> settings_phone </i> <span class="inputenable" id="mobile">{{@$AssignContact->mobile}} </span>
				<i class="material-icons mr-2 copy_icon"> file_copy </i>				
			</div> 
		</li>
		<li style="margin: -8px 0 0;">
			@if(@$AssignContact->type == 'CREATE')
			<b class="mobile_msg created_msg" style="background-color: green;cursor: pointer;width: 78px;display: block;">Created</b>
			@endif
			<b class="mobile_exist mobile_msg">Exist</b>
			<b class="mobile_assigned mobile_msg" style="width: auto;">Assigned</b>
			<b class="mobile_pull mobile_msg" style="background-color: green;cursor: pointer;width: 101px;">Pull Contact</b>
		</li>
		
		<li class="active contact_item">
			<span class="con_follow_lable">Agency Name</span>
			<div class="follow_text" class="text-sub" title="Agency Name">
				<i class="material-icons mr-2"> accessible </i> <span class="inputenable" name="agent" id="agency_name"><lable class="contact_detail">{{@$AssignContact->agency_name}}</lable> <input class="contact_input" type="text" name="agency_name" value="{{$AssignContact->agency_name}}" /> </span>
			</div>
		</li>
		
		<li class="active contact_item">
			<span class="con_follow_lable">Contact Name</span>
			<div class="follow_text" class="text-sub" title="Contact Name">
				<i class="material-icons mr-2"> perm_identity </i> <span class="inputenable" id="name"><lable class="contact_detail">{{@$AssignContact->name}}</lable> <input class="contact_input" type="text" autocomplete="off" name="name" value="{{$AssignContact->name}}" /></span>
			</div>
		</li>
		
		<li class="active contact_item">
			<span class="con_follow_lable">Contact Email</span>
			<div class="follow_text" class="text-sub" title="Contact Email">
				<i class="material-icons mr-2"> mail_outline </i> <span class="inputenable" id="email"><lable class="contact_detail">{{@$AssignContact->email}}</lable> <input class="contact_input" type="text" autocomplete="off" name="email" value="{{$AssignContact->email}}" /></span>
				<i class="material-icons mr-2 copy_icon"> file_copy </i>
			</div>
		</li>
		
		<li class="active contact_item">
			<span class="con_follow_lable">Wesite</span>
			<div class="follow_text" class="text-sub" title="Wesite">
				<i class="material-icons mr-2"> web </i> <span class="inputenable" id="website"><lable class="contact_detail">{{@$AssignContact->website}}</lable> <input class="contact_input" type="text" autocomplete="off" name="website" value="{{@$AssignContact->website}}" /></span>
			</div>
		</li>
		
		<li class="active contact_item">
			<span class="con_follow_lable">Location</span>
			<div class="follow_text" class="text-sub" title="Location">
				<i class="material-icons mr-2"> my_location </i> <span class="inputenable" id="location"><lable class="contact_detail">{{@$AssignContact->location}}</lable> <input class="contact_input" autocomplete="off" type="text" name="location" value="{{@$AssignContact->location}}" /></span>
			</div>
		</li>
		<li class="active contact_item">
			<span class="con_follow_lable">Contact Type</span>
			<div class="follow_text" class="text-sub" title="Contact Type">
				<i class="material-icons mr-2"> compare_arrows </i> <span class="inputenable" id="contact_type"><lable class="contact_detail">{{@$AssignContact->contact_type}}</lable> <input autocomplete="off" class="contact_input" type="text" name="contact_type" value="{{@$AssignContact->contact_type}}" /> </span>
			</div>

			<input type="hidden" value="Operator-{{ $operator_name }}" id="source" />
			<input type="hidden" value="{{ $operator_id }}" id="con_operator_id" />
		</li>
		
		<li class="active contact_item">
			<span class="con_follow_lable">Additional Info</span>
			<div class="follow_text" class="text-sub" title="Additional Info">
				<i class="material-icons mr-2"> info </i> <span class="inputenable" id="additional_info"><lable class="contact_detail">{{$AssignContact->additional_info}}</lable> <input class="contact_input" autocomplete="off" type="text" name="additional_info" value="{{$AssignContact->additional_info}}" /></span>
			</div>
		</li>
															
														</ul>
														<div class="input-field col s12 add_btn" style="display:none;"> 
															<button class="mb-6 btn waves-effect waves-light" type="button" id="add_contact_btn"> Submit
															</button>
														</div>
														
													</div>
												</div>
											</div>
										</div>
										<div class="col s4 add_fade @if($AssignContact->favorite_status == 'favorite') favorite_contact @endif">
											
											<div class="input-field">
												<textarea cols="" rows="" id="comment" name="comment" class="comment_box" required></textarea>
												<label>Commnent Select</label>
											</div>
											<div class="col s6">
												<input class="validate invalid" required="" aria-required="true" id="followup_date" type="date" name="followup_date" min="{{date('Y-m-d', strtotime('-1 day'))}}" value="{{ date('Y-m-d') }}">
											</div>
											<div class="col s6">
												<select name="status" class="select_status">
													<option value="ACTIVE" @if($AssignContact->status == 'ACTIVE') {{'selected'}} @endif>FollowUp</option>
													<option value="COMPLETE" @if($AssignContact->status == 'COMPLETE') {{'selected'}} @endif>COMPLETE</option>
													<option value="CLOSE" @if($AssignContact->status == 'CLOSE') {{'selected'}} @endif>CLOSE</option>
													<option value="INACTIVE" @if($AssignContact->status == 'INACTIVE') {{'selected'}} @endif>INACTIVE</option>
													<option value="REQUEST" @if($AssignContact->status == 'REQUEST') {{'selected'}} @endif>REQUEST</option>
													<option value="UPDATE" @if($AssignContact->status == 'UPDATE') {{'selected'}} @endif>UPDATE</option>
												</select>
											</div>
											
											<div class="col s6">
												<select name="favorite_status" class="favorite_status">
													<option value="normal" @if($AssignContact->favorite_status == 'unfavorite') {{'selected'}} @endif>Normal</option>
													<option value="favorite" @if($AssignContact->favorite_status == 'favorite') {{'selected'}} @endif>Favorite</option>
													<option value="unfavorite" @if($AssignContact->favorite_status == 'unfavorite') {{'selected'}} @endif>Unfavorite</option>
												</select>
											</div>
											
											<div class="col s6">
												<input type="checkbox" id="with_update" name="with_update" /> With Update
											</div>
											
											<div class="input-field col s12" style="text-align:center;">
												@if($AssignContact->status == 'CLOSE')
													<button class="btn waves-effect waves-light right" type="submit" name="action" id="add_followup" disabled>CLOSED
														<i class="material-icons right">not_interested</i>
													</button>
												@elseif($AssignContact->status == 'INACTIVE')
													<button class="btn waves-effect waves-light right" type="submit" name="action" id="add_followup" disabled>INACTIVE
														<i class="material-icons right">not_interested</i>
													</button>
												@else
													<button class="btn waves-effect waves-light right" type="submit" name="action" id="add_followup">Submit
														<i class="material-icons right">send</i>
													</button>
												@endif
												<a class="mb-6 btn waves-effect waves-light purple lightrn-1 right" style="float: none !important;" target="_blank" href="/operator/sendemail/{{$AssignContact->id}}">Send Email
														<i class="material-icons right">send</i>
													</a>
											</div>
										</div>
										<div class="input-field col s4 add_fade">
											<div class="comment_main"> 
											<ul id='' class=''>
												@foreach($AssignContact->followUpComment as $comment)
												<li><a href="#!"><span style="color:#ff4081;">{{date('d M Y h:i A', strtotime($comment->created_at))}}:</span> {{$comment->comment}}  <span style="padding: 0 19px 11px;float: right;width: 100%;text-align: right;color: #555;font-weight: bold;">{{date('d M Y', strtotime($comment->followup_date))}} </span></a></li>
												@endforeach
											</ul>
											</div>
										</div>
										
								</div>
								
							</form>
                        </div>
                        @php $i++;  @endphp
                        @endforeach
						@else
								<div class="carousel-item slide-1">
								<div class="row">
									<form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="POST" action="#" >
									{{csrf_field()}}
										<input type="hidden" name="operator_id" id="operator_id" value="{{ $operator_id }}">
										<input type="hidden" name="assign_contact_id" id="assign_contact_id" value="">
							
										<div class="input-field col s4 sidebar">
										
											<div class="sidebar-content">
												<div id="sidebar-list_hide" class="sidebar-menu list-group position-relative animate fadeLeft">
													<div class="sidebar-list-padding app-sidebar sidenav_hide" id="email-sidenav">
														<ul class="email-list display-grid">
															<!--<li class="sidebar-title">Contact</li>-->
		<li class="active contact_item"> 
			<div class="follow_text" class="text-sub" title="Contact Number">
				<i class="material-icons mr-2"> settings_phone </i> <span class="inputenable" id="mobile"></span>
			</div>
		</li>
		<li style="margin: -8px 0 0;">
			<b class="mobile_exist mobile_msg">Exist</b>
			<b class="mobile_assigned mobile_msg" style="width: 81px;">Assigned</b>
			<b class="mobile_pull mobile_msg" style="background-color: green;cursor: pointer;width: 101px;">Pull Contact</b>
		</li>
		
		<li class="active contact_item">
			<div class="follow_text" class="text-sub" title="Agency Name">
				<i class="material-icons mr-2"> accessible </i> <span class="inputenable" name="agent" id="agency_name"> </span>
			</div>
		</li>
		
		<li class="active contact_item">
			<div class="follow_text" class="text-sub" title="Contact Name">
				<i class="material-icons mr-2"> perm_identity </i> <span class="inputenable" id="name"> </span>
			</div>
		</li>
		
		<li class="active contact_item">
			<div class="follow_text" class="text-sub" title="Contact Email">
				<i class="material-icons mr-2"> mail_outline </i> <span class="inputenable" id="email"> </span>
			</div>
		</li>
		
		<li class="active contact_item">
			<div class="follow_text" class="text-sub" title="Wesite">
				<i class="material-icons mr-2"> web </i> <span class="inputenable" id="website"> </span>
			</div>
		</li>
		
		<li class="active contact_item">
			<div class="follow_text" class="text-sub" title="">
				<i class="material-icons mr-2"> my_location </i> <span class="inputenable" id="location"> </span>
			</div>
		</li>
		
		<li class="active contact_item">
			<div class="follow_text" class="text-sub" title="Contact Type">
				<i class="material-icons mr-2"> compare_arrows </i> <span class="inputenable" id="contact_type"> </span>
			</div>
			<input type="hidden" value="Operator-{{ $operator_name }}" id="source" />
			<input type="hidden" value="{{ $operator_id }}" id="con_operator_id" />
		</li>
															
														</ul>
														<div class="input-field col s12 add_btn" style="display:none;"> 
															<button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" type="button" id="add_contact_btn">
															<i class="material-icons right">add</i>
															</button>
														</div>
														
													</div>
												</div>
											</div>
										</div>
										<div class="col s4 add_fade">
											
											<div class="input-field">
												<textarea cols="" rows="" id="comment" name="comment" class="comment_box" required></textarea>
												<label>Commnent Select</label>
											</div>
											<div class="col s6">
												<input class="validate invalid" required="" aria-required="true" id="followup_date" type="date" name="followup_date" min="{{date('Y-m-d', strtotime('+1 day'))}}" value="{{ date('Y-m-d') }}">
											</div>
											<div class="col s6">
												<select name="status">
													<option></option>
												</select>
											</div>
											
											<div class="col s6">
												<select name="">
													<option></option>
												</select>
											</div>
											
											<div class="input-field col s6">
												
											</div>
										</div>
										<div class="input-field col s4 add_fade">
											<div class="comment_main"> 
											<ul id='' class=''>
												
											</ul>
											</div>
										</div>
										
								</div>
								
							</form>
                        </div>
						@endif
                        </div>
					</div>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>

     <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow add_contact"><i class="material-icons">add</i></a>
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
    
   <!-- BEGIN PAGE LEVEL JS-->
      <script src="{{URL::asset('asset/js/scripts/intro.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  <script>
	function validateEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
		return regex.test(email);
	}
	
	function validateMobile(mobile) {
		var regex = /^\d*(?:\.\d{1,2})?$/; 
		return regex.test(mobile);
	}
	
	
	
	function copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		setTimeout(function(){
			jQuery(".copy_icon").css({"font-size":"15px","color":"#fff"});
		},700);
		$temp.remove();
	}
	$(window).on('load', function () {
	  
		// Copy content
		jQuery(".copy_icon").click(function(){
			copyToClipboard(jQuery(this).parent().find("span"));
			jQuery(this).css({"font-size":"18px","color":"rgb(22 253 29)"});
		});
	  
	  // Select Status
	  jQuery(".select_status").change(function(){
		  var status = jQuery(this).val();
		  if(status == 'UPDATE'){
			  jQuery(".contact_detail").hide();
			  jQuery(".contact_input").show();
			 // jQuery("#followup_date").remove();
			 // jQuery(".favorite_status").parent().remove(); 
		  }
	  });
	  
	  // Check with update 
	  jQuery("#with_update").change(function(){
		  var check_status = jQuery(this).prop("checked");
		  if(check_status == true){
			  jQuery(".contact_detail").hide();
			  jQuery(".contact_input").show();
		  }else{
			  jQuery(".contact_detail").show();
			  jQuery(".contact_input").hide();
		  }
	  });
	  
	  
	  // Add Contact
	  jQuery(".add_contact").click(function(){
		  jQuery(".inputenable").attr('contentEditable',true);
		  jQuery(".inputenable").text('');
		  jQuery("#contact_type").text('Agent/Client/Hotel/Other');
		  jQuery(".created_msg").hide();
		  jQuery(".carousel-fixed-item").hide();
		  jQuery(".add_fade").css({'display':'none'});
		  jQuery(".add_btn").show();
		  jQuery("#add_followup").prop('deactive','true'); 
	  });
	  
	  jQuery(".mobile_pull").click(function(){
			var mobile = jQuery("#mobile").text();
			var assign_to = jQuery("#con_operator_id").val();
			jQuery.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$("#loader-wrapper").css("display","block");
			jQuery.ajax({
				url: 'ajaxAsignContactsbymobile',
				type: 'post',
				cache: false,
				data: {'mobile':mobile, 'assign_to':assign_to},
				success: function(res){ 
					console.log(res);
					var res = JSON.parse(res);
					alert(res.message); 
					location.href = '/operator/contactfollowup';
				}
			});
			
		});
	  
		jQuery("#mobile").keyup(function(event){
			var mobile = jQuery(this).text();
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == 86){
				mobile = mobile.replace(/\s+/g, '');
				jQuery(this).text(mobile);
			}
			
			if(mobile.length == 10){
				console.log(mobile);
				
				jQuery.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$("#loader-wrapper").css("display","block");
				jQuery.ajax({
					url: 'checkcontact',
					type: 'post',
					cache: false,
					data: {'mobile':mobile},
					success: function(res){ 
						console.log(res);
						var res = JSON.parse(res);
						$("#loader-wrapper").css("display","none");
						if(res.status == 1){
							jQuery(".mobile_exist").show();
							if(res.asignstatus == 1){
								jQuery(".mobile_assigned").show();
								jQuery(".mobile_assigned").text(res.assmsg);
								jQuery(".mobile_pull").hide();
							}else if(res.asignstatus == 0){
								jQuery(".mobile_assigned").hide();
								jQuery(".mobile_pull").show();
							}
						}else if(res.status == 0){
							jQuery(".mobile_exist").hide();
							jQuery(".mobile_assigned").hide();
							jQuery(".mobile_pull").hide();
						}
					}
				});
			}else if(mobile.length > 10){
				jQuery(this).text("")
				alert('Please input vailid mobile number!');
			}
			
		});
		
		jQuery("#add_contact_btn").click(function(){
			var agency_name = jQuery("#agency_name").text();
			var name = jQuery("#name").text();
			var email = jQuery("#email").text();
			var mobile = jQuery("#mobile").text();
			var locationval = jQuery("#location").text();
			var contact_type = jQuery("#contact_type").text();
			var additional_info = jQuery("#additional_info").text();
			var source = jQuery("#source").val();
			var con_operator_id = jQuery("#con_operator_id").val();
			var operator_id = jQuery("#operator_id").val();
			var website = jQuery("#website").text();
			var dataValue = {'contact_ids':1, "assign_to": 1};
			var checkemail = validateEmail(email);
			var checkmobile = validateMobile(mobile);
			
			if(checkemail === false && email != ''){
				alert('Please input vailid email!');
			}else if(checkmobile === false || mobile.length != 10){
				alert('Please input vailid mobile number!');
			}else{
				jQuery.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$("#loader-wrapper").css("display","block");
				jQuery.ajax({
					url: 'ajaxcreateandasigncontact',
					type: 'post',
					cache: false,
					data: {'agency_name':agency_name, 'name':name, 'email':email, 'mobile':mobile, 'location':locationval, 'contact_type':contact_type, 'additional_info':additional_info, 'source':source,'con_operator_id':con_operator_id, 'website':website, 'operator_id':operator_id},
					success: function(res){ 
						console.log(res);
						var res = JSON.parse(res);
						$("#loader-wrapper").css("display","none");
						if(res.message != 'Contact Added Successfull!'){
							alert(res.message); 
						}
						location.href = '/operator/contactfollowup';
					}
				});
			}
		});
	  
	 $('.dropdown-trigger').dropdown({
  inDuration: 300,
  outDuration: 225,
  constrainWidth: false, // Does not change width of dropdown to that of the activator
  hover: false, // Activate on hover
  gutter: 0, // Spacing from edge
  coverTrigger: false, // Displays dropdown below the button
  alignment: 'left', // Displays dropdown with edge aligned to the left of button
  stopPropagation: false // Stops event propagation
  }
  );
	
     $('.btn-next').on('click', function (e) {
        $('.intro-carousel').carousel('next');
    })

    $('.btn-prev').on('click', function (e) {
        $('.intro-carousel').carousel('prev');
    })

    // Inti carousel when modal pops up

    function initCarouselModal() {
        $('.carousel.carousel-slider').carousel({
            fullWidth: true,
            indicators: true,
            onCycleTo: function () {

                // When carousel is at it's first step disable prev button

                if ($('.carousel-item.active').index() == 1) {
                    $('.btn-prev').addClass('disabled');

                }

                // When carousel is at 2nd or 3rd step 

                else if ($('.carousel-item.active').index() > 1) {

                    // activate button

                    $('.btn-prev').removeClass('disabled');
                    $('.btn-next').removeClass('disabled');

                    // on 3rd step add and remove elements

                    if ($('.carousel-item.active').index() == {{count($AssignContacts)}}) {
                        $('.btn-next').addClass('disabled');
                    }
                }
            }
        })
    }
    initCarouselModal();

});
</script>  
    
@endsection