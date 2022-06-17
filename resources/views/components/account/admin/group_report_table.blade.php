<div class="table-responsive">
	<table class="table table-hover mb-0" id="datatable">
		<thead>
			<tr>
				<th>Farmer</th>
				<th>Crop</th>
				<th>From</th>
				<th>To</th>
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
					<a href="{{ route('admin.group_only_report', $group['id']) }}">{{ $row['farmer_name'] }}</a>
				@else
					<a href="{{ route('admin.group_member_report', [$group['id'], $row['farmer_id']]) }}">{{ $row['farmer_name'] }}</a>
				@endif
				</td>
				<td>{{ $row['farmer_child_categories'] }}</td>
				<td>{{ '25 April 2022' }}</td>
				<td>{{ '25 May 2022' }}</td>
				<td>{{ number_format($row['data']['expenses'], 2) }}</td>
				<td>{{ number_format($row['data']['sales'], 2) }}</td>
				<td>{{ number_format($row['data']['profit'], 2) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>