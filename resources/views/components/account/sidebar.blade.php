<div class="app-sidebar colored">
	<div class="sidebar-header">
		<a class="header-brand" href="{{ route('index') }}">
			<div class="logo-img">
			   <img src="/assets/img/ifam.png" width="120" class="header-brand-img" alt="iFam"> 
			</div>
		</a>
		<button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
		<button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
	</div>
	
	<div class="sidebar-content">
		<div class="nav-container">
			<nav id="main-menu-navigation" class="navigation-main">
				<div class="nav-item @if($_active_menu == 'dashboard') active @endif">
					<a href="{{ route('dashboard') }}"><i class="ik ik-grid"></i><span>Dashboard</span></a>
				</div>
				<div class="nav-item @if($_active_menu == 'groups') active @endif">
					<a href="{{ route('groups') }}"><i class="ik ik-users"></i><span>Groups</span>
					@if($groupsCount > 0)<span class="badge badge-success">{{ $groupsCount }}</span>@endif
					</a>
				</div>
				@can('view groups reports')
				<div class="nav-item @if($_active_menu == 'admin.groups-reports') active @endif">
					<a href="{{ route('admin.groups') }}"><i class="ik ik-users"></i><span>Groups Reports</span></a>
				</div>
				@endcan
				<div class="nav-item @if($_active_menu == 'farms') active @endif">
					<a href="{{ route('farms') }}"><i class="ik ik-layout"></i><span>Farms</span>
					@if($farmsCount > 0)<span class="badge badge-success">{{ $farmsCount }}</span>@endif
					</a>
				</div>
				<div class="nav-item @if($_active_menu == 'report') active @endif">
					<a href="{{ route('report') }}"><i class="ik ik-bar-chart-line-"></i><span>Report</span>
					</a>
				</div>
				<div class="nav-item @if($_active_menu == 'profile') active @endif">
					<a href="{{ route('profile') }}"><i class="ik ik-user"></i><span>Profile</span></a>
				</div>
				@can('manage farm categories')
				<div class="nav-item @if($_active_menu == 'admin.farm-categories') active @endif">
					<a href="{{ route('admin.farm_categories') }}"><i class="ik ik-pie-chart"></i><span>Farm Categories</span></a>
				</div>
				@endcan
				@can('manage roles and permissions')
				<div class="nav-item @if($_active_menu == 'admin.roles') active @endif">
					<a href="{{ route('admin.roles') }}"><i class="ik ik-sliders"></i><span>Roles and Permissions</span></a>
				</div>
				@endcan
				@can('manage platform users')
				<div class="nav-item @if($_active_menu == 'admin.users') active @endif">
					<a href="{{ route('admin.users') }}"><i class="ik ik-users"></i><span>Platform Users</span></a>
				</div>
				@endcan
				@can('manage platform users')
				<div class="nav-item @if($_active_menu == 'admin.farmers') active @endif">
					<a href="{{ route('admin.farmers') }}"><i class="ik ik-users"></i><span>Farmers</span></a>
				</div>
				@endcan
				<div class="nav-lavel">&nbsp;</div>
				<div class="nav-item @if($_active_menu == 'information-center') active @endif">
					<a href="{{ route('information_center') }}"><i class="ik ik-help-circle"></i><span>Information Center</span></a>
				</div>
				<div class="nav-item @if($_active_menu == 'contact-support') active @endif">
					<a href="{{ route('contact_support') }}"><i class="ik ik-mail"></i><span>Contact Support</span></a>
				</div>
			</nav>
		</div>
	</div>
</div>