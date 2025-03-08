@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
	<style>
		.active.custom_tab_main.tab_border {
			margin: 0;
		}
		#yazra_table td {
			padding: 7px 5px !important;
		}
	</style>
@endsection

@section('content')
	<!-- BEGIN: Page Main-->
	<div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <div class="section section-data-tables">
  
  
  <!-- Multi Select -->

  <div class="row">
	
    <div class="col s12">
      <div class="card">
        <div class="card-content">
			<!-- Tab Start -->
			<div class=" active custom_tab_main tab_border">
				<div class="col s12">
					<ul class="custom_tabs">
						<li class="custom_tab">
							<a class="active" href="{{ url('/admin/assigncontact') }}">Assigned Contacts <b style="color:#000;">{{ $total_cont }}</b></a>
						</li>
						<li class="custom_tab">
							<a class="" href="{{ url('/admin/unassigncontact') }}">Unassigned Contacts <b style="color:#000;">{{ $total_cont_un }}</b></a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /Tab Start -->
		
		<div style="border-bottom: 1px solid #ff4081;float: left;width: 100%;">
		<div> 
			<div class="col s12 m8"> 
			<form action="" method="GET" >
				{{ csrf_field() }}
				<div> 
					<div class="col s12 m4"> 
						<label for="hotel_name" class="">Location</label>
						<input class="validate invalid" id="location" name="location" type="text" value="{{ app('request')->input('location') }}">
					</div>
					<div class="col s12 m4">
						<label for="contact_type" class="">Contact Type</label>
						<select id="contact_type" name="contact_type" class="contact_type"> 
							<option value="">Select Contact Type</option>
							@foreach($contact_types as $contact_type)
							<option value="{{ $contact_type->contact_type }}" @if (app('request')->input('contact_type')== $contact_type->contact_type ) selected @endif>{{ $contact_type->contact_type }}</option>
							@endforeach
						</select>
					</div>
					<div class=" col s12 m3"> 
						<label for="source" class="">Select Source</label>
						<select id="source" name="source" class="source"> 
							<option value="">Select Source</option>
							@foreach($sources as $source)
								<option value="{{ $source->source }}" @if (app('request')->input('source')== $source->source ) selected @endif>{{ $source->source }}</option>
							@endforeach
						</select>
					</div>
					<div class=" col s12 m11">
						<button class="btn cyan waves-effect waves-light right" type="submit" id="search_hotel" style="margin-top: 0 !important;">Search
						<i class="material-icons right">send</i>
						</button>
					</div>
				</div>
			</form>
			</div>
			<div class="col s12 m4"> 

			</div>
		</div>
	</div>
          <div class="row">
            <div class="col s12">
				<div class="table-responsive">
					<table id="yazra_table" class="table table-bordered table-striped display dataTable dataTables_scrollHead">
						<thead>
							<tr>
								<th>Name</th>                  
								<th>Mobile</th>                  
								<th>Email</th>                 
								<th>Location</th>                  
								<th>Contact Type</th>                  
								<th>Source</th>                  
								<th>Last Lead</th>
								<th>Lead Count</th>                  
								<th>Date</th>                  
								<th>Status</th>
								<th>Assigned Operator</th>
							</tr>
						</thead>
					</table>
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
    $(document).ready(function() {
		// Yazra Datatable
		var location = jQuery("#location").val();
		var contact_type = jQuery("#contact_type").val();
		var source = jQuery("#source").val();
		jQuery('#yazra_table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: "{{ url('/admin/assigncontact') }}",
				data: {'location':location, 'contact_type':contact_type, 'source':source}
			},
			columns: [
			{
				data: 'name',
				name: 'name'
			},
			{
				data: 'mobile',
				name: 'mobile'
			},
			{
				data: 'email',
				name: 'email'
			},
			{
				data: 'location',
				name: 'location'
			},
			{
				data: 'contact_type',
				name: 'contact_type'
			},
			{
				data: 'source',
				name: 'source'
			},
			{
				data: 'last_lead_no',
				name: 'last_lead_no'
			},
			{
				data: 'lead_count',
				name: 'lead_count'
			},
			{
				data: 'created_at',
				name: 'created_at'
			},
			{
				data: 'assigned_status',
				name: 'assigned_status'
			},
			{data: 'operator', name: 'operator', orderable: false, searchable: false},
		  ]
		 });
		
		
		
		
		
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
			var assign_contact_no = $('#assign_contact_no').val();
			var location = $('#location').val();
			var contact_type = $('#contact_type').val();
			var source = $('#source').val();
			if(assign_to==''){ 
				alert('Please select the Assign To value');
				return false;
			}
			if(assign_contact_no == ''){ 
				alert('Please select the how much contact want to assign');
				return false;
			}
			
           
			var dataValue = {'location':location, 'contact_type':contact_type, 'source':source, 'assign_contact_no':assign_contact_no, "assign_to": assign_to};
        
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
					//location.reload(true)
					alert(data.message);
				}
			});
            
        });

    });
    </script>
@endsection