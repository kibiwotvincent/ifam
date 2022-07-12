<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-users bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Users</h5>
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
						<li class="breadcrumb-item active" aria-current="page">Users</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>Users ({{ count($users) }})</h3>
					<div class="card-header-right">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<div class="input-group-append">
								<div class="input-group-text"><i class="ik ik-search"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-block">
					<div class="table-responsive">
						<table id="data_tabl" class="table">
							<thead>
								<tr>
									<th>Avatar</th>
									<th>Name</th>
									<th>Phone Number</th>
									<th>ID Number</th>
									<th>Gender</th>
									<th>Roles</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $row)
								<tr>
									<td><img src="{{ $row['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$row['profile_photo']) }}" class="table-user-thumb" alt=""></td>
									<td>{{ $row['name'] }}</td>
									<td>{{ $row['phone_number'] }}</td>
									<td>{{ $row['id_number'] }}</td>
									<td>{{ $row['gender'] }}</td>
									<td><span class="badge badge-light">{{ implode(', ', $row->getRoleNames()->toArray()) }}</span></td>
									<td class="table-action text-right">
										<a href="#" class="text-success" data-toggle="modal" data-target="#updateUser{{ $row['id'] }}Modal"><i class="ik ik-sliders"></i></a>
										
										<div class="modal fade text-left" id="updateUser{{ $row['id'] }}Modal" tabindex="-1" role="dialog" aria-labelledby="updateUser{{ $row['id'] }}ModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="updateUser{{ $row['id'] }}ModalLabel">Update User</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													</div>
													<div class="modal-body">
													<form class="ajax" id="update_user_{{ $row['id'] }}_form" action="{{ route('admin.users.update.role', $row['id']) }}" method="post">
														@csrf
														<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
														<input type="hidden" name="user_id" value="{{ $row['id'] }}" >
														<h6>Select user role</h6>
														<div class="row mb-2 border-checkbox-section">
															@foreach($roles as $role)
															<div class="col-4 mb-2">
																<div class="border-checkbox-group border-checkbox-group-success">
																	<input class="border-checkbox" type="checkbox" id="role-{{ $role['id'] }}-{{ $row['id'] }}" name="roles[]" value="{{ $role['name'] }}" 
																	@if($row->hasRole($role['name'])) checked="checked" @endif
																	>
																	<label class="border-checkbox-label" for="role-{{ $role['id'] }}-{{ $row['id'] }}">{{ $role['name'] }}</label>
																</div>
															</div>
															@endforeach
														</div>
														<p class="d-none error" for="roles"></p>
														
														<div id="update_user_{{ $row['id'] }}_form_feedback"></div>
														<div class="text-right">
															<a class="btn btn-light mr-2" href="#" data-dismiss="modal">Cancel</a>
															<button type="submit" class="btn btn-success" id="update_user_{{ $row['id'] }}_form_submit">Update User</button>
														</div>
													</form>
													</div>
												</div>
											</div>
										</div>
										
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>