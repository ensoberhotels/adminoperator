@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard ') 

@section('styles')
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/css/pages/dashboard-modern.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/css/pages/intro.css') }}">
   <!-- BEGIN: VENDOR CSS-->
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/vendors.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/animate-css/animate.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/chartist-js/chartist.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
    <!-- END: VENDOR CSS-->
@endsection

@section('content') 
   <!-- BEGIN: Page Main-->
      <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="col s12">
          <div class="container">
            

<!-- card stats start -->
<div id="card-stats">
   <div class="">
		<div class="clable_main">
			<div class="clable"> 
				<div class="clable_text">
					Lead Followup Remainder
				</div>
				<div class="clable_value">
					{{ $new_count }}
				</div>
			</div>
			
			<div class="clable color1">
				<div class="clable_text">
					Quotation Followup Remainder
				</div>
				<div class="clable_value">
					{{ $new_count }}
				</div>
			</div>
			
			<div class="clable color2">
				<div class="clable_text">
					Sale Followup Remainder
				</div>
				<div class="clable_value">
					{{ $new_count }}
				</div>
			</div> 
			
			<div class="clable color3">
				<div class="clable_text">
					Client Checkin Remainder
				</div>
				<div class="clable_value">
					{{ $new_count }}
				</div>
			</div>
			
			<div class="clable color4">
				<div class="clable_text">
					Feedback Remainder
				</div>
				<div class="clable_value">
					{{ $new_count }}
				</div>
			</div>
			
			<div class="clable color1">
				<div class="clable_text">
					Feedback Remainder
				</div>
				<div class="clable_value">
					{{ $new_count }}
				</div>
			</div>
			<div class="clable color">
				<div class="clable_text">
					Vender Services Remainder
				</div>
				<div class="clable_value">
					{{ $new_count }}
				</div>
			</div>
		</div>
   </div>
   
   <div class="row">
      <div class="col s12 m12">
              <div class="card subscriber-list-card animate fadeRight">
                 <div class="card-content pb-1">
                    <h4 class="card-title mb-0">Lead List <i class="material-icons float-right">more_vert</i></h4>
                 </div>
                 <table class="subscription-table responsive-table highlight">
                    <thead>
                       <tr>
                          <th>Name</th>
                          <th>Lead Number</th>
                          <th>Create Date</th>
                          <th>Status</th>
                          <th>Start Date</th>
                          <th>Amount</th>
                       </tr>
                    </thead>
                    <tbody>
                    @if(count($leadlists))
                    @foreach($leadlists as $leadlist)
                       <tr>
                          <td>{{$leadlist->name}}</td>
                          <td>{{$leadlist->lead_no}}</td>
                          <td>{{(isset($leadlist->create_date) ? date('d M Y', strtotime($leadlist->create_date)) : '')}}</td>
                          <td><span class="badge pink lighten-5 pink-text text-accent-2">{{$leadlist->lead_status}}</span></td>
                          <td>{{date('d M Y', strtotime($leadlist->start_date))}}</td>
                          <td>@if($leadlist->price!='')<span>&#8377;</span> {{$leadlist->price}} @else Not Quotated @endif</td>
                       </tr>
                    @endforeach 
                    @else  
                       <tr>
                          <td colspan="6">No Lead created</td>
                       </tr>
                    @endif
                       
                    </tbody>
                 </table>
                 <div class="pagination">{{$leadlists->links()}}</div>
              </div>
           </div>
   </div>
</div>
<!--/ card stats end-->
          </div>
        </div>
      </div>
    </div> 
   <!-- END: Page Main-->
@endsection

@section('scripts')
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist.min.js') }}" type="text/javascript"></script>
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-tooltip.js') }}" type="text/javascript"></script>
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}" type="text/javascript"></script>

   <!-- BEGIN PAGE LEVEL JS-->
      <script src="{{URL::asset('public/asset/js/scripts/dashboard-modern.js') }}" type="text/javascript"></script>
      <script src="{{URL::asset('public/asset/js/scripts/intro.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
@endsection