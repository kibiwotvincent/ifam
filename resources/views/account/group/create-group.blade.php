<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-plus bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Create Group</h5>
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
						<li class="breadcrumb-item active" aria-current="page">Create Group</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="ajax" id="create_group_form" action="{{ route('create_group') }}" method="post">
						@method('post')
						@csrf
						<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
						<div class="form-group">
							<label for="group-name">Name * </label>
							<input type="text" class="form-control" id="group-name" name="name">
							<p class="d-none error" for="amount"></p>
						</div>
						<div class="form-group">
							<label for="group-logo">Logo</label>
							<input type="file" class="form-control" id="group-logo" name="logo">
							<p class="d-none error" for="logo"></p>
						</div>
						
						<div id="create_group_form_feedback"></div>
						
						<div class="text-right">
							<a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
							<button type="submit" class="btn btn-success mr-2" id="create_group_form_submit">Create</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>