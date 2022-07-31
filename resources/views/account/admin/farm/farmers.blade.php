<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-users bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Farmers</h5>
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
							<a href="{{ route('dashboard') }}">Admin</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Farmers</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>Farmers ({{ count($farmers) }})</h3>
					<div class="card-header-right">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<div class="input-group-append">
								<div class="input-group-text"><i class="ik ik-search"></i></div>
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
									<th>Phone Number</th>
									<th>ID Number</th>
									<th>Gender</th>
									<th>Roles</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach($farmers as $row)
								<tr>
									<td>
									<img src="{{ $row['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$row['profile_photo']) }}" class="table-user-thumb mr-2" alt="">
									{{ $row['name'] }}
									</td>
									<td>{{ $row['phone_number'] }}</td>
									<td>{{ $row['id_number'] }}</td>
									<td>{{ $row['gender'] }}</td>
									<td><span class="badge badge-light">{{ implode(', ', $row->getRoleNames()->toArray()) }}</span></td>
									<td class="table-action text-right">
										<a href="{{ route('admin.farmer.report', $row['id']) }}"><i class="ik ik-bar-chart-line- mr-2 f-16 text-success"></i></a>
										<a href="{{ route('admin.farmer', $row['id']) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
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