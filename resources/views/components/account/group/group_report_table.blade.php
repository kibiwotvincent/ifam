@if(count($groupStats) == 0)
<div class="alert alert-info mt-3 mx-3" role="alert">Nothing to display!</div>
@else
<div class="row">
	<div class="col my-3 mr-2 text-right">
		<div class="dropdown">
			<a style="padding: 10px 15px; border-radius: 4px;" class="border-0 dropdown-toggle bg-success text-white" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Download <i class="ik ik-chevron-down"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
				<a class="dropdown-item" href="#">Excel</a>
				<a class="dropdown-item" href="#">PDF</a>
			</div>
		</div>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-hover mb-0" id="datatable">
		<thead>
			<tr>
				<th>Farmer</th>
				<th>Category</th>
				<th>Expenses</th>
				<th>Sales</th>
				<th>Profit</th>
			</tr>
		</thead>
		<tbody>
			@foreach($groupStats as $row)
			<tr>
				<td>
				@if($row['farmer_type'] == "group")
					@if($isAdmin)
						<a href="{{ route('admin.group_only_report', $group['id']) }}">{{ $row['farmer_name'] }}</a>
					@else
						<a href="{{ route('group_only_report', $group['id']) }}">{{ $row['farmer_name'] }}</a>
					@endif
				@else
					@if($isAdmin)
					<a href="{{ route('admin.group_member_report', [$group['id'], $row['farmer_id']]) }}">{{ $row['farmer_name'] }}</a>
					@else
					<a href="{{ route('group_member_report', [$group['id'], $row['farmer_id']]) }}">{{ $row['farmer_name'] }}</a>
					@endif
				@endif
				</td>
				<td>{{ $row['farmer_child_categories'] }}</td>
				<td>{{ number_format($row['data']['expenses'], 2) }}</td>
				<td>{{ number_format($row['data']['sales'], 2) }}</td>
				<td>{{ number_format($row['data']['profit'], 2) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endif