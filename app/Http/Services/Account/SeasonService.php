<?php

namespace App\Http\Services\Account;

use App\Models\Account\Season;
use App\Models\Account\GroupMember;
use App\Models\Account\GroupMergedSeason;
use App\Services\BaseService;

/**
 * Class SeasonService.
 */
class SeasonService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $season
     */
    public function __construct(Season $season)
    {
        $this->model = $season;
    }

    public function store(array $data = []): Season
    {
		$season = Season::create([
			'farm_department_id' => $data['department_id'],
			'name' => $data['name'],
			'description' => $data['description'],
			'start_date' => $data['start_date'],
			'child_category_id' => $data['child_category_id'],
			'child_sub_category_id' => $data['child_sub_category_id'],
			'metadata' => $data['metadata'],
		]);
		
        return  $season;
    }
	
	public function update(array $data = []): Season
    {
		$season = Season::find($data['season_id']);
		
		$season->name = $data['name'];
		$season->description = $data['description'];
		$season->start_date = $data['start_date'];
		$season->end_date = $data['end_date'];
		$season->child_sub_category_id = $data['child_sub_category_id'];
		$season->metadata = $data['metadata'];
		
		$season->save();
		
		//merge season to group
		if($data['merged_group_id'] == null) {
			//delete season's existing merged group
			GroupMergedSeason::where(['season_id' => $data['season_id']])->delete();
		}
		else {
			//re-check this
			$userID = $season->department->farm->farmable['id'];
			$groupMember = GroupMember::where(['user_id' => $userID, 'group_id' => $data['merged_group_id']])->first();
			
			GroupMergedSeason::updateOrCreate(
									['season_id' => $data['season_id']], //check
									['group_id' => $data['merged_group_id'], 'group_member_id' => $groupMember['id']],
								);
		}
		
        return  $season;
    }

}
