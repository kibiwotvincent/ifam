<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-users bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $group['name'] }}</h5>
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
						<li class="breadcrumb-item active" aria-current="page">{{ $group['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="row mb-1">
				<div class="col-md-5">
					<h5 class="mt-3 h6 font-weight-bold text-muted">Group Farms</h5>
				</div>
				<div class="col-md-7 text-right">
					<a href="{{ route('group_profile', $group['id']) }}" class="btn btn-info mr-2"><i class="ik ik-grid"></i> Group Profile</a>
					<a href="{{ route('group.add_farm', $group['id']) }}" class="btn btn-success"><i class="ik ik-plus-circle"></i> Add Group Farm</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mb-4 pl-0 pr-0">
					<div class="owl-container">
						<div class="owl-carousel basic">
							@foreach($group->farms as $row)
							<div class="card proj-t-card">
								<div class="card-body">
									<div class="row">
										<div class="col-10">
											<a href="{{ route('group.view_farm', [$row->farmable['id'], $row['id']]) }}">
												<h6 class="mb-5 font-weight-bold">{{ $row['name'] }}</h6>
											</a>
										</div>
										<div class="col-1 text-right">
											<a href="{{ route('farm.report', $row['id']) }}" title="Farm Report">
												<span classs="badge badge-pil badge-light"><i class="ik ik-bar-chart-2"></i></span>
											</a>
										</div>
									</div>
									<p>
									Added On <span class="text-muted">{{ date('d M Y', strtotime($row['created_at'])) }}</span>
									</p>
									<div class="row">
										<div class="col">
											<span class="badge badge-pill badge-info">
											{{ $row->departments[0]->category['name'] }}
											@if(count($row->departments) > 1)
											+ {{ count($row->departments) - 1 }}
											@endif
											</span>
										</div>
										<div class="col text-right">
											<a href="#">
											<span class="badge badge-pill badge-success"><i class="ik ik-edit"></i> Edit</span>
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
							<div class="col-6">
								<h3 class="mt-2">Group Members</h3>
							</div>
							<div class="col-6 text-right">
								<a href="#" data-toggle="modal" data-target="#addMemberModal" class="btn btn-success"><i class="ik ik-plus-circle"></i> Add Member</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card-block">
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
								<td><img src="{{ $row->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$row->user['profile_photo']) }}" class="table-user-thumb" alt=""></td>
								<td>{{ $row->user['full_name'] }}</td>
								<td>{{ $row->user['id_number'] }}</td>
								<td><span class="mb-0 badge badge-pill badge-{{ $row['position'] }}">{{ $row['position'] }}</span></td>
								<td>{{ $row->user['gender'] }}</td>
								<td>{{ $row->user['age'] }}</td>
								<td><span class="mb-0 badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
								<td class="table-action text-right">
									<a href="{{ route('view_group_member', [$row['group_id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
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
	
	<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addMemberModalLabel">Add Group Member</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form class="ajax" id="add_member_form" action="{{ route('add_group_member', $group['id']) }}" method="post">
				@method('post')
				@csrf
				<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
				<input type="hidden" name="group_id" value="{{ $group['id'] }}"/>
				<div class="formgroup mb-3">
					<label for="member-id-no">Enter ID number of member to add</label>
					<div class="input-group m-0 mb-2">
						<input type="number" class="form-control" id="member-id-no" name="id_number">
						<div class="input-group-append">
							<div class="input-group-text p-0">
							<button type="submit" class="btn btn-success" style="border-radius: 0px 4px 4px 0px;" id="add_member_form_submit">Add</button>
							</div>
						</div>
					</div>
					<p class="d-none error" for="id_number"></p>
					<div id="add_member_form_feedback"></div>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>