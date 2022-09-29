<div class="card">
	<div class="card-body">
		<form class="ajax-upload" id="add_season_record_form" action="{{ route('update_season_record', [$season->department->farm['id'], $season['farm_department_id'], $season['id'], $seasonRecord['id']]) }}" method="post">
			@csrf
			<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
			<input type="hidden" name="season_record_id" value="{{ $seasonRecord['id'] }}" >
			
			<div class="form-group">
				<label for="title">Title *</label>
				<input type="text" class="form-control" id="title" name="title" value="{{ $seasonRecord['title'] }}" required>
				<p class="d-none error" for="title"></p>
			</div>
			<div class="form-group">
				<label for="summary">Summary *</label>
				<textarea class="form-control html-editor" rows="4" id="summary" name="summary" required>{{ $seasonRecord['summary'] }}</textarea>
				<p class="d-none error" for="summary"></p>
			</div>
			<div class="form-group">
				<label for="record-date">Record Date *</label>
				<input type="date" class="form-control" id="record-date" name="record_date" value="{{ $seasonRecord->record_date->format('Y-m-d') }}" required>
				<p class="d-none error" for="record_date"></p>
			</div>
			
			@if($seasonRecord->files->isNotEmpty())
				<label>Attached Files:</label>
				<div class="row">
					@foreach($seasonRecord->files as $file)
					<div class="col-md-6">
						<div class="form-group">
							<a target="_blank" href="{{ asset('storage/'.$seasonRecord::SEASON_RECORD_FILES_FOLDER.'/'.$file['name']) }}" class="text-primary mr-1">
							{{ $file['name'] }}
							</a>
							<a href="!#" class="bg-transparent border-0" data-toggle="modal" data-target="#deleteSeasonRecordFile{{ $file['id'] }}Modal"><i class="ik ik-trash-2 text-danger f-16 font-weight-bold"></i></a>
						</div>
					</div>
					@endforeach
				</div>
			@endif
			
			<div class="form-group">
				<label>Attach Docs / Photos</label>
				@for($i = 1; $i <= 5; $i++)
				<div id="scaffold-{{ $i }}" @if($i > 1) class="scaffold d-none" @endif>
					<input type="file" name="record_file_{{ $i }}" id="record-file-{{ $i }}" class="file-upload-default">
					<div class="input-group col-xs-12">
						<input type="text" class="form-control file-upload-info" id="file-upload-info-{{ $i }}" disabled placeholder="Upload Document/photo">
						<span class="input-group-append">
						<button class="file-upload-browse btn btn-success" style="border-radius: 0px 4px 4px 0px;" type="button">Upload</button>
						</span>
						<button class="delete-doc ml-1 bg-transparent border-0 d-none" id="delete-record-file-{{ $i }}" data-delete-id="{{ $i }}"><i class="ik ik-trash-2 text-danger f-16 font-weight-bold"></i></button>
					</div>
					<p class="d-none error" for="record_file_{{ $i }}"></p>
				</div>
				@endfor
				<div class="pl-2">
					<button id="add-more-doc" class="btn btn-icon btn-success"><i class="ik ik-plus"></i></button>
				</div>
			</div>        
			
			<div id="add_season_record_form_feedback"></div>
	
			<div class="text-right mt-4 pt-2">
				<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success mr-2" id="add_season_record_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>
@if($seasonRecord->files->isNotEmpty())
	@foreach($seasonRecord->files as $row)
		<!-- delete season record file confirmation -->
		<div class="modal fade" id="deleteSeasonRecordFile{{ $row['id'] }}Modal" tabindex="-1" role="dialog" aria-labelledby="deleteSeasonRecordModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="deleteSeasonRecordModalLabel">Delete Season Record File</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form class="ajax" id="delete_season_record_file_{{ $row['id'] }}_form" action="{{ route('destroy_season_record_file', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $seasonRecord['id'], $row['id']]) }}" method="post">
							@method('post')
							@csrf
							<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
							<input type="hidden" name="season_record_file_id" value="{{ $row['id'] }}"/>
							<p>Are you sure you want to delete this file ?</p>
							<div id="delete_season_record_file_{{ $row['id'] }}_form_feedback"></div>
									
							<div class="text-right">
								<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
								<button type="submit" class="btn btn-danger" id="delete_season_record_file_{{ $row['id'] }}_form_submit">Delete</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--end delete season record file confirmation -->
	@endforeach
@endif