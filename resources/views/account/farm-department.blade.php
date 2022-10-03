<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-4">
				<div class="page-header-title">
					<i class="ik ik-grid bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $department->category['name'] }}</h5>
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
							<a href="{{ route('farms') }}">Farms</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('view_farm', $farm['id']) }}">{{ $farm['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $department->category['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<x-account.farm.meta-data />
	
	<div class="row clearfix">
		<div class="col-md-12">
			@php $page = "farmer"; @endphp
			<x-account.farm.farm-department :page=$page />
		</div>
	</div>
</div>
</x-app-layout>