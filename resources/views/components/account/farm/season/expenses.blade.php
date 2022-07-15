<div class="row mb-3">
	<div class="col-8">
		<h6 class="mt-2">Expenses ({{ count($expenses) }})</h6>
	</div>
	<div class="col-4 text-right">
		@if(!$read_only)
			@if($is_group)
			<a href="{{ route('group.add_expense', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Expense</a>
			@else
			<a href="{{ route('add_expense', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Expense</a>
			@endif
		@endif
	</div>
</div>
<div class="table-responsive">
	<table class="table table-hover mb-0">
		<thead>
			<tr>
			
				<th>Date</th>
				<th>Amount</th>
				<th>Description</th>
				
				@if(!$read_only)
				<th class="text-right">Action</th>
				@endif
				
			</tr>
		</thead>
		<tbody>
			@foreach($expenses as $row)
			<tr>
			
				<td>{{ date('d M Y', strtotime($row['date_incurred'])) }}</td>
				<td>{{ number_format($row['amount'], 2) }}</td>
				<td>{{ $row['description'] }}</td>
				
				@if(!$read_only)
				<td class="text-right">
				<a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
				<a href="#"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
				</td>
				@endif
				
			</tr>
			@endforeach
		</tbody>
	</table>
</div>