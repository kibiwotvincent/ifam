<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-user bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $farmer['name'] }}</h5>
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
							<a href="{{ route('admin.farmers') }}">Farmers</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $farmer['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="row mb-1">
				<div class="col-md-6">
					<h5 class="mt-3 h6 font-weight-bold text-muted">Groups</h5>
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('admin.farmer.report', $farmer['id']) }}" class="btn btn-success"><i class="ik ik-bar-chart-line-"></i> Farmer Report</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mb-4 pl-0 pr-0">
					<div class="owl-container">
						<div class="owl-carousel basic">
							@foreach($groups as $row)
							<div class="card proj-t-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col pl-0 mx-3">
											<a href="{{ route('admin.group', $row->group['id']) }}">
												<h6 class="mb-5 font-weight-bold">{{ $row->group['name'] }}</h6>
											</a>
											<p>
											Joined On <span class="text-muted">{{ date('d M Y', strtotime($row['created_at'])) }}</span>
											</p>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<span class="badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span>
										</div>
										<div class="col text-right">
											<a href="{{ route('admin.group_member_report', [$row->group['id'], $row['id']]) }}">
											<span classs="badge badge-light"><i class="ik ik-bar-chart-2"></i></span>
											</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="slider-nav text-center">
							<a href="#" class="left-arrow owl-prev text-success">
								<i class="ik ik-chevron-left"></i>
							</a>
							<div class="slider-dot-container"></div>
							<a href="#" class="right-arrow owl-next text-success">
								<i class="ik ik-chevron-right"></i>
							</a>
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card table-card">
				<div class="card-header">
					<div class="container px-0">
						<div class="row">
							<div class="col-12">
								<h3 class="mt-2">Farms</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="card-block">
					<div class="table-responsive">
						<table id="data_tabl" class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Added On</th>
									<th>Departments</th>
									<th class="text-right">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach($farmer->farms as $row)
								<tr>
									<td><a href="{{ route('admin.farmer.view_farm', [$farmer['id'], $row['id']]) }}">{{ $row['name'] }}</a></td>
									<td>{{ date('d M Y', strtotime($row['created_at'])) }}</td>
									<td>
									@foreach($row->departments as $department)
									<a href="{{ route('admin.farmer.view_department', [$farmer['id'], $row['id'], $department['id']]) }}" class="badge badge-pill badge-light text-muted">{{ $department->category['name'] }}</a>
									@endforeach
									</td>
									<td class="table-action text-right">
									<a href="{{ route('admin.farmer.farm_report', [$farmer['id'], $row['id']]) }}"><i class="ik ik-bar-chart-line- mr-2 f-16 text-success"></i></a>
									<a href="{{ route('admin.farmer.view_farm', [$farmer['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</x-app-layout>