<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Season;
use App\Models\Account\Expense;
use App\Http\Requests\Account\AddExpenseRequest;
use App\Http\Requests\Account\UpdateExpenseRequest;
use App\Http\Requests\Account\DeleteExpenseRequest;
use App\Http\Requests\Account\RestoreExpenseRequest;
use App\Http\Services\Account\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExpenseController extends Controller
{
	
    protected $expenseService;

    /**
     * ExpenseController constructor.
     *
     * @param  ExpenseService  $expenseService
	 * @return void
     */
    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }
	
    /**
     * Display the add expense view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$season = Season::find($request->season_id);
		$this->authorize('create', [Expense::class, $season]);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.add-expense' : 'account.add-expense';
		
        return view($view, compact('season'));
    }
	
	/**
     * Display expense view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$expense = Expense::withTrashed()->find($request->id);
		$this->authorize('view', $expense);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.expense' : 'account.expense';
		$season = $expense->season;
		
        return view($view, compact('expense', 'season'));
    }
	
	/**
     * Display the update expense view.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
		$expense = Expense::findOrFail($request->id);
		$this->authorize('update', $expense);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.update-expense' : 'account.update-expense';
		$season = $expense->season;
		
        return view($view, compact('expense', 'season'));
    }

    /**
     * Handle an incoming add expense request.
     *
     * @param  \App\Http\Requests\Account\AddExpenseRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddExpenseRequest $request)
    {
		$season = Season::find($request->season_id);
		$this->authorize('create', [Expense::class, $season]);
		
		$this->expenseService->store($request->validated());
		return Response::json(['message' => "Expense added successfully."], 200);
    }
	
    /**
     * Handle an incoming update expense request.
     *
     * @param  \App\Http\Requests\Account\UpdateExpenseRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateExpenseRequest $request)
    {
		$expense = Expense::find($request->expense_id);
		$this->authorize('update', $expense);
		
		$this->expenseService->update($request->validated());
		return Response::json(['message' => "Expense updated successfully."], 200);
    }
	
	/**
     * Handle an incoming delete expense request.
     *
     * @param  \App\Http\Requests\Account\DeleteExpenseRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete(DeleteExpenseRequest $request)
    {
		$expense = Expense::find($request->expense_id);
		$this->authorize('delete', $expense);
		
		$this->expenseService->delete($request->validated()['expense_id']);
		return Response::json(['message' => "Expense deleted successfully."], 200);
    }
	
	/**
     * Handle an incoming permanently delete expense request.
     *
     * @param  \App\Http\Requests\Account\DeleteExpenseRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(DeleteExpenseRequest $request)
    {
		$expense = Expense::withTrashed()->find($request->expense_id);
		$this->authorize('destroy', $expense);
		
		$this->expenseService->destroy($request->validated()['expense_id']);
		return Response::json(['message' => "Expense has been permanently deleted."], 200);
    }
	
	/**
     * Handle an incoming restore deleted expense request.
     *
     * @param  \App\Http\Requests\Account\RestoreExpenseRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function restore(RestoreExpenseRequest $request)
    {
		$expense = Expense::withTrashed()->find($request->expense_id);
		$this->authorize('restore', $expense);
		
		$this->expenseService->restore($request->validated()['expense_id']);
		return Response::json(['message' => "Expense has been restored successfully."], 200);
    }
}
