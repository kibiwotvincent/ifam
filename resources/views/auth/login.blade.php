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
				<h3>Sign In</h3>
				<form class="ajax" id="login_form" action="{{ route('login') }}" method="post">
					@csrf
					<input type="hidden" name="_redirect" value="{{ route('dashboard') }}" />
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Email" name="email" required="">
						<i class="ik ik-mail"></i>
						<p class="d-none error" for="email"></p>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" name="password" required="">
						<i class="ik ik-lock"></i>
						<p class="d-none error" for="password">g</p>
					</div>
					<div class="row">
						<div class="col text-left">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="remember_checkbox" name="remember" value="1">
								<span class="custom-control-label pt-1">&nbsp;Remember Me</span>
							</label>
						</div>
						<div class="col text-right">
							<a href="{{ route('forgot_password') }}">Forgot Password ?</a>
						</div>
					</div>
					<div id="login_form_feedback"></div>
					<div class="sign-btn text-center">
						<button type="submit" class="btn btn-success" id="login_form_submit">Sign In</button>
					</div>
				</form>
				<div class="register">
					<p>Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
</x-auth-layout>