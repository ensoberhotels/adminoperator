@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard ')

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
                  <li class="breadcrumb-item"><a href="index.html">Contacts</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">All Contacts</a>
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
  
  
  <!-- Multi Select -->

  <div class="row">
    <div class="col s12">
      <div class="card">
		<div class="dastop_search" style="border-bottom: 1px solid #ff4081;float: left;width: 100%; padding: 0 15px;">
			<form action="" method="GET">
				{{ csrf_field() }}
				<div class="row">
					<div class="col s12 m3">
						<label for="from_date" class="active">Vendor</label>
						<select name="vender_id">
							<option value=""></option>
							@foreach($venders as $vender)
								<option value="{{$vender->id}}" @if(@request()->vender_id == $vender->id) {{ 'selected' }} @endif>{{$vender->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col s6 m3">
						<label for="from_date" class="">From</label>
						<input class="form-control" id="from" name="from" type="date" value="{{ @request()->from }}">
					</div>
					<div class="col s6 m3">
						<label for="to_date" class="">To</label>
						<input class="form-control" id="to" name="to" type="date" value="{{ @request()->to }}">
					</div>
					<div class="col s6 m3"><br>
						<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" id="addbookingbtn">Search Activity</button>
					</div>
				</div>
			</form>
		</div>
	  
        <div class="card-content">
          <div class="row">
            <div class="col s12"> 
              <table id="multi-select" class="display">
                <thead>
                  <tr>
                    <th class="" >Voucher No</th>                   
                    <th class="" >Activity</th>                  
                    <th class="" >Name</th>                  
                    <th class="" >Mobile</th>                  
                    <th class="" >Email</th>                  
                    <th class="" >Adults</th>                  
                    <th class="" >Chields</th>                  
                    <th class="" >Total Visitors</th>                  
                    <th class="" >Date</th>   
                    <th class="" >Time</th>  
                    <th class="" >Slot</th>  
                    <th class="" >Actual Cost</th>  
                    <th class="" >Total Bill</th>  
                    <th class="" >Advance</th>  
                    <th class="" >Received By</th>  
                    <th class="" >Advance Date</th>  
                    <th class="" >Balance</th>  
                    <th class="" >Vendor</th>  
                    <th class="" >PDF</th>  
                  </tr>
                </thead>
                <tbody>
                @foreach($vouchers as $voucher)
                
                <tr>
                    <td> {{ $voucher->voucher_no }}</td>
                    <td> {{ $voucher->activity_id }}</td>
                    <td> {{ $voucher->client_name }}</td>
                    <td> {{ $voucher->mobile }}</td>
                    <td> {{ $voucher->email }}</td>
                    <td> {{ $voucher->adults }}</td>
                    <td> {{ $voucher->chields }}</td>
                    <td> {{ $voucher->total_visitors }}</td>
                    <td> {{ date('d M Y', strtotime($voucher->date)) }}</td>
                    <td> {{ $voucher->time }}</td>
                    <td> {{ ucwords(str_replace('_',' ', $voucher->slot)) }}</td>
                    <td> {{ $voucher->actual_cost }}</td>
                    <td> {{ $voucher->total_bill }}</td>
                    <td> {{ $voucher->advance_received }}</td>
                    <td> {{ $voucher->payment_received_by }}</td>
                    <td> {{ date('d M Y', strtotime($voucher->date_of_advance)) }}</td>
                    <td> {{ $voucher->balance }}</td>
                    <td> {{ @$voucher->Vender->name }}</td>
                    <td> <a href="/storage/app/quotations/{{ $voucher->voucher_no }}.pdf" target="_blank"><i class="material-icons ">visibility</i></a></td> 
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="pagination">{{$vouchers->links()}}</div>
            </div>
            
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

</div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
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
    
    </script>
@endsection