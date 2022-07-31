<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-users bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $group['name'] }}</h5>
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
							<a href="{{ route('admin.groups') }}">Groups</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $group['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="row mb-1">
				<div class="col-md-6">
					<h5 class="mt-3 h6 font-weight-bold text-muted">Group Farms</h5>
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('admin.group_report', $group['id']) }}" class="btn btn-success"><i class="ik ik-bar-chart-line-"></i> Group Report</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mb-4 pl-0 pr-0">
					<div class="owl-container">
						<div class="owl-carousel basic">
							@foreach($group->farms as $row)
							<div class="card proj-t-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col pl-0 mx-3">
											<a href="{{ route('admin.group.view_farm', [$row->farmable['id'], $row['id']]) }}">
												<h6 class="mb-5 font-weight-bold">{{ $row['name'] }}</h6>
											</a>
											<p>
											Added On <span class="text-muted">{{ date('d M Y', strtotime($row['created_at'])) }}</span>
											</p>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<span class="badge badge-pill badge-info">
											{{ $row->departments[0]->category['name'] }}
											@if(count($row->departments) > 1)
											+ {{ count($row->departments) - 1 }}
											@endif
											</span>
										</div>
										<div class="col text-right">
											<a href="{{ route('admin.farm_report', [$group['id'], $row['id']]) }}">
											<span classs="badge badge-pil badge-light"><i class="ik ik-bar-chart-2"></i></span>
											</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="slider-nav text-center">
							<a href="#" class="left-arrow owl-prev text-success">
								<i class="ik ik-chevron-left"></i>
							</a>
							<div class="slider-dot-container"></div>
							<a href="#" class="right-arrow owl-next text-success">
								<i class="ik ik-chevron-right"></i>
							</a>
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card table-card">
				<div class="card-header">
					<div class="container px-0">
						<div class="row">
							<div class="col-12">
								<h3 class="mt-2">Group Members</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="card-block">
					<x-account.group.group-members-table :group=$group :isAdmin=true />
				</div>
			</div>
		</div>
	</div>
</div>
</x-app-layout>