<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-menu bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">View Farm</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('farms') }}">Farms</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('farm', $farm['id']) }}">{{ $farm['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">View</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<x-account.farm.view_farm :farm=$farm />
		</div>
	</div>
</div>
</x-app-layout>