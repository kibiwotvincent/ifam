<x-app-layout>
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-4">
					<div class="page-header-title">
						<i class="ik ik-users bg-success"></i>
						<div class="d-inline">
							<h5 class="pt-2">Group Only Report</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
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
							<li class="breadcrumb-item active" aria-current="page">Group Only Report</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card table-card">
					<div class="card-header">
						<form class="ajax-get-report" id="view_group_only_report_form" action="{{ route('fetch_group_only_report', $group['id']) }}" method="post">
						@csrf
						
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<div class="formgroup">
								<label for="from">From</label>
								<input type="date" style="min-width: 180px;" class="form-control" id="from" name="from" />
								<p class="d-none error" for="from"></p>
							</div>
						</div>
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<div class="formgroup">
								<label for="to">To</label>
								<input type="date" style="min-width: 180px;" class="form-control" id="to" name="to" />
								<p class="d-none error" for="to"></p>
							</div>
						</div>
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<div class="formgroup">
								<label class="d-block" for="farm-department">Department</label>
								<select style="min-width: 180px;" class="form-control select2 department-selector" id="farm-department" name="department">
									<option value="">All Departments</option>
									@foreach($departments as $department)
									<option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
									@endforeach
								</select>
								<p class="d-none error" for="department"></p>
							</div>
						</div>
						
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<div class="formgroup">
								<label class="d-block pb-1">Categories</label>
								<div class="dropdown d-inline-block">
									<a style="padding: 8px 10px 10px 12px; border-radius: 4px;" class="border dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span>Categories <i class="ik ik-chevron-down"></i></span>
									</a>
									<div class="border-checkbox-section dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
										@foreach($categories as $row)
										<div class="border-checkbox-group border-checkbox-group-success checkbox-panels checkbox-panel-{{ $row['parent_category_id'] }} d-block">
											<input class="border-checkbox departments" data-department-id="{{ $row['parent_category_id'] }}" type="checkbox" id="category-{{ $row['id'] }}" name="categories[]" value="{{ $row['id'] }}" checked="checked" >
											<label class="border-checkbox-label" for="category-{{ $row['id'] }}">{{ $row['name'] }}</label>
										</div>
										@endforeach
									</div>
								</div>
								<p class="d-none error" for="categories"></p>
							</div>
						</div>
						
						<div class="d-inline-block mr-2 mb-3 mb-lg-0">
							<label>&nbsp;</label>
							<button type="submit" id="view_group_only_report_form_submit" style="padding: 8px 15px 8.5px 15px; border-radius: 4px;" class="border-0 bg-success text-white">
							Submit
							</button>
						</div>
						</form>
					</div>
					<div class="card-block" id="view_group_only_report_form_feedback">
						<x-account.group.group_only_report_table :seasons=$seasons :from=$from :to=$to />
					</div>
				</div>
			</div>
		</div>
		
	</div>
</x-app-layout>