<header class="header-top" header-theme="light">
	<div class="container-fluid">
		<div class="d-flex justify-content-between">
			<div class="top-menu d-flex align-items-center">
				<button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
				<div class="d-none d-sm-inline">
					<div class="input-group m-0 ml-3">
						<input type="text" class="form-control" placeholder="Search">
						<div class="input-group-append">
							<div class="input-group-text"><i class="ik ik-search"></i></div>
						</div>
					</div>
				</div>
			</div>
			<div class="top-menu d-flex align-items-center">
				<span class="mr-10">Hello, {{ $user['first_name'] }} </span>  
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="/assets/img/user.jpg" alt="profile"></a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i> Profile</a>
						<a class="dropdown-item" href="#"><i class="ik ik-settings dropdown-icon"></i> Settings</a>
						<form action="{{ route('logout') }}" method="post">
						@csrf
						<button class="dropdown-item"><i class="ik ik-power dropdown-icon"></i> Logout</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</header>