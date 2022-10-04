<form class="ajax" id="add_farm_form" action="{{ route('add_farm') }}" method="post">
	@method('post')
	@csrf
	<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
	<input type="hidden" name="owner" value="{{ $owner }}" >
	<input type="hidden" name="owner_id" value="{{ $ownerID }}" >
	<div class="form-group">
		<label for="farm-name">Farm Name *</label>
		<input type="text" class="form-control" id="farm-name" name="name" required>
		<p class="d-none error" for="name"></p>
	</div>
	<div class="form-group">
		<label for="farm-description">Farm Description</label>
		<textarea class="form-control" id="farm-description" rows="4" name="description"></textarea>
		<p class="d-none error" for="description"></p>
	</div>
	
	<div class="form-group">
		<label>Add Farm Departments *</label>
		<div class="row mt-2 border-checkbox-section">
			@foreach($farmCategories as $row)
			<div class="col-6 col-md-3 mb-2">
				<div class="border-checkbox-group border-checkbox-group-success">
					<input class="border-checkbox" type="checkbox" id="category-{{ $row['id'] }}" name="departments[]" value="{{ $row['id'] }}">
					<label class="border-checkbox-label" for="category-{{ $row['id'] }}">{{ $row['name'] }}</label>
				</div>
			</div>
			@endforeach
		</div>
		<p class="d-none error" for="departments"></p>
	</div>
	
	<div class="form-group">
		<label for="farm-acreage">Acreage (in acres)</label>
		<input type="text" class="form-control" id="farm-acreage" name="acreage">
		<p class="d-none error" for="acreage"></p>
	</div>
	<div class="form-group">
		<label for="farm-location">Location Cordinates</label>
		<input type="text" class="form-control" id="farm-location" name="location">
		<p class="d-none error" for="location"></p>
	</div>
	
	<div id="add_farm_form_feedback"></div>
	
	<div class="text-right">
		<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
		<button type="submit" class="btn btn-success mr-2" id="add_farm_form_submit">Save</button>
	</div>
</form>