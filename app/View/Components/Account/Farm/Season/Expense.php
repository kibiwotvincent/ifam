<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use \App\Models\Account\Expense as ExpenseModel;
use Illuminate\Support\Facades\Auth;

class Expense extends Component
{
	public $season;
	public $expense;
	public $canDelete;
	public $canRestore;
	public $canDestroy;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, Season $season, ExpenseModel $expense)
    {
		$user = Auth::user();
		
		//get the farm which season belongs to
		$farm = $season->department->farm;
		
		$canDelete = false;
		$canRestore = false;
		$canDestroy = false;
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null) {
				$canDelete = $member->can('delete group expense');
				$canRestore = $member->can('restore group expense');
				$canDestroy = $member->can('permanently delete group expense');
			}
		}
		else {
			$canDelete = $user->can('delete expense');
			$canRestore = $user->can('restore expense');
			$canDestroy = $user->can('permanently delete expense'); //this is fetched from secretary
		}
		
		$this->season = $season;
		$this->expense = $expense;
		$this->canDelete = $canDelete;
		$this->canRestore = $canRestore;
		$this->canDestroy = $canDestroy;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.expense');
    }
}
