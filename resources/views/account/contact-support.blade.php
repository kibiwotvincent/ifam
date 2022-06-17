<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-mail bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Contact Support</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Contact Support</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="forms-sample">
						<div class="form-group">
							<label for="exampleInputName1">Phone Number</label>
							<input type="text" class="form-control" id="exampleInputName1">
						</div>
						<div class="form-group">
							<label for="exampleInputName1">Subject</label>
							<input type="text" class="form-control" id="exampleInputName1">
						</div>
						<div class="form-group">
							<label for="exampleTextarea1">Message</label>
							<textarea class="form-control" id="exampleTextarea1" rows="6"></textarea>
						</div>
						
						<div class="text-right">
							<a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
							<button type="submit" class="btn btn-success mr-2">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</x-app-layout>