<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-layout bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Farms</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Farms</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="row mb-2">
				<div class="col-md-6">
					<h6 class="mt-2 font-weight-bold">Farms</h6>
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('add_farm') }}" class="btn btn-success"><i class="ik ik-plus-circle"></i> Add New Farm</a>
				</div>
			</div>
		</div>
		<x-account.farm.farms :group=null />
	</div>
</div>
</x-app-layout>