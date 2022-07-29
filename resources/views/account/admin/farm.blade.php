<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-layout bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $farm['name'] }}</h5>
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
							<a href="{{ route('dashboard') }}">Admin</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('admin.groups') }}">Groups</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('admin.group', $farm->farmable['id']) }}">{{ $farm->farmable['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $farm['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="row mb-2">
				<div class="col-md-12">
					<h6 class="mt-2 font-weight-bold">Farm Departments</h6>
				</div>
			</div>
		</div>
		@foreach($farm->departments as $row)
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="widget">
				<div class="widget-body">
					<div class="border-bottom">
						<div class="mb-2">
							<a class="mb-3" href="{{ route('admin.group.view_department', [$farm['farmable_id'], $farm['id'], $row['id']]) }}">
								<h5 class="font-weight-bold text-muted">{{ $row->category['name'] }}</h5>
							</a>
							<div class="text-center">
							<span class="text-muted h6">Kshs </span>
							<span class="h5 font-weight-bold">{{ number_format($row->profits(), 2) }}</span> 
							<strong class="text-muted">Profit</strong>
							</div>
						</div>
					</div>
					<div class="row pt-2">
						<div class="col border-right">
							<span class="text-muted">Kshs </span>
							<span class="h6 font-weight-bold">{{ number_format($row->expenses(), 2) }}</span> 
							<strong class="text-muted">Expenses</strong>
						</div>
						<div class="col">
							<span class="text-muted">Kshs </span>
							<span class="h6 font-weight-bold">{{ number_format($row->sales(), 2) }}</span> 
							<strong class="text-muted">Sales</strong>
						</div>
					</div>
				</div>
				<div class="progress progress-sm">
					<div class="progress-bar bg-light" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
</x-app-layout>