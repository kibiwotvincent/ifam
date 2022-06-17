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
			@foreach($mergedSeasons as $row)
			<tr>
				<td>{{ $row->season['name'] }}</td>
				<td>{{ $row->season->department->farm['name'] }}</td>
				<td>{{ $row->season->child_category['name'] }}</td>
				<td>{{ $row->season['start_date_string'] }}</td>
				<td>{{ $row->season['end_date_string'] }}</td>
				<td>{{ number_format($row->season->total_expenses(), 2) }}</td>
				<td>{{ number_format($row->season->total_sales(), 2) }}</td>
				<td>{{ number_format($row->season->total_profits() ,2) }}</td>
				<td><span class="badge badge-pill badge-{{ $row->season['status'] }}">{{ $row->season['status'] }}</span></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>