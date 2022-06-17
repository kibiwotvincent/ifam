<div class="card-group mb-4">
	<div class="card">
		<div class="card-body">
			<div class="d-flex justify-content-between align-items-center">
				<div class="state">
					<h3 class="text-info">Kshs {{ $expenses }}</h3>
					<p class="card-subtitle text-muted fw-500 h6">Expenses</p>
				</div>
				<div class="icon"><i class="ik ik-shopping-bag"></i></div>
			</div>
			<div class="progress mt-3 mb-1" style="height: 6px;">
				<div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="d-flex justify-content-between align-items-center">
				<div class="state">
					<h3 class="text-success">Kshs {{ $sales }}</h3>
					<p class="card-subtitle text-muted fw-500 h6">Sales</p>
				</div>
				<div class="icon">
					<i class="ik ik-truck"></i>
				</div>
			</div>
			<div class="progress mt-3 mb-1" style="height: 6px;">
				<div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="d-flex justify-content-between align-items-center">
				<div class="state">
					<h3 class="text-warning">Kshs {{ $profit }}</h3>
					<p class="card-subtitle text-muted fw-500 h6">Profit</p>
				</div>
				<div class="icon">
					<i class="ik ik-dollar-sign"></i>
				</div>
			</div>
			<div class="progress mt-3 mb-1" style="height: 6px;">
				<div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
				</div>
			</div>
		</div>
	</div>
</div>