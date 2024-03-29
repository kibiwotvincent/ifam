<div class="card table-card">
	<div class="card-header">
		<h3>Seasons ({{ count($seasons) }})</h3>
		@if($canAddSeason)
		<div class="card-header-right">
			@if($page == "group")
			<a href="{{ route('group.add_season', [$farm->farmable['id'], $farm['id'], $department['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Season</a>
			@else
			<a href="{{ route('add_season', [$farm['id'], $department['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Season</a>
			@endif
		</div>
		@endif
	</div>
	<div class="card-block">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead>
					<tr>
						<th>Season</th>
						<th>Crop</th>
						<th>Start Date</th>
						<th>Expenses</th>
						<th>Sales</th>
						<th>Profit</th>
						<th>Status</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($seasons as $row)
					<tr>
						<td class="@if($row->trashed()) trashed @endif">{{ $row['name'] }}</td>
						<td class="@if($row->trashed()) trashed @endif">{{ $row->child_category['name'] }}</td>
						<td class="@if($row->trashed()) trashed @endif">{{ $row->start_date->format('d M Y') }}</td>
						<td class="@if($row->trashed()) trashed @endif">{{ number_format($row->expenses->sum('amount'), 2) }}</td>
						<td class="@if($row->trashed()) trashed @endif">{{ number_format($row->sales()->paid()->sum('amount_paid'), 2) }}</td>
						<td class="@if($row->trashed()) trashed @endif">{{ number_format($row->sales()->paid()->sum('amount_paid') - $row->expenses->sum('amount') ,2) }}</td>
						<td class="@if($row->trashed()) trashed @endif"><span class="badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
						<td class="text-right">
						@if($page == "group")
						<a href="{{ route('group.view_season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-eye mr-10 f-16 text-success"></i></a>
						<a href="{{ route('group.update_season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-edit mr-10 f-16 text-success"></i></a>
						<a href="{{ route('group.season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@elseif($page == "admin")
						<a href="{{ route('admin.group.view_season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-eye mr-10 f-16 text-success"></i></a>
						<a href="{{ route('admin.group.season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@elseif($page == "admin.farmer")
						<a href="{{ route('admin.farmer.view_season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-eye mr-10 f-16 text-success"></i></a>
						<a href="{{ route('admin.farmer.season', [$farm->farmable['id'], $farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@elseif($page == "farmer")
						<a href="{{ route('view_season', [$farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-eye mr-10 f-16 text-success"></i></a>
						<a href="{{ route('update_season', [$farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-edit mr-10 f-16 text-success"></i></a>
						<a href="{{ route('season', [$farm['id'], $department['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>