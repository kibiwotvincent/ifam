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
		@foreach($farms as $row)
		<div class="col-md-6">
			<div class="card proj-t-card" stylee="min-height: 205px;">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<h6 class="mb-5 font-weight-bold">{{ $row['name'] }}</h6>
						</div>
						<div class="col-6 text-right">
							<div class="dropdown d-inline-block">
								<a style="padding: 10px; border-radius: 4px;" class="border dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								
								<span class="text-muted font-weight-bold pb-1">Farm Departments <i class="ik ik-chevron-down"></i></span>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
									@foreach($row->departments as $department)
									<a class="dropdown-item" href="{{ route('view_department', [$row['id'], $department['id']]) }}">{{ $department->category['name'] }}</a>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col pl-0 mx-3">
							<p>
							Added On <span class="text-muted">{{ date('d M Y', strtotime($row['created_at'])) }}</span>
							</p>
							<div style="min-height: 50px;">
							<p>{{ $row['description'] }}</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<a href="#">
								<span class="badge badge-pill badge-info"><i class="ik ik-edit"></i> Edit Farm</span>
							</a>
						</div>
						<div class="col-6 text-right">
							<a href="{{ route('farm.report', $row['id']) }}">
								<span class="badge badge-pill badge-success"><i class="ik ik-bar-chart-2"></i> Farm Report</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
</x-app-layout>