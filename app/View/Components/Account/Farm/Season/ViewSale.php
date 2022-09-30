<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use \App\Models\Account\Sale as SaleModel;
use Illuminate\Support\Facades\Auth;

class ViewSale extends Component
{
	public $season;
	public $sale;
	public $canDelete;
	public $canRestore;
	public $canDestroy;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, Season $season, SaleModel $sale)
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
				$canDelete = $member->can('delete group sale');
				$canRestore = $member->can('restore group sale');
				$canDestroy = $member->can('permanently delete group sale');
			}
		}
		else {
			$canDelete = $user->can('delete sale');
			$canRestore = $user->can('restore sale');
			$canDestroy = $user->can('permanently delete sale');
		}
		
		$this->season = $season;
		$this->sale = $sale;
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
        return view('components.account.farm.season.view_sale');
    }
}
