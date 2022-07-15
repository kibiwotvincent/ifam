<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-user bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Profile</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Profile</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-4 col-md-5">
			<div class="card">
				<div class="card-body">
					<div class="text-center "> 
						<img src="{{ $user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$user['profile_photo']) }}" class="rounded-circle" width="150" />
						<h4 class="card-title mt-10">{{ $user['name'] }}</h4>
						<p class="card-subtitle">ID No: {{ $user['id_number'] }}</p>
					</div>
				</div>
				<hr class="mb-0"> 
				<div class="card-body mb-20"> 
					<small class="text-muted d-block pt-10">Phone Number</small>
					<h6>{{ $user['phone_number'] ? $user['phone_number'] : '--' }}</h6> 
					<small class="text-muted d-block">Email Address </small>
					<h6>{{ $user['email'] ? $user['email'] : '--' }}</h6>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-7">
			<div class="card">
				<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Profile Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Change Profile Photo</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Change Password</a>
					</li>
					
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
						<div class="card-body">
							<form class="form-horizontal ajax" id="update_profile_form" action="{{ route('profile') }}" method="post">
								@csrf
								<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="first-name">First Name</label>
											<input type="text" value="{{ $user['first_name'] }}" class="form-control" name="first_name" id="first-name">
											<p class="d-none error" for="first_name"></p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="last-name">Last Name</label>
											<input type="text" value="{{ $user['last_name'] }}" class="form-control" name="last_name" id="last-name">
											<p class="d-none error" for="last_name"></p>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" value="{{ $user['email'] }}" class="form-control" name="email" id="email">
									<p class="d-none error" for="email"></p>
								</div>
								<div class="form-group">
									<label for="phone-number">Phone Number</label>
									<input type="text" value="{{ $user['phone_number'] }}" class="form-control" name="phone_number" id="phone-number">
									<p class="d-none error" for="phone_number"></p>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="date-of-birth">Date of Birth</label>
											<input type="date" value="{{ $user['date_of_birth']->format('Y-m-d') }}" class="form-control" name="date_of_birth" id="date-of-birth">
											<p class="d-none error" for="date_of_birth"></p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="gender">Select Gender</label>
											<div class="form-radio">
												<div class="radio radio-success radio-inline">
													<label>
														<input type="radio" name="gender" value="Male" @if($user['gender'] == "Male") checked="checked" @endif>
														<i class="helper"></i>Male
													</label>
												</div>
												<div class="radio radio-success radio-inline">
													<label>
														<input type="radio" name="gender" value="Female" @if($user['gender'] == "Female") checked="checked" @endif>
														<i class="helper"></i>Female
													</label>
												</div>
											</div>
											<p class="d-none error" for="gender"></p>
										</div>
									</div>
								</div>
								<div id="update_profile_form_feedback"></div>
								<div class="text-right">
								<button class="btn btn-success" type="submit" id="update_profile_form_submit">Update Profile</button>
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
									<label>Select Profile Photo</label>
									<input type="file" name="profile_photo" id="profile-photo" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Profile Photo">
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
							<form class="form-horizontal ajax" id="change_password_form" action="{{ route('profile.change_password') }}" method="post">
								@csrf
								<input type="hidden" name="_redirect" value="{{ route('login') }}" >
								<div class="form-group">
									<label for="current-password">Current Password</label>
									<input type="text" class="form-control" name="current_password" id="current-password">
									<p class="d-none error" for="current_password"></p>
								</div>
								<div class="form-group">
									<label for="new-password">New Password</label>
									<input type="password" class="form-control" name="new_password" id="new-password">
									<p class="d-none error" for="new_password"></p>
								</div>
								<div class="form-group">
									<label for="confirm-new-password">Confirm New Password</label>
									<input type="password" class="form-control" name="new_password_confirmation" id="confirm-new-password">
									<p class="d-none error" for="new_password_confirmation"></p>
								</div>
								<div id="change_password_form_feedback"></div>
								<div class="text-right">
								<button class="btn btn-success" type="submit" id="change_password_form_submit">Change Password</button>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
</x-app-layout>