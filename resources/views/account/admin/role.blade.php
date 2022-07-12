<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-4">
				<div class="page-header-title">
					<i class="ik ik-sliders bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $role['name'] }}</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Admin</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('admin.roles') }}">Roles & Permissions</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('admin.roles') }}">Roles</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $role['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row mb-1">
		<div class="col-md-7">
			<h6 class="mt-3">{{ $role['name'] }}</h6>
		</div>
		<div class="col-md-5 text-right">
			<a href="#" data-toggle="modal" data-target="#deleteRoleModal" class="btn btn-danger ml-3" style="margin-top: 2px"><i class="ik ik-trash-2"></i> Delete Role</a>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="ajax" id="update_role_form" action="{{ route('admin.roles.update', $role['id']) }}" method="post">
						@csrf
						<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
						
						<div class="row">
							@foreach($permissions as $row)
							<div class="col-sm-3">
								<div class="form-group">
									<div class="border-checkbox-section pt-1">
										<div class="border-checkbox-group border-checkbox-group-success">
											<input class="border-checkbox" type="checkbox" id="permission-{{ $row['id'] }}" name="permissions[]" value="{{ $row['name'] }}"
											@if(in_array($row['name'], $role_permissions)) checked @endif
											>
											<label class="border-checkbox-label" for="permission-{{ $row['id'] }}">{{ $row['name'] }}</label>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<p class="d-none error" for="permissions"></p>
						<div id="update_role_form_feedback"></div>
						
						<div class="text-right">
							<button type="submit" class="btn btn-success mr-2" id="update_role_form_submit">Update Role</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteRoleModalLabel">Confirm Delete Role</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form class="ajax" id="delete_role_form" action="{{ route('admin.roles.delete', $role['id']) }}" method="post">
				@csrf
				<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
				<input type="hidden" name="role_id" value="{{ $role['id'] }}" >
				<h6 class="py-2">Are you sure you want to delete `{{ $role['name'] }}` role?</h6>
				<p class="d-none error" for="role_id"></p>
				<div id="delete_role_form_feedback"></div>
				<div class="text-right">
					<a class="btn btn-light mr-2" href="#" data-dismiss="modal">Cancel</a>
					<button type="submit" class="btn btn-danger" id="delete_role_form_submit">Delete</button>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>