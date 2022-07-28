<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-users bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $member->user['name'] }} 
						<span class="mb-0 ml-2 badge badge-pill badge-{{ $member['position'] }}">{{ $member['position'] }}</span>
						</h5>
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
							<a href="{{ route('view_group', $group['id']) }}">{{ $group['name'] }}</a>
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
					@if($member->isAccepted())
						<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeMemberModal"><i class="ik ik-user-x"></i> Remove Member</a>
					@else
						<form class="ajax" id="approve_member_form" action="{{ route('approve_group_member', $member['id']) }}" method="post">
						@csrf
						<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
						<input type="hidden" name="member_id" value="{{ $member['id'] }}" >
						<button type="submit" class="btn btn-success" id="approve_member_form_submit"><i class="ik ik-user-check"></i> Approve Member</button>
						</form>
					@endif
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
												<a href="{{ route('group.view_merged_season', [$row['group_id'], $row['group_member_id'], $row['season_id']]) }}">
													<h6 class="mb-5 font-weight-bold">{{ $row->season['name'] }}</h6>
												</a>
												<p>
												Started On <span class="text-muted">{{ $row->season['start_date_string'] }}</span>
												<span class="badge badge-pill badge-{{ $row->season['status'] }} ml-3 py-1">{{ $row->season['status'] }}</span>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<span class="badge badge-pill badge-info">
												{{ $row->season->department->category['name'] }}
												</span>
											</div>
											<div class="col pt-1 text-right">
												<a href="#" title="Unmerge Season" data-toggle="modal" data-target="#unmergeSeason{{ $row['id'] }}Modal">
												<i class="ik ik-zap-off f-18"></i>
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
	
	<!-- remove member confirmation -->
	<div class="modal fade" id="removeMemberModal" tabindex="-1" role="dialog" aria-labelledby="removeMemberModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="removeMemberModalLabel">Remove Member</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form class="ajax" id="remove_member_form" action="{{ route('remove_group_member', $member['group_id']) }}" method="post">
						@method('post')
						@csrf
						<input type="hidden" name="_redirect" value="{{ route('view_group', $member['group_id']) }}" >
						<input type="hidden" name="member_id" value="{{ $member['id'] }}"/>
						<p>Are you sure you want to remove {{ $member->user['full_name'] }} from {{ $member->group['name'] }} ?</p>
						<div id="remove_member_form_feedback"></div>
								
						<div class="text-right">
							<a href="#" class="btn btn-light" data-dismiss="modal">Cancel</a>
							<button type="submit" class="btn btn-danger" id="remove_member_form_submit">Remove</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--end remove member confirmation -->
	
	<!-- unmerge season confirmations -->
	@foreach($member->merged_seasons as $row)
	<div class="modal fade" id="unmergeSeason{{ $row['id'] }}Modal" tabindex="-1" role="dialog" aria-labelledby="unmergeSeason{{ $row['id'] }}ModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="unmergeSeason{{ $row['id'] }}ModalLabel">Unmerge Season</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form class="ajax" id="unmerge_season_{{ $row['id'] }}_form" action="{{ route('group.unmerge_season', [$row['group_id'], $row['group_member_id'], $row['season_id']]) }}" method="post">
						@csrf
						<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
						<input type="hidden" name="group_id" value="{{ $row['group_id'] }}"/>
						<input type="hidden" name="group_member_id" value="{{ $row['group_member_id'] }}"/>
						<input type="hidden" name="season_id" value="{{ $row['season_id'] }}"/>
						<p>Are you sure you want to unmerge `{{ $row->season['name'] }}` season from {{ $row->group['name'] }} ?</p>
						<div id="unmerge_season_{{ $row['id'] }}_form_feedback"></div>
								
						<div class="text-right">
							<a href="#" class="btn btn-light" data-dismiss="modal">Cancel</a>
							<button type="submit" class="btn btn-danger" id="unmerge_season_{{ $row['id'] }}_form_submit">Unmerge</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endforeach;
	<!--end unmerge season confirmations -->
	
</div>
</x-app-layout>