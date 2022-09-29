<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-4">
				<div class="page-header-title">
					<i class="ik ik-globe bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">{{ $season['name'] }}</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
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
						<li class="breadcrumb-item">
							<a href="{{ route('admin.group', $season->merged_group->group['id']) }}">{{ $season->merged_group->group['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('admin.view_group_member', [$season->merged_group->group['id'], $member['id']]) }}">{{ $member->user['name'] }}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $season['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<x-account.farm.season.meta_data />

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
					<li class="nav-item border-right">
						<a class="nav-link active font-weight-bold" id="pills-expenses-tab" data-toggle="pill" href="#expenses-tab" role="tab" aria-controls="pills-expenses-tab" aria-selected="false"><i class="ik ik-minus-circle"></i> Expenses</a>
					</li>
					<li class="nav-item border-right">
						<a class="nav-link font-weight-bold px-4" id="pills-sales-tab" data-toggle="pill" href="#sales-tab" role="tab" aria-controls="pills-sales-tab" aria-selected="true"><i class="ik ik-shopping-cart"></i> Sales</a>
					</li>
					<li class="nav-item border-right">
						<a class="nav-link font-weight-bold" id="pills-records-tab" data-toggle="pill" href="#records-tab" role="tab" aria-controls="pills-records" aria-selected="false"><i class="ik ik-records"></i> Season's Calendar</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="expenses-tab" role="tabpanel" aria-labelledby="pills-expenses-tab">
						<div class="card-body">
							<x-account.farm.season.expenses :isGroup=false :readOnly=true />
						</div>
					</div>
					<div class="tab-pane fade" id="sales-tab" role="tabpanel" aria-labelledby="pills-sales-tab">
						<div class="card-body">
							<x-account.farm.season.sales :isGroup=false :readOnly=true />
						</div>
					</div>
					<div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="card-body">
							<x-account.farm.season.report />
						</div>
					</div>
					<div class="tab-pane fade" id="records-tab" role="tabpanel" aria-labelledby="pills-records-tab">
						<div class="card-body">
							<x-account.farm.season.season-records :isGroup=false :readOnly=true />
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>