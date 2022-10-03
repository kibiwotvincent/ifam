<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Farm;
use \App\Models\Account\Season;
use \App\Models\Account\FarmDepartment as FarmDepartmentModel;
use Illuminate\Support\Facades\Auth;

class FarmDepartment extends Component
{
	public $farm;
	public $department;
	public $page;
	
	public $seasons;
	public $isGroup;
	public $canAddSeason;
	public $canViewSeason;
	public $canUpdateSeason;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $page = "farmer")
    {
		$department = FarmDepartmentModel::find($request->department_id);
		$user = Auth::user();
		
		//get the farm which season belongs to
		$farm = $department->farm;
		
		$canViewDeletedSeasons = false;
		$canAddSeason = false;
		$canViewSeason = false;
		$canUpdateSeason = false;
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null) {
				$canAddSeason = $member->can('add group season');
				$canViewSeason = $member->can('view group season');
				$canUpdateSeason = $member->can('update group season');
				$canViewDeletedSeasons = $member->can('view deleted group seasons');
			}
		}
		else {
			$canAddSeason = $user->can('add season');
			$canViewSeason = $user->can('view season');
			$canUpdateSeason = $user->can('update season');
			$canViewDeletedSeasons = $user->can('view deleted seasons');
		}
		
		if($canViewDeletedSeasons) {
			//include deleted seasons
			$seasons = $department->seasons()->withTrashed()->orderBy('start_date', 'desc')->get();
		}
		else {
			//don't include deleted seasons
			$seasons = $department->seasons()->orderBy('start_date', 'desc')->get();
		}
		
		if($canViewSeason == false) {
			//check allow if user is allowed to view any season
			$canViewSeason = $user->can('view any season');
		}
		
		$this->farm = Farm::find($request->farm_id);
		$this->page = $page;
		$this->department = $department;
		
		$this->seasons = $seasons;
		$this->isGroup = $farm->isOwnedByGroup;
		$this->canAddSeason = $canAddSeason;
		$this->canViewSeason = $canViewSeason;
		$this->canUpdateSeason = $canUpdateSeason;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.farm-department');
    }
}
