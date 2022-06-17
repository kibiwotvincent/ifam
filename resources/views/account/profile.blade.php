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
						<img src="/assets/img/user.jpg" class="rounded-circle" width="150" />
						<h4 class="card-title mt-10">John Doe</h4>
						<p class="card-subtitle">ID No: 31185987</p>
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
						<a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Profile Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Notification Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Change Password</a>
					</li>
					
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
						<div class="card-body">
							<form class="form-horizontal">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="example-name">First Name</label>
											<input type="text" placeholder="Johnathan Doe" class="form-control" name="example-name" id="example-name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="example-name">Last Name</label>
											<input type="text" placeholder="Johnathan Doe" class="form-control" name="example-name" id="example-name">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="example-email">Email</label>
									<input type="email" placeholder="johnathan@admin.com" class="form-control" name="example-email" id="example-email">
								</div>
								<div class="form-group">
									<label for="example-password">ID Number</label>
									<input type="password" value="password" class="form-control" name="example-password" id="example-password">
								</div>
								<div class="form-group">
									<label for="example-phone">Phone Number</label>
									<input type="text" placeholder="123 456 7890" id="example-phone" name="example-phone" class="form-control">
								</div>
								<div class="text-right">
								<button class="btn btn-success" type="submit">Update Profile</button>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
						<div class="card-body">
							
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
</div>
</x-app-layout>