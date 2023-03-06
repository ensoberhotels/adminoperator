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
                    <th>City Name</th>
                    <th class="no-sort">Itinerary City</th>
                  </tr>
                </thead>
                <tbody>
				@foreach($cities as $data)
                  <tr>
                    <th>
                      <label>
                        <input type="checkbox" />
                        <span></span>
                      </label>
                    </th>
                    <td>{{ $data->name }}</td>
                    <td>

                    
                     <form action="/public/admin/itinerary/cities/{{$data->id}}" method="POST" style="display: inline-block;">
                        {{ csrf_field() }}
                        @if($data->itinerary_city == 1)
                            <input type="checkbox" value="1" name="itinerary_city" style="position: unset; opacity: 1; pointer-events: auto; width: 16px !important;" checked/>
                        @else
                            <input type="checkbox" value="1" name="itinerary_city" onchange="this.form.submit()" style="position: unset; opacity: 1; pointer-events: auto; width: 16px !important;"/>
                        @endif
                     </form>
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
	
@endsection