<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-plus bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Add Season</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
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
						<li class="breadcrumb-item">
							<a href="{{ route('view_department', [$farm['id'], $department['id']]) }}">{{ $department->category['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Add Season</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<x-account.farm.season.add-season />
		</div>
	</div>
	
</div>
</x-app-layout>