<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use Illuminate\Support\Facades\Auth;

class Expenses extends Component
{
	public $season;
	public $expenses;
	public $isGroup;
	public $canAddExpense;
	public $canViewExpense;
	public $canUpdateExpense;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
		$season = Season::find($request->season_id);
		$user = Auth::user();
		
		//get the farm which season belongs to
		$farm = $season->department->farm;
		
		$canViewDeletedExpenses = false;
		$canAddExpense = false;
		$canViewExpense = false;
		$canUpdateExpense = false;
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null) {
				$canAddExpense = $member->can('add group expense');
				$canViewExpense = $member->can('view group expense');
				$canUpdateExpense = $member->can('update group expense');
				$canViewDeletedExpenses = $member->can('view deleted group expenses');
			}
		}
		else {
			$canAddExpense = $user->can('add expense');
			$canViewExpense = $user->can('view expense');
			$canUpdateExpense = $user->can('update expense');
			$canViewDeletedExpenses = $user->can('view deleted expenses');
		}
		
		if($canViewDeletedExpenses) {
			//include deleted expenses
			$expenses = $season->expenses()->withTrashed()->orderBy('date_incurred', 'desc')->get();
		}
		else {
			//don't include deleted expenses
			$expenses = $season->expenses()->orderBy('date_incurred', 'desc')->get();
		}
		
		if($canViewExpense == false) {
			//check allow if user is allowed to view any expense
			$canViewExpense = $user->can('view any expense');
		}
		
		$this->season = $season;
		$this->expenses = $expenses;
		$this->isGroup = $farm->isOwnedByGroup;
		$this->canAddExpense = $canAddExpense;
		$this->canViewExpense = $canViewExpense;
		$this->canUpdateExpense = $canUpdateExpense;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.expenses');
    }
}
