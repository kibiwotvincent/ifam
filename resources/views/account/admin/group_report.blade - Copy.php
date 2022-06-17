<x-app-layout>
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-5">
					<div class="page-header-title">
						<i class="ik ik-users bg-success"></i>
						<div class="d-inline">
							<h5 class="pt-2">Group Report</h5>
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
								<a href="{{ route('admin.group', $group['id']) }}">{{ $group['name'] }}</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Group Report</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card table-card">
					<div class="card-header">
						<form class="forms-sample ajax" id="add_farm_form" action="{{ route('add_farm') }}" method="post">
						@csrf
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<select style="min-width: 180px;" class="form-control select2" id="farm-category" name="category" required>
								<option value="">All Departments</option>
								@foreach($departments as $row)
								<option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<div class="dropdown d-inline-block">
								<a style="padding: 8px 10px 10px 12px; border-radius: 4px;" class="border dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="text-muted font-weight-bold">Child Categories <i class="ik ik-chevron-down"></i></span>
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
						
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<div class="dropdown d-inline-block">
								<a style="padding: 8px 10px 10px 12px; border-radius: 4px;" class="border dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="text-muted font-weight-bold">Child Sub Categories <i class="ik ik-chevron-down"></i></span>
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
						<div class="card-header-right">
							<div class="dropdown d-inline-block mt-2">
								<a style="padding: 10px 15px; border-radius: 4px;" class="border-0 dropdown-toggle bg-success text-white" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Download <i class="ik ik-chevron-down"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
									<a class="dropdown-item" href="#">Excel</a>
									<a class="dropdown-item" href="#">PDF</a>
								</div>
							</div>
						</div>
						</form>
					</div>
					<div class="card-block">
						<div class="alert alert-info mt-3 mx-3" role="alert">No current active season!</div>
						<x-account.admin.group_report_table :seasons=$seasons />
					</div>
				</div>
			</div>
		</div>
		
	</div>
</x-app-layout>