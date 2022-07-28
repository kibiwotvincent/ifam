<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Group\CreateGroupRequest;
use App\Http\Services\Account\Group\GroupService;
use App\Models\Account\GroupMember;
use App\Models\Account\Group;
use App\Models\Account\Season;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\FarmDepartment;
use App\Models\Account\Admin\ChildCategory;
use App\Models\Account\Admin\ChildSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;

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
		$departments = FarmDepartment::get()
						->map(function($farmDepartment) {
							return $farmDepartment->category;
						})->unique('id');
						
		$categories = collect([]);
		foreach($departments as $category) {
			foreach($category->child_categories as $row) {
				$categories->push($row);
			}
		}
		$categories = $categories->unique('id');
		
		$groupsStats = $this->groupService->groupsStats();
		
        return view('account.admin.groups_report', ['departments' => $departments, 'categories' => $categories, 'groups_stats' => $groupsStats]);
    }
	
	/**
     * Display group report view.
     *
     * @return \Illuminate\View\View
     */
    public function group_report(Request $request)
    {
		$group = Group::find($request->group_id);
		$departments =  $group->departments();
		$categories =  $group->categories();
		
		$groupStats = $this->groupService->groupStats($group);
		$isAdmin = $request->routeIs('admin.*') ? true : false;
		
        return view('account.admin.group_report', ['group' => $group, 'departments' => $departments, 'categories' => $categories, 
		'group_stats' => $groupStats, 'is_admin' => $isAdmin]);
    }
	
	/**
     * Display group only report view.
     *
     * @return \Illuminate\View\View
     */
    public function group_only_report(Request $request)
    {	
		$group = Group::find($request->group_id);
		$seasons = $group->seasons(false);
		
		$departments =  $group->departments(false);
		$categories =  $group->categories(false);
		
        return view('account.admin.group_only_report', ['group' => $group, 'seasons' => $seasons, 'departments' => $departments, 'categories' => $categories, 'from' => null, 'to' => null]);
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

	/**
     * Display groups report - aggregates groups data called from ajax.
     *
     * @return \Illuminate\View\View
     */
    public function fetch_groups_report(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
            'department' => ['nullable', 'numeric'],
            'categories' => ['required', 'array'],
		]);
		
		$validator->after(function ($validator) use ($request) {
			if ($request->from != null && $request->to != null) {
				$from = new Carbon($request->from);
				$to = new Carbon($request->to);
				
				//extra validate `from` date only if `to` date exists
				//`from` date must be before or equals to `to` date
				if($from->gt($to)) {
					$validator->errors()->add(
						'from', "The from must be a date before or equal to to."
					);
				}
				
				//extra validate `to` date only if `from` date exists
				//`to` date must come after or equals to `from` date
				if($to->lt($from)) {
					$validator->errors()->add(
						'from', "The to must be a date after or equal to from."
					);
				}
			}
		});
		
		if ($validator->fails()) {
			//get the first error message
			$errorMessage = $validator->errors()->all()[0];
			
			return response()
					->view('components.common.alert', ['type' => "danger", 'message' => $errorMessage], 200)
					->header('Content-Type', "text/html; charset=UTF-8");
		}
		
		$groupsStats = $this->groupService->groupsStats($request->department, $request->categories, $request->from, $request->to);
		
		$viewData = ['groupsStats' => $groupsStats];
		
		return response()
			->view('components.account.admin.groups_report_table', $viewData, 200)
			->header('Content-Type', "text/html; charset=UTF-8");
    }
}
