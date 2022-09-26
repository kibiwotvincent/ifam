<div class="row">
	<div class="col-8">
		<h6 class="mt-2">Season Records ({{ count($records) }})</h6>
	</div>
	<div class="col-4 text-right">
		@if(!$read_only)
			@if($is_group)
			<a href="{{ route('group.add_season_record', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Record</a>
			@else
			<a href="{{ route('add_season_record', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Record</a>
			@endif
		@endif
	</div>
	
	<div class="col-md-12 p-0">
		<div class="card latest-update-card mt-4 mx-0 mb-0">
			<div class="card-block">
				<div class="latest-update-box">
					@foreach($records as $row)
						<div class="row pt-20 pb-30">
							<div class="col-auto text-right update-meta pr-0">
								<i class="b-success update-icon ring"></i>
							</div>
							<div class="col pl-5">
								<span>{{ date('d M Y', strtotime($row['record_date'])) }}</span>
								<a href="#!">
									<h6 class="text-muted font-weight-bold mt-2" style="text-decoration: underline;">{{ $row['title'] }}</h6>
								</a>
								<div class="text-muted mb-0">
								{!! $row['summary'] !!}
								</div>
								<div>
									@if($row->files->isNotEmpty())
										<p class="mb-1">Attached files:</p>
										@foreach($row->files as $file)
											<a target="_blank" href="{{ asset('storage/season-record-files/'.$file['name']) }}" class="text-primary mr-4">
											{{ $file['name'] }}
											</a>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>