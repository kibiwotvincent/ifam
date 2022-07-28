<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Account\Group\GroupMergedSeasonService;
use App\Models\Account\Season;
use App\Models\Account\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GroupMergedSeasonController extends Controller
{
	
    protected $groupMergedSeasonService;

    /**
     * GroupMergedSeasonController constructor.
     *
     * @param  GroupMergedSeasonService  $groupMergedSeasonService
	 * @return void
     */
    public function __construct(GroupMergedSeasonService $groupMergedSeasonService)
    {
        $this->groupMergedSeasonService = $groupMergedSeasonService;
    }
	
	/**
     * Display group merged season view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$season = Season::find($request->season_id);
		$member = GroupMember::find($request->member_id);
		
        return view('account.admin.merged_season', ['season' => $season, 'member' => $member]);
    }
	
}
