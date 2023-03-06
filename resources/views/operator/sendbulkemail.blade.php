@extends('operator.template.base')

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
        #mobile-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute; z-index: 9;}
        #mobile-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
        #mobile-list li:hover{background:#ece3d2;cursor: pointer;}
        .select-wrapper input.select-dropdown {display: none;}
        .select-wrapper ul, .select-wrapper svg.caret { display: none !important; }
        
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
                  <li class="breadcrumb-item"><a href="index.html">Lead</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add lead</a>
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
                        <h3 class="card-title"><strong>Bulk Email</strong></h3>
                    </div>
                    
                    
            <form class="add_hotel_group_rate_form" id="add_hotel_group_rate_form" method="POST" action="/operator/bulkemailaction" >
            {{csrf_field()}}
            <input type="hidden" name="operator_id" id="operator_id" value="{{ $operator_id[0] }}">
              <div class="row">
                    
              <div class="" id="details">  
                <div class="row group">
                  <div class="col s11">
					<div class="input-field col s4 show_select">
						<!--<label for="d_country" class="">Destination Country</label> -->
						
						<div class="hide after_select_formate"> 
							<b id="e_canpain_title" style="font-size: 19px; width: 80%; float: left;">This is first testing of bulk email	</b>
							<div style="width: 20%; float:left;">
								<img src="/storage/app/email_template/82IDfYTbx2ngaO0zxxk7ZtFFaMq7gnCSY39e5i3i.jpeg" style="width: 100%;" id="e_canpain_img">
								<a class="modal-trigger" href="#modal1"><i class="material-icons">edit</i></a>
							</div>
							<input type="hidden" name="emailtemplate" id="emailtemplate" />
						</div>
						
						
						<a class="modal-trigger" id="before_select_compaign" href="#modal1"><button class="buttons-csv buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange" tabindex="0" aria-controls="multi-select" type="button"><span>Select Email Campaign</span></button></a>
						<!-- Modal Structure -->
						<div id="modal1" class="modal modal-fixed-footer animate zoomIn">
							<div class="card-content pb-1">
								<h4 class="card-title mb-0">Email Campaign List <i class="material-icons float-right">more_vert</i></h4>
							</div>
							<table class="subscription-table responsive-table highlight">
								<thead>
								   <tr>
									  <th>Title</th>
									  <th>Template</th>
									  <th>Action</th>
								   </tr>
								</thead>
								<tbody>
								@foreach($emailtemplates as $emailtemplate)
									<tr>
									  <td class="title">{{ $emailtemplate->title }}</td>
									  <td><img src="/storage/app/{{ $emailtemplate->template }}" class="image" width="100px"></td>
									  <td>
										<p>
											<label>
											  <input class="with-gap select_e_campaign" type="radio" value="{{ $emailtemplate->id }}" />
											  <span></span>
											</label>
										</p>
										  
									  </td>
								   </tr>
								@endforeach
								</tbody>
							</table>
						</div>
	  
					</div>
					
					<div class="input-field col s4 show_select">
						<!--<label for="d_country" class="">Destination Country</label> -->
						
						<div class="hide after_select_formateEL"> 
							<b id="e_list_title" style="font-size: 19px; width: 80%; float: left;">This is first testing of bulk email	</b>
							<div style="width: 20%; float:left;">
								<span class="badge badge pill pink float-right mr-10 e_list_count" style="font-size: 20px; height: 29px; padding: 4px 11px 0;"></span>
								<a class="modal-trigger" href="#modal2"><i class="material-icons">edit</i></a>
							</div>
							<input type="hidden" name="emailcampaign" id="emailcampaign" />
						</div>
						
						
						<a class="modal-trigger" id="before_select_emaillist" href="#modal2"><button class="buttons-csv buttons-html5 mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange" tabindex="0" aria-controls="multi-select" type="button"><span>Select Email List</span></button></a>
						<!-- Modal Structure -->
						<div id="modal2" class="modal modal-fixed-footer animate zoomIn">
							<div class="card-content pb-1">
								<h4 class="card-title mb-0">Email Campaign List <i class="material-icons float-right">more_vert</i></h4>
							</div>
							<table class="subscription-table responsive-table highlight">
								<thead>
								   <tr>
									  <th>Title</th>
									  <th>Contact Count</th>
									  <th>Action</th>
								   </tr>
								</thead>
								<tbody>
								@foreach($emailcampaigns as $emailcampaign)
									<tr>
									  <td class="title">{{ $emailcampaign->title }}</td>
									  <td><span class="badge badge pill pink emailcount" style="font-size: 20px; height: 29px; padding: 4px 11px 0;">{{ count(explode(',', $emailcampaign->contact_ids)) }}</span></td>
									  <td>
										<p>
											<label>
											  <input class="with-gap select_e_list" type="radio" value="{{ $emailcampaign->id }}" />
											  <span></span>
											</label>
										</p>
										  
									  </td>
								   </tr>
								@endforeach
								</tbody>
							</table>
						</div>
						
					</div>
					
					<div class="input-field col s4 show_select">
						<!--<label for="d_country" class="">Destination Country</label> -->
						<select id="smtpemail" name="smtpemail" class="country_id"> 
							<option value="">Select SMTP Email</option>
							@foreach($smtpemails as $smtpemail)
								<option value="{{ $smtpemail->id }}">{{ $smtpemail->email }}  </option>
							@endforeach 
						</select>
					</div>
					
					</div>
					<div class="col s11">
					<div class="input-field col s2"> 
						<label for="from" class="">From*</label>
						<input class="validate invalid" required="" aria-required="true" id="from" name="from" type="number" value="0"> 
					</div>
					
					<div class="input-field col s2"> 
						<label for="to" class="">To*</label>
						<input class="validate invalid" required="" aria-required="true" id="to" name="to" type="number">
					</div>
					
					<div class="input-field col s2"> 
					  <button class="btn waves-effect waves-light right" type="submit" name="action" id="add_lead">Submit
						<i class="material-icons right">send</i>
					  </button>
					</div>
                  
                  </div>
                </div>
              </div>
                
              </div>
            </form>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- END RIGHT SIDEBAR NAV -->
            <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
</div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection

@section('scripts')
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
		
    <script>
		jQuery(document).ready(function(){
			
			//Select Email Campaign
			jQuery(".select_e_campaign").click(function(){
				var title = jQuery(this).parentsUntil("tbody").find(".title").text();
				var src = jQuery(this).parentsUntil("tbody").find(".image").attr("src");
				var id = jQuery(this).val();
				jQuery("#emailtemplate").val(id);
				jQuery("#e_canpain_title").text(title);
				jQuery("#e_canpain_img").attr("src",src);
				jQuery(".after_select_formate").removeClass("hide");
				jQuery("#before_select_compaign").addClass("hide");
				jQuery('#modal1').modal('close');
			});
			
			//Select Email List
			jQuery(".select_e_list").click(function(){
				var title = jQuery(this).parentsUntil("tbody").find(".title").text();
				var count = jQuery(this).parentsUntil("tbody").find(".emailcount").text();
				var id = jQuery(this).val();
				jQuery("#emailcampaign").val(id);
				jQuery("#e_list_title").text(title);
				jQuery(".e_list_count").text(count);
				jQuery(".after_select_formateEL").removeClass("hide");
				jQuery("#before_select_emaillist").addClass("hide");
				jQuery('#modal2').modal('close');
			});
		});
    
	</script>
@endsection