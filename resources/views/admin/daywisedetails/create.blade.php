@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/vendors/materialize-stepper/materialize-stepper.min.css') }}">
   <style>
        .step-actions {
            float: right;
        }
		    .show_select select{display:block;}
        .ck.ck-content {
            height: 161px;
        }
        .dynamic_data_lable {
            float: right;
            width: 100%;
            text-align: center;
            margin-bottom: 5px;
        }
        .dynamic_data_lable ul {
            margin: 0;
            padding: 0;
        }
        .dynamic_data_lable li {
            display: inline-block;
            background-color: #ff4081;
            color: #fff;
            font-size: 11px;
            padding: 0 10px;
            border-radius: 4px;
        }
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
                  <li class="breadcrumb-item"><a href="#">Add Day Wise Itinerary</a>
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
	
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h4 class="card-title">Create New Day Wise Itinerary</h4>
                    </div>
					
					
			      <form class="add_car_form" id="add_car_form" method="POST" action="{{ route('daywisedetail.store') }}" enctype="multipart/form-data" role="form">
		      	{{csrf_field()}}
              <div class="row">
              <div class="col s12 m2">
                <div class="l9">
                <p>Distination</p>
                </div>
                <div class="l9">
                <select name="distination" class="validate invalid" required="" aria-required="true">
                  <option value="">Select Distination</option>
                  @foreach($cities as $city)
                  <option value="{{$city->id}}">{{$city->name}}</option>
                  @endforeach
                </select>
                </div>
              </div>


                <div class=" col s12 m1">
                  <div class="l9">
                    <p>Nights</p>
                  </div>
					        <input class="validate invalid" required="" aria-required="true" type="number" name="day" id="dayno">
                </div>			

                <div class=" col s12 m1">
                  <p><br></p>
					        <button class="btn waves-effect waves-light right" type="button" onClick="setFieldDayWise()">Load
                  </button>
                </div>

                <div class="col s12 m8">
                  <div class="dynamic_data_lable">
                    <ul>
                      <li title="Hotel Destination">__HOTELDESTI__</li>
                      <li title="Hotel Name">__HOTELNAME__</li>
                      <li title="Meal Plane">__MEALPLANE__</li>
                      <li title="Pickup Location">__PICKLOCA__</li>
                      <li title="Drop Location">__DROPLOCA__</li>
                      <li title="Distance">__DISTACE__</li>
                      <li title="Tranvel Duration">__DURATION__</li>
                    </ul>
                  </div>
                  <div class="" id="daywisefields">
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m3">
                  <p>Status</p>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" value="ACTIVE" name="status" type="radio" checked="">
                      <span>ACTIVE</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required="" aria-required="true" value="INACTIVE" name="status" type="radio">
                    <span>INACTIVE</span>
                  </label>
                  <div class="">
                  </div>
                </div>
                <div class="col s12 m6">
                  <label for="tnc_select1">T&amp;C *</label>
                  <p>
                    <label>
                      <input class="validate" required="" aria-required="true" id="tnc_select1" type="checkbox">
                      <span>Please agree to our policies</span>
                    </label>
                  </p>
                  <div class="">
                  </div>
                </div>
                <div class=" col s12 m5">
                  <button class="btn waves-effect waves-light right" type="submit" name="action" id="add_hotel">Submit
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
            </form>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('public/asset/js/ckeditor.js') }}" type="text/javascript"></script>
    <script>
		ClassicEditor.create( document.querySelector( '.wysing_editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		}).then( editor => {
			window.editor = editor;
		}).catch( err => {
			console.error( err.stack );
		});
	</script>

    <script>
      // thiis function use for create day wise fields
      function setFieldDayWise(){
        
        let daycount = jQuery("#dayno").val();
        jQuery("#daywisefields").html('');
        for (let i = 0; i <= daycount; i++) {

            let field = `<div class="">
                    <div class="col s12 m2 change_des_main">
                        <input type="file" id="input-file-now-custom-2" name="image[]" class="dropify"/><br>
                        <span style="font-size:12px;">Change destination</span>
                        <select name="change_des[]"><option value="0">0</option><option value="1">1</option></select>
                    </div>
                    <div class="col s12 m10">
                      <textarea name="description[]" class="wysing_editor${i}" ></textarea>
                    </div>
                  </div>`;

            jQuery("#daywisefields").append(field);

            ClassicEditor.create( document.querySelector( '.wysing_editor'+i ), {
              // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            }).then( editor => {
              window.editor = editor;
            }).catch( err => {
              console.error( err.stack );
            });
        }
      }

      jQuery(document).ready(function(){
          //jQuery('.invalid').select2();
         
      });
    </script>

    
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('public/asset/vendors/materialize-stepper/materialize-stepper.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ URL::asset('public/asset/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('public/asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
@endsection