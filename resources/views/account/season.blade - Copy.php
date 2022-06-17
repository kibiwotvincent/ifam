<x-app-layout>
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-5">
				<div class="page-header-title">
					<i class="ik ik-globe bg-success"></i>
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
							<a href="{{ route('farms') }}">Farms</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('view_farm', $farm['id']) }}">{{ $farm['name'] }}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{ route('view_farm', $farm['id']) }}">Seasons</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ $season['name'] }}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	
	<div class="card-group mb-4">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="state">
						<h3 class="text-info">Kshs 57,423.00</h3>
						<p class="card-subtitle text-muted fw-500 h6">Expenses</p>
					</div>
					<div class="icon"><i class="ik ik-shopping-bag"></i></div>
				</div>
				<div class="progress mt-3 mb-1" style="height: 6px;">
					<div class="progress-bar bg-info" role="progressbar" style="width: 83%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					</div>
				</div>
				<div class="text-muted f12">
					<span>Progress</span>
					<span class="float-right">83%</span>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="state">
						<h3 class="text-success">Kshs 180,423.00</h3>
						<p class="card-subtitle text-muted fw-500 h6">Sales</p>
					</div>
					<div class="icon">
						<i class="ik ik-truck"></i>
					</div>
				</div>
				<div class="progress mt-3 mb-1" style="height: 6px;">
					<div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					</div>
				</div>
				<div class="text-muted f12">
					<span>Progress</span>
					<span class="float-right">63%</span>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="state">
						<h3 class="text-warning">Kshs 123,423.00</h3>
						<p class="card-subtitle text-muted fw-500 h6">Profit</p>
					</div>
					<div class="icon">
						<i class="ik ik-dollar-sign"></i>
					</div>
				</div>
				<div class="progress mt-3 mb-1" style="height: 6px;">
					<div class="progress-bar bg-warning" role="progressbar" style="width: 77%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					</div>
				</div>
				<div class="text-muted f12">
					<span>Progress</span>
					<span class="float-right">77%</span>
				</div>
			</div>
		</div>
	</div>
	
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Slimple Line Chart</h3>
                                    </div>
                                    <div class="card-block">
                                        <div id="lineChart" class="chart-shadow st-cir-chart" style="height: 450px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
						<a class="nav-link font-weight-bold" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="ik ik-file-text"></i> View Report</a>
					</li>
					<li class="nav-item border-right d-none">
						<a class="nav-link font-weight-bold" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="ik ik-edit-1"></i> Make Notes</a>
					</li>
					<li class="nav-item border-right">
						<a class="nav-link font-weight-bold" id="pills-calendar-tab" data-toggle="pill" href="#calendar-tab" role="tab" aria-controls="pills-calendar" aria-selected="false"><i class="ik ik-calendar"></i> Season's Calendar</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="expenses-tab" role="tabpanel" aria-labelledby="pills-expenses-tab">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-8">
									<h6 class="mt-2">Expenses ({{ count($expenses) }})</h6>
								</div>
								<div class="col-4 text-right">
									<a href="{{ route('add_expense', [$farm['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Expense</a>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
										<tr>
											<th>Date</th>
											<th>Amount</th>
											<th>Description</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($expenses as $row)
										<tr>
											<td>{{ date('d M Y', strtotime($row['date_incurred'])) }}</td>
											<td>{{ $row['amount'] }}</td>
											<td>{{ $row['description'] }}</td>
											<td class="text-right">
											<a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
											<a href="#"><i class="ik ik-arrow-right-circle f-16 text-info"></i></a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="sales-tab" role="tabpanel" aria-labelledby="pills-sales-tab">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-8">
									<h6 class="mt-2">Sales ({{ count($sales) }})</h6>
								</div>
								<div class="col-4 text-right">
									<a href="{{ route('add_sale', [$farm['id'], $season['id']]) }}" class="btn btn-sm btn-success"><i class="ik ik-plus-circle"></i> Add Sale</a>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
										<tr>
											<th>Date</th>
											<th>Expected Amount</th>
											<th>Amount Paid</th>
											<th>Description</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sales as $row)
										<tr>
											<td>{{ date('d M Y', strtotime($row['sale_date'])) }}</td>
											<td>{{ $row['expected_amount'] }}</td>
											<td>{{ $row['amount_paid'] }}</td>
											<td>{{ $row['description'] }}</td>
											<td class="text-right">
											<a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
											<a href="#"><i class="ik ik-arrow-right-circle f-16 text-info"></i></a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="card-body">
							
						</div>
					</div>
					<div class="tab-pane fade" id="calendar-tab" role="tabpanel" aria-labelledby="pills-calendar-tab">
						<div class="card-body">
							<div id="calendar"></div>
							<!-- calendar modals -->
							<div class="modal" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="editEventLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<form class="editEventForm">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editEventLabel">Edit Event</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<label for="editEname">Event Title</label>
													<input type="text" class="form-control" id="editEname" name="editEname" placeholder="Please enter event title">
												</div>
												<div class="form-group">
													<label for="editStarts">Start</label>
													<input type="text" class="form-control datetimepicker-input" id="editStarts" name="editStarts" data-toggle="datetimepicker" data-target="#editStarts">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button class="btn btn-danger delete-event" type="submit">Delete</button>
												<button class="btn btn-success save-event" type="submit">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div> 

							<div class="modal" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="addEventLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="addEventLabel">Add New Event</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											<form id="addEventForm">
												<div class="form-group">
													<label for="eventName">Event Title</label>
													<input type="text" class="form-control" id="eventName" name="eventName" placeholder="Please enter event title">
												</div>
												<div class="form-group">
													<label for="eventStarts">Starts</label>
													<input type="text" class="form-control datetimepicker-input" id="eventStarts" name="eventStarts" data-toggle="datetimepicker" data-target="#eventStarts">
												</div>
												<div class="form-group mb-0" id="addColor">
													<label for="colors">Choose Color</label>
													<ul class="color-selector">
														<li class="bg-aqua">
															<input type="radio" data-color="bg-aqua" checked name="colorChosen" id="addColorAqua">
															<label for="addColorAqua"></label>
														</li>
														<li class="bg-blue">
															<input type="radio" data-color="bg-blue" name="colorChosen" id="addColorBlue">
															<label for="addColorBlue"></label>
														</li>
														<li class="bg-light-blue">
															<input type="radio" data-color="bg-light-blue" name="colorChosen" id="addColorLightblue">
															<label for="addColorLightblue"></label>
														</li>
														<li class="bg-teal">
															<input type="radio" data-color="bg-teal" name="colorChosen" id="addColorTeal">
															<label for="addColorTeal"></label>
														</li>
														<li class="bg-yellow">
															<input type="radio" data-color="bg-yellow" name="colorChosen" id="addColorYellow">
															<label for="addColorYellow"></label>
														</li>
														<li class="bg-orange">
															<input type="radio" data-color="bg-orange" name="colorChosen" id="addColorOrange">
															<label for="addColorOrange"></label>
														</li>
														<li class="bg-green">
															<input type="radio" data-color="bg-green" name="colorChosen" id="addColorGreen">
															<label for="addColorGreen"></label>
														</li>
														<li class="bg-lime">
															<input type="radio" data-color="bg-lime" name="colorChosen" id="addColorLime">
															<label for="addColorLime"></label>
														</li>
														<li class="bg-red">
															<input type="radio" data-color="bg-red" name="colorChosen" id="addColorRed">
															<label for="addColorRed"></label>
														</li>
														<li class="bg-purple">
															<input type="radio" data-color="bg-purple" name="colorChosen" id="addColorPurple">
															<label for="addColorPurple"></label>
														</li>
														<li class="bg-fuchsia">
															<input type="radio" data-color="bg-fuchsia" name="colorChosen" id="addColorFuchsia">
															<label for="addColorFuchsia"></label>
														</li>
														<li class="bg-muted">
															<input type="radio" data-color="bg-muted" name="colorChosen" id="addColorMuted">
															<label for="addColorMuted"></label>
														</li>
														<li class="bg-navy">
															<input type="radio" data-color="bg-navy" name="colorChosen" id="addColorNavy">
															<label for="addColorNavy"></label>
														</li>
													</ul>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-success save-event">Save</button>
											<button type="button" class="btn btn-danger delete-event" data-dismiss="modal">Delete</button>
										</div>
									</div>
								</div>
							</div> 
							<!-- end calendar modals -->
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
</div>
</x-app-layout>