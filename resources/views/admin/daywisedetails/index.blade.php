@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
	<style type="text/css">
   .dataTables_length{

   display:none;
}
.dataTables_info,.dataTables_paginate{display:none;}
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
                  <li class="breadcrumb-item"><a href="#">All Amenity</a>
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
					<h4 class="card-title">All Daywisedetails</h4>
				</div>
				<div class="col s2 m6 l6" style="text-align: right;">
					<!--<a class="mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow">Delete</a>
					<a class="mb-6 btn waves-effect waves-light gradient-45deg-green-teal gradient-shadow">Update</a>-->
				</div>
			</div>
          <div class="row">
            <div class="col s12">
              <table id="multi-select" class="display">
                <thead>
                  <tr>
                    <th class="no-sort">
                      <label>
                        <input type="checkbox" class="select-all" />
                        <span></span>
                      </label>
                    </th>
                    <th>Distination</th>
                    <th>Day</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Create</th>
                    <th>Last Update</th>
                    <th class="no-sort">Action</th>
                  </tr>
                </thead>
                <tbody>
				@foreach($datas as $data)
                  <tr>
                    <th>
                      <label>
                        <input type="checkbox" />
                        <span></span>
                      </label>
                    </th>
                    <td>{{ @$data->getDistination->name }}</td>
                    <td><b>{{ $data->day }}</b></td>
                    <td>
                        <a href="{{ URL::to($data->image) }}" target="_blank">
                           <img src="{{ URL::to($data->image) }}" width="50px"/>
                        </a>
                     </td>
					      <td>{{ str_limit($data->description, $limit = 150, $end = '...') }}</td>
                     <td>{{ date('d-M-Y H:i A', strtotime($data->created_at)) }}</td>
                     <td>{{ date('d-M-Y H:i A', strtotime($data->updated_at)) }}</td>
                     <td>
                        <div class="switch">
                        <label onchange="change_status('{{$data->id}}','DayWiseDetail')" >
                           @if($data->status == 'ACTIVE')
                              <input checked="" type="checkbox">
                           @else
                              <input type="checkbox">
                           @endif
                           <span class="lever"></span>
                        </label>
                        </div>
					      </td>
                    <td>

                    
                     <form action="{{ route('daywisedetail.destroy', $data->code) }}" method="POST" style="display: inline-block;">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange car_delete" title="Delete" onclick="return confirm('Are you sure?')">
                           <i class="material-icons">delete_sweep</i>
                        </button>
                     </form>
                     <a href="{{ route('daywisedetail.edit', $data->code) }}">
                        <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow"><i class="material-icons">brush</i></button>
                     </a>
					      </td> 
                  </tr>
				@endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Distination</th>
                    <th>Day</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Create</th>
                    <th>Last Update</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
              <div class="pagination">{{$datas->links()}}</div>
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