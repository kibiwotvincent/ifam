<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Group\AddGroupMemberRequest;
use App\Http\Requests\Account\Group\ApproveGroupMemberRequest;
use App\Http\Requests\Account\Group\RemoveGroupMemberRequest;
use App\Http\Requests\Account\Group\UpdateMemberRequest;
use App\Http\Requests\Account\Group\JoinGroupRequest;
use App\Http\Requests\Account\Group\LeaveGroupRequest;
use App\Http\Requests\Account\Group\CancelJoinRequest;
use App\Http\Requests\Account\Group\GroupMemberReportRequest;
use App\Http\Services\Account\Group\GroupMemberService;
use App\Models\Account\Group;
use App\Models\Account\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class GroupMemberController extends Controller
{
	
    protected $groupMemberService;

    /**
     * GroupMemberController constructor.
     *
     * @param  GroupMemberService  $groupMemberService
	 * @return void
     */
    public function __construct(GroupMemberService $groupMemberService)
    {
        $this->groupMemberService = $groupMemberService;
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
		$groups = Group::inRandomOrder()->limit(10)->get();
		
        return view('account.group.groups', ['groups' => $groups]);
    }
	
	/**
     * Display group view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$group = Group::find($request->group_id);
		$member = GroupMember::withNotAccepted()->find($request->member_id);
		
        return view('account.group.member', compact('group', 'member'));
    }

    /**
     * Handle an incoming add group member request.
     *
     * @param  \App\Http\Requests\Account\AddGroupMemberRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddGroupMemberRequest $request)
    {
		$this->groupMemberService->store($request->validated());
		return Response::json(['message' => "Member has been added to the group successfully."], 200);
    }

    /**
     * Handle an incoming join group request.
     *
     * @param  \App\Http\Requests\Account\JoinGroupRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function join(JoinGroupRequest $request)
    {
		$this->groupMemberService->join($request->validated());
		return Response::json(['message' => "Your request has been submitted to group officials."], 200);
    }
	
	/**
     * Handle an incoming approve group member request.
     *
     * @param  \App\Http\Requests\Account\Group\ApproveGroupMemberRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function approve(ApproveGroupMemberRequest $request)
    {
		$this->groupMemberService->approve($request->validated());
		return Response::json(['message' => "Member has been approved successfully."], 200);
    }
	
	/**
     * Handle an incoming leave group request.
     *
     * @param  \App\Http\Requests\Account\Group\LeaveGroupRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function leave(LeaveGroupRequest $request)
    {
		$this->groupMemberService->leave($request->validated());
		return Response::json(['message' => "You have successfully left the group."], 200);
    }
	
	/**
     * Handle an incoming remove group member request.
     *
     * @param  \App\Http\Requests\Account\Group\RemoveGroupMemberRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function remove(RemoveGroupMemberRequest $request)
    {
		$this->groupMemberService->remove($request->validated());
		return Response::json(['message' => "Member has been removed successfully from the group."], 200);
    }
	
	/**
     * Handle an incoming cancel join request.
     *
     * @param  \App\Http\Requests\Account\Group\CancelJoinRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function cancel(CancelJoinRequest $request)
    {
		$this->groupMemberService->cancel($request->validated());
		return Response::json(['message' => "You have successfully cancelled your request to join group."], 200);
    }
	
	/**
     * Handle an incoming update member request.
     *
     * @param  \App\Http\Requests\Account\Group\UpdateMemberRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateMemberRequest $request)
    {
		$this->groupMemberService->update($request->validated());
		$position = ucfirst($request->position);
		
		return Response::json(['message' => $position." has been updated successfully."], 200);
    }
	
	/**
     * Display group member report view.
     *
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
		$group = Group::find($request->group_id);
		$member = $group->members->only([$request->member_id])->first();
		
		$seasons = $member->mergedSeasons(null, null);
		
		$departments = $member->departments();
		$categories = $member->categories();
		
        return view('account.group.group_member_report', ['group' => $group, 'member' => $member, 'seasons' => $seasons, 'departments' => $departments, 'categories' => $categories, 'from' => null, 'to' => null]);
    }
	
	/**
     * Display group member report usually called from ajax.
     *
     * @param  \App\Http\Requests\Account\Group\GroupMemberReportRequest  $request
     * @return \Illuminate\View\View
     */
    public function fetch_report(GroupMemberReportRequest $request)
    {	
		$member = GroupMember::find($request->member_id);
		
		$seasons = $member->mergedSeasons($request->department, $request->categories);
		
		$viewData = ['seasons' => $seasons, 'from' => $request->from, 'to' => $request->to];
		
		return response()
			->view('components.account.group.group_member_report_table', $viewData, 200)
			->header('Content-Type', "text/html; charset=UTF-8");
    }
}
