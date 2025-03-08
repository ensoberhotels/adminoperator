@extends('admin.template.base')


@section('title', 'Ensober Admin Dashboard ')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
   <style>
        .step-actions {
            float: right;
        }
		.show_select select{display:block;}
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
                  <li class="breadcrumb-item"><a href="#">Add Amenity</a>
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
            <div class="section section-form-wizard">
    <!-- Linear Stepper -->	
	
    <div class="row pl-1 pr-1">
        <div class="col s12">
            <div class="card pl-3 pr-3">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">
                            <h3 class="card-title">Your Raised Grievance Details</h3>
                        </div>
                    </div>
                <div class="row">
                    <div class="col s12">
                    <div class="table-responsive">
                        <table id="multi-select" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>From</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i=1;@endphp
                                @foreach($grievances as $grievance)
                                <tr id="">
                                    <td style="display: inline-block;">{{$i}}</td>
                                    <td >{{$grievance->title}}</td>
                                    <td >{{$grievance->description}}</td>
                                    <td><a href="{{ asset('public/public/asset/images/grievance') }}/{{$grievance->attachment}}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('public/asset/images/grievance') }}/{{$grievance->attachment}}" height="50" width="50" alt="attachments"></td></a>
                                    <td>{{$grievance->from_name}}</td>
                                    <td style="text-align: center;">
                                      @if($grievance->status=='P') <span style="color: white;font-size: 12px;border-radius: 5px;padding: 4px 7px;background-color: blue;">Pending</span> @endif
                                      @if($grievance->status=='W') <span style="color: white;font-size: 12px;border-radius: 5px;padding: 4px 6px;background-color: #cfcf28;">Working</span> @endif
                                      @if($grievance->status=='D') <span style="color: white;font-size: 12px;border-radius: 5px;padding: 4px 18px;background-color: green;">Done</span> @endif
                                    </td>
                                </tr>
                                @php $i++;@endphp
                                @endforeach
                            </tbody>
                        </table>
                    <div class="pagination">{{$grievances->links()}}</div>
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
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('asset/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
@endsection