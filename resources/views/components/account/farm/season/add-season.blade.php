<div class="card">
	<div class="card-body">
		<form class="ajax" id="add_season_form" action="{{ route('add_season', [$department['farm_id'], $department['id']]) }}" method="post">
			@method('post')
			@csrf
			<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
			<input type="hidden" name="department_id" value="{{ $department['id'] }}" >
			<div class="form-group">
				<label for="category-name">Season Name *</label>
				<input type="text" class="form-control" id="category-name" name="name" required>
				<p class="d-none error" for="name"></p>
			</div>
			<div class="form-group">
				<label for="category-description">Season Description</label>
				<textarea class="form-control" id="category-description" rows="4" name="description"></textarea>
				<p class="d-none error" for="description"></p>
			</div>
			<div class="row mb-1">
				<div class="col-md-4">
					<div class="form-group">
						<label for="crop">Select Category * </label>
						<select class="form-control select2 category-selector" id="crop" name="child_category_id" required>
							<option value="">Select category</option>
							@foreach($child_categories as $row)
							<option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
							@endforeach
						</select>
						<p class="d-none error" for="child_category_id"></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="variety">Select Sub Category </label>
						<select class="form-control select2 sub-category-selector" id="variety" name="child_sub_category_id">
							<option value="">Select sub category</option>
							<!-- other options to be populated once category has been selected -->
						</select>
						<p class="d-none error" for="child_sub_category_id"></p>
						
						<!-- pre generated sub categories (to be used to populate sub category options) -->
						<!-- when no category has been selected -->
						<div class="d-none" id="empty-sub-categories">
							<option value="">Select sub category</option>
						</div>
						@foreach($child_sub_categories as $childCategoryID => $group)
							<div class="d-none" id="sub-categories-for-{{ $childCategoryID }}">
								<option value="">Select sub category</option>
								@foreach($group as $row)
								<option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
								@endforeach
							</div>
						@endforeach
						<!-- end pre generated sub categories -->
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="season-start-date">Season Start Date *</label>
						<input type="date" class="form-control" id="season-start-date" name="start_date" required>
						<p class="d-none error" for="start_date"></p>
					</div>
				</div>
			</div>
			<div class="row mb-2">
				@php
				$categoryMetadatas = $department->category->getMetadatas();
				@endphp
				
				@foreach($department->category->metadata as $metadata)
				<div class="col-md-4">
					<div class="form-group">
						<label for="metadata-{{ $metadata }}">{{ $categoryMetadatas[$metadata]['label'] }}</label>
						<input type="{{ $categoryMetadatas[$metadata]['input'] }}" class="form-control" id="metadata-{{ $metadata }}" name="metadata[{{ $metadata }}]">
						<p class="d-none error" for="metadata.{{ $metadata }}"></p>
					</div>
				</div>
				@endforeach
			</div>
			
			<div id="add_season_form_feedback"></div>
			
			<div class="text-right">
				<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success mr-2" id="add_season_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>