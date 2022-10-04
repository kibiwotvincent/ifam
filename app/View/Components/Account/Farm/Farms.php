<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Group;
use Illuminate\Support\Facades\Auth;

class Farms extends Component
{
	public $farms;
	public $isGroup;
	public $canAddFarm;
	public $canViewFarm;
	public $canUpdateFarm;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, Group $group = null)
    {
		$user = Auth::user();
		
		$canViewDeletedFarms = false;
		$canAddFarm = false;
		$canViewFarm = false;
		$canUpdateFarm = false;
		
		if($group != null) {
			$member = $group->members()->where('user_id', $user->id)->first();
			if($member != null) {
				$canAddFarm = $member->can('add group farm');
				$canViewFarm = $member->can('view group farm');
				$canUpdateFarm = $member->can('update group farm');
				$canViewDeletedFarms = $member->can('view deleted group farms');
			}
		}
		else {
			$canAddFarm = $user->can('add farm');
			$canViewFarm = $user->can('view farm');
			$canUpdateFarm = $user->can('update farm');
			$canViewDeletedFarms = $user->can('view deleted farms');
		}
		
		$farmsQuery = ($group != null) ? $group->farms() : $user->farms();
		
		$farmsQuery = ($canViewDeletedFarms) ? $farmsQuery->withTrashed() : $farmsQuery;
		
		$farms = $farmsQuery->orderBy('name', 'asc')->get();
		
		if($canViewFarm == false) {
			//check allow if user is allowed to view any farm
			$canViewFarm = $user->can('view any farm');
		}
		
		$this->farms = $farms;
		$this->canAddFarm = $canAddFarm;
		$this->canViewFarm = $canViewFarm;
		$this->canUpdateFarm = $canUpdateFarm;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.farms');
    }
}
