<div class="card">
	<div class="card-body">
		<form class="ajax" id="add_season_record_form" action="{{ route('add_season_record', [$season->department->farm['id'], $season['farm_department_id'], $season['id']]) }}" method="post">
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
			</div>
			<p class="d-none error" for="start"></p>
			<div class="form-group">
				<label>Attach Docs / Photos</label>
				<div>
					<input type="file" name="record_file" id="record-file" class="file-upload-default" onchange="alert('test')">
					<div class="input-group col-xs-12">
						<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Document/photo">
						<span class="input-group-append">
						<button class="file-upload-browse btn btn-success" type="button">Upload</button>
						</span>
						<button class="ml-1 bg-transparent border-0"><i class="ik ik-trash-2 text-danger f-16 font-weight-bold"></i></button>
					</div>
					<p class="d-none error" for="record_file"></p>
				</div>
				
				<div>
					<input type="file" name="record_file" id="record-file2" class="file-upload-default" onchange="alert('test')">
					<div class="input-group col-xs-12">
						<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Document/photo">
						<span class="input-group-append">
						<button class="file-upload-browse btn btn-success" type="button">Upload</button>
						</span>
						<button class="ml-1 bg-transparent border-0"><i class="ik ik-trash-2 text-danger f-16 font-weight-bold"></i></button>
					</div>
					<p class="d-none error" for="record_file2"></p>
				</div>
			</div>        
			
			<div id="add_season_record_form_feedback"></div>
	
			<div class="text-right mt-4">
				<a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success mr-2" id="add_season_record_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>