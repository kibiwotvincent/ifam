<div class="card">
	<div class="card-body">
		<form class="ajax" id="update_season_form" action="{{ route('update_season', [$season->department['farm_id'], $season->department['id'], $season['id']]) }}" method="post">
			@csrf
			<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
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
				<div class="col-md-4">
					<div class="form-group">
						<label for="crop">Crop * </label>
						<input type="text" class="form-control" id="crop" name="crop" value="{{ $season->child_category['name'] }}" readonly>
						<p class="d-none error" for="child_category_id"></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="variety">Select Variety </label>
						<select class="form-control select2" id="variety" name="child_sub_category_id">
							<option value="">Select variety</option>
							@foreach($child_sub_categories as $row)
							<option value="{{ $row['id'] }}" @if($season['child_sub_category_id'] == $row['id']) selected @endif>{{ $row['name'] }}</option>
							@endforeach
						</select>
						<p class="d-none error" for="child_sub_category_id"></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="category-name">Acreage (in acres)</label>
						<input type="text" class="form-control" id="category-name" name="acreage" value="{{ $season['acreage'] }}">
						<p class="d-none error" for="acreage"></p>
					</div>
				</div>
			</div>
			<div class="row mb-1">
				<div class="col-md-4">
					<div class="form-group">
						<label for="season-start-date">Season Start Date *</label>
						<input type="date" class="form-control" id="season-start-date" name="start_date" value="{{ date('Y-m-d', strtotime($season['start_date'])) }}" required>
						<p class="d-none error" for="start_date"></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="season-end-date">Season End Date</label>
						<input type="date" class="form-control" id="season-end-date" name="end_date" value="{{ $season['end_date'] == "" ? "" : date('Y-m-d', strtotime($season['end_date'])); }}">
						<p class="d-none error" for="end_date"></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="season-status">&nbsp;</label>
						<div class="border-checkbox-section pt-1">
							@if($season['status'] == "open")
							<div class="border-checkbox-group border-checkbox-group-success">
								<input class="border-checkbox" type="checkbox" id="checkbox2" name="status" value="closed">
								<label class="border-checkbox-label" for="checkbox2">End season</label>
							</div>
							@else
							<div class="border-checkbox-group border-checkbox-group-success">
								<input class="border-checkbox" type="checkbox" id="checkbox2" name="status" value="open">
								<label class="border-checkbox-label" for="checkbox2">Open season</label>
							</div>
							@endif
						</div>
						<p class="d-none error" for="status"></p>
					</div>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-md-12">
					<div class="form-group">
						<label for="merged-group-id">Select Tracking Group </label>
						<select class="form-control select2" id="merged-group-id" name="merged_group_id">
							<option value="">Select group</option>
							@foreach($user_groups as $row)
							<option value="{{ $row['group_id'] }}" @if($season->merged_group['group_id'] == $row['group_id']) selected @endif>{{ $row->group['name'] }}</option>
							@endforeach
						</select>
						<small class="text-muted f-12">Selected group will be able to track this season's expenses, sales and profit for use in group reports.</small>
						<p class="d-none error" for="merged_group_id"></p>
					</div>
				</div>
			</div>
			
			
			<div id="update_season_form_feedback"></div>
			
			<div class="text-right">
				<a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
				<button type="submit" class="btn btn-success mr-2" id="update_season_form_submit">Save</button>
			</div>
		</form>
	</div>
</div>