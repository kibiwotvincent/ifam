<?php

namespace App\Http\Services\Account\Group;

use App\Services\BaseService;
use App\Models\Account\GroupMergedSeason;

/**
 * Class GroupMergedSeasonService.
 */
class GroupMergedSeasonService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $groupMergedSeasonService
     */
    public function __construct(GroupMergedSeason $groupMergedSeason)
    {
        $this->model = $groupMergedSeason;
    }
	
	public function unmerge(array $data = [])
    {
		GroupMergedSeason::where([
			'id' => $data['id'],
		])->delete();
		
        return null;
    }
	
}
