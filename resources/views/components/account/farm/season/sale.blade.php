<div class="card">
	<div class="card-body">
			<div class="form-group">
				<label for="description">Short Description</label>
				<span class="form-control pt-2 font-weight-bold">{{ $sale['description'] }}</span>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Quantity</label>
						<span class="form-control pt-2 font-weight-bold">{{ $sale['quantity'] }}</span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Unit Measure</label>
						<span class="form-control pt-2 font-weight-bold">{{ $sale['unit_measure'] ?? '--' }}</span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Quality</label>
						<span class="form-control pt-2 font-weight-bold">{{ $sale['quality'] ?? '--' }}</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Expected Amount</label>
						<span class="form-control pt-2 font-weight-bold">{{ $sale['expected_amount'] ?? '--' }}</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Sale Date</label>
						<span class="form-control pt-2 font-weight-bold">{{ $sale->sale_date->format('d M Y') }}</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Sale Receipt Copy</label>
						@if($sale['sale_receipt_copy'] != "")
						<a target="_blank" href="{{ asset('storage/'.$sale::SALE_RECEIPTS_FOLDER.'/'.$sale['sale_receipt_copy']) }}" class="ml-1 text-primary form-control pt-2 font-weight-bold">
						{{ $sale->sale_receipt_copy }}
						</a>
						@else
						<span class="form-control pt-2 font-weight-bold">--</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Amount Paid</label>
						<span class="form-control pt-2 font-weight-bold">{{ $sale['amount_paid'] ?? '--' }}</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Payment Date</label>
						<span class="form-control pt-2 font-weight-bold">{{ $sale->payment_date == "" ? '--' : $sale->payment_date->format('d M Y') }}</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Payment Receipt Copy</label>
						@if($sale['payment_receipt_copy'] != "")
						<a target="_blank" href="{{ asset('storage/'.$sale::PAYMENT_RECEIPTS_FOLDER.'/'.$sale['payment_receipt_copy']) }}" class="ml-1 text-primary form-control pt-2 font-weight-bold">
						{{ $sale->payment_receipt_copy }}
						</a>
						@else
						<span class="form-control pt-2 font-weight-bold">--</span>
						@endif
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Payment Info</label>
				<span class="form-control pt-2 font-weight-bold">{{ $sale['payment_info'] ?? '--' }}</span>
			</div>
			
			<div class="text-right">
				<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
				@if($sale->trashed())
					@if($canRestore)
					<button class="btn btn-success mr-2" data-toggle="modal" data-target="#restoreSaleModal" >Restore</button>
					@endif
					@if($canDestroy)
					<button class="btn btn-warning" data-toggle="modal" data-target="#destroySaleModal" >Delete Permanently</button>
					@endif
				@else
					@if($canDelete)
					<button class="btn btn-warning" data-toggle="modal" data-target="#deleteSaleModal" >Delete</button>
					@endif
				@endif
			</div>
	</div>
</div>

<!-- delete sale confirmation -->
<div class="modal fade" id="deleteSaleModal" tabindex="-1" role="dialog" aria-labelledby="deleteSaleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteSaleModalLabel">Delete Sale</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="delete_sale_form" action="{{ route('delete_sale', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $sale['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="sale_id" value="{{ $sale['id'] }}"/>
					<p>Are you sure you want to delete this sale ?</p>
					<div id="delete_sale_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="delete_sale_form_submit">Delete Sale</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end delete sale confirmation -->
<!-- destroy sale confirmation -->
<div class="modal fade" id="destroySaleModal" tabindex="-1" role="dialog" aria-labelledby="destroySaleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="destroySaleModalLabel">Permanently Delete Sale</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="destroy_sale_form" action="{{ route('destroy_sale', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $sale['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="sale_id" value="{{ $sale['id'] }}"/>
					<p>Are you sure you want to permanently delete this sale ?</p>
					<div id="destroy_sale_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="destroy_sale_form_submit">Permanently Delete Sale</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end destroy sale confirmation -->
<!-- restore deleted sale confirmation -->
<div class="modal fade" id="restoreSaleModal" tabindex="-1" role="dialog" aria-labelledby="restoreSaleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="restoreSaleModalLabel">Restore Sale</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="restore_sale_form" action="{{ route('restore_sale', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $sale['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="sale_id" value="{{ $sale['id'] }}"/>
					<p>Are you sure you want to restore this sale ?</p>
					<div id="restore_sale_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="restore_sale_form_submit">Restore Sale</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end restore deleted sale confirmation -->