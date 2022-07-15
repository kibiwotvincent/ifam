<div class="row mb-3">
	<div class="col-8">
		<h6 class="mt-2">Sales ({{ count($sales) }})</h6>
	</div>
	<div class="col-4 text-right">
		@if(!$read_only)
			@if($is_group)
			<a href="{{ route('group.add_sale', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Sale</a>
			@else
			<a href="{{ route('add_sale', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Sale</a>
			@endif
		@endif
	</div>
</div>
<div class="table-responsive">
	<table class="table table-hover mb-0">
		<thead>
			<tr>
			
				<th>Date</th>
				<th>Expected Amount</th>
				<th>Amount Paid</th>
				<th>Description</th>
				<th>Status</th>
				
				@if(!$read_only)
				<th class="text-right">Action</th>
				@endif
				
			</tr>
		</thead>
		<tbody>
			@foreach($sales as $row)
			<tr>
			
				<td>{{ date('d M Y', strtotime($row['sale_date'])) }}</td>
				<td>{{ number_format($row['expected_amount'], 2) }}</td>
				@if($row['amount_paid'] == "")
				<td>--</td>
				@else
				<td>{{ number_format($row['amount_paid'], 2) }}</td>
				@endif
				<td>{{ $row['description'] }}</td>
				@if($row['status'] == "paid")
				<td><span class="badge badge-pill badge-success">{{ $row['status'] }}</span></td>
				@else
				<td><span class="badge badge-pill badge-warning">{{ $row['status'] }}</span></td>
				@endif
				
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