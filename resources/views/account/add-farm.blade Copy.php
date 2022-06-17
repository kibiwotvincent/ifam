<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-plus bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Add New Farm</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('farms') }}">Farms</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Add New Farm</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="forms-sample ajax" id="add_farm_form" action="{{ route('add_farm') }}" method="post">
						@method('post')
						@csrf
						<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
						<div class="form-group">
							<label for="farm-name">Farm Name</label>
							<input type="text" class="form-control" id="farm-name" name="name" required>
							<p class="d-none error" for="name"></p>
						</div>
						<div class="form-group">
							<label for="farm-description">Farm Description</label>
							<textarea class="form-control" id="farm-description" rows="4" name="description"></textarea>
							<p class="d-none error" for="description"></p>
						</div>
						<div class="form-group">
							<label for="farm-acreage">Acreage (in acres)</label>
							<input type="number" class="form-control" id="farm-acreage" name="acreage">
							<p class="d-none error" for="acreage"></p>
						</div>
						<div class="form-group">
							<label for="farm-location">Location Cordinates</label>
							<input type="text" class="form-control" id="farm-location" name="location">
							<p class="d-none error" for="location"></p>
						</div>
						<div class="form-group">
							<label for="farm-category">Select Farm Category </label>
							<select class="form-control select2" id="farm-category" name="category" required>
								<option value="">Select farm category</option>
								@foreach($farm_categories as $row)
								<option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group mb-1">
							<label>Select Farm Category</label>
						</div>
						<div class="form-group form-radio">
							<div class="row">
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="1" required>
											<i class="helper"></i>Crop Farming
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="2">
											<i class="helper"></i>Dairy Farming
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="3">
											<i class="helper"></i>Poultry Farming
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="4">
											<i class="helper"></i>Beef Farming
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="5">
											<i class="helper"></i>Goat Farming
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="6">
											<i class="helper"></i>Sheep Farming
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="7">
											<i class="helper"></i>Fish Rearing
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="8">
											<i class="helper"></i>Bee Keeping
										</label>
									</div>
								</div>
								<div class="col-6 col-sm-6 col-md-3">
									<div class="radio radio-success">
										<label>
											<input type="radio" name="category" value="9">
											<i class="helper"></i>Rabbit Farming
										</label>
									</div>
								</div>
							</div>
							<p class="d-none error" for="category"></p>
						</div>
						
						<div id="add_farm_form_feedback"></div>
						
						<div class="text-right">
							<a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
							<button type="submit" class="btn btn-success mr-2" id="add_farm_form_submit">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</x-app-layout>