<div class="card">
	<div class="card-body">
		<form class="ajax-upload" id="add_expense_form" action="{{ route('add_expense', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" method="post">
			@method('post')
			@csrf
			<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
			<input type="hidden" name="season_id" value="{{ $season['id'] }}" >
			<div class="form-group">
				<label for="description">Short Description *</label>
				<textarea class="form-control" id="description" rows="4" name="description" required></textarea>
				<p class="d-none error" for="description"></p>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="amount">Amount * </label>
						<input type="text" class="form-control" id="amount" name="amount" required>
						<p class="d-none error" for="amount"></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="date-incurred">Date Incurred * </label>
						<input type="date" class="form-control" id="date-incurred" name="date_incurred" required>
						<p class="d-none error" for="date_incurred"></p>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Receipt Copy</label>
				<input type="file" name="receipt_copy" id="receipt-copy" class="file-upload-default" capture="camera">
				<div class="input-group col-xs-12">
					<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Receipt Copy">
					<span class="input-group-append">
					<button class="file-upload-browse btn btn-success" type="button">Upload</button>
					</span>
				</div>
				<p class="d-none error" for="receipt_copy"></p>
			</div>
			
			<div id="add_expense_form_feedback"></div>
			
			<div class="text-right">
				<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success" id="add_expense_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>