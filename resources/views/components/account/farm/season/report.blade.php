<div class="table-responsive">
	<table class="table table-hover mb-0">
		<thead>
			<tr>
				<th>Date</th>
				<th>Type</th>
				<th>Amount</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sales_and_expenses as $row)
			<tr>
				<td>{{ date('d M Y', strtotime($row['date'])) }}</td>
				@if($row['type'] == "expense")
				<td><span class="badge badge-pill badge-info">{{ $row['type'] }}<span></td>
				@else
				<td><span class="badge badge-pill badge-success">{{ $row['type'] }}<span></td>
				@endif
				<td>{{ number_format($row['amount'], 2) }}</td>
				<td>{{ $row['description'] }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>