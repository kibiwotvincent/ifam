<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Group\UnmergeGroupSeasonRequest;
use App\Http\Services\Account\Group\GroupMergedSeasonService;
use App\Models\Account\Season;
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
		
        return view('account.group.merged_season', ['season' => $season]);
    }
	
    /**
     * Handle an incoming unmerge merged season request.
     *
     * @param  \App\Http\Requests\Account\Group\UnmergeGroupSeasonRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function unmerge(UnmergeGroupSeasonRequest $request)
    {
		$this->groupMergedSeasonService->unmerge($request->validated());
		return Response::json(['message' => "Group season unmerged successfully."], 200);
    }

	
}
