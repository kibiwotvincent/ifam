<div class="card">
	<div class="card-body">
		<form class="ajax-upload" id="add_season_record_form" action="{{ route('add_season_record', [$season->department->farm['id'], $season['farm_department_id'], $season['id']]) }}" method="post">
			@csrf
			<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
			<input type="hidden" name="season_id" value="{{ $season['id'] }}" >
			
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" name="title">
				<p class="d-none error" for="title"></p>
			</div>
			<div class="form-group">
				<label for="summary">Summary</label>
				<textarea class="form-control html-editor" rows="4" id="summary" name="summary"></textarea>
				<p class="d-none error" for="summary"></p>
			</div>
			<div class="form-group">
				<label for="record-date">Record Date</label>
				<input type="date" class="form-control" id="record-date" name="record_date" >
				<p class="d-none error" for="record_date"></p>
			</div>
			<p class="d-none error" for="start"></p>
			<div class="form-group">
				<label>Attach Docs / Photos</label>
				@for($i = 1; $i <= 5; $i++)
				<div id="scaffold-{{ $i }}" @if($i > 1) class="scaffold d-none" @endif>
					<input type="file" name="record_file_{{ $i }}" id="record-file-{{ $i }}" class="file-upload-default">
					<div class="input-group col-xs-12">
						<input type="text" class="form-control file-upload-info" id="file-upload-info-{{ $i }}" disabled placeholder="Upload Document/photo">
						<span class="input-group-append">
						<button class="file-upload-browse btn btn-success" type="button">Upload</button>
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
				<a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success mr-2" id="add_season_record_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>