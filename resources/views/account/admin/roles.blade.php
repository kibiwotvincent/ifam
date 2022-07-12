<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-sliders bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Roles & Permissions</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Admin</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Roles & Permissions</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="card">
			<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-permissions-tab" data-toggle="pill" href="#permissions" role="tab" aria-controls="pills-permissions" aria-selected="false">Permissions ({{ count($permissions) }})</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-roles-tab" data-toggle="pill" href="#roles" role="tab" aria-controls="pills-roles" aria-selected="true">Roles ({{ count($roles) }})</a>
				</li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="permissions" role="tabpanel" aria-labelledby="pills-permissions-tab">
					<div class="card-body">
						<div class="col-12 text-right mb-2">
							<a href="#" data-toggle="modal" data-target="#createPermissionModal" class="btn btn-success"><i class="ik ik-plus-circle"></i> Create New Permission</a>
						</div>
						<div class="row">
							@foreach($permissions as $row)
							<div class="col-sm-3 mb-2">
							<h6 class="d-inline">{{ $row->name }}</h6>
							<button style="border: none; background: transparent;" data-toggle="modal" data-target="#deletePermission{{ $row['id'] }}Modal"><i class="ik ik-trash-2"></i></button>
							</div>
							
							<div class="modal fade" id="deletePermission{{ $row['id'] }}Modal" tabindex="-1" role="dialog" aria-labelledby="deletePermission{{ $row['id'] }}ModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="deletePermission{{ $row['id'] }}ModalLabel">Confirm Delete Permission</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
										<form class="ajax" id="delete_permission_{{ $row['id'] }}_form" action="{{ route('admin.permissions.delete', $row['id']) }}" method="post">
											@csrf
											<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
											<input type="hidden" name="permission_id" value="{{ $row['id'] }}" >
											<h6 class="py-2">Are you sure you want to delete `{{ $row['name'] }}` permission?</h6>
											<p class="d-none error" for="permission_id"></p>
											<div id="delete_permission_{{ $row['id'] }}_form_feedback"></div>
											<div class="text-right">
												<a class="btn btn-light mr-2" href="#" data-dismiss="modal">Cancel</a>
												<button type="submit" class="btn btn-danger" id="delete_permission_{{ $row['id'] }}_form_submit">Delete</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</div>
							
							@endforeach
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="pills-roles-tab">
					<div class="card-body">
						<div class="col-12 text-right">
							<a href="#" data-toggle="modal" data-target="#createRoleModal" class="btn btn-success"><i class="ik ik-plus-circle"></i> Create New Role</a>
						</div>
						<div class="row">
							@foreach($roles as $row)
							<div class="col-6 col-sm-3 col-md-4 col-lg-2 mt-4">
							<a href="{{ route('admin.roles.view', $row['id']) }}" class="h6 d-inline"><i class="ik ik-chevrons-right"></i> {{ $row->name }}</a>
							</div>
							
							<div class="modal fade" id="deleteRole{{ $row['id'] }}Modal" tabindex="-1" role="dialog" aria-labelledby="deleteRole{{ $row['id'] }}ModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="deleteRole{{ $row['id'] }}ModalLabel">Confirm Delete Role</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
										<form class="ajax" id="delete_role_{{ $row['id'] }}_form" action="{{ route('admin.roles.store') }}" method="post">
										@csrf
										<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
										<h6 class="py-2">Are you sure you want to delete `{{ $row['name'] }}` role?</h6>
										<div id="delete_role_{{ $row['id'] }}_form_feedback"></div>
										<div class="text-right">
											<a class="btn btn-light mr-2" href="#" data-dismiss="modal">Cancel</a>
											<button type="submit" class="btn btn-danger" id="delete_role_{{ $row['id'] }}_form_submit">Delete</button>
										</div>
										</form>
										</div>
									</div>
								</div>
							</div>
							
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="createPermissionModalLabel">Create Permission</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form class="ajax" id="create_permission_form" action="{{ route('admin.permissions.store') }}" method="post">
				@csrf
				<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
				<div class="formgroup mb-3">
					<label for="permission-name">Enter permission name</label>
					<div class="input-group m-0 mb-2">
						<input type="text" class="form-control" id="permission-name" name="name" required>
						<div class="input-group-append">
							<div class="input-group-text p-0">
							<button type="submit" class="btn btn-success" style="border-radius: 0px 4px 4px 0px;" id="create_permission_form_submit">Create</button>
							</div>
						</div>
					</div>
					<p class="d-none error" for="name"></p>
					<div id="create_permission_form_feedback"></div>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="createRoleModalLabel">Create Role</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form class="ajax" id="create_role_form" action="{{ route('admin.roles.store') }}" method="post">
				@csrf
				<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
				<div class="formgroup mb-3">
					<label for="role-name">Enter role name</label>
					<div class="input-group m-0 mb-2">
						<input type="text" class="form-control" id="role-name" name="name" required>
						<div class="input-group-append">
							<div class="input-group-text p-0">
							<button type="submit" class="btn btn-success" style="border-radius: 0px 4px 4px 0px;" id="create_role_form_submit">Create</button>
							</div>
						</div>
					</div>
					<p class="d-none error" for="name"></p>
					<div id="create_role_form_feedback"></div>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>