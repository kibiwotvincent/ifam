<div class="row mb-1">
	<div class="col-md-4">
		<h6 class="mt-2">Added On: <span class="text-muted font-weight-bold">{{ date('d M Y', strtotime($seasonRecord['record_date'])) }}</span></h6>
	</div>
	<div class="col-md-8 text-right">
		<a class="btn btn-light" href="{{ url()->previous() }}">Back</a>
		@if($seasonRecord->trashed())
			@if($canRestore)
			<button class="btn btn-success ml-2" data-toggle="modal" data-target="#restoreSeasonRecordModal" >Restore</button>
			@endif
			@if($canDestroy)
			<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#destroySeasonRecordModal" >Delete Permanently</button>
			@endif
		@else
			@if($canDelete)
			<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#deleteSeasonRecordModal" >Delete</button>
			@endif
		@endif
	</div>
</div>
<div class="card latest-update-card mx-0 mb-0 pt-3">
	<div class="card-block">
		<div class="latest-update-box">
			<div class="row pt-20 pb-30">
				<div class="col-auto text-right update-meta pr-0">
					<i class="b-succes update-ico rin ml-4 pl-3"></i>
				</div>
				<div class="col pl-5">
					<h6 class="font-weight-bold mb-3" style="text-decoration: underline;">{{ $seasonRecord['title'] }}</h6>
					<div class="text-muted mb-0">
					{!! $seasonRecord['summary'] !!}
					</div>
					<div>
						@if($seasonRecord->files->isNotEmpty())
							<p class="mb-1">Attached files:</p>
							@foreach($seasonRecord->files as $file)
								<a target="_blank" href="{{ asset('storage/'.$seasonRecord::SEASON_RECORD_FILES_FOLDER.'/'.$file['name']) }}" class="text-primary mr-4">
								{{ $file['name'] }}
								</a>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- delete season record confirmation -->
<div class="modal fade" id="deleteSeasonRecordModal" tabindex="-1" role="dialog" aria-labelledby="deleteSeasonRecordModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteSeasonRecordModalLabel">Delete Season Record</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="delete_season_record_form" action="{{ route('delete_season_record', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $seasonRecord['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="season_record_id" value="{{ $seasonRecord['id'] }}"/>
					<p>Are you sure you want to delete this season record ?</p>
					<div id="delete_season_record_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="delete_season_record_form_submit">Delete Season Record</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end delete season record confirmation -->
<!-- destroy season record confirmation -->
<div class="modal fade" id="destroySeasonRecordModal" tabindex="-1" role="dialog" aria-labelledby="destroySeasonRecordModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="destroySeasonRecordModalLabel">Permanently Delete Season Record</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="destroy_season_record_form" action="{{ route('destroy_season_record', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $seasonRecord['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="season_record_id" value="{{ $seasonRecord['id'] }}"/>
					<p>Are you sure you want to permanently delete this season record ?</p>
					<div id="destroy_season_record_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="destroy_season_record_form_submit">Permanently Delete Season Record</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end destroy season record confirmation -->
<!-- restore deleted season record confirmation -->
<div class="modal fade" id="restoreSeasonRecordModal" tabindex="-1" role="dialog" aria-labelledby="restoreSeasonRecordModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="restoreSeasonRecordModalLabel">Restore Season Record</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="restore_season_record_form" action="{{ route('restore_season_record', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $seasonRecord['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="season_record_id" value="{{ $seasonRecord['id'] }}"/>
					<p>Are you sure you want to restore this season record ?</p>
					<div id="restore_season_record_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="restore_season_record_form_submit">Restore Season Record</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end restore deleted season record confirmation -->