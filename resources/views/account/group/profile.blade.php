<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-users bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Group Profile</h5>
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
						<li class="breadcrumb-item active" aria-current="page">Group Profile</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xl-12">
			<div class="card proj-progress-card">
				<div class="card-block">
					<div class="row">
						@if(isset($chairperson->user))
						<div class="col-md-4">
							<div class="row">
								<div class="col-8">
									<h6>{{ $chairperson->user['full_name'] }}</h6>
									<h5 class="mb-20 fw-700 text-muted">Chairperson <a href="#" data-toggle="modal" data-target="#updateChairpersonModal" class="ml-2"><i class="ik ik-edit-1 text-success"></i> </a></h5>
								</div>
								<div class="col-4 text-right">
									<img src="{{ $chairperson->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$chairperson->user['profile_photo']) }}" class="rounded-circle" width="60" />
								</div>
							</div>
							<h6 class="mb-3 text-muted phone"><i class="ik ik-phone"></i> {{ $chairperson->user['phone_number'] }}</h6>
							<div class="progress">
								<div class="bg-green" style="width:100%"></div>
							</div>
						</div>
						@else
						<div class="col-md-4">
							<x-account.group.update-official position="chairperson"/>
						</div>
						@endif
						@if(isset($secretary->user))
						<div class="col-md-4">
							<div class="row">
								<div class="col-8">
									<h6>{{ $secretary->user['full_name'] }}</h6>
									<h5 class="mb-20 fw-700 text-muted">Secretary <a href="#" data-toggle="modal" data-target="#updateSecretaryModal" class="ml-2"><i class="ik ik-edit-1 text-success"></i> </a></h5>
								</div>
								<div class="col-4 text-right">
									<img src="{{ $secretary->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$secretary->user['profile_photo']) }}" class="rounded-circle" width="60" />
								</div>
							</div>
							<h6 class="mb-3 text-muted phone"><i class="ik ik-phone"></i> {{ $secretary->user['phone_number'] }}</h6>
							<div class="progress">
								<div class="bg-info" style="width:100%"></div>
							</div>
						</div>
						@else
						<div class="col-md-4">
							<x-account.group.update-official position="secretary"/>
						</div>
						@endif
						@if(isset($treasurer->user))
						<div class="col-md-4">
							<div class="row">
								<div class="col-8">
									<h6>{{ $treasurer->user['full_name'] }}</h6>
									<h5 class="mb-20 fw-700 text-muted">Treasurer <a href="#" data-toggle="modal" data-target="#updateTreasurerModal" class="ml-2"><i class="ik ik-edit-1 text-success"></i> </a></h5>
								</div>
								<div class="col-4 text-right">
									<img src="{{ $treasurer->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$treasurer->user['profile_photo']) }}" class="rounded-circle" width="60" />
								</div>
							</div>
							<h6 class="mb-3 text-muted phone"><i class="ik ik-phone"></i> {{ $treasurer->user['phone_number'] }}</h6>
							<div class="progress">
								<div class="bg-warning" style="width:100%"></div>
							</div>
						</div>
						@else
						<div class="col-md-4">
							<x-account.group.update-official position="treasurer"/>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-md-5">
			<div class="card">
				<div class="card-body">
					<div class="text-center "> 
						<img src="/assets/img/user.jpg" class="" width="180" />
						<h4 class="card-title mt-10">{{ $group['name'] }}</h4>
					</div>
				</div>
				<hr class="mb-0"> 
				<div class="card-body mb-20"> 
					<small class="text-muted d-block pt-10">Phone Number</small>
					<h6>0706038461</h6> 
					<small class="text-muted d-block">Email Address </small>
					<h6>johndoe@admin.com</h6>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-7">
			<div class="card">
				<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Group Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Group Documents</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Group Settings</a>
					</li>
					
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
						<div class="card-body">
							<form class="form-horizontal">
								<div class="form-group">
											<label for="example-name">Name</label>
											<input type="text" placeholder="Johnathan Doe" class="form-control" name="example-name" id="example-name">
										</div>
								<div class="form-group">
									<label for="example-email">Email</label>
									<input type="email" placeholder="johnathan@admin.com" class="form-control" name="example-email" id="example-email">
								</div>
								<div class="form-group">
									<label for="example-phone">Phone Number</label>
									<input type="text" placeholder="123 456 7890" id="example-phone" name="example-phone" class="form-control">
								</div>
								<div class="form-group">
									<label>Logo</label>
									<input type="file" name="logo" id="group-logo" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Group Logo">
										<span class="input-group-append">
										<button class="file-upload-browse btn btn-success" type="button">Upload</button>
										</span>
									</div>
								</div>
								<div class="text-right">
								<button class="btn btn-success" type="submit">Update Profile</button>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
						<div class="card-body">
							<form class="form-horizontal ajax-upload" id="change_profile_photo_form" action="{{ route('profile.change_profile_photo') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
								<div class="form-group">
									<label>Group Constitution</label>
									<input type="file" name="profile_photo" id="profile-photo" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Group Constitution">
										<span class="input-group-append">
										<button class="file-upload-browse btn btn-success" type="button">Upload</button>
										</span>
									</div>
								</div>
								<div id="change_profile_photo_form_feedback"></div>
								<div class="text-right mt-4">
								<button class="btn btn-success" type="submit" id="change_profile_photo_form_submit">Change Profile Photo</button>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="card-body">
							<hr>
							<p class="mt-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
							<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	<!-- update chairperson modal -->
	@if(isset($chairperson->user))
	<div class="modal fade" id="updateChairpersonModal" tabindex="-1" role="dialog" aria-labelledby="updateChairpersonModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateChairpersonModalLabel">Change Chairperson</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<x-account.group.update-official position="chairperson"/>
				</div>
			</div>
		</div>
	</div>
	@endif
	<!--end update chairperson modal -->
	<!-- update secretary modal -->
	@if(isset($secretary->user))
	<div class="modal fade" id="updateSecretaryModal" tabindex="-1" role="dialog" aria-labelledby="updateSecretaryModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateSecretaryModalLabel">Change Secretary</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<x-account.group.update-official position="secretary"/>
				</div>
			</div>
		</div>
	</div>
	@endif
	<!--end update secretary modal --
	<!-- update treasurer modal -->
	@if(isset($treasurer->user))
	<div class="modal fade" id="updateTreasurerModal" tabindex="-1" role="dialog" aria-labelledby="updateTreasurerModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateTreasurerModalLabel">Change Treasurer</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<x-account.group.update-official position="treasurer"/>
				</div>
			</div>
		</div>
	</div>
	@endif
	<!--end update treasurer modal -->
	
</div>
</x-app-layout>