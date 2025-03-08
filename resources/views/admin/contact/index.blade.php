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
  
  
  <!-- Multi Select -->

  <div class="row">
	
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div style=" border-bottom: 1px solid #ff4081;">
		<form action="" method="GET" >
      {{ csrf_field() }}
        <div class="row"> 
      <div class="col s12 m2"> 
        <label for="hotel_name" class="">Location</label>
        <input class="validate invalid" id="location" name="location" type="text" value="{{ app('request')->input('location') }}">
      </div>
      <div class="col s12 m2">
        <label for="contact_type" class="">Contact Type</label>
        <select id="contact_type" name="contact_type" class="contact_type"> 
            <option value="">Select Contact Type</option>
            @foreach($contact_types as $contact_type)
                <option value="{{ $contact_type->contact_type }}" @if (app('request')->input('contact_type')== $contact_type->contact_type ) selected @endif>{{ $contact_type->contact_type }}</option>
            @endforeach
        </select>
      </div>
      <div class=" col s12 m2"> 
        <label for="source" class="">Select Source</label>
        <select id="source" name="source" class="source"> 
            <option value="">Select Source</option>
            @foreach($sources as $source)
                <option value="{{ $source->source }}" @if (app('request')->input('source')== $source->source ) selected @endif>{{ $source->source }}</option>
            @endforeach
        </select>
      </div>
	  <div class=" col s12 m2"> 
        <label for="fdate" class="">From Date</label>
        <input type="date" id="fdate" name="fdate" class="fdate" value="{{app('request')->input('fdate')}}" /> 
      </div>
	  <div class=" col s12 m2"> 
        <label for="tdate" class="">To Date</label>
        <input type="date" id="tdate" name="tdate" class="tdate" value="{{app('request')->input('tdate')}}"/> 
      </div>
	  <div class=" col s12 m2">
          <button class="btn cyan waves-effect waves-light" type="submit" id="search_hotel">Search
          </button>&nbsp;
          <a href="/admin/contact"><button id="search_hotel" class="btn cyan waves-effect waves-light" type="button">Clear Search
          </button></a>
       </div>
      </div>
      </form>
	</div>
			
          <div class="row">
            <div class="col s12">
              <table id="multi-select" class="display">
                <thead>
                  <tr>
                    <th class="no-sort" style="width: 15px; ">
                      <input type="checkbox" class="custome_checkbox custom_check_all" />
                    </th>
                    <th class="" style="width: 175px; ">Name</th>                  
                    <th class="" style="width: 100px; ">Mobile</th>                  
                    <th class="" style="width: 200px; ">Email</th>                  
                    <!--<th class="">Additional Info</th>-->               
                    <th class="" style="width: 100px; ">Location</th>                  
                    <th class="" style="width: 100px; ">Contact Type</th>                  
                    <th class="" style="width: 100px; ">Source</th>                  
                    <!--<th class="" >Last Lead Number</th>-->
                    <!--<th class="" >Lead Count</th>-->                
                    <th class="" style="width: 100px; ">Favorite Status</th>                  
                    <th class="" style="width: 100px; ">Create Date</th>                  
                    <!--<th class="" >FollowUp Date</th>-->               
                    <!--<th class="no-sort">Status</th>-->
                    <th class="no-sort" style="width: 100px; ">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($Contacts as $Contact)
				@php
					$addre = explode(',',$Contact->location);
					$state = @$addre[1];
				@endphp
                <tr class="animated">
                    <td class="custom_check" style="width: 15px; ">
					
						<input type="checkbox" name="contacts[]" class="custome_checkbox" value="{{$Contact->id}}"/>
						@if($Contact->favorite_status == 'favorite')
							<b style="width: 20px; height: 20px;background-color: green;float: left;border-radius: 100%;" title="Favorite"></b>
						@endif
                    </td>
                    <td style="width: 140px; "> {{ $Contact->name }}</td>
                    <td style="width: 100px; "> {{ $Contact->mobile }}</td>
                    <td style="width: 200px; word-break: break-all;"> {{ $Contact->email }}</td>
                    <!--<td style="width: 100px; "> 
						@if($Contact->additional_info)
							{{ $Contact->additional_info }}
						@else
							N/A
						@endif
					</td>-->
                    <td style="width: 100px; "> {{ $state }}</td>
                    <td style="width: 100px; "> @if($Contact->contact_type){{ $Contact->contact_type }}@else {{'NA'}} @endif</td>
                    <td style="width: 100px; "> {{ $Contact->source }}</td>
                    <!--<td>{{ $Contact->last_lead_no }}</td>-->
                    <!--<td> {{ $Contact->lead_count }}</td>-->
                    <td> {{ $Contact->favorite_status }}</td>
					<td style="width: 100px; ">{{ date('d M Y', strtotime(@$Contact->created_at)) }}</td>
					
					@if(@$Contact->asignContact['follow_up_date'])
						<!--<td style="width: 80px; "><b style="color:green;">{{ date('d M Y', strtotime(@$Contact->asignContact['follow_up_date'])) }}</b></td>-->
					@else
						<!--<td style="width: 80px; "><b style="color:red;">N/A</b></td>-->
					@endif
					
                    <!--<td>
                        <div class="switch">
                          <label onchange="change_status('{{$Contact->id}}','Contacts')" >
                            @if($Contact->status == 'ACTIVE')
                                <input checked="" type="checkbox">
                            @else
                                <input type="checkbox">
                            @endif
                            <span class="lever"></span>
                          </label>
                        </div>
                    </td>-->
                    <td style="width: 100px; ">
                    
                    <!--<form action="{{ route('contact.destroy', $Contact->id) }}" method="POST" style="display: inline-block;">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange car_delete" title="Delete" onclick="return confirm('Are you sure?')">
                            <i class="material-icons">delete_sweep</i>
                        </button>
                    </form>-->
						<button class="delete_contact mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange car_delete" title="Delete"  contact_id="{{$Contact->id}}">
                            <i class="material-icons">delete_sweep</i>
                        </button>
						
                        <a href="{{ route('contact.edit',$Contact->id) }}">
                            <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow"><i class="material-icons">brush</i></button>
                        </a>                        
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Guest Name</th>                  
                    <th>Mobile</th>                  
                    <th>Email</th> 
					<th class="" style="width: 100px; ">Additional Info</th> 					
                    <th>Location</th>
                    <th>Contact Type</th>
                    <th>Source</th>
                    <th>Last Lead Number</th>
                    <th>Lead Count</th> 
					<th class="" >Favorite Status</th> 
					<th>FollowUp Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            
          </div>
          <div style="border-top: 1px solid; margin-top: 27px; margin-bottom: 30px; float: left; width: 100%;"><br>
			<div class=" col s3">
				<select id="assign_to" name="assign_to"> 
					<option value="">Assign To</option>
					@foreach($Operators as $Operator)
						<option value="{{ $Operator->id }}">{{ $Operator->name }}</option>
					@endforeach
				</select>
			</div>
			<div class=" col s3">
				<button type="button" class="mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange btn_click" style="margin-top: 10px;">Assign Contacts</button>
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
    <script src="{{ URL::asset('public/asset/js/custom/custom-script1.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('public/asset/js/scripts/data-tables.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    
    <script type="">
    $(document).ready(function() {
		jQuery(".buttons-csv").addClass("mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange");
		jQuery(".buttons-csv").removeClass("dt-button");
		
		jQuery(".custom_check_all").change(function(){
			var check_status = jQuery(this).prop('checked');
			if(check_status === true){
				jQuery(".custom_check").each(function(){
					jQuery(this).find('.custome_checkbox').prop('checked',true);
				});
			}else{
				jQuery(".custom_check").each(function(){
					jQuery(this).find('.custome_checkbox').prop('checked',false);
				});
			}
		});
		
		jQuery(".delete_contact").click(function(){
			thisdiv = jQuery(this);
			var contact_id = jQuery(this).attr("contact_id");
			var dataValue = {'contact_id':contact_id};
			var r = confirm("Are You Sure Delete This Contact?");
			if (r == true) {
				$.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});
				//$("#loader-wrapper").css("display","block");       
				$.ajax({
					url: "/admin/contact/"+contact_id,
					type:"DELETE",
					cache: false,
					async:true,
					data: dataValue,
					success: function(data){
						//alert(data);
						thisdiv.parent().parent().css({"background-color":"#d37878"});
						thisdiv.parent().parent().addClass('zoomOutUp');
						setTimeout(function(){ thisdiv.parent().parent().hide() }, 2000);
						$("#loader-wrapper").css("display","none");
					}
				});
			}
		});
		
        $(".btn_click").click(function(){
			var assign_to = $('#assign_to').val();
			if(assign_to==''){ alert('Please select the Assign To value');}
			var contact_ids = new Array();
			$("input[name='contacts[]']:checked").each(function() {
				contact_ids.push($(this).val());
			});
			if(contact_ids==''){ alert('Please Check aleast one Contact');}
           
			var dataValue = {'contact_ids':contact_ids, "assign_to": assign_to};
        
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			$("#loader-wrapper").css("display","block");       
			$.ajax({
				url: "ajaxAsignContacts",
				type:"post",
				cache: false,
				async:true,
				data: dataValue,
				success: function(data){
					var data = JSON.parse(data);
					$("#loader-wrapper").css("display","none");
					alert(data.message);
				}
			});
            
        });

    });
    </script>
@endsection