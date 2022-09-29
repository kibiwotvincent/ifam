<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label for="description">Short Description</label>
			<span class="form-control pt-2 font-weight-bold">{{ $expense['description'] }}</span>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Amount</label>
					<span class="form-control pt-2 font-weight-bold">{{ number_format($expense['amount'], 2) }}</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Date Incurred</label>
					<span class="form-control pt-2 font-weight-bold">{{ $expense->date_incurred->format('d M Y') }}</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Receipt Copy</label>
			@if($expense['receipt_copy'] != "")
			<a target="_blank" href="{{ asset('storage/'.$expense::EXPENSE_RECEIPTS_FOLDER.'/'.$expense['receipt_copy']) }}" class="ml-1 text-primary form-control pt-2 font-weight-bold">
			{{ $expense->receipt_copy }}
			</a>
			@else
			<span class="form-control pt-2 font-weight-bold">--</span>
			@endif
		</div>
		<div class="text-right">
			<a class="btn btn-light" href="{{ url()->previous() }}">Back</a>
			@if($expense->trashed())
				@if($canRestore)
				<button class="btn btn-success ml-2" data-toggle="modal" data-target="#restoreExpenseModal" >Restore</button>
				@endif
				@if($canDestroy)
				<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#destroyExpenseModal" >Delete Permanently</button>
				@endif
			@else
				@if($canDelete)
				<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#deleteExpenseModal" >Delete</button>
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