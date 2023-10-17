<x-auth-layout>
<div class="container-fluid h-100">
	<div class="row flex-row h-100 bg-white">
		<div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
			<div class="lavalite-bg px-3" style="background-image: url('/assets/img/auth/green.jpg')">
				<div class="lavalite-overlay">
					<div class="text-center" style="padding-top: 25%;">
						<p class="text-white" style="text-transform: uppercase;">Farm management made easy!</p>
						<h1 class="text-white font-weight-bold" style="font-size: 3rem;">Make data. Make sense.</h1>
						<h3 class="text-white font-weight-bold" style="font-size: 1.5rem">We provide a platform to track everything in the farm right from planting to harvesting.</h3>
						<div class="row" style="margin-top: 96px;">
							<div class="col-12">
								<ul class="m-0 p-0">
								  <li class="d-inline-block mx-2">
									<a href="#" class="text-success">Terms & Conditions</a>
								  </li>
								  <li class="d-inline-block mx-2">
									<a href="#" class="text-success">Privacy Policy</a>
								  </li>
								  <li class="d-inline-block ml-2">
									<a href="#" class="text-success">Contact Us</a>
								  </li>
								</ul>
							</div>
							<div class="col-12 mt-20">
								<a href="#" class="text-white mx-2">© 2022 iFam. All rights reserved.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
			<div class="authentication-form mx-auto">
				<div class="logo-centered">
					<a href="{{ route('index') }}"><img src="/assets/img/ifam-square.png" width="80" height="80" alt=""></a>
				</div>
				<h3>Forgot Password</h3>
				<p>Password reset code will be sent to your email.</p>
				<form method="post" action="{{ route('forgot_password') }}">
					@method('post')
					@csrf
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Email" required="">
						<i class="ik ik-mail"></i>
					</div>
					<div class="sign-btn text-center">
						<button class="btn btn-success">Submit</button>
					</div>
				</form>
				<div class="register">
					<p>Not a member? <a href="{{ route('register') }}">Create an account</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
</x-auth-layout>