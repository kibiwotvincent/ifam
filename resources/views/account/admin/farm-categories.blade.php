<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-layout bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Farm Categories</h5>
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
							<a href="{{ route('dashboard') }}">Admin</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Farm Categories</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
						<div class="row">
                            <div class="col-md-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h3>Farm Categories ({{ count($farm_categories) }})</h3>
                                        <div class="card-header-right">
                                            <a href="{{ route('admin.add_farm_category') }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Farm Category</a>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
													@foreach($farm_categories as $row)
                                                    <tr>
                                                        <td>{{ $row['name'] }}</td>
                                                        <td>{{ $row['description'] }}</td>
														<td class="table-action text-right">
														<a href="#!"><i class="ik ik-edit f-16 mr-15 text-success"></i></a>
														<a href="{{ route('admin.view_farm_category', $row['id']) }}"><i class="ik ik-arrow-right-circle f-16 text-success"></i>
														</a>
														</td>
                                                    </tr>
													@endforeach
												</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
</div>
</x-app-layout>