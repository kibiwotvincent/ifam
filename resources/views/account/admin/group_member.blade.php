<x-app-layout>
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-4">
					<div class="page-header-title">
						<i class="ik ik-users bg-success"></i>
						<h5 class="pt-2">{{ $member->user['name'] }} 
							<span class="mb-0 ml-2 badge badge-pill badge-{{ $member['position'] }}">{{ $member['position'] }}</span>
						</h5>
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
								<a href="{{ route('admin.group', $member->group['id']) }}">{{ $member->group['name'] }}</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">{{ $member->user['name'] }}</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="row mb-1">
					<div class="col-md-8">
						<h5 class="mt-3 h6">Member Merged Seasons</h5>
					</div>
					<div class="col-md-4 text-right">
						<a href="{{ route('admin.group_member_report', [$group['id'], $member['id']]) }}" class="btn btn-success"><i class="ik ik-bar-chart-2"></i> Group Member Report</a>
					</div>
				</div>
				
				@if(count($member->merged_seasons) == 0)
					<div class="alert alert-warning" role="alert">
					  There are no merged seasons belonging to this member yet!
					</div>
				@else
					<div class="row">
						<div class="col-md-12 mb-4 pl-0 pr-0">
							<div class="owl-container">
								<div class="owl-carousel basic">
									@foreach($member->merged_seasons as $row)
									<div class="card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col pl-0 mx-3">
													<a href="{{ route('admin.view_merged_season', [$row['group_id'], $row['group_member_id'], $row['season_id']]) }}">
														<h6 class="mb-5 font-weight-bold">{{ $row->season['name'] }}</h6>
													</a>
													<p>Started On <span class="text-muted">{{ $row->season['start_date_string'] }}</span></p>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<span class="badge badge-pill badge-info">
													{{ $row->season->department->category['name'] }}
													</span>
												</div>
												<div class="col pt-1 text-right">
													<span class="badge badge-pill badge-{{ $row->season['status'] }} ml-3 py-1">{{ $row->season['status'] }}</span>
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
				@endif
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card table-card">
					<div class="card-header">
						<div class="container px-0">
							<div class="row">
								<div class="col-md-6">
									<h3 class="mt-2">Member Contributions</h3>
								</div>
								<div class="col-md-6 text-right">
									<a href="#" data-toggle="modal" data-target="#addMemberModal" class="btn btn-success"><i class="ik ik-plus-circle"></i> Add Member Contributions</a>
								</div>
							</div>
						</div>
					</div>
					<div class="card-block d-none">
						<div class="table-responsive">
						<table id="data_tabl" class="table">
							<thead>
								<tr>
									<th class="nosort">Avatar</th>
									<th>Name</th>
									<th>ID Number</th>
									<th>Position</th>
									<th>Gender</th>
									<th>Age</th>
									<th>Status</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach($group->members as $row)
								<tr>
									<td><img src="/assets/img/users/1.jpg" class="table-user-thumb" alt=""></td>
									<td>{{ $row->user['full_name'] }}</td>
									<td>{{ $row->user['id_number'] }}</td>
									<td><span class="mb-0 badge badge-pill badge-{{ $row['position'] }}">{{ $row['position'] }}</span></td>
									<td>Male</td>
									<td>53</td>
									<td><span class="mb-0 badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
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