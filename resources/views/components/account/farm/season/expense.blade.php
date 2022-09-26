<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<h6>Date incurred: <span class="font-weight-bold">{{ date('d M Y', strtotime($expense['date_incurred'])) }}</span></h6>
			</div>
			<div class="col-md-6 text-right">
				<h6>Amount: <span class="font-weight-bold">{{ number_format($expense['amount'], 2) }}</span></h6>
			</div>
		</div>
		<h6 class="mt-2">Description </h6>
		<p class="text-muted">{{ $expense['description'] }}</p>
		<h6>Receipt Copy </h6>
		<a target="_blank" href="{{ asset('storage/expense-receipts/'.$expense['receipt_copy']) }}" class="d-block text-primary">
		{{ $expense['receipt_copy'] }}
		</a>
		<div class="text-right mt-3">
			<a class="btn btn-light mr-2" href="{{ url()->previous() }}">Cancel</a>
			@if($expense->trashed())
				@if($canRestore)
				<button class="btn btn-success mr-2" data-toggle="modal" data-target="#restoreExpenseModal" >Restore</button>
				@endif
				@if($canDestroy)
				<button class="btn btn-warning" data-toggle="modal" data-target="#destroyExpenseModal" >Delete Permanently</button>
				@endif
			@else
				@if($canDelete)
				<button class="btn btn-warning" data-toggle="modal" data-target="#deleteExpenseModal" >Delete</button>
				@endif
			@endif
		</div>
	</div>
</div>

<!-- delete expense confirmation -->
<div class="modal fade" id="deleteExpenseModal" tabindex="-1" role="dialog" aria-labelledby="deleteExpenseModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteExpenseModalLabel">Delete Expense</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="delete_expense_form" action="{{ route('delete_expense', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $expense['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="expense_id" value="{{ $expense['id'] }}"/>
					<p>Are you sure you want to delete this expense ?</p>
					<div id="delete_expense_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="delete_expense_form_submit">Delete Expense</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end delete expense confirmation -->
<!-- destroy expense confirmation -->
<div class="modal fade" id="destroyExpenseModal" tabindex="-1" role="dialog" aria-labelledby="destroyExpenseModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="destroyExpenseModalLabel">Permanently Delete Expense</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="destroy_expense_form" action="{{ route('destroy_expense', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $expense['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="expense_id" value="{{ $expense['id'] }}"/>
					<p>Are you sure you want to permanently delete this expense ?</p>
					<div id="destroy_expense_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="destroy_expense_form_submit">Permanently Delete Expense</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end destroy expense confirmation -->
<!-- restore deleted expense confirmation -->
<div class="modal fade" id="restoreExpenseModal" tabindex="-1" role="dialog" aria-labelledby="restoreExpenseModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="restoreExpenseModalLabel">Restore Expense</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="restore_expense_form" action="{{ route('restore_expense', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id'], $expense['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="expense_id" value="{{ $expense['id'] }}"/>
					<p>Are you sure you want to restore this expense ?</p>
					<div id="restore_expense_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="restore_expense_form_submit">Restore Expense</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end restore deleted expense confirmation -->