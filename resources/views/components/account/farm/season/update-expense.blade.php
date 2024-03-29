<div class="card">
	<div class="card-body">
		<form class="ajax-upload" id="update_expense_form" action="{{ route('update_expense', [$season->department['farm_id'], $season->department['id'], $season['id'], $expense['id']]) }}" method="post">
			@method('post')
			@csrf
			<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
			<input type="hidden" name="expense_id" value="{{ $expense['id'] }}" >
			<div class="form-group">
				<label for="description">Short Description *</label>
				<textarea class="form-control" id="description" rows="4" name="description" required>{{ $expense['description'] }}</textarea>
				<p class="d-none error" for="description"></p>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="amount">Amount * </label>
						<input type="text" class="form-control" id="amount" name="amount" required value="{{ $expense['amount'] }}">
						<p class="d-none error" for="amount"></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="date-incurred">Date Incurred * </label>
						<input type="date" class="form-control" id="date-incurred" name="date_incurred" required value="{{ $expense->date_incurred->format('Y-m-d') }}">
						<p class="d-none error" for="date_incurred"></p>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Receipt Copy
				@if($expense['receipt_copy'] != "")
				<a target="_blank" href="{{ asset('storage/'.$expense::EXPENSE_RECEIPTS_FOLDER.'/'.$expense['receipt_copy']) }}" class="ml-1 text-primary">
				<i class="ik ik-file-text"></i>
				</a>
				@endif
				</label>
				<input type="file" name="receipt_copy" id="receipt-copy" class="file-upload-default">
				<div class="input-group col-xs-12">
					<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Receipt Copy">
					<span class="input-group-append">
					<button class="file-upload-browse btn btn-success" type="button">Upload</button>
					</span>
				</div>
				<p class="d-none error" for="receipt_copy"></p>
			</div>
			
			<div id="update_expense_form_feedback"></div>
			
			<div class="text-right">
				<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success" id="update_expense_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>