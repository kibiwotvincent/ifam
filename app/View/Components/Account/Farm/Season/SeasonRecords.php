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
	public $canAddSeasonRecord;
	public $canViewSeasonRecord;
	public $canUpdateSeasonRecord;
	
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
		
		$canViewDeletedSeasonRecords = false;
		$canAddSeasonRecord = false;
		$canViewSeasonRecord = false;
		$canUpdateSeasonRecord = false;
		
		$canViewDeletedSeasonRecords = false;
		if($farm->farmable_type == 'App\Models\Account\Group') {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null) {
				$canAddSeasonRecord = $member->can('add group season record');
				$canViewSeasonRecord = $member->can('view group season record');
				$canUpdateSeasonRecord = $member->can('update group season record');
				$canViewDeletedSeasonRecords = $member->can('view deleted group season records');
			}
		}
		else {
			$canAddSeasonRecord = $user->can('add season record');
			$canViewSeasonRecord = $user->can('view season record');
			$canUpdateSeasonRecord = $user->can('update season record');
			$canViewDeletedSeasonRecords = $user->can('view deleted season records');
		}
		
		if($canViewDeletedSeasonRecords) {
			//include deleted season records
			$seasonRecords = $season->records()->withTrashed()->orderBy('record_date', 'desc')->get();
		}
		else {
			//don't include deleted season records
			$seasonRecords = $season->records()->orderBy('record_date', 'desc')->get();
		}
		
		if($canViewSeasonRecord == false) {
			//check allow if user is allowed to view any season record
			$canViewSeasonRecord = $user->can('view any season record');
		}
		
		$this->season = $season;
		$this->records = $seasonRecords;
		$this->isGroup = $farm->isOwnedByGroup;
		$this->canAddSeasonRecord = $canAddSeasonRecord;
		$this->canViewSeasonRecord = $canViewSeasonRecord;
		$this->canUpdateSeasonRecord = $canUpdateSeasonRecord;
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
