@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard | Create Ititnerary')

@section('styles')
	<style>
		.active.custom_tab_main.tab_border {
			margin: 0;
		}
		#yazra_table td {
			padding: 7px 5px !important;
		}
		.table-responsive {
			overflow: auto;
			float: left;
			width: 100%;
		}
		.box {
			float: left;
			width: 100%;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0px 7px 0 #d6d8db;
		}
		.mobile_search{display:none;}
		span.r_i_hotel_name {
			color: hsl(1deg 76% 66%);
			font-size: 16px;
			font-weight: bold;
			float: left;
			width: 100%;
			text-align: center;
			border-bottom: 1px solid hsl(270deg 51% 53%);
		}
		@if($operator->view_only == 'Y')
			.buttons-csv{display:none !important;}
		@endif
		@media only screen and (max-width: 600px) {
			.mobile_search{display:block;}
			.dastop_search{display:none;}
		}
	</style>
@endsection

@section('content')
	<!-- BEGIN: Page Main-->
<div id="main">
	<div class="container">
		<div class="row mobile_search">
		<div class="box">
			<form action="" method="GET" >
				{{ csrf_field() }}
				<div class="row"  style="margin-bottom: 1px !important;">
					<div class="col s12 m3">
						@if(@$operator->room_inventory == 'Y')
							<span class="r_i_hotel_name">{{ @$hotel->hotel_name }}</span>
							<input type="hidden" value="{{ @$hotel->id }}" id="hotel_id" />
						@else
							<label for="from_date" class="active">Hotel</label>
							<select class="form-control" id="hotel_id" name="hotel_id">
								<option value="">Select Hotel</option>
								@foreach($hotels as $hotellist)
									<option value="{{ $hotellist->id }}" @if(@request()->hotel_id == $hotellist->id) {{ 'selected' }} @endif>{{ $hotellist->hotel_name }}</option>
								@endforeach
							</select>
						@endif
					</div>
					<div class="col s6 m3">
						<label for="from_date" class="active">From</label>
						<input class="form-control" id="from" name="from" type="date" value="{{ @request()->from }}"/>
					</div>
					<div class="col s6 m3">
						<label for="to_date" class="active">To</label>
						<input class="form-control" id="to" name="to" type="date" value="{{ @request()->to }}"/>
					</div>
					<div class="col s12 m3" style="margin-top: 8px !important; text-align: center;">
						<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" id="addbookingbtn">Search Booking</button>
					</div>
				</div>
			</form>
		</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="dastop_search" style="border-bottom: 1px solid #ff4081;float: left;width: 100%;">
							<form action="" method="GET" >
								{{ csrf_field() }}
								<div class="row">
									<div class="col s12 m3">
										<label for="from_date" class="active">Hotel</label>
										@if(@$operator->room_inventory == 'Y')
											<br><span class="">{{ @$hotel->hotel_name }}</span>
											<input type="hidden" value="{{ @$hotel->id }}" id="hotel_id" />
										@else
											<select class="form-control" id="hotel_id" name="hotel_id">
												<option value="">Select Hotel</option>
												@foreach($hotels as $hotellist)
													<option value="{{ $hotellist->id }}" @if(@request()->hotel_id == $hotellist->id) {{ 'selected' }} @endif>{{ $hotellist->hotel_name }}</option>
												@endforeach
											</select>
										@endif
									</div>
									<div class="col s6 m3">
										<label for="from_date" class="active">From</label>
										<input class="form-control" id="from" name="from" type="date" value="{{ @request()->from }}"/>
									</div>
									<div class="col s6 m3">
										<label for="to_date" class="active">To</label>
										<input class="form-control" id="to" name="to" type="date" value="{{ @request()->to }}"/>
									</div>
									<div class="col s6 m3"><br>
										<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" id="addbookingbtn">Search Booking</button>
									</div>
								</div>
							</form>
						</div>
						
						<div class="table-responsive">
							<table id="multi-select" class="dataTable display">
								<thead>
									<tr>
										<th>More</th>
										<th>Booking No</th>
										<th>Check In</th>
										<th>Check Out</th>
										<th>Client Name</th>
										<th>Booking From</th>
										<th>Booking Status</th>
										<th>No Of Rooms</th>
										<th>Total Rooms</th>
										<th>Meal Plan</th>
										<th>Total Billing</th>
										<th>Adults</th>
										<th>Kids WB</th>
										<th>Kids WOB</th>
										<th>Infant</th>
										<th>Agent Name</th>
										<th>Hotel</th>
										<th>Source</th>
										<th>Confirmed By</th>
										<th>Comment</th>
										<th>Advance Amount</th>
										<th>Date of Advance</th>
										<th>Payment Source</th>
										<th>Comment For Balance </th>
										<th>Extras Billing</th>
										<th>Payment Snapshot</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									@foreach($bookings as $booking)
									<tr>
										<td></td>
										<td>{{ $booking->send_quotation_no }}</td>
										<td style="width:150px;">{{(isset($booking->check_in) ? date('d-m-Y', strtotime($booking->check_in)) :'')}}</td>
										<td  style="width:150px;">{{(isset($booking->check_out) ? date('d-m-Y', strtotime($booking->check_out)) : '')}}</td>
										<td>{{ $booking->client_name }}</td>
										<td>{{ $booking->booking_from }}</td>
										<td>{{ $booking->booking_status }}</td>
										<td>{{ $booking->noofrooms }}</td>
										<td>{{ $booking->total_rooms }}</td>
										<td>{{ $booking->getMealShortNameByCode($booking->plan) }}</td>
										<td>{{ $booking->total_bill }}</td>
										<td>{{ $booking->adults }}</td>
										<td>{{ $booking->kidswd }}</td>
										<td>{{ $booking->kidswod }}</td>
										<td>{{ $booking->infant }}</td>
										<td>{{ $booking->agent_name }}</td>
										<td>{{ @$booking->hotelDetals->hotel_name }}</td>
										<td>{{ $booking->source }}</td>
										<td>{{ $booking->confirmed_by }}</td>
										<td>{{ $booking->comment }}</td>
										<td>{{ $booking->advance_amount }}</td>
										<td>{{ $booking->date_of_advance }}</td>
										<td>{{ $booking->payment_source }}</td>
										<td>{{ $booking->comment_for_balace }}</td>
										<td>{{ $booking->extra_bill }}</td>
										<td><a href="/storage/app/{{ $booking->payment_snapshot }}" target="_blank"><img src="/storage/app/{{ $booking->payment_snapshot }}" style="width:50px;" class="img-responsive"></a></td>
										<td><a href="/operator/bookings/delete/{{ $booking->id }}" onclick="return confirm('Are you sure want to delete?')"><button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light">Delete</button></a></td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
								  <tr>
									<th>More</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Client Name</th>
									<th>Booking From</th>
									<th>Booking Status</th>
									<th>No Of Rooms</th>
									<th>Total Rooms</th>
									<th>Meal Plan</th>
									<th>Total Billing</th>
									<th>Adults</th>
									<th>Kids WB</th>
									<th>Kids WOB</th>
									<th>Infant</th>
									<th>Agent Name</th>
									<th>Hotel</th>
									<th>Source</th>
									<th>Confirmed By</th>
									<th>Comment</th>
									<th>Advance Amount</th>
									<th>Date of Advance</th>
									<th>Payment Source</th>
									<th>Comment For Balance </th>
									<th>Extras Billing</th>
									<th>Booking No</th>
									<th>Payment Snapshot</th>
									<th>Delete</th>
								  </tr>
								</tfoot>
							  </table>
							  <div class="pagination">{{$bookings->links()}}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!-- END: Page Main-->

@php 
	$checkroominv = Session::get('operator.room_inventory');
@endphp
@if(@$checkroominv[0] != 'Y')
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
				<a href="{{ url('/operator/addroombook') }}">
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
@endsection

@section('scripts')
	<!-- BEGIN VENDOR JS-->
    <script src="{{ URL::asset('public/asset/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('public/asset/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/dataTables.select.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('public/asset/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('public/asset/js/scripts/data-tables.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
    <script type="">
    $(document).ready(function() {
		

    });
    </script>
@endsection