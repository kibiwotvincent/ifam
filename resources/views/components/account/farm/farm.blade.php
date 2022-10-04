@foreach($farm->departments as $row)
<div class="col-lg-6 col-md-6 col-sm-12">
	<div class="widget">
		<div class="widget-body">
			<div class="border-bottom">
				<div class="mb-2">
					@if($farm->isOwnedByGroup)
					<a class="mb-3" href="{{ route('group.department', [$farm['farmable_id'], $farm['id'], $row['id']]) }}">
					@else
					<a class="mb-3" href="{{ route('department', [$farm['id'], $row['id']]) }}">
					@endif
					<h5 class="font-weight-bold text-muted">{{ $row->category['name'] }}</h5>
					</a>
					<div class="text-center">
					<span class="text-muted h6">Kshs </span>
					<span class="h5 font-weight-bold">{{ number_format($row->profits(), 2) }}</span> 
					<strong class="text-muted">Profit</strong>
					</div>
				</div>
			</div>
			<div class="row pt-2">
				<div class="col border-right">
					<span class="text-muted">Kshs </span>
					<span class="h6 font-weight-bold">{{ number_format($row->expenses(), 2) }}</span> 
					<strong class="text-muted">Expenses</strong>
				</div>
				<div class="col">
					<span class="text-muted">Kshs </span>
					<span class="h6 font-weight-bold">{{ number_format($row->sales(), 2) }}</span> 
					<strong class="text-muted">Sales</strong>
				</div>
			</div>
		</div>
		<div class="progress progress-sm">
			<div class="progress-bar bg-light" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
		</div>
	</div>
</div>
@endforeach