<div class="table-responsive">
	<table class="table table-hover mb-0" id="datatable">
		<thead>
			<tr>
				<th>Season</th>
				<th>Farm</th>
				<th>Crop</th>
				<th>From</th>
				<th>To</th>
				<th>Expenses</th>
				<th>Sales</th>
				<th>Profit</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($seasons as $row)
			<tr>
				<td>{{ $row['name'] }}</td>
				<td>{{ $row->department->farm['name'] }}</td>
				<td>{{ $row->child_category['name'] }}</td>
				<td>{{ $row['start_date_string'] }}</td>
				<td>{{ $row['end_date_string'] }}</td>
				<td>{{ number_format($row->total_expenses(), 2) }}</td>
				<td>{{ number_format($row->total_sales(), 2) }}</td>
				<td>{{ number_format($row->total_profits() ,2) }}</td>
				<td><span class="badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>