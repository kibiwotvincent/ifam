<div class="row mb-3">
	<div class="col-8">
		<h6 class="mt-2">Sales ({{ count($sales) }})</h6>
	</div>
	<div class="col-4 text-right">
		@if($canAddSale)
			@if($isGroup)
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
				@if($canUpdateSale || $canViewSale)
				<th class="text-right">Action</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($sales as $row)
			<tr>
				<td class="@if($row->trashed()) trashed @endif">{{ date('d M Y', strtotime($row['sale_date'])) }}</td>
				<td class="@if($row->trashed()) trashed @endif">{{ $row['expected_amount'] == "" ? '--' : number_format($row['expected_amount'], 2) }}</td>
				<td class="@if($row->trashed()) trashed @endif">{{ $row['amount_paid'] == "" ? '--' : number_format($row['amount_paid'], 2) }}</td>
				<td class="@if($row->trashed()) trashed @endif">{{ $row['description'] }}</td>
				<td class="@if($row->trashed()) trashed @endif"><span class="badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
				@if($canUpdateSale || $canViewSale)
				<td class="text-right">
					@if($isGroup)
						@if($canUpdateSale)
						<a href="{{ route('group.update_sale', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-edit mr-15 f-16 text-success"></i></a>
						@endif
						@if($canViewSale)
						<a href="{{ route('group.view_sale', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@endif
					@else
						@if($canViewSale)
						<a href="{{ route('update_sale', [$season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-edit mr-15 f-16 text-success"></i></a>
						@endif
						@if($canViewSale)
						<a href="{{ route('view_sale', [$season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@endif
					@endif
				</td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>