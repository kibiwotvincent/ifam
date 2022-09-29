<div class="row mb-3">
	<div class="col-8">
		<h6 class="mt-2">Expenses ({{ count($expenses) }})</h6>
	</div>
	<div class="col-4 text-right">
		@if($canAddExpense)
			@if($isGroup)
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
				@if($canUpdateExpense || $canViewExpense)
				<th class="text-right">Action</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($expenses as $row)
			<tr>
				<td class="@if($row->trashed()) trashed @endif">{{ date('d M Y', strtotime($row['date_incurred'])) }}</td>
				<td class="@if($row->trashed()) trashed @endif">{{ number_format($row['amount'], 2) }}</td>
				<td class="@if($row->trashed()) trashed @endif">{{ $row['description'] }}</td>
				@if($canUpdateExpense || $canViewExpense)
				<td class="text-right">
					@if($isGroup)
						@if($canUpdateExpense)
						<a href="{{ route('group.update_expense', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-edit mr-15 f-16 text-success"></i></a>
						@endif
						@if($canViewExpense)
						<a href="{{ route('group.view_expense', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@endif
					@else
						@if($canViewExpense)
						<a href="{{ route('update_expense', [$season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-edit mr-15 f-16 text-success"></i></a>
						@endif
						@if($canViewExpense)
						<a href="{{ route('view_expense', [$season->department['farm_id'], $season->department['id'], $season['id'], $row['id']]) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i></a>
						@endif
					@endif
				</td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>