<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\Season;
use App\Models\Account\Expense;
use App\Http\Requests\Account\AddExpenseRequest;
use App\Http\Services\Account\ExpenseService;
use App\Models\Account\Farm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

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
		$view = ($request->routeIs('group.*')) ? 'account.group.add-expense' : 'account.add-expense';
		
        return view($view, ['season' => $season]);
    }
	
	
	/**
     * Display expense view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$season = Season::find($request->season_id);
		$farm = Farm::find($request->farm_id);
		$expenses = Expense::where('season_id', $request->season_id)->get();
        return view('account.season', ['farm' => $farm, 'season' => $season, 'expenses' => $expenses]);
    }

    /**
     * Handle an incoming add expense request.
     *
     * @param  \App\Http\Requests\Account\AddExpenseRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddExpenseRequest $request)
    {
		$this->expenseService->store($request->validated());
		return Response::json(['message' => "Expense added successfully."], 200);
    }

    
}
