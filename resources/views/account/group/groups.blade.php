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
						<li class="breadcrumb-item active" aria-current="page">Groups</li>
					</ol>
				</nav>
			</div>
		</div>
		</div>
		
		@if(count($groups) > 0)
		<div class="row">
			<div class="col-md-12"> 
				<div class="row mb-1">
					<div class="col-md-7">
						<h6 class="mt-3">Explore Groups</h6>
					</div>
					<div class="col-md-5">
						<div class="input-group mb-2 mr-sm-2">
							<input type="text" class="form-control" placeholder="Search">
							<div class="input-group-append">
								<div class="input-group-text" style="border-radius: 0px 4px 4px 0px;"><i class="ik ik-search"></i></div>
							</div>
							<a href="{{ route('create_group') }}" class="btn btn-success ml-3" style="margin-top: 2px"><i class="ik ik-plus"></i> Create Group</a>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 mb-4 pl-0 pr-0">
						<div class="owl-container">
							<div class="owl-carousel basic">
								@foreach($groups as $row)
								<div class="card proj-t-card">
									<div class="card-body">
										<div class="row align-items-center mb-30">
											<div class="col pl-0 mx-3">
												<a href="{{ route('view_group', $row['id']) }}">
													<h6 class="mb-5 font-weight-bold">{{ $row['name'] }}</h6>
												</a>
												Created On <span class="text-muted">{{ date('d M Y', strtotime($row['created_at'])) }}</span>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<h6 class="mb-0"><span class="font-weight-bold">{{ count($row->members) }}</span> Members</h6> 
											</div>
											<div class="col text-right">
												<form class="ajax" id="join_group_{{ $row['id'] }}_form" action="{{ route('join_group', $row['id']) }}" method="post">
													@method('post')
													@csrf
													<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
													<input type="hidden" name="group_id" value="{{ $row['id'] }}" >
													<button type="submit" id="join_group_{{ $row['id'] }}_form_submit" class="badge badge-pill btn-success ">Join Group</button>
													
												</form>
												</a>
											</div>
											<div class="col-12 mt-2">
												<div id="join_group_{{ $row['id'] }}_form_feedback"></div>
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
		@endif
		
		<div class="row">
			<div class="col-md-6">
				<h6 class="mt-2" >My Groups</h6>
			</div>
			@if(count($groups) == 0)
			<div class="col-md-6 text-right">
				<a href="{{ route('create_group') }}" class="btn btn-success mb-2"><i class="ik ik-plus"></i> Create Group</a>
			</div>
			@endif
		</div>
		
		@if(count($user_groups) == 0)
		<div class="alert alert-info" role="alert">You're not a member of any group yet.</div>
		@endif
		
		<div class="row">
			@foreach($user_groups as $row)
			<div class="col-md-6">
				<div class="card proj-t-card">
					<div class="card-body">
						<div class="row align-items-center mb-30">
							<div class="col pl-0 mx-3">
								<a href="{{ route('view_group', $row->group['id']) }}">
									<h6 class="mb-5 font-weight-bold">{{ $row->group['name'] }}</h6>
								</a>
								Created On <span class="text-muted">{{ date('d M Y', strtotime($row->group['created_at'])) }}</span>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h6 class="mb-0"><span class="font-weight-bold">{{ count($row->group->members) }}</span> Members</h6> 
							</div>
							<div class="col">
								<h6 class="mb-0"><span class="font-weight-bold">{{ count($row->group->farms) }}</span> Farms added</h6> 
							</div>
							<div class="col text-right">
								@if($row['status'] == "accepted")
								<a href="#" class="badge badge-pill badge-success" data-toggle="modal" data-target="#leaveGroup{{ $row['id'] }}Modal">Leave Group</a>
								@else
									<form class="ajax" id="cancel_join_request_{{ $row['id'] }}_form" action="{{ route('cancel_join_request', $row['group_id']) }}" method="post">
										@method('post')
										@csrf
										<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
										<input type="hidden" name="group_id" value="{{ $row['group_id'] }}"/>
										<button type="submit" id="cancel_join_request_{{ $row['id'] }}_form_submit" class="badge badge-pill btn-info">Cancel Join Request</button>
									</form>
								
								@endif
							</div>
							<div class="col-12">
								<div id="cancel_join_request_{{ $row['id'] }}_form_feedback"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- leave group confirmation -->
			<div class="modal fade" id="leaveGroup{{ $row['id'] }}Modal" tabindex="-1" role="dialog" aria-labelledby="leaveGroup{{ $row['id'] }}ModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="LeaveGroup{{ $row['id'] }}ModalLabel">Leave Group</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form class="ajax" id="leave_group_{{ $row['id'] }}_form" action="{{ route('leave_group', $row['id']) }}" method="post">
								@method('post')
								@csrf
								<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
								<input type="hidden" name="group_id" value="{{ $row['group_id'] }}"/>
								<p>Are you sure you want to leave {{ $row->group['name'] }}</p>
								<div id="leave_group_{{ $row['id'] }}_form_feedback"></div>
										
								<div class="text-right">
									<a href="#" class="btn btn-light" data-dismiss="modal">Cancel</a>
									<button type="submit" class="btn btn-danger" id="leave_group_{{ $row['id'] }}_form_submit">Leave Group</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end leave group confirmation -->
			@endforeach
		</div>

	</div>
</x-app-layout>