<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use Illuminate\Support\Facades\Auth;

class SeasonRecords extends Component
{
	public $season;
	public $records;
	public $isGroup;
	public $readOnly;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, bool $isGroup, bool $readOnly)
    {
		$season = Season::find($request->season_id);
		$user = Auth::user();
		
		//get the farm which season belongs to
		$farm = $season->department->farm;
		
		$canViewDeletedSeasonRecords = false;
		if($farm->farmable_type == 'App\Models\Account\Group') {
			$group = $farm->farmable;
			$member = $group->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('view deleted group season records')) {
				$canViewDeletedSeasonRecords = true;
			}
		}
		else {
			if($user->can('view deleted season records')) {
				$canViewDeletedSeasonRecords = true;
			}
		}
		
		if($canViewDeletedSeasonRecords) {
			//include deleted season records
			$seasonRecords = $season->records()->withTrashed()->orderBy('record_date', 'desc')->get();
		}
		else {
			//don't include deleted season records
			$seasonRecords = $season->records()->orderBy('record_date', 'desc')->get();
		}
		
		$this->season = $season;
		$this->records = $seasonRecords;
		$this->isGroup = $isGroup;
		$this->readOnly = $readOnly;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.season-records');
    }
}
