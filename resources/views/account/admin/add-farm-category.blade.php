<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-plus bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Add Farm Category</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Admin</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('admin.farm_categories') }}">Farm Categories</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Add Farm Category</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="ajax" id="add_farm_category_form" action="{{ route('admin.add_farm_category') }}" method="post">
						@method('post')
						@csrf
						<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
						<div class="form-group">
							<label for="category-name">Category Name</label>
							<input type="text" class="form-control" id="category-name" name="name" required>
							<p class="d-none error" for="name"></p>
						</div>
						<div class="form-group">
							<label for="category-description">Category Description</label>
							<textarea class="form-control" id="category-description" rows="4" name="description"></textarea>
							<p class="d-none error" for="description"></p>
						</div>
						
						<div id="add_farm_category_form_feedback"></div>
						
						<div class="text-right">
							<a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
							<button type="submit" class="btn btn-success mr-2" id="add_farm_category_form_submit">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>