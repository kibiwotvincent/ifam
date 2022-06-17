<x-app-layout>
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-5">
					<div class="page-header-title">
						<i class="ik ik-users bg-success"></i>
						<div class="d-inline">
							<h5 class="pt-2">Groups Report</h5>
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
							<li class="breadcrumb-item active" aria-current="page">Groups Report</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card table-card">
					<div class="card-header">
						<div class="col-12">
						<div class="row">
						<div class="col-md-10">
						<form class="forms-sample ajax" id="add_farm_form" action="{{ route('add_farm') }}" method="post">
						@csrf
						<div class="row">
						<div class="col-md-6 col-lg-3">
							<select class="form-control select2" id="groups" name="category" required>
								<option value="">All Groups</option>
								@foreach($groups as $row)
								<option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6 col-lg-3">
							<select class="form-control select2" id="farm-category" name="category" required>
								<option value="">All Departments</option>
								@foreach($departments as $row)
								<option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="col-md-6 col-lg-3 mt-2 text-left md-text-center">
							<div class="dropdown d-inline-block">
								<a style="padding: 10px 10px 10px 12px; border-radius: 4px;" class="border dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="text-muted font-weight-bold pb-1">Child Categories <i class="ik ik-chevron-down"></i></span>
								</a>
								<div class="border-checkbox-section dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
									@foreach($child_categories as $row)
									<div class="border-checkbox-group border-checkbox-group-success d-block">
										<input class="border-checkbox" type="checkbox" id="child-category-{{ $row['id'] }}" name="departments[]" value="{{ $row['id'] }}">
										<label class="border-checkbox-label" for="child-category-{{ $row['id'] }}">{{ $row['name'] }}</label>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						
						<div class="col-md-6 col-lg-3 mt-2">
							<div class="dropdown d-inline-block">
								<a style="padding: 10px 10px 10px 12px; border-radius: 4px;" class="border dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="text-muted font-weight-bold pb-1">Child Sub Categories <i class="ik ik-chevron-down"></i></span>
								</a>
								<div class="border-checkbox-section dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
									@foreach($child_sub_categories as $row)
									<div class="border-checkbox-group border-checkbox-group-success d-block">
										<input class="border-checkbox" type="checkbox" id="child-sub-category-{{ $row['id'] }}" name="departments[]" value="{{ $row['id'] }}">
										<label class="border-checkbox-label" for="child-sub-category-{{ $row['id'] }}">{{ $row['name'] }}</label>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						</div>
						</form>
						</div>
						<div class="col-md-2 text-right">
							<div class="dropdown d-inline-block">
								<a style="padding: 10px; border-radius: 4px;" class="border-0 dropdown-toggle bg-success text-white" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								
								Download <i class="ik ik-chevron-down"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
									<a class="dropdown-item" href="#">Excel</a>
									<a class="dropdown-item" href="#">PDF</a>
								</div>
							</div>
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
									<th>Created On</th>
									<th>Interests</th>
									<th>Members</th>
									<th class="text-right">View</th>
								</tr>
							</thead>
							<tbody>
								@foreach($groups as $row)
								<tr>
									<td>{{ $row['name'] }}</td>
									<td>{{ date('d M Y', strtotime($row['created_at'])) }}</td>
									<td>French beans, Passion fruits</td>
									<td><span class="badge badge-pill badge-light text-muted">{{ count($row->members) }}</span></td>
									<td class="table-action text-right">
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