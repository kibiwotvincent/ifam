<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-dollar-sign bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Members Contributions</h5>
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
						<li class="breadcrumb-item">
							<a href="{{ route('view_group', $group['id']) }}">{{ $group['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Members Contributions</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card table-card bg-white">
				<div class="card-block">
					<div class="table-responsive">
	<table id="data_table" class="table">
		<thead>
			<tr>
				<th>Name</th>
				@foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $month)
				<th class="text-center">{{ $month }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($group->members as $row)
			<tr>
				<td>
				<img src="{{ $row->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$row->user['profile_photo']) }}" class="table-user-thumb mr-2" alt="">
				{{ $row->user['name'] }}
				</td>
				@for($i = 1; $i <= 12; $i++)
				<td><button class="btn">500 <i class="ik ik-x"></i></button></td>
				@endfor
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addMemberModalLabel">Add Group Member</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form class="ajax" id="add_member_form" action="{{ route('add_group_member', $group['id']) }}" method="post">
				@method('post')
				@csrf
				<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
				<input type="hidden" name="group_id" value="{{ $group['id'] }}"/>
				<div class="formgroup mb-3">
					<label for="member-id-no">Enter ID number of member to add</label>
					<div class="input-group m-0 mb-2">
						<input type="number" class="form-control" id="member-id-no" name="id_number">
						<div class="input-group-append">
							<div class="input-group-text p-0">
							<button type="submit" class="btn btn-success" style="border-radius: 0px 4px 4px 0px;" id="add_member_form_submit">Add</button>
							</div>
						</div>
					</div>
					<p class="d-none error" for="id_number"></p>
					<div id="add_member_form_feedback"></div>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>