@foreach($farms as $row)
<div class="col-md-6">
	<div class="card proj-t-card" stylee="min-height: 205px;">
		<div class="card-body">
			<div class="row">
				<div class="col-6">
					<a class="h6 font-weight-bold" href="{{ route('view_farm', $row['id']) }}">{{ $row['name'] }}</a>
				</div>
				<div class="col-6 text-right">
					<div class="dropdown d-inline-block">
						<a style="padding: 10px; border-radius: 4px;" class="border dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						
						<span class="text-muted font-weight-bold pb-1">Farm Departments <i class="ik ik-chevron-down"></i></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
							@foreach($row->departments as $department)
							<a class="dropdown-item" href="{{ route('department', [$row['id'], $department['id']]) }}">{{ $department->category['name'] }}</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col pl-0 mx-3">
					<p>
					Added On <span class="text-muted">{{ $row->created_at->format('d M Y') }}</span>
					@if($row->trashed())
						<span class="badge badge-pill badge-danger py-1 ml-1">Deleted</deleted>
					@endif
					</p>
					<div style="min-height: 50px;">
					<p>{{ $row['description'] }}</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<a href="{{ route('update_farm', $row['id']) }}">
						<span class="badge badge-pill badge-info"><i class="ik ik-edit"></i> Edit Farm</span>
					</a>
				</div>
				<div class="col-6 text-right">
					<a href="{{ route('farm.report', $row['id']) }}">
						<span class="badge badge-pill badge-success"><i class="ik ik-bar-chart-2"></i> Farm Report</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach