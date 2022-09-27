<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-3">
				<div class="page-header-title">
					<i class="ik ik-plus bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Add Expense</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<nav class="breadcrumb-container" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('groups') }}">Groups</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('view_group', $season->department->farm->farmable['id']) }}">{{ $season->department->farm->farmable['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('group.view_farm', [$season->department->farm->farmable['id'], $season->department->farm['id']]) }}">{{ $season->department->farm['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('group.view_department', [$season->department->farm->farmable['id'], $season->department->farm['id'], $season->department['id']]) }}">{{ $season->department->category['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('group.view_season', [$season->department->farm->farmable['id'], $season->department->farm['id'], $season->department['id'], $season['id']]) }}">{{ $season['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Add Expense</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<x-account.farm.season.add-expense :season=$season />
		</div>
	</div>
	
</div>
</x-app-layout>