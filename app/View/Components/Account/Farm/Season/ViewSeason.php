<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use \App\Models\Account\Season as SeasonModel;
use Illuminate\Support\Facades\Auth;

class ViewSeason extends Component
{
	public $season;
	public $canDelete;
	public $canRestore;
	public $canDestroy;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, Season $season)
    {
		$user = Auth::user();
		
		//get the farm which season belongs to
		$farm = $season->department->farm;
		
		$canDelete = false;
		$canRestore = false;
		$canDestroy = false;
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			$group = $farm->farmable;
			$member = $group->members()->where('user_id', $user->id)->first();
			if($member != null) {
				$canDelete = $member->can('delete group season');
				$canRestore = $member->can('restore group season');
				$canDestroy = $member->can('permanently delete group season');
			}
		}
		else {
			$canDelete = $user->can('delete season');
			$canRestore = $user->can('restore season');
			$canDestroy = $user->can('permanently delete season');
		}
		
		$this->season = $season;
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
        return view('components.account.farm.season.view_season');
    }
}
