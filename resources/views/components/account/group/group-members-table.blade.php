<div class="table-responsive">
	<table id="data_tabl" class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>ID Number</th>
				<th>Position</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Contributions</th>
				<th>Status</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($group->members()->acceptedOrPending()->get() as $row)
			<tr>
				<td>
				<img src="{{ $row->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$row->user['profile_photo']) }}" class="table-user-thumb mr-2" alt="">
				{{ $row->user['name'] }}
				</td>
				<td>{{ $row->user['id_number'] }}</td>
				<td><span class="mb-0 badge badge-pill badge-{{ $row['position'] }}">{{ $row['position'] }}</span></td>
				<td>{{ $row->user['gender'] }}</td>
				<td>{{ $row->user['age'] }}</td>
				<td>{{ number_format($row->contributions()->sum('amount'), 2) }}</td>
				<td><span class="mb-0 badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
				<td class="table-action text-right">
					@if($isAdmin)
					<a href="{{ route('admin.view_group_member', [$row['group_id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
					@else
					<a href="{{ route('view_group_member', [$row['group_id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>