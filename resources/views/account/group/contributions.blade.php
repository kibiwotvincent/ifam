<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-dollar-sign bg-success"></i>
					<div class="d-inline">
						<h5 class="pt-2">Members Contributions</h5>
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
						<li class="breadcrumb-item active" aria-current="page">Members Contributions</li>
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
					<a href="{{ route('group.contributions_report', [$group['id'], $year, $month]) }}" class="btn btn-info"><i class="ik ik-bar-chart-2"></i>Contributions Report</a>
				</div>
			</div>
		</div>
		<div class="col-md-12">			
			<div class="card">
				<ul class="nav nav-pills custom-pills">
					@foreach($months as $index => $monthName)
					<li class="nav-item">
						<a class="nav-link px-4 @if($index == $month) active @endif" href="{{ route('group.contributions', [$group['id'], $year, $index]) }}">{{ $monthName }}</a>
					</li>
					@endforeach
				</ul>
				<div class="card-body">
					@foreach($group->members as $row)
						<div class="border rounded p-2 mb-2 bg-light">
							<div class="mb-2">
								<img src="{{ $row->user['profile_photo'] == "" ? asset('assets/img/default.jpg') : asset('storage/profile-photos/'.$row->user['profile_photo']) }}" class="rounded mr-2" width="30" alt="">
								<span class="font-weight-bold">{{ $row->user['name'] }}</span>
								<div class="mt-1 float-right">
								<span class="text-muted">ID Number: </span><span class="font-weight-bold">{{ $row->user['id_number'] }}</span>
								</div>
							</div>
							<div class="pt-2" style="border-top: 1px dotted #d3d3d3;">
								
								@foreach($row->grouped_contributions($year, $month) as $monthContributionsArray)
									@foreach($monthContributionsArray as $contribution)
									<div class="p-2" style="border-bottom: 1px dotted #d3d3d3;">
										<div class="row">
											<div class="col-md-3">
												<span class="d-block">Amount Received</span>
												<span class="font-weight-bold">{{ number_format($contribution['amount'], 2) }}</span>
											</div>
											<div class="col-md-3">
												<span class="d-block">Date Received</span>
												<span class="font-weight-bold">{{ Date('d M Y', strtotime($contribution['date_received'])) }}</span>
											</div>
											<div class="col-md-3">
												<span class="d-block">Payment Mode</span>
												<span class="font-weight-bold">{{ ucfirst($contribution['payment_mode']) }}</span>
											</div>
											<div class="col-md-3">
												<span class="d-block">Transaction Info/No</span>
												<span class="font-weight-bold">{{ $contribution['transaction_info'] ?? '--' }}</span>
											</div>
										</div>
									</div>
									@endforeach
								@endforeach
								
								<form class="form-horizontal pt-2 ajax" id="add_contribution_{{ $row['id'] }}_form" action="{{ route('group.add_contribution', $group['id']) }}" method="post">
									@csrf
									<input type="hidden" name="target_year" value="{{ $year }}" >
									<input type="hidden" name="target_month" value="{{ $month }}" >
									<input type="hidden" name="group_member_id" value="{{ $row['id'] }}" >
									<div class="form-group row">
										<div class="col-md-3">
											<label for="amount-{{ $row['id'] }}">Amount Received</label>
											<input type="text" class="form-control" name="amount" id="amount-{{ $row['id'] }}">
											<p class="d-none error" for="amount"></p>
										</div>
										<div class="col-md-3">
											<label for="date-{{ $row['id'] }}">Date Received</label>
											<input type="date" class="form-control" name="date_received" id="date-{{ $row['id'] }}">
											<p class="d-none error" for="date_received"></p>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="mode-{{ $row['id'] }}">Payment Mode</label>
												<select class="form-control select2" name="payment_mode" id="mode-{{ $row['id'] }}">
													<option value="">Select</option>
													@foreach($modes as $mode => $modeName)
													<option value="{{ $mode }}">{{ $modeName }}</option>
													@endforeach
												</select>
												<p class="d-none error" for="payment_mode"></p>
											</div>
										</div>
										<div class="col-md-3">
											<label for="txn-info-{{ $row['id'] }}">Transaction Info/No</label>
											<input type="text" class="form-control" name="transaction_info" id="txn-info-{{ $row['id'] }}">
											<p class="d-none error" for="transaction_info"></p>
										</div>
										<div class="col-md-1">
											<label class="d-block">&nbsp;</label>
											<button type="submit" data-replace-icon-on-submit="1" data-reset-form-after-submit="1" id="add_contribution_{{ $row['id'] }}_form_submit" style="padding: 8px 15px; border-radius: 4px;" class="border-0 bg-success text-white">
												<i class="ik ik-arrow-right-circle"></i>
											</button>
										</div>
									</div>
									<div id="add_contribution_{{ $row['id'] }}_form_feedback"></div>
								</form>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>