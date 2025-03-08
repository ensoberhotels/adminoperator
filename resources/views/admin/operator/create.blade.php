@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
    <style>
		.menus{
			padding-right: 25px !important;
			font-size: 11px !important;
		}
		.oneMenu{
			width: 12px !important;
		}
		.moduleMemu{
			margin-left: 20px !important;
		}
		.contents{
			padding-left: 5px;
		}
		.ActiveModule{
			color:green !important;
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
                  <li class="breadcrumb-item"><a href="index.html">Operator</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Operator</a>
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
            <div class="seaction">
  <!--Basic Form-->

  <!-- jQuery Plugin Initialization -->
  <div class="row">
    <div class="col s12">
      <div id="basic-form" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">Create Operator</h4>
          <form class="col s12" id="add_operator_form" method="post" action="{{ route('operator.store') }}">
            {{csrf_field()}}
            <div class="row">
              <div class="col s12 m2">
				<label for="fn">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
              </div>
            
              <div class="col s12 m2">
				<label for="email">Email *</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}">
              </div>
            
			  <div class="col s12 m2">
				<label for="password">Password *</label>
				<input id="password" type="password" name="password" value="{{ old('password') }}">
			  </div>		
			
				<div class="col s12 m2">
					<br>
					<button class="btn cyan waves-effect waves-light right" type="submit" name="action" id="add_vender">Submit
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>

			<div class="col-12">
				<table>
					<thead>
						<tr>
							<th>Menus</th>
							<th style="float:right"><input type="checkbox" id="allChecked" style="position: relative; opacity: 6; text-align:right" class="form-control check_hotel" class="form-control check_hotel oneMenu"/>&nbsp;&nbsp;Check All Menus</th>
						</tr>
					</thead>
				</table>
				<ul>
				@foreach($menu as $module=>$menus)
					<div class="col m3 s4 menus"> 
						<li>
							<input type="checkbox" style="position:relative; opacity:6;" class="form-control check_hotel oneMenu modules"><label class="contents" style="cursor:pointer;"><b><u>{{@getModuleName($module)}}</u></b></label>
						</li>
						<ul>
							@foreach($menus as $menusdata)
								<li class="listMenus" style="display:none;">
									<input type="checkbox" value="{{$menusdata->id}}" name="menus[]" style="position:relative; opacity:6; margin-left:20px;" class="form-control check_hotel oneMenu moduleMemu" /><label class="contents">{{$menusdata->name}}</label><br>
								</li>
							@endforeach
						</ul>
					</div>
				@endforeach
				</ul>
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
    <script>
		jQuery(document).ready(function(){
			jQuery("#room_inventory").change(function(){
				var room_inv = jQuery(this).val();
				if(room_inv == 'Y'){
					jQuery(".room_inven_hotel").show();
				}else{
					jQuery(".room_inven_hotel").hide();
				}
			});
			
			jQuery("#room_status").change(function(){
				var room_status = jQuery(this).val();
				if(room_status == 'Y'){
					jQuery(".room_status_hotel").show();
				}else{
					jQuery(".room_status_hotel").hide();
				}
			});
		});

		// function for Check and uncheck all at a Time
		jQuery(document).on('click', '#allChecked', function(){
			if(jQuery(this).is(':checked'))
			{
				jQuery('.oneMenu').prop('checked', true);
			}
			else{
				jQuery('.oneMenu').prop('checked', false);
			}
		});

		// function for Check and uncheck all closest checkbox of Module at a Time
		jQuery(document).on('click', '.modules', function(){
			if(jQuery(this).is(':checked'))
			{
				jQuery(this).closest('div').find('.oneMenu').prop('checked', true);
			}
			else{
				jQuery(this).closest('div').find('.oneMenu').prop('checked', false);
			}
		});

		// function for show closest Module at a Time
		jQuery(document).on('click', '.contents', function(){
			jQuery('.contents').removeClass('ActiveModule');
			jQuery(this).addClass('ActiveModule');
			jQuery(this).closest('div').find('.listMenus').toggle();
		});
	</script>
@endsection

