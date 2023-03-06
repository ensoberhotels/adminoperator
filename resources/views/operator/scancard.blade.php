@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard ')

@section('styles')
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

	<style>
		.select_template{float: left; margin: 0; padding: 0;}
		.select_template input {
			position: unset !important;
			opacity: 1 !important;
			pointer-events: auto !important;
			width: 15px !important;
			height: 15px !important;
		}
		.row {
			display: -ms-flexbox;
			display: unset;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-right: -15px;
			margin-left: -15px;
		}
		.select_template li {
			display: inline-block;
			margin: 0 5px;
		}
		textarea.custom_message {
			width: 100%;
			height: 112px;
			padding: 5px 15px;
		}
		.custom_div {
			float: left;
			width: 100%;
			display:none;
		}
		.contact-header {
			float: left;
			width: 100%;
			margin: -26px 0 -25px;
		}
		header#header {
			display: none;
		}
		button#add_hotel {
			width: 100%;
			font-size: 15px !important;
			height: 32px !important;
			margin-top: 40px !important;
		}
		.col.s12.m12.form-header {
			background-color: #df810a8c !important;
		}
		h6.form-header-text {
			padding: 0 15px;
		}
		
		.custom-file-input::-webkit-file-upload-button {
		  visibility: hidden;
		}
		.custom-file-input::before {
		  content: 'Select some files';
		  display: inline-block;
		  background: linear-gradient(top, #f9f9f9, #e3e3e3);
		  border: 1px solid #999;
		  border-radius: 3px;
		  padding: 5px 8px;
		  outline: none;
		  white-space: nowrap;
		  -webkit-user-select: none;
		  cursor: pointer;
		  text-shadow: 1px 1px #fff;
		  font-weight: 700;
		  font-size: 10pt;
		}
		.custom-file-input:hover::before {
		  border-color: black;
		}
		.custom-file-input:active::before {
		  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
		}
		.custom-file-input{opacity:1;}
		.custom-file-input {
			opacity: 1;
			text-indent: 307px;
			background: url(https://cdn-icons-png.flaticon.com/128/1516/1516989.png);
			height: 100px !important;
			width: 100px !important;
			background-size: contain;
			margin-left: 21px !important;
			margin-top: 16px !important;
			border-color: #eee !important;
			margin-bottom: 11px !important;
		}
		table{font-size:12px;}
		.loader-mobile {
			float: left;
			width: 100%;
			height: 100%;
			background-color: #000;
			position: fixed;
			z-index: 99;
			display:none;
		}
	</style>
@endsection

@section('content')
	<!-- BEGIN: Page Main-->
	<div id="main">
	<div class="loader-mobile"><br><br>
		<center><img src="https://www.ensoberhotels.com/images/logo.png" alt="logo" style="width: 100px;"></center><br>
		<img src="https://images.squarespace-cdn.com/content/v1/5c0d32d64cde7a04e842cfc1/1546847044836-9YLY3MKJSFNYVO8MWEMQ/loading+gif.gif">
		
		<center><h2>Loading...</h2></center>
	</div>

	<center><img src="https://www.ensoberhotels.com/images/logo.png" alt="logo" style="width: 100px;"></center>
      <div class="row">
          <div class="container">
            <!-- Contact Us -->
		<div id="contact-us" class="section">
		  <div class="app-wrapper">
			<div class="contact-header" style="margin-top: 0rem;"> 
			  <div class="row contact-us">
				<div class="col s12 m12 form-header" style="padding: 0.5rem;">
				  <h6 class="form-header-text"><i class="material-icons"> recent_actors </i> 
					Scan Visiting Card And Send Rate
				  </h6>
				</div>
			  </div>
			</div>

    <!-- Contact Sidenav -->
    <div id="sidebar-list" class="row contact-sidenav">
      
		<div class="contact-form margin-top-contact" style="padding: 15px 15px 30px;">
			<form class="" method="POST" action="/api/saveVisitingCard" enctype='multipart/form-data' onSubmit="showLoader()">
				
				<div class="row">
				  <div class="col m6 s12">
					<label for="name">Card Pic</label>
					<input type="file" accept="image/*" name="image" capture="camera" class="custom-file-input">
				  </div>
				</div>
				<div class="row hide">
				  <div class="col m6 s12">
					<label for="name">To Name</label>
					<input id="name" type="text" name="name" class="validate">
				  </div>
				</div>
				<div class="row">
					<div class="col m6 s12 hide">
						<label for="budget">Subject</label>
						<input id="budget" type="text" class="validate" name="subject" value="Ensober Hotels Rate">
				
						<div class="s12">
							<label for="rate_date">Date</label>
							<input id="rate_date" type="date" class="validate" name="rate_date" value="{{date('Y-m-d')}}">
						</div>
					</div>
					<div class="col m6 s12">
						<label for="budget">Select Hotel</label>
						<select class="hotel_id selectpicker" data-live-search="true" name="hotel_id[]" multiple style="height: 84px !important;">
							<option>Select Hotel</option>
							@foreach($Hotels as $Hotel)
								<option value="{{$Hotel->id}}">{{$Hotel->hotel_name}}</option>
							@endforeach
						</select> 
					</div>
				</div>
				<div class="row">
					<button class="btn waves-effect waves-light right" type="submit" name="action" id="add_hotel">Submit <i class="material-icons right">send</i></button>
				</div>
			</form>
		</div>
    </div>
	
	<div>
		<div class="table-responsive">
			<table id="multi-select" class="dataTable display">
				<thead>
					<tr>
						<th>Si. No</th>
						<th>Card</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Text</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@php $x=1; @endphp
					@foreach($cards as $card)
					<tr>
						<td>{{$x}}</td>
						<td><a href="{{url('storage/app/'.$card->card)}}" target="_blank"><img src="{{url('storage/app/'.$card->card)}}" style="width:150px;"/></a></td>
						<td>{{ $card->email }}</td>
						<td>{{ $card->mobile }}</td>
						<td>{{ $card->raw_text }}</td>
						<td width="100px">{{ date('d-m-Y', strtotime($card->created_at)) }}</td>
					</tr>
					@php $x++; @endphp
					@endforeach
				</tbody>
				<tfoot>
				  <tr>
					<th>Si. No</th>
					<th>Card</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Text</th>
					<th>Date</th>
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
    <!-- END: Page Main-->
@endsection

@section('scripts')
<script>
	function showLoader(){
		jQuery(".loader-mobile").show();
	}
	jQuery(document).ready(function(){
		
		
		jQuery('.selectpicker').selectpicker();
	});
</script>
@endsection