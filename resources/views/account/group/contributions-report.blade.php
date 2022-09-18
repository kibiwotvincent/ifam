<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-dollar-sign bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Members Contributions Report</h5>
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
							<a href="{{ route('view_group', $group['id']) }}">{{ $group['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('group.contributions', $group['id']) }}">Members Contributions</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Report</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="col-md-12 mt-2">
			<div class="row">
				<div class="col-6">
					<div class="dropdown mb-3">
						<a style="padding: 10px 40px;" class="rounded bg-success dropdown-toggle" href="#" id="year-selector" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="text-white font-weight-bold pb-1">{{ $year }} <i class="ik ik-chevron-down"></i></span>
						</a>
						<div class="dropdown-menu" aria-labelledby="year-selector">
							@for($yearStart = $years[0]; $yearStart <= $years[1]; $yearStart++)
							<a class="dropdown-item" href="{{ route('group.contributions', [$group['id'], $yearStart]) }}">{{ $yearStart }}</a>
							@endfor
						</div>
					</div>
				</div>
				<div class="col-6 text-right">
					<div class="dropdown">
						<a style="padding: 10px 15px; border-radius: 4px;" class="border-0 dropdown-toggle bg-info text-white" href="#" id="download-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Download <i class="ik ik-chevron-down"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="download-dropdown">
							<a class="dropdown-item" href="#">Excel</a>
							<a class="dropdown-item" href="#">PDF</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">			
			<div class="card">
				<ul class="nav nav-pills custom-pills">
					@foreach($months as $index => $monthName)
					<li class="nav-item">
						<a class="nav-link px-4 @if($index == $month) active @endif" href="{{ route('group.contributions_report', [$group['id'], $year, $index]) }}">{{ $monthName }}</a>
					</li>
					@endforeach
				</ul>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>ID Number</th>
									<th>Amount</th>
									<th>Date Received</th>
									<th>Payment Mode</th>
									<th>Transaction Info</th>
								</tr>
							</thead>
							<tbody>
								@foreach($members as $row)
								@foreach($row->contributions()->year($year)->month($month)->orderBy('date_received', 'desc')->get() as $contribution)
								<tr>
									<td>
									<img src="{{ $row->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$row->user['profile_photo']) }}" class="table-user-thumb mr-2" alt="">
									{{ $row->user['name'] }}
									</td>
									<td>{{ $row->user['id_number'] }}</td>
									<td>{{ number_format($contribution['amount'], 2) }}</td>
									<td>{{ Date('d M Y', strtotime($contribution['date_received'])) }}</td>
									<td>{{ $contribution['payment_mode'] }}</td>
									<td>{{ $contribution['transaction_info'] ?? '--' }}</td>
								</tr>
								@endforeach
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