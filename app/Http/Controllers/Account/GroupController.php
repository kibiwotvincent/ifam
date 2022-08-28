<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Group\CreateGroupRequest;
use App\Http\Requests\Account\Group\GroupReportRequest;
use App\Http\Requests\Account\Group\GroupOnlyReportRequest;
use App\Http\Services\Account\Group\GroupService;
use App\Models\Account\GroupMember;
use App\Models\Account\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\Admin\ChildCategory;

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
		$user = Auth::user();
		$user_groups = $user->groups;
		
		$userGroupIDs = $user->groups()->get()->pluck('group_id')->all();
		
		$groups = Group::inRandomOrder()->limit(10)->get()->except($userGroupIDs);
		
        return view('account.group.groups', compact('groups', 'user_groups'));
    }
	
	/**
     * Display group view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$group = Group::find($request->id);
		
        return view('account.group.group', ['group' => $group]);
    }
	
	/**
     * Display group profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile(Request $request)
    {
		$group = Group::find($request->id);
		$chairperson = $group->members()->chairperson()->first();
		$secretary = $group->members()->secretary()->first();
		$treasurer = $group->members()->treasurer()->first();
		
        return view('account.group.profile', compact('group', 'chairperson', 'secretary', 'treasurer'));
    }
	
	/**
     * Display group report view.
     *
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
		$group = Group::find($request->id);
		
		$departments =  $group->departments();
		$categories =  $group->categories();
		
		$groupStats = $this->groupService->groupStats($group);
		$isAdmin = $request->routeIs('admin.*') ? true : false;
		
        return view('account.group.report', ['group' => $group, 'departments' => $departments, 'categories' => $categories, 'group_stats' => $groupStats, 'is_admin' => $isAdmin]);
    }
	
	/**
     * Display group only report view.
     *
     * @return \Illuminate\View\View
     */
    public function group_only_report(Request $request)
    {	
		$group = Group::find($request->id);
		$seasons = $group->seasons(false);
		
		$departments =  $group->departments(false);
		$categories =  $group->categories(false);
		
        return view('account.group.group_only_report', ['group' => $group, 'seasons' => $seasons, 'departments' => $departments, 'categories' => $categories, 'from' => null, 'to' => null]);
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

	/**
     * Display group report.
     *
     * @param  \App\Http\Requests\Account\Group\GroupReportRequest  $request
     * @return \Illuminate\View\View
     */
    public function group_report(GroupReportRequest $request)
    {
		$group = Group::find($request->id);
		
		$groupStats = $this->groupService->groupStats($group, $request->department, $request->categories, $request->from, $request->to);
		
		$viewData = ['group' => $group, 'groupStats' => $groupStats, 'isAdmin' => (bool) $request->is_admin];
		
		return response()
			->view('components.account.group.group_report_table', $viewData, 200)
			->header('Content-Type', "text/html; charset=UTF-8");
    }
	
	
	/**
     * Display group only report - aggregates group data without merged seasons.
     *
     * @param  \App\Http\Requests\Account\Group\GroupOnlyReportRequest  $request
     * @return \Illuminate\View\View
     */
    public function fetch_group_only_report(GroupOnlyReportRequest $request)
    {	
		$group = Group::find($request->id);
		$seasons = $group->seasons(false, $request->department, $request->categories);
		
		$viewData = ['seasons' => $seasons, 'from' => $request->from, 'to' => $request->to];
		
		return response()
			->view('components.account.group.group_only_report_table', $viewData, 200)
			->header('Content-Type', "text/html; charset=UTF-8");
    }
}
