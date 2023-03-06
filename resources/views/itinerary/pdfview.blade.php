@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
	<style>
		td.lable_text {
			text-align: center;
			background-color: #009688;
				color:#fff;
			padding: 5px 0;
		}
		table.footer {
			border-top: 1px solid #555;
			padding: 10px 0 0; 
			font-size: 13px;
		}
		table {
			width: 700px;
			font-size: 18px;
			font-family: sans-serif;
			margin: 0 auto;
		}
		table.header {
			text-align: center;
		}
		table.body td {
			padding: 10px 0; 
		}
		/**table.body tr:nth-child(even) {background-color: #8b5050; color:#fff;}
		table.body tr:nth-child(odd) {background-color: #26237a; color:#fff;}**/
		
		.bottom_area {
			width: 100%;
			text-align: center;
			padding-top: 24px;
			border-top: 1px solid #555;
			margin-top: 15px;
			margin-bottom: 15px;
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
                 <li class="breadcrumb-item"><a href="#">Amenities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">All Vouchers</a>
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
    <div class="col s12">
      <div class="card">
        <div class="card-content">
			<div class="row">
				<div class="col s6">
					<h4 class="card-title">All Vouchers</h4>
				</div>
			</div>
          <div class="row">
            <table class="header" >
				<tr>
					<td><img src="{{ URL::asset('asset/images/logo/Panorama.jpg') }}" alt=""/></td>
					<td>By</td>
					<td><img src="{{ URL::asset('asset/images/logo/Ensober.jpg') }}" alt="logo"/></td>
				</tr>
				<tr>
					<td colspan="3">
						<p>Resort Address: Teda Village, Ramnagar – 244715</p>
					</td>
				</tr>
			</table>
			<table class="body">
				<tr>
					<td class="lable_text" colspan="3">Reservation Voucher</td>
				</tr>
				<tr>
					<td><b>Reservation No</b></td>
					<td>:</td>
					<td>PAN/200902</td>
				</tr>
				<tr>
					<td><b>Date</b></td>
					<td>:</td>
					<td>06-Oct 2020</td>
				</tr>
				<tr>
					<td><b>Hotel Name</b></td>
					<td>:</td>
					<td>Panorama Resort, Corbett</td>
				</tr>
				<tr>
					<td><b>Agent Name</b></td>
					<td>:</td>
					<td>Direct</td>
				</tr>
				<tr>
					<td><b>Confirmation No. / Confirmed By</b></td>
					<td>:</td>
					<td>Mrs. Pragya</td>
				</tr>
				<tr>
					<td><b>Client Name</b></td>
					<td>:</td>
					<td>Mr. Jatin Kumar Tanwar</td>
				</tr>
				<tr>
					<td><b>Check In </b></td>
					<td>:</td>
					<td>09 October 2020</td>
				</tr>
				<tr>
					<td><b>Check Out</b></td>
					<td>:</td>
					<td>11 October 2020</td>
				</tr>
				<tr>
					<td><b>No Of Nights</b></td>
					<td>:</td>
					<td>2 Nights</td>
				</tr>
				<tr>
					<td><b>No Of Pax</b></td>
					<td>:</td>
					<td>2 Adults</td>
				</tr>
				<tr>
					<td><b>Kids</b></td>
					<td>:</td>
					<td>N/A</td>
				</tr>
				<tr>
					<td><b>No Of Room</b></td>
					<td>:</td>
					<td>01</td>
				</tr>
				<tr>
					<td><b>Room Type</b></td>
					<td>:</td>
					<td>Whirlpool</td>
				</tr>
				<tr>
					<td><b>Package / Tariff Include</b></td>
					<td>:</td>
					<td>AP</td>
				</tr>
				<tr>
					<td><b>Cost</b></td>
					<td>:</td>
					<td>Rs. 9500/- Net</td>
				</tr>
				<tr>
					<td><b>Advance Received</b></td>
					<td>:</td>
					<td>Rs. 3000/-</td>
				</tr>
				<tr>
					<td><b>Balance</b></td>
					<td>:</td>
					<td>Payable at the Time of Check in</td>
				</tr>
			</table>
			<table class="footer">
				<tr>
					<td>
						<p>
							*Kindly follow the Social distancing and Covid-19 guidelines as per Govt.<br>
							This is a computer generated voucher and does not require signature.<br>
							Standard Check In Time : 12:00 PM<br>
							Standard Check Out Time: 10:00 PM<br> 
							Stay Safe! Stay Healthy!
						</p>
					</td>
				</tr>
			</table> 
			
			<div class="bottom_area">
				<a href="{{ url('pdfview?download=pdf') }}"><button type="button">Download PDF</button></a> 
				<form class="form-inline" action="{{url('sendpdf')}}" method="post" style="display: inline-block; margin-left: 15px;">
				{{csrf_field()}}
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
					<button type="submit" class="btn btn-primary">Send</button>
				</form>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('asset/js/scripts/data-tables.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
	<script>
		/* jQuery(document).ready(function(){
			jQuery(".car_delete").click(function(event){
				event.preventDefault();
				var car_id = jQuery(this).attr("carid");
				jQuery.ajax({
					type: 'get',
					url: '/admin/car/destroy/'+car_id,
					//data: {'delete':'delete'},
					success: function(res){
						console.log(res);
					}
				});
			});
		}); */
	</script>
@endsection