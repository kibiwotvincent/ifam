<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-4">
				<div class="page-header-title">
					<i class="ik ik-layout bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $farm['name'] }}</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('groups') }}">Groups</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('view_group', $farm->farmable['id']) }}">{{ $farm->farmable['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $farm['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<x-account.farm.meta-data />
	
	<div class="row clearfix">
		<div class="col-md-12">
			<x-account.farm.seasons :is_group=true/>
		</div>
	</div>
</div>
</x-app-layout>