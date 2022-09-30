<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-edit bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $season['name'] }}</h5>
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
							<a href="{{ route('groups') }}">Groups</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('view_group', $season->department->farm['farmable_id']) }}">{{ $season->department->farm->farmable['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('group.view_farm', [$season->department->farm['farmable_id'], $season->department['farm_id']]) }}">{{ $season->department->farm['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('group.view_department', [$season->department->farm->farmable['id'], $season->department->farm['id'], $season->department['id']]) }}">{{ $season->department->category['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $season['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<x-account.farm.season.update-season :isGroup=true />
		</div>
	</div>
	
</div>
</x-app-layout>