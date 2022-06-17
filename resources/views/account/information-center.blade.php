<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-help-circle bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Information Center</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Information Center</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<div class="card proj-t-card">
				<div class="card-body p-0">
				<div class="row">
				<div class="col-md-4 p-0">
					<img src="/assets/img/portfolio-1.jpg" class="" style="width: 100%;height: 100%;" />
				</div>
				<div class="col-md-8 p-md-0">
					<div class="row mb-30 m-1">
						<div class="col-md-12 mt-2">
							<a href="crop.html">
								<h6 class="mb-5 font-weight-bold">Crop Farming</h6>
							</a>
							Created On <span class="text-muted">4th July 2021</span>
						</div>
					</div>
					<div class="row m-1 mb-3 mr-md-3">
						<div class="col">
							<h6 class="mb-0"><span class="font-weight-bold">3</span> Seasons</h6> 
						</div>
						<div class="col text-right">
							<a href="#">
								<span class="mb-0 badge badge-pill badge-success"><i class="ik ik-plus"></i> Add Season</span>
							</a>
						</div>
					</div>
				</div>
				</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card proj-t-card">
				<div class="card-body p-0">
				<div class="row">
				<div class="col-md-4 p-0">
					<img src="/assets/img/portfolio-1.jpg" class="" style="width: 100%;height: 100%;" />
				</div>
				<div class="col-md-8 p-md-0">
					<div class="row mb-30 m-1">
						<div class="col-md-12 mt-2">
							<a href="crop.html">
								<h6 class="mb-5 font-weight-bold">Dairy Farming</h6>
							</a>
							
						</div>
					</div>
					<div class="row ml-3">
						Last Updated On <span class="text-muted">4th July 2021</span>
					</div>
				</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
</x-app-layout>