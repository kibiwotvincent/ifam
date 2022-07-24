<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-users bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Farm Report</h5>
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
						<li class="breadcrumb-item">
							<a href="{{ route('group.view_farm', [$farm->farmable['id'], $farm['id']]) }}">{{ $farm['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Farm Report</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card table-card">
				<div class="card-header">
					<form class="forms-sample ajax-get-report" id="view_farm_report_form" action="{{ route('farm.report', $farm['id']) }}" method="post">
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
								@foreach($farm->departments as $row)
								<option value="{{ $row['id'] }}">{{ $row->category['name'] }}</option>
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
									@foreach($farm->departments as $farmDepartment)
										@foreach($farmDepartment->category->child_categories as $row)
										<div class="border-checkbox-group border-checkbox-group-success checkbox-panels checkbox-panel-{{ $farmDepartment['id'] }} d-block">
											<input class="border-checkbox departments" data-department-id="{{ $farmDepartment['id'] }}" type="checkbox" id="child-category-{{ $row['id'] }}" name="categories[]" value="{{ $row['id'] }}" checked="checked" >
											<label class="border-checkbox-label" for="child-category-{{ $row['id'] }}">{{ $row['name'] }}</label>
										</div>
										@endforeach
									@endforeach
								</div>
							</div>
							<p class="d-none error" for="categories"></p>
						</div>
					</div>
					
					<div class="d-inline-block mr-2 mb-3 mb-lg-0">
						<label>&nbsp;</label>
						<button type="submit" id="view_farm_report_form_submit" style="padding: 8px 15px 8.5px 15px; border-radius: 4px;" class="border-0 bg-success text-white">
						Submit
						</button>
					</div>
					</form>
				</div>
				<div class="card-block" id="view_farm_report_form_feedback">
					<x-account.farm.farm_report_table :seasons=$seasons :from=$from :to=$to />
				</div>
			</div>
		</div>
	</div>

</div>
</x-app-layout>