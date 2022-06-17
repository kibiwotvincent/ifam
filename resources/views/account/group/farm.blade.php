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
							<a href="{{ route('groups') }}">Groups</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('view_group', [$farm['farmable_id']]) }}">{{ $farm->farmable['name'] }}</a>
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
				<div class="col-md-6">
					<h6 class="mt-2 font-weight-bold">Farm Departments</h6>
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('add_farm') }}" class="btn btn-success"><i class="ik ik-plus-circle"></i> Add New Farm</a>
				</div>
			</div>
		</div>
		@foreach($farm->departments as $row)
		<div class="col-md-6">
			<div class="card proj-t-card" stylee="min-height: 205px;">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<a href="{{ route('group.view_department', [$farm['farmable_id'], $farm['id'], $row['id']]) }}">
								<h6 class="mb-5 font-weight-bold">{{ $row->category['name'] }}</h6>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col pl-0 mx-3">
							<p>
							Added On <span class="text-muted">{{ date('d M Y', strtotime($row['created_at'])) }}</span>
							</p>
							<div style="min-height: 75px;">
							<p>{{ $row['description'] }}</p>
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