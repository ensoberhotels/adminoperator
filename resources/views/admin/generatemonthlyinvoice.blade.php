@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles') 
	
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
                  <li class="breadcrumb-item"><a href="index.html">Report</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Contact Followup Report</a>
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
          <div style=" border-bottom: 1px solid #ff4081; margin-bottom: 15px;">
			<form action="{{url('admin/hotel-monthly-invoice')}}" target="_blank" method="GET" >
			{{ csrf_field() }}
				<div class="row"> 
					<div class="col s3"> 
					<label for="hotel_name" class="">Hotel</label>
					<select name="hotel_id" required>
						@foreach($hotels as $hotel)
						<option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col s2"> 
					<label for="hotel_name" class="">From Date</label>
					<input class="validate invalid" id="fromdate" name="fromdate" type="date" value="{{ app('request')->input('fromdate') }}" required>
				  </div>
				  <div class="col s2"> 
					<label for="hotel_name" class="">To Date</label>
					<input class="validate invalid" id="todate" name="todate" type="date" value="{{ app('request')->input('todate') }}" required>
				  </div>
				  <div class="col s2">
				  <label for="booking_from" class="">Booking From</label>
				  <select name="booking_from">
					<option value="">ALL</option>
					<option value="ONLINE">ONLINE</option>
					<option value="OFFLINE">OFFLINE</option>
				  </select>
				</div>
				  <div class="col s2">
				  <label for="hotel_name" class="">Document Type</label>
				  <select name="doc_type">
					<option value="PDF">PDF</option>
					<option value="EXCEL">EXCEL</option>
				  </select>
				</div>
				
				<div class="col s2"> 
					<label for="extra" class="">Extra's</label> 
					<input type="number" name="extra" value="0" min="0" />
				</div>
				<div class="col s2"> 
					<label for="insentive" class="">Incentive </label>
					<input type="number" name="insentive" value="0" min="0" /> 
				</div>
				<div class="col s4"> 
					<label for="billing" class="">Comment</label>
					<textarea name="comment"></textarea>
				</div>
				<div class="col s2">
				  <button class="btn cyan waves-effect waves-light" type="submit" id="search_hotel">Generate
					<i class="material-icons right">send</i>
				  </button>
				</div>
			</div>
			<div class="row">
				<div class="col s4"> 
					<label for="billing" class="">Description</label>
					<textarea name="des1"></textarea>
				</div>
				<div class="col s2"> 
					<label for="amount1" class="">Amount</label>
					<input type="number" name="amount1" value="0" />
				</div>				
			</div>
			<div class="row">
				<div class="col s4"> 
					<label for="billing" class="">Description</label>
					<textarea name="des2"></textarea>
				</div>
				<div class="col s2"> 
					<label for="amount2" class="">Amount</label>
					<input type="number" name="amount2" value="0" />
				</div>				
			</div>
			<div class="row">
				<div class="col s4"> 
					<label for="billing" class="">Description</label>
					<textarea name="des3"></textarea>
				</div>
				<div class="col s2"> 
					<label for="amount3" class="">Amount</label>
					<input type="number" name="amount3" value="0" />
				</div>				
			</div>
			<div class="row">
				<div class="col s4"> 
					<label for="billing" class="">Description</label>
					<textarea name="des4"></textarea>
				</div>
				<div class="col s2"> 
					<label for="amount4" class="">Amount</label>
					<input type="number" name="amount4" value="0"  />
				</div>				
			</div>
		</form>
	</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- START RIGHT SIDEBAR NAV -->

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
    <script type="">
    $(document).ready(function() {		
		
    });
    </script>
@endsection