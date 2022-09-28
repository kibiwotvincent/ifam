<div class="card">
	<div class="card-body">
		<form class="ajax-upload" id="add_sale_form" action="{{ route('add_sale', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" method="post">
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
				<div class="col-md-4">
					<div class="form-group">
						<label for="quantity">Quantity * </label>
						<input type="text" class="form-control" id="quantity" name="quantity" required>
						<p class="d-none error" for="quantity"></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="unit-measure">Unit Measure * </label>
						<input type="text" class="form-control" id="unit-measure" name="unit_measure" required>
						<p class="d-none error" for="unit_measure"></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="quality">Quality </label>
						<input type="text" class="form-control" id="quality" name="quality">
						<p class="d-none error" for="quality"></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="expected-amount">Expected Amount </label>
						<input type="text" class="form-control" id="expected-amount" name="expected_amount">
						<p class="d-none error" for="expected_amount"></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="sale-date">Sale Date * </label>
						<input type="date" class="form-control" id="sale-date" name="sale_date">
						<p class="d-none error" for="sale_date"></p>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Sale Receipt Copy</label>
				<input type="file" name="sale_receipt_copy" id="sale-receipt-copy" class="file-upload-default">
				<div class="input-group col-xs-12">
					<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Sale Receipt Copy">
					<span class="input-group-append">
					<button class="file-upload-browse btn btn-success" type="button">Upload</button>
					</span>
				</div>
				<p class="d-none error" for="sale_receipt_copy"></p>
			</div>
			
			<div id="add_sale_form_feedback"></div>
			
			<div class="text-right">
				<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success" id="add_sale_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>