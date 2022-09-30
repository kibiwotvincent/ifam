<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use \App\Models\Account\SeasonRecord as SeasonRecordModel;
use Illuminate\Support\Facades\Auth;

class ViewSeasonRecord extends Component
{
	public $season;
	public $seasonRecord;
	public $canDelete;
	public $canRestore;
	public $canDestroy;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, Season $season, SeasonRecordModel $seasonRecord)
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
				$canDelete = $member->can('delete group season record');
				$canRestore = $member->can('restore group season record');
				$canDestroy = $member->can('permanently delete group season record');
			}
		}
		else {
			$canDelete = $user->can('delete season record');
			$canRestore = $user->can('restore season record');
			$canDestroy = $user->can('permanently delete season record');
		}
		
		$this->season = $season;
		$this->seasonRecord = $seasonRecord;
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
        return view('components.account.farm.season.view_season_record');
    }
}
