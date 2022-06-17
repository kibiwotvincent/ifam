<x-app-layout>
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-5">
					<div class="page-header-title">
						<i class="ik ik-users bg-success"></i>
						<div class="d-inline">
							<h5 class="pt-2">Groups</h5>
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
							<li class="breadcrumb-item active" aria-current="page">Groups</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card table-card">
					<div class="card-header">
						<h3>Groups ({{ count($groups) }})</h3>
						<div class="card-header-right">
							<a href="{{ route('admin.groups_report') }}" class="btn btn-sm btn-success"><i class="ik ik-bar-chart-2"></i> Groups Report</a>
						</div>
					</div>
					<div class="card-block">
						<div class="table-responsive">
						<table id="data_tabl" class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Created On</th>
									<th>Interests</th>
									<th>Members</th>
									<th class="text-right">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach($groups as $row)
								<tr>
									<td><a href="{{ route('admin.group', $row['id']) }}">{{ $row['name'] }}</a></td>
									<td>{{ date('d M Y', strtotime($row['created_at'])) }}</td>
									<td>{{ implode(", ", $row->interests()) }}</td>
									<td><span class="badge badge-pill badge-light text-muted">{{ count($row->members) }}</span></td>
									<td class="table-action text-right">
									<a href="{{ route('admin.group_report', $row['id']) }}"><i class="ik ik-bar-chart-line- mr-2 f-16 text-success"></i></a>
									<a href="{{ route('admin.group', $row['id']) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
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