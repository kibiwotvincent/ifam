<div class="card table-card">
	<div class="card-header">
		<h3>Seasons ({{ count($department->seasons) }})</h3>
		<div class="card-header-right">
			@if($is_group)
			<a href="{{ route('group.add_season', [$farm->farmable['id'], $farm['id'], $department['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Season</a>
			@else
			<a href="{{ route('add_season', [$farm['id'], $department['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Season</a>
			@endif
		</div>
	</div>
	<div class="card-block">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead>
					<tr>
						<th>Season</th>
						<th>Crop</th>
						<th>Started On</th>
						<th>Ended On</th>
						<th>Expenses</th>
						<th>Sales</th>
						<th>Profit</th>
						<th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($department->seasons as $row)
					<tr>
						<td>
						@if($is_group)
						<a href="{{ route('group.view_season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}">{{ $row['name'] }}</a>
						@else
						<a href="{{ route('view_season', [$farm['id'], $department['id'], $row['id']]) }}">{{ $row['name'] }}</a>
						@endif
						</td>
						<td>{{ $row->child_category['name'] }}</td>
						<td>{{ $row['start_date_string'] }}</td>
						<td>{{ $row['end_date_string'] }}</td>
						<td>{{ number_format($row->expenses->sum('amount'), 2) }}</td>
						<td>{{ number_format($row->sales()->paid()->sum('amount_paid'), 2) }}</td>
						<td>{{ number_format($row->sales()->paid()->sum('amount_paid') - $row->expenses->sum('amount') ,2) }}</td>
						<td><span class="badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
						<td class="table-action text-right">
						@if($is_group)
						<a href="{{ route('group.update_season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-edit f-16 mr-15 text-success"></i></a>
						<a href="{{ route('group.view_season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@else
						<a href="{{ route('update_season', [$farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-edit f-16 mr-15 text-success"></i></a>
						<a href="{{ route('view_season', [$farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>