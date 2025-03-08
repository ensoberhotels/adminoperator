@extends('vender.template.base')

@section('title', 'Ensober Vendor Dashboard')

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
                  <li class="breadcrumb-item"><a href="index.html">Itenerary</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">All Itenerary</a>
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
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">All Itenerary</h4>
                </div>
                <!--<div class="col s2 m6 l6" style="text-align: right;">
                    <a class="mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow">Delete</a>
                    <a class="mb-6 btn waves-effect waves-light gradient-45deg-green-teal gradient-shadow">Update</a>
                </div>-->
            </div>
          <div class="row">
            <div class="col s12">
              <table id="multi-select" class="display">
                <thead>
                  <tr>
                    <th>Itenerary No</th>
                    <th>No Of Adults</th>
                    <th>Kids (5-12 Years)</th>
                    <th>Infant (below 5 Years)</th>
                    <th>Arrival Date & Time</th>
                    <th>Arrival City</th>
                    <th>Drop Date & Time</th>
                    <th>Drop City</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($itineraries as $itinerary)
                  <tr>
                    <td><a href="{{URL::to('/vender/itineraryupdate/'.$itinerary->itinerary_no)}}">{{ $itinerary->itinerary_no }}</a>
                    <a href="{{URL::to('/vender/itinerarymanage/'.$itinerary->itinerary_no)}}" id="hotel_link" target="_blank" style="color: #ff4081;"><i class="material-icons" style="font-size: 15px; margin-top: 1px;">remove_red_eye</i></a>
                  </td>
                    <td>{{ $itinerary->adult }}</td>
                    <td>{{ $itinerary->kids }}</td>
                    <td>{{ $itinerary->infant }}</td>
                    <td>{{ date('d M Y', strtotime($itinerary->arrival_date)) }}{{ date('H:i A', strtotime($itinerary->arrival_time)) }}</td>
                    <td>{{ @$itinerary->arrivalCity->name }}</td>
                    <td>{{ $itinerary->drop_date }} {{ $itinerary->drop_time }}</td>
                    <td>{{ @$itinerary->dropCity->name }}</td>                    
                                       
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Itenerary No</th>
                    <th>No Of Adults</th>
                    <th>Kids (5-12 Years)</th>
                    <th>Infant (below 5 Years)</th>
                    <th>Arrival Date & Time</th>
                    <th>Arrival City</th>
                    <th>Drop Date & Time</th>
                    <th>Drop City</th>
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
@endsection