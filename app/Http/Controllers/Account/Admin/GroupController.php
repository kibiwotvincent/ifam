<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Group\CreateGroupRequest;
use App\Http\Services\Account\Group\GroupService;
use App\Models\Account\GroupMember;
use App\Models\Account\Group;
use App\Models\Account\Season;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\Admin\ChildCategory;
use App\Models\Account\Admin\ChildSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
	
    protected $groupService;

    /**
     * GroupController constructor.
     *
     * @param  GroupService  $groupService
	 * @return void
     */
    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }
	
    /**
     * Display the create group view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('account.group.create-group');
    }
	
	/**
     * Display groups view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$groups = Group::orderBy('name', 'asc')->get();
		
        return view('account.admin.groups', compact('groups'));
    }
	
	/**
     * Display groups report view.
     *
     * @return \Illuminate\View\View
     */
    public function groups_report()
    {
		$departments = FarmCategory::orderBy('name', 'asc')->get();
		$childCategories = ChildCategory::orderBy('name', 'asc')->get();
		
		$groupsStats = $this->groupService->groupsStats();
		
        return view('account.admin.groups_report', ['departments' => $departments, 'child_categories' => $childCategories, 'groups_stats' => $groupsStats]);
    }
	
	/**
     * Display groups report view.
     *
     * @return \Illuminate\View\View
     */
    public function group_report(Request $request)
    {
		$group = Group::find($request->group_id);
		$departments = FarmCategory::orderBy('name', 'asc')->get();
		$childCategories = ChildCategory::orderBy('name', 'asc')->get();
		
		$groupStats = $this->groupService->groupStats($group);
		
        return view('account.admin.group_report', ['group' => $group, 'departments' => $departments, 'child_categories' => $childCategories, 
		'group_stats' => $groupStats]);
    }
	
	/**
     * Display groups report view.
     *
     * @return \Illuminate\View\View
     */
    public function group_member_report(Request $request)
    {
		$group = Group::find($request->group_id);
		$member = $group->members->only([$request->member_id])->first();
		
		$groupMemberMergedSeasons = $group->merged_seasons()->where('group_member_id', $member['id'])->get();
		$seasons = [];
		foreach($groupMemberMergedSeasons as $mergedSeason) {
			//pick selected member's seasons
			array_push($seasons, $mergedSeason->season);
		}
		
		$departments = FarmCategory::orderBy('name', 'asc')->get();
		$childCategories = ChildCategory::orderBy('name', 'asc')->get();
		
		$groupsStats = $this->groupService->groupsStats();
		
        return view('account.admin.group_member_report', ['group' => $group, 'member' => $member, 'merged_seasons' => $groupMemberMergedSeasons, 'departments' => $departments, 'child_categories' => $childCategories]);
    }
	
	/**
     * Display groups report view.
     *
     * @return \Illuminate\View\View
     */
    public function group_only_report(Request $request)
    {
		$departments = FarmCategory::orderBy('name', 'asc')->get();
		$childCategories = ChildCategory::orderBy('name', 'asc')->get();
		
		$group = Group::find($request->group_id);
		$seasons = $group->seasons(false);
		
        return view('account.admin.group_only_report', ['group' => $group, 'seasons' => $seasons, 'departments' => $departments, 'child_categories' => $childCategories]);
    }
	
	/**
     * Display group view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$group = Group::find($request->group_id);
		
        return view('account.admin.group', ['group' => $group]);
    }

    /**
     * Handle an incoming create group request.
     *
     * @param  \App\Http\Requests\Account\CreateGroupRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateGroupRequest $request)
    {
		$this->groupService->store($request->validated());
		return Response::json(['message' => "Group created successfully."], 200);
    }

	
}
