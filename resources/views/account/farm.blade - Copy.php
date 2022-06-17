<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-layout bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $farm['name'] }}</h5>
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
						<li class="breadcrumb-item active" aria-current="page">{{ $farm['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 d-none">
			<div class="row mb-2">
				<div class="col-md-6">
					<h6 class="mt-2 font-weight-bold">Farms</h6>
				</div>
				<div class="col-md-6 text-right d-none">
					<a href="{{ route('add_farm') }}" class="btn btn-success"><i class="ik ik-plus-circle"></i> Add New Farm</a>
				</div>
			</div>
		</div>
		@foreach($child_categories as $row)
		<div class="col-md-6">
			<div class="card proj-t-card">
				<div class="card-body p-0">
					<div class="row">
						<div class="col-md-4 p-0">
							<img src="http://www.ifam.com/img/portfolio-1.jpg" class="" style="width: 100%;height: 100%;" />
						</div>
						<div class="col-md-8 p-md-0">
							<div class="row mb-30 m-1">
								<div class="col-md-12 mt-2">
									<a href="crop.html">
										<h6 class="mb-5 font-weight-bold">{{ $row['name'] }}</h6>
									</a>
									46 <span class="text-muted">varieties added</span>
								</div>
							</div>
							<div class="row m-1 mb-3 mr-md-3">
								<div class="col">
									<h6 class="mb-0"><span class="font-weight-bold">3</span> Seasons</h6> 
								</div>
								<div class="col text-right">
									<a href="#">
										<span class="mb-0 badge badge-pill badge-success"><i class="ik ik-plus"></i> Add To Farm</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
</x-app-layout>