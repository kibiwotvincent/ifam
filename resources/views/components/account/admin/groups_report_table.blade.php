<div class="table-responsive">
	<table class="table table-hover mb-0" id="datatable">
		<thead>
			<tr>
				<th>Group</th>
				<th>Crop</th>
				<th>From</th>
				<th>To</th>
				<th>Expenses</th>
				<th>Sales</th>
				<th>Profit</th>
			</tr>
		</thead>
		<tbody>
			@foreach($groups as $group)
			<tr>
				<td><a href="{{ route('admin.group_report', $group['id']) }}">{{ $group['name'] }}</a></td>
				<td>{{ $group['group_child_categories'] }}</td>
				<td>{{ '01 May 2022' }}</td>
				<td>{{ '31 May 2022' }}</td>
				<td>{{ number_format($group['data']['expenses'], 2) }}</td>
				<td>{{ number_format($group['data']['sales'], 2) }}</td>
				<td>{{ number_format($group['data']['profit'], 2) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>