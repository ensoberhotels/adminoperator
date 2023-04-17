<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      	<div class="brand-sidebar">
		<h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img src="{{ URL::asset('public/asset/images/logo/logo.png') }}" alt="logo"/><span class="logo-text hide-on-med-and-down"></span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
      	</div>
      	<ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
		<li class="active"><a class="collapsible-body active" href="{{URL::to('/admin/dashboard')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Dashboard</span></a></li>		
		<li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
		@foreach($access_menus as $menu)
		
			<li class="bold @if(Request::segment(2) == $menu->path) {{ 'active' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="{{URL($menu->path)}}"><i class="material-icons">{{$menu->icon}}</i><span class="menu-title" data-i18n="">{{$menu->name}}</span>
					@if(@$menu->childs->count() > 0) <span class="fa arrow menu_hide"></span>@endif
				</a>
				@if($menu->childs->count() > 0)
						<div class="collapsible-body">
					<ul class="collapsible" data-collapsible="accordion">
						
            					@foreach($menu->childs as $child)
            						@if($child->path == '#')
            							<li><a class="collapsible-body" href="{{URL::to($child->path)}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{$child->name}}</span>
            								@if(@$child->sub_childs->count() > 0) <span class="fa arrow menu_hide"></span>@endif</a>
            								@if($child->sub_childs->count() > 0)
            									@foreach($child->sub_childs as $child)
            										<li><a class="collapsible-body" href="{{URL::to($child->path)}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{$child->name}}</span></a></li>
            									@endforeach
            								@endif
            							</li>

            						@else
            							<li><a class="collapsible-body" href="{{URL::to($child->path)}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{$child->name}}</span></a></li>
            						@endif
            					@endforeach
          					</ul>
        				</div>

				@endif
            				
          			
        		</li>
		@endforeach
	</ul>
</aside>