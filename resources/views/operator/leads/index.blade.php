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
		.custom_tab_main {
			padding: 0 15px;
		}
		.custome_lable_m1 {
			width: 156px;
			height: 88px;
		}
		.custome_lable_text {
			width: 100%;
			height: 88px;
			padding: 10px !important;
		}
		table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
    border-top: 1px solid #555;
}
#main .content-wrapper-before {
    height: 239px !important;
}
th {
    color: #000;
    font-size: 13px;
}
td {
    color: #000;
    font-size: 13px;
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
		
		<!-- Tab Start -->
		<div class=" active custom_tab_main" id="">
			<div class="col s12">
				<ul class="custom_tabs">
					<li class="custom_tab">
						<a class="active" href="{{URL::to('/operator/leads/')}}">Lead</a>
					</li>
					<li class="custom_tab">
						<a class="" href="{{URL::to('/operator/quotation/')}}">Quotation</a>
					</li>
					<li class="custom_tab">
						<a class="" href="{{URL::to('/operator/sales/')}}">Sale</a>
					</li>
					<li class="custom_tab">
						<a class="" href="{{URL::to('/operator/booked/')}}">Booked</a>
					</li>
				</ul>
			</div>
			<div class="clable_main">
				<div class="clable">
					<a class="active" href="@if($total_count>0){{URL::to('/operator/leads/?lead=total')}} @else {{ '#' }}@endif"> 
					<div class="clable_text">
						Total Leads
					</div>
					<div class="clable_value">
						{{ $total_count }}
					</div>
					</a>
				</div>
				
				<div class="clable color1">
					<a class="active" href="@if($active_count>0){{URL::to('/operator/leads/?lead=active')}} @else {{ '#' }}@endif"> 
					<div class="clable_text">
						Active Leads
					</div>
					<div class="clable_value">
						{{$active_count}}
					</div>
					</a>
				</div>
				
				<div class="clable color2">
					<a class="active" href="@if($book_count>0){{URL::to('/operator/leads/?lead=book')}} @else {{ '#' }}@endif"> 
					<div class="clable_text">
						Booked Leads
					</div>
					<div class="clable_value">
						{{$book_count}}
					</div>
					</a>
				</div> 
				
				<div class="clable color3">
					<a class="active" href="@if($postponed_count>0){{URL::to('/operator/leads/?lead=poastponed')}} @else {{ '#' }}@endif">
					<div class="clable_text">
						Postpone Leads
					</div>
					<div class="clable_value">
						{{$postponed_count}}
					</div>
					</a>
				</div>
				
				<div class="clable color4">
					<a class="active" href="@if($loosed_count>0){{URL::to('/operator/leads/?lead=loosed')}} @else {{ '#' }}@endif">
					<div class="clable_text">
						Lost Leads
					</div>
					<div class="clable_value">
						{{$loosed_count}}
					</div>
					</a>
				</div>
			<!--</div>
			
			<div class="clable_main">--> 
				<div class="clable">
					<a class="active" href="@if($new_count>0){{URL::to('/operator/leads/?lead=new')}} @else {{ '#' }}@endif">
					<div class="clable_text">
						Today's Leads
					</div>
					<div class="clable_value">
						{{ $new_count }}
					</div>
					</a>
				</div>
				
				<div class="clable color1">
					<a class="active" href="@if($yester_count>0){{URL::to('/operator/leads/?lead=yesterd')}} @else {{ '#' }}@endif">
					<div class="clable_text">
						Yesterday's Leads
					</div>
					<div class="clable_value">
						{{$yester_count}}
					</div>
					</a>
				</div>
				
				<div class="clable color2">
					<a class="active" href="@if($pendding_count>0){{URL::to('/operator/leads/?lead=pendding')}} @else {{ '#' }}@endif">
					<div class="clable_text">
						Pendding Quote
					</div>
					<div class="clable_value">
						{{$pendding_count}}
					</div>
					</a>
				</div> 
				
				<div class="clable color3">
					<a class="active" href="@if($closed_count>0){{URL::to('/operator/leads/?lead=closed')}} @else {{ '#' }}@endif">
					<div class="clable_text">
						Closed Leads
					</div>
					<div class="clable_value">
						{{$closed_count}}
					</div>
					</a>
				</div>
				
				<div class="clable color4">
					<a class="active" href="@if($hot_count>0){{URL::to('/operator/leads/?lead=hot')}} @else {{'#'}}@endif">
					<div class="clable_text">
						Hot Leads
					</div>
					<div class="clable_value">
						{{$hot_count}}
					</div>
					</a>
				</div>
				
				<div class="clable color">
					<a class="active" href="@if($follow_up_count>0){{URL::to('/operator/leads/?lead=follow_up')}} @else {{'#'}}@endif">
					<div class="clable_text">
						Followup Leads
					</div>
					<div class="clable_value">
						{{$follow_up_count}}
					</div>
					</a>
				</div>
			</div>
			
            <!--<div class="row status_count">
			  <div class="col s12 m2">
			   @if($new_count>0) <a class="active" href="{{URL::to('/operator/leads/?lead=new')}}"> @endif
				 <div class="card animate fadeLeft custome_lable_m">
					<div class="card-content cyan white-text custome_lable_text">
					   <p class="card-stats-title"><i class="material-icons">person_outline</i> New Leads</p>
					   <h4 class="card-stats-number white-text">{{ $new_count }}</h4>
					</div>
				 </div>
				 @if($new_count>0) </a> @endif
			  </div>
      <div class="col s12 m2">
      @if($active_count>0) <a class="active" href="{{URL::to('/operator/leads/?lead=active')}}"> @endif
       
         <div class="card animate fadeLeft custome_lable_m">
            <div class="card-content red accent-2 white-text custome_lable_text">
               <p class="card-stats-title"><i class="material-icons">attach_money</i>Active Leads</p>
               <h4 class="card-stats-number white-text">{{ $active_count }}</h4>
            </div>
         </div>
         @if($active_count>0) </a > @endif
       
      </div>
      <div class="col s12 m2">
      @if($hot_count>0) <a class="active" href="{{URL::to('/operator/leads/?lead=hot')}}"> @endif
      
         <div class="card animate fadeRight custome_lable_m">
            <div class="card-content orange lighten-1 white-text custome_lable_text">
               <p class="card-stats-title"><i class="material-icons">trending_up</i> Hot Leads</p>
               <h4 class="card-stats-number white-text">{{ $hot_count }}</h4>
            </div>
         </div>
         @if($hot_count>0) </a > @endif
       
      </div>
      <div class="col s12 m2">
      @if($follow_up_count>0) <a class="active" href="{{URL::to('/operator/leads/?lead=follow_up')}}"> @endif
      
         <div class="card animate fadeRight custome_lable_m">
            <div class="card-content green lighten-1 white-text custome_lable_text">
               <p class="card-stats-title"><i class="material-icons">content_copy</i> Follow Up Reminders</p>
               <h4 class="card-stats-number white-text">{{ $follow_up_count }}</h4>
               
            </div>
         </div>
        @if($follow_up_count>0) </a > @endif
         
      </div>
      
      
      
      <div class="col s12 m2">
       @if($inactive_count>0) <a class="active" href="{{URL::to('/operator/leads/?lead=inactive')}}"> @endif
     
         <div class="card animate fadeRight custome_lable_m">
            <div class="card-content lime lighten-2 lighten-1 white-text custome_lable_text">
               <p class="card-stats-title"><i class="material-icons">content_copy</i> Lost</p>
               <h4 class="card-stats-number white-text">{{ $inactive_count }}</h4>
            </div>
         </div>
        @if($inactive_count>0) </a > @endif
         
      </div>
   </div>-->
		</div> 
		
		<!-- /Tab End -->
		
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="row">
            <div class="col s12">
				<a href="{{url('/operator/leads?notclose=1')}}"><button class=" buttons-html5 mb-6 btn waves-effect gradient-45deg-red-pink waves-light car_delete" tabindex="0" aria-controls="multi-select" title="Except Closed Leads"><span>Short By Closed Leads</span></button></a>
              <table id="multi-select" class="display">
                <thead>
                  <tr>
					<th class="no-sort" style="color:#fff;">###</th>
                    <th class="no-sort">
                      <label>
                        <input type="checkbox" class="select-all" />
                        <span></span>
                      </label>
                    </th>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Hotel Name</th>
                    <th>Guest Info </th>                  
                    <th>Mobile</th>
					<th>Followup Date	 </th>
					<th>Comment	 </th>
					<th>Source	 </th>
                    <th>Check In</th>
                    <th class="no-sort">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($leads as $lead)
                <tr class=" @if($lead->today_followup == 'YES') {{'todayfoloup'}} @endif @if($lead->lead_status == 'CLOSED') {{'closed_leadR'}} @endif" title="@if($lead->today_followup == 'YES') {{''}} @endif">
					<td>
                     
                    </td>
                    <td>
                      <label>
                        <input type="checkbox" />
                        <span></span>
                      </label>
                    </td>
                    <td>{{ $lead->lead_no }}</td>
                    <td width="50px">{{ date('d M', strtotime($lead->created_at)) }}</td>
                    <td>{{ @$lead->hotel['hotel_name'] }}</td>
					<td> {{ $lead->name }}</td>
					<td> 
						{{ $lead->mobile }}
						<div class="pull-right">
							<a target="_blank" class="" href="tel:{{ $lead->mobile }}">
								<img src="{{ URL::asset('asset/images/p_icon.jpeg') }}"" />
								<!--<i class="material-icons">mobile_screen_share</i>-->
							</a>

							<a target="_blank" class="" href="https://api.whatsapp.com/send?phone=91{{ $lead->mobile }}">
								<img src="{{ URL::asset('asset/images/w_icon.jpeg') }}"" />
								<!--<i class="material-icons">app_settings_alt</i>-->
							</a>
						</div>
					</td>
					<td> {{ $lead->followup_date }} </td>
					<!--<td>{{ $lead->lead_status }}</td>-->
					<td>
						<p class="tooltipped" data-tooltip="{{ $lead->lead_comment }}">{{ str_limit($lead->lead_comment, 20) }}</p>
					</td>
                    <td>{{ $lead->lead_source }}</td>
                    <td>
						{{ $lead->start_date }}
                        <!--<div class="switch">
                          <label onchange="change_status('{{$lead->id}}','Lead')" >
                            @if($lead->status == 'ACTIVE')
                                <input checked="" type="checkbox">
                            @else
                                <input type="checkbox">
                            @endif
                            <span class="lever"></span>
                          </label>
                        </div>-->
                    </td>
                    <td style="text-align: center; padding: 5px 0 0 !important; width: 140px;">
						@if($lead->lead_status != 'CLOSED')
							<form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display: inline-block;">
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="DELETE">
								<button class="buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange car_delete" tabindex="0" aria-controls="multi-select" title="Delete" onclick="return confirm('Are you sure?')"><span>Delete</span></button>
							</form>
							<a href="{{ route('leads.edit',$lead->id) }}">
								<button class=" buttons-html5 mb-6 btn waves-effect gradient-45deg-red-pink waves-light car_delete" tabindex="0" aria-controls="multi-select" title="Update"><span>Update</span></button>
							</a> <br>
							
							<span id="make_a_quate_{{$lead->id}}">
							  @if($lead->make_quatation == '0')
									<button class="buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan car_delete" tabindex="0" aria-controls="multi-select" title="MAKE A QUOTATION" onclick="make_quatation('{{$lead->id}}')"><span>MAKE A QUOTATION</span></button><br>
							  @endif
							</span>
							<a href="{{ url('/operator/lead/followup/'.$lead->id) }}">
								<button class=" buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-amber-amber car_delete" tabindex="0" aria-controls="multi-select" title="Update"><span>Followup</span></button>
							</a>
						@endif
						
						@if($lead->lead_status != 'CLOSED')
						<!-- Modal Trigger -->
						  <a class="waves-effect waves-light btn modal-trigger" href="#modal{{$lead->id}}">Close</a><br>
						  <!-- Modal Structure -->
						  <div id="modal{{$lead->id}}" class="modal modal-fixed-footer" style="width:400px; height:300px;">
						  <form method="POST" action="{{ url('/operator/leadclose') }}">
						  {{csrf_field()}}
							<div class="modal-content" style="width: 348px; text-align:left;">
							  <h5>Lead Close</h5>
								<div class="form-group">
								  <label for="email">Close Status:</label>
								  <select class="form-control" name="closed_status" required>
									<option value="">Select Reason</option>
									<option value="BOOKED">BOOKED</option>
									<option value="POSTPONED">POSTPONE</option>
									<option value="LOST">LOST</option>
								  </select>
								</div>
								<div class="form-group">
								  <label for="pwd">Closed Reason:</label>
								  <textarea class="form-control" name="closed_reason"></textarea>
								</div>
							</div>
							<div class="modal-footer" style="width: 348px;">
								<input type="hidden" name="lead_id" value="{{ $lead->id }}" />
							  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
							  <button type="submit" class="btn btn-primary">Submit</button>
							</div>
							</form>
						  </div>
						  <!-- /Modal Trigger -->
						  @endif
						  
						  @if($lead->lead_status == 'QUOTATION')
							<span href="javascript:void(0);" class="gnbtn">In Quotation</span><br>
						@elseif($lead->lead_status == 'CLOSED')  
							<a href="javascript:void(0);" class="bnbtn tooltipped" data-tooltip="{{ $lead->closed_reason }}">CLOSED</a><br>
							<a href="javascript:void(0);" class="@if($lead->closed_status == 'BOOKED') {{'gnbtn'}} @else {{'bnbtn'}}@endif">{{$lead->closed_status}}</a><br>
							
							<a href="{{url('/operator/reopenclose/'.$lead->id)}}" onclick="return confirm('Are you sure want to reopen?')" class="wnbtn">REOPEN</a>
						@endif
                       </td> 
                       
                  </tr>
                @endforeach
				
				
				<!-- Closed Lead -->
				@if(@$_GET['notclose'] == 1)
					@foreach($Closeleads as $lead)
                
						<tr class=" @if($lead->today_followup == 'YES') {{'todayfoloup'}} @endif @if($lead->lead_status == 'CLOSED') {{'closed_leadR'}} @endif" title="@if($lead->today_followup == 'YES') {{'Today Followup Lead'}} @endif">
						<td>
                     
                    </td>
                    <td>
                      <label>
                        <input type="checkbox" />
                        <span></span>
                      </label>
                    </td>
                    <td>{{ $lead->lead_no }}</td>
					<td width="50px">{{ date('d M', strtotime($lead->created_at)) }}</td>
					<td>{{ $lead->hotel['hotel_name'] }}</td>
					<td> {{ $lead->name }}</td>
					<td> 
						{{ $lead->mobile }}
						<div class="pull-right">
							<a target="_blank" class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" href="tel:{{ $lead->mobile }}"><i class="material-icons">mobile_screen_share</i></a>

							<a target="_blank" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow" href="https://api.whatsapp.com/send?phone=91{{ $lead->mobile }}"><i class="material-icons">app_settings_alt</i></a>
						</div>
					</td>
					<td> {{ $lead->followup_date }} </td>
					<!--<td>{{ $lead->lead_status }}</td>-->
					<td>
						<p class="tooltipped" data-tooltip="{{ $lead->lead_comment }}">{{ str_limit($lead->lead_comment, 20) }}</p>
					</td>
                    <td>{{ $lead->lead_source }}</td>
                    <td>
						{{ $lead->start_date }}
                        <!--<div class="switch">
                          <label onchange="change_status('{{$lead->id}}','Lead')" >
                            @if($lead->status == 'ACTIVE')
                                <input checked="" type="checkbox">
                            @else
                                <input type="checkbox">
                            @endif
                            <span class="lever"></span>
                          </label>
                        </div>-->
                    </td>
                    <td style="text-align: center; padding: 5px 0 0 !important; width: 140px;">
						@if($lead->lead_status != 'CLOSED')
							<form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display: inline-block;">
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="DELETE">
								<button class="buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange car_delete" tabindex="0" aria-controls="multi-select" title="Delete" onclick="return confirm('Are you sure?')"><span>Delete</span></button>
							</form>
							<a href="{{ route('leads.edit',$lead->id) }}">
								<button class=" buttons-html5 mb-6 btn waves-effect gradient-45deg-red-pink waves-light car_delete" tabindex="0" aria-controls="multi-select" title="Update"><span>Update</span></button>
							</a> <br>
							
							<span id="make_a_quate_{{$lead->id}}">
							  @if($lead->make_quatation == '0')
									<button class="buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan car_delete" tabindex="0" aria-controls="multi-select" title="MAKE A QUOTATION" onclick="make_quatation('{{$lead->id}}')"><span>MAKE A QUOTATION</span></button><br>
							  @endif
							</span>
							<a href="{{ url('/operator/lead/followup/'.$lead->id) }}">
								<button class=" buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-amber-amber car_delete" tabindex="0" aria-controls="multi-select" title="Update"><span>Followup</span></button>
							</a>
						@endif
						
						@if($lead->lead_status != 'CLOSED')
						<!-- Modal Trigger -->
						  <a class="waves-effect waves-light btn modal-trigger" href="#modal{{$lead->id}}">Close</a><br>
						  <!-- Modal Structure -->
						  <div id="modal{{$lead->id}}" class="modal modal-fixed-footer" style="width:400px; height:300px;">
						  <form method="POST" action="{{ url('/operator/leadclose') }}">
						  {{csrf_field()}}
							<div class="modal-content" style="width: 348px;">
							  <h5>Lead Close</h5>
								<div class="form-group">
								  <label for="email">Close Status:</label>
								  <select class="form-control" name="closed_status">
									<option value="BOOKED">BOOKED</option>
									<option value="POSTPONED">POSTPONE</option>
									<option value="LOOSED">LOST</option>
								  </select>
								</div>
								<div class="form-group">
								  <label for="pwd">Closed Reason:</label>
								  <textarea class="form-control" name="closed_reason"></textarea>
								</div>
							</div>
							<div class="modal-footer" style="width: 348px;">
								<input type="hidden" name="lead_id" value="{{ $lead->id }}" />
							  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
							  <button type="submit" class="btn btn-primary">Submit</button>
							</div>
							</form>
						  </div>
						  <!-- /Modal Trigger -->
						  @endif
						  
						  @if($lead->lead_status == 'QUOTATION')
							<span href="javascript:void(0);" class="gnbtn">In Quotation</span><br>
						@elseif($lead->lead_status == 'CLOSED')  
							<a href="javascript:void(0);" class="bnbtn tooltipped" data-tooltip="{{ $lead->closed_reason }}">CLOSED</a><br>
							<a href="javascript:void(0);" class="@if($lead->closed_status == 'BOOKED') {{'gnbtn'}} @else {{'bnbtn'}}@endif">{{$lead->closed_status}}</a><br>
							
							<a href="{{url('/operator/reopenclose/'.$lead->id)}}" onclick="return confirm('Are you sure want to reopen?')" class="wnbtn">REOPEN</a>
						@endif
                       </td> 
                       
                  </tr>
					@endforeach
				@endif
				<!-- /Closed Lead -->
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Hotel Name</th>
                    <th>Guest Info </th>                  
                    <th>Mobile</th>
					<th>Followup Date	 </th>
					<th>Comment	 </th>
					<th>Source	 </th>
                    <th>Check In</th> 
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
  <script type="">
  function make_quatation(id){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url: "/operator/ajaxMakeQuatation",
    type:"post",
    cache: false,
    async:true,
    data: {'id':id},
    success: function(data){
        var  data = JSON.parse(data);
        $('#make_a_quate_'+id).html(''); 
        alert(data.msg);       
    }
  });   
  };
  </script>  
    
@endsection