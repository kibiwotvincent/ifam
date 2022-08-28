<div class="row mb-3">
	<div class="col-8">
		<h6 class="mt-2">Season Records ({{ count($records) }})</h6>
	</div>
	<div class="col-4 text-right">
		@if(!$read_only)
			@if($is_group)
			<a href="{{ route('group.add_season_record', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Record</a>
			@else
			<a href="{{ route('add_season_record', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Record</a>
			@endif
		@endif
	</div>
</div>
<div class="table-responsive">
	<table class="table table-hover mb-0">
		<thead>
			<tr>
			
				<th>Record Date</th>
				<th>Title</th>
				<th>Attached Files</th>
				
				@if(!$read_only)
				<th class="text-right">Action</th>
				@endif
				
			</tr>
		</thead>
		<tbody>
			@foreach($records as $row)
			<tr>
				<td>{{ date('d M Y', strtotime($row['record_date'])) }}</td>
				<td>{{ $row['title'] }}</td>
				<td><span class="badge badge-pill badge-light">{{ count($row->files) }}</span></td>
				
				@if(!$read_only)
				<td class="text-right">
				<a href="#!"><i class="ik ik-edit f-16 mr-15 text-success"></i></a>
				<a href="#"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
				</td>
				@endif
				
			</tr>
			@endforeach
		</tbody>
	</table>
</div>