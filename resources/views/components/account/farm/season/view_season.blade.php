<div class="card">
	<div class="card-body">
		<form class="ajax" id="update_season_form" action="{{ route('update_season', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" method="post">
			@csrf
			<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
			<input type="hidden" name="season_id" value="{{ $season['id'] }}" >
			<div class="form-group">
				<label for="category-name">Season Name *</label>
				<input type="text" class="form-control" id="category-name" name="name" value="{{ $season['name'] }}" required>
				<p class="d-none error" for="name"></p>
			</div>
			<div class="form-group">
				<label for="category-description">Season Description</label>
				<textarea class="form-control" id="category-description" rows="4" name="description">{{ $season['description'] }}</textarea>
				<p class="d-none error" for="description"></p>
			</div>
			<div class="row mb-1">
				<div class="col-md-3">
					<div class="form-group">
						<label for="crop">Crop * </label>
						<input type="text" class="form-control" id="crop" name="crop" value="{{ $season->child_category['name'] }}" readonly>
						<p class="d-none error" for="child_category_id"></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="crop">Crop * </label>
						<input type="text" class="form-control" id="crop" name="crop" value="{{ $season->child_sub_category['name'] }}" readonly>
						<p class="d-none error" for="child_category_id"></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="season-start-date">Season Start Date *</label>
						<input type="date" class="form-control" id="season-start-date" name="start_date" value="{{ date('Y-m-d', strtotime($season['start_date'])) }}" required>
						<p class="d-none error" for="start_date"></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="season-end-date">Season End Date</label>
						<input type="date" class="form-control" id="season-end-date" name="end_date" value="{{ $season['end_date'] == "" ? "" : $season->end_date->format('Y-m-d') }}">
						<p class="d-none error" for="end_date"></p>
					</div>
				</div>
			</div>
			<div class="row">
				@php
				$categoryMetadatas = $season->department->category->getMetadatas();
				@endphp
				
				@foreach($season->department->category->metadata as $metadata)
				<div class="col-md-4">
					<div class="form-group">
						<label for="metadata-{{ $metadata }}">{{ $categoryMetadatas[$metadata]['label'] }}</label>
						<input type="{{ $categoryMetadatas[$metadata]['input'] }}" class="form-control" id="metadata-{{ $metadata }}" name="metadata[{{ $metadata }}]" value="{{ $season->metadata[$metadata] }}">
						<p class="d-none error" for="metadata.{{ $metadata }}"></p>
					</div>
				</div>
				@endforeach
			</div>
			<div class="row mb-2">
				<div class="col-md-12">
					<div class="form-group">
						<label for="merged-group-id">Tracking Group </label>
						<input type="text" class="form-control" id="crop" name="crop" value="{{ $season->merged_group->group['name'] }}" readonly>
						<p class="d-none error" for="child_category_id"></p>
						
					</div>
				</div>
			</div>
			
			
			<div id="update_season_form_feedback"></div>
			
			<div class="text-right">
				<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success mr-2" id="update_season_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>